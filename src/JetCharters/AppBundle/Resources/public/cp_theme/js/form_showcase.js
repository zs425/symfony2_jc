$(function() {
        // add uniform plugin styles to html elements
        // $("input:checkbox, input:radio").uniform();

        // select2 plugin for select elements
        $(".select2").select2({
            placeholder: "Select a State"
        });

        // datepicker plugin
        // $('[type=date]').datepicker().on('changeDate', function (ev) {
        //     $(this).datepicker('hide');
        // });

        // wysihtml5 plugin on textarea
        $(".wysihtml5").wysihtml5({
            "font-styles": false
        });

        $('.date').datepicker();
	
    });

$(document).ready(function() { 
    $(".autoCompleteWidget select").select2({ placeholder: "Select"}); 
});

/*var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC"];
    

$(document).ready(function(){
   $( "#jaetcharters_appbundle_emptyleg_origin" ).autocomplete({
       source: availableTags, //"/assets/ajax/getAircraftName.cfm",
       autoFocus: true,
       minLength: 3
   });
});*/

// TODO: Add autocomplete
//     $(document).ready(function()
// {
//   $( "#name" ).autocomplete({
//       source: "/assets/ajax/getAircraftName.cfm",
//       autoFocus: true,
//       minLength: 3
//   });
//   $( "#location" ).autocomplete({
//       source: "/assets/ajax/getAirport.cfm",
//       autoFocus: true,
//       minLength: 3
//   });
// })