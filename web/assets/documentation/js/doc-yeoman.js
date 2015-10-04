!function ($) {
  $(function(){
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
      var msViewportStyle = document.createElement("style");
      msViewportStyle.appendChild(
        document.createTextNode(
          "@-ms-viewport{width:auto!important}"
        )
      );
      document.getElementsByTagName("head")[0].
        appendChild(msViewportStyle);
    }


    var $window = $(window)
    var $body   = $(document.body)

    var navHeight = $('.navbar').outerHeight(true) + 10

    $body.scrollspy({
      target: '.ndoboost-sidebar',
      offset: navHeight
    })

    $window.on('load', function () {
      $body.scrollspy('refresh')
    })

})

}(jQuery);

var BlankonDocumentation = function () {

    // =========================================================================
    // SETTINGS APP
    // =========================================================================
    var globalPluginsPath   = '../../../assets/global/plugins/bower_components',
        targetListPath      = 'http://localhost:9000/#';

    return {

        // =========================================================================
        // CONSTRUCTOR APP
        // =========================================================================
        init: function () {
            BlankonDocumentation.handleCodePrettify();
            BlankonDocumentation.handleChosenSelect();
            BlankonDocumentation.handleDatatables();
            BlankonDocumentation.handleSmoothScroll();
            BlankonDocumentation.handleSidebarResponsive();
        },

        // =========================================================================
        // CODE PRETTIFY
        // =========================================================================
        handleCodePrettify: function () {
            $('.tooltips').tooltip({
                selector: "[data-toggle=tooltip]",
                container: "body"
            })
            $("pre.html-code").snippet("html",{style:"matlab",clipboard: globalPluginsPath+"/jquery-snippet/ZeroClipboard.swf"});
            $("pre.html-code-no-menu").snippet("html",{style:"matlab",menu: false});
            $("pre.css-code").snippet("css",{style:"matlab",clipboard: globalPluginsPath+"/jquery-snippet/ZeroClipboard.swf"});
            $("pre.js-code").snippet("javascript",{style:"matlab",clipboard: globalPluginsPath+"/jquery-snippet/ZeroClipboard.swf"});
        },

        // =========================================================================
        // CHOSEN SELECT
        // =========================================================================
        handleChosenSelect: function () {
            $('.chosen-select').chosen();
            function targetList(selector, wrap){
                $(selector).change(function(){
                    $( selector + ' option:selected').each(function(){
                        var id = $(selector).val();
                        $(wrap).hide();
                        $('#' + id).fadeIn();
                        return;
                    });
                }).change();
            }
            targetList('#plugins-list','.plugins-wrap');
            targetList('#widgets-list','.widgets-wrap');

            function targetListRedirect(selector){
                $(selector).change(function(){
                    var url = $(this).val(); // get selected value
                    if(url == '#'){
                        return false;
                    }
                    if (url) { // require a URL
                        window.open(targetListPath+'/'+url, '_blank') ; // redirect
                    }
                    return false;
                }).change();
            }
            targetListRedirect('#components-list');
            targetListRedirect('#quick-search-list');
        },

        // =========================================================================
        // DATATABLES
        // =========================================================================
        handleDatatables: function () {
            var responsiveHelperDom = undefined;
            var breakpointDefinition = {
                tablet: 1024,
                phone : 480
            };

            var tableDom = $('.datatable');
            tableDom.dataTable({
                autoWidth        : false,
                preDrawCallback: function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelperDom) {
                        responsiveHelperDom = new ResponsiveDatatablesHelper(tableDom, breakpointDefinition);
                    }
                },
                rowCallback    : function (nRow) {
                    responsiveHelperDom.createExpandIcon(nRow);
                },
                drawCallback   : function (oSettings) {
                    responsiveHelperDom.respond();
                }
            });
        },

        // =========================================================================
        // SMOOTH SCROLL PAGE
        // =========================================================================
        handleSmoothScroll: function () {
            $('.ndoboost-sidenav a').smoothScroll();
        },

        // =========================================================================
        // SIDEBAR RESPONSIVE
        // =========================================================================
        handleSidebarResponsive: function () {
            // Optimalisation: Store the references outside the event handler:
            var $window = $(window);
            function checkWidth() {
                var windowsize = $window.width();
                // Check if view screen on greater then 720px and smaller then 1024px
                if (windowsize >= 1366) {
                    $('body').find('.container-fluid').removeClass('container-fluid').addClass('container');
                }
                else{
                    $('body').find('.container').removeClass('container').addClass('container-fluid');
                }
            }
            // Execute on load
            checkWidth();
            // Bind event listener
            $(window).resize(checkWidth);
        }

    };

}();

// Call main app init
BlankonDocumentation.init();