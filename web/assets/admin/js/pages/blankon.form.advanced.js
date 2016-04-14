var BlankonFormAdvanced = function () {

    return {

        // =========================================================================
        // CONSTRUCTOR APP
        // =========================================================================
        init: function () {
            BlankonFormAdvanced.bootstrapSwitch();
            BlankonFormAdvanced.inputMask();
            BlankonFormAdvanced.bootstrapDatepicker();
            BlankonFormAdvanced.bootstrapColorpicker();
            BlankonFormAdvanced.dropzone();
        },

        // =========================================================================
        // BOOTSTRAP SWITCH
        // =========================================================================
        bootstrapSwitch: function () {
            if($('.switch').length){
                $('.switch').bootstrapSwitch();
            }
        },

        // =========================================================================
        // JQUERY INPUTMASK
        // =========================================================================
        inputMask: function () {
            if($('#input-mask').length){
                $(":input").inputmask();
            }
        },

        // =========================================================================
        // BOOTSTRAP DATEPICKER
        // =========================================================================
        bootstrapDatepicker: function () {
            if($('#dp').length){
                $('#dp1').datepicker({
                    format: 'mm-dd-yyyy',
                    todayBtn: 'linked'
                });

                $('#dp2').datepicker();
                $('#btn2').click(function(e){
                    e.stopPropagation();
                    $('#dp2').datepicker('update', '03/17/12');
                });

                //inline
                $('#dp3').datepicker({
                    todayBtn: 'linked'
                });

                $('#btn3').click(function(){
                    $('#dp3').datepicker('update', '15-05-1984');
                });
            }
        },

        // =========================================================================
        // BOOTSTRAP COLORPICKER
        // =========================================================================
        bootstrapColorpicker: function () {
            // With hex format
            $('.colorpicker-1').colorpicker();

            // As a component
            $('.colorpicker-2').colorpicker();

            // Transparent color support
            $('.colorpicker-3').colorpicker();

            // Horizonal mode
            $('.colorpicker-4').colorpicker({
                format: 'rgba', // force this format
                horizontal: true
            });

            // Inline mode
            $('.colorpicker-5').colorpicker();

            // Bootstrap colors
            $('.colorpicker-6').colorpicker({
                colorSelectors: {
                    'default': '#777777',
                    'primary': '#337ab7',
                    'success': '#5cb85c',
                    'info': '#5bc0de',
                    'warning': '#f0ad4e',
                    'danger': '#d9534f'
                }
            });

            // Custom widget size
            $('.colorpicker-7').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 200,
                        maxTop: 200
                    },
                    hue: {
                        maxTop: 200
                    },
                    alpha: {
                        maxTop: 200
                    }
                }
            });

            // Bootstrap Modal
            $('.colorpicker-8').colorpicker();

            // Using events
            var bodyStyle = $('.body-content')[0].style;
            $('.colorpicker-9').colorpicker({
                color: bodyStyle.backgroundColor
            }).on('changeColor', function(ev) {
                bodyStyle.backgroundColor = ev.color.toHex();
            });
        },

        // =========================================================================
        // DROPZONE UPLOAD
        // =========================================================================
        dropzone: function () {
            Dropzone.options.myDropzone = {
                init: function() {
                    this.on("addedfile", function(file) {
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-block btn-danger'>Remove file</button>");

                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                            // Make sure the button click doesn't submit the form:
                            e.preventDefault();
                            e.stopPropagation();

                            // Remove the file preview.
                            _this.removeFile(file);
                            // If you want to the delete the file on the server as well,
                            // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });
                }
            }
        }

    };

}();

// Call main app init
BlankonFormAdvanced.init();