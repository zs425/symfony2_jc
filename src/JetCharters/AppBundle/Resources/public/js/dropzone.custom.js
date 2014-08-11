function populate(dz)
{
    $.ajax({
        dataType: "json",
        url: dz.element.dataset.existing,
        success: function(response) {
            if (response.length > 0) {
                $(dz.element).children(".dz-default.dz-message").hide();
            }
            for (var i = response.length - 1; i >= 0; i--) {
                var f = {
                    name: response[i].name,
                    size: response[i].size
                };
                dz.emit("addedfile", f);
                dz.emit("thumbnail", f, response[i].path);
                dz.emit("resize", f);
            };
        }
    });
}

function removeFile(dz, file)
{
    $.ajax({
        type: "DELETE",
        dataType: "json",
        url: dz.element.dataset.deleteurl + '/' + file.previewElement.querySelector("[data-dz-name]").textContent,
        success: function(response) {
            var _ref;
            if ((_ref = file.previewElement) != null) {
                _ref.parentNode.removeChild(file.previewElement);
            }
            return dz._updateMaxFilesReachedClass();
        }
    });
}


Dropzone.options.dropzoneImageUpload = {
    dictDefaultMessage: "Drop files or click within the box to upload.",
    addRemoveLinks: true,
    drop: function() {
        $(".dropzone .dz-default.dz-message").hide();
    },
    success: function(file, serverResponse, event) {
        file.previewElement.querySelector("[data-dz-name]").textContent = serverResponse.id;
        file.previewElement.querySelectorAll("[data-dz-thumbnail]").alt = serverResponse.id;

        return file;
    },
    init: function() {
        populate(this);
    },
    removedfile: function(file) {
        removeFile(this, file);
    }
};

Dropzone.options.dropzoneVideoUpload = {
    dictDefaultMessage: "Drop files or click within the box to upload.",
    addRemoveLinks: true,
    previewTemplate: '<div class="dz-preview dz-file-preview"> <a href="javascript:undefined;" class="btn btn-block preview-btn" style="display:none">Preview</a> <div class="dz-details"> <div class="dz-filename"><span data-dz-name></span></div> <div class="dz-size" data-dz-size></div> <div class="dz-videoembed" data-dz-videoembed></div> <img data-dz-thumbnail /> </div> <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div> <div class="dz-success-mark"><span>✔</span></div> <div class="dz-error-mark"><span>✘</span></div> <div class="dz-error-message"><span data-dz-errormessage></span></div> </div>',
    drop: function() {
        $(".dropzone .dz-default.dz-message").hide();

    },
    thumbnail: function(file, dataUrl)
    {

    	_this = this;
    	// console.log(_this.element.dataset);
		$(".preview-btn").show();
		$(".preview-btn").off("click");
		$(".preview-btn").click(function()
		{
			_button = this;
			var id = $(_button).parent().find("[data-dz-name]").html();
			$(_button).text("Loading...").attr("disabled", "disabled");

		    $.ajax(
		    {
		        type: "GET",
		        dataType: "json",
		        url: _this.element.dataset.embedurl + '/' + id,
		        success: function(response)
		        {
		        	$('#video-modal').children(".modal-body")
		        		.html(response.embed);
		        	$('#video-modal').modal('show');
		        	$(_button).text("Preview").removeAttr("disabled");
		        }
		    });
		});

        var thumbnailElement, _i, _len, _ref, _results;
        file.previewElement.classList.remove("dz-file-preview");
        file.previewElement.classList.add("dz-image-preview");
        _ref = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          thumbnailElement = _ref[_i];
          thumbnailElement.alt = file.name;
          _results.push(thumbnailElement.src = dataUrl);
        }
        return _results;
    },
    success: function(file, serverResponse, event) {
        file.previewElement.querySelector("[data-dz-name]").textContent = serverResponse.id;
        file.previewElement.querySelectorAll("[data-dz-thumbnail]").alt = serverResponse.id;
    	$(".preview-btn").show();


        // TODO: Make preview work on drop success
    	_this = this;
		$(file.previewElement).find(".preview-btn").click(function(){
				var id = serverResponse.id;
				_button = this;
				$(_button).text("Loading...").attr("disabled", "disabled");

			    $.ajax({
			        type: "GET",
			        dataType: "json",
			        url: _this.element.dataset.embedurl + '/' + id,
			        success: function(response) {
			        	$('#video-modal').children(".modal-body")
			        		.html(response.embed);
			        	$('#video-modal').modal('show');
			        	$(_button).text("Preview").removeAttr("disabled");
			        }
			    });
			});

        return file;
    },
    init: function() {
        populate(this);


    },
    removedfile: function(file) {
        removeFile(this, file);
    }
};
