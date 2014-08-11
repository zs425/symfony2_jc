(function ($) {
    //Plugin Function
    $.fn.actionInView = function(options) {
        var elements = [],
            defaults = {
                before: function(el){},
                action: function(el){},
                viewportFactor : 1
            },
            vars = $.extend({}, defaults, options),
            view_height;
        this.each(function(){
            var $this = $(this);
            var top_sect = $this.offset().top;
            console.log(top_sect);
            elements.push({
                obj: $this,
                top: top_sect,
                height: $this.outerHeight(true),
                inView: false
            });
            vars.before(this);
        });

        function initTopView(){
            if (vars.viewportFactor > 1){
                view_height = vars.viewportFactor;
            } else if(vars.viewportFactor < 0) {
                view_height= $(window).height() + vars.viewportFactor;
            } else {
                view_height= $(window).height()* vars.viewportFactor;
            }
        }
        initTopView();
        function initTopPoints(){
            initTopView();
            for(var key in elements){
                elements[key].top = elements[key].obj.offset().top;
                elements[key].height = elements[key].obj.outerHeight(true);
            }
        }
        $(window).resize(function(){
            initTopPoints();
        });
        function scroller(){
            var win_top = $(window).scrollTop();
            for(var key=0; key< elements.length; key++){
                if (!elements[key].inView){
                    if (elements[key].top + elements[key].height > win_top && win_top+view_height > elements[key].top ) {
                        elements[key].inView = true;
                        vars.action(elements[key].obj);
                        elements.splice(key, 1);
                    }
                }
            }
        }
        $(window).scroll(function(){
            scroller();
        });
//        $(function() {
            setTimeout(function(){
                scroller();
            }, 100);
//        });
    }

})(jQuery);