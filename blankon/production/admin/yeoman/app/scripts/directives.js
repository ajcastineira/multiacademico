// =========================================================================
// DIRECTIVE APP
// =========================================================================
'use strict';
(function(){
angular.module('blankonDirective', [])

    // =========================================================================
    // REFRESH PANEL
    // =========================================================================
    .directive('refreshPanel', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                element.click(function(){
                    var targetElement = $(this).parents('.panel').find('.panel-body');
                    targetElement.append('<div class="indicator"><span class="spinner"></span></div>');
                    setInterval(function(){
                        $.getJSON('../../../assets/admin/data/reload-sample.json', function(json) {
                            $.each(json, function() {
                                // Retrieving data from json...
                                console.log('Retrieving data from json...');
                            });
                            targetElement.find('.indicator').hide();
                        });
                    },5000);
                });
            }
        };
    })

    // =========================================================================
    // COLLAPSE PANEL
    // =========================================================================
    .directive('collapsePanel', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                element.click(function(){
                    var targetCollapse = $(this).parents('.panel').find('.panel-body'),
                        targetCollapse2 = $(this).parents('.panel').find('.panel-sub-heading'),
                        targetCollapse3 = $(this).parents('.panel').find('.panel-footer')
                    if((targetCollapse.is(':visible'))) {
                        $(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
                        targetCollapse.slideUp();
                        targetCollapse2.slideUp();
                        targetCollapse3.slideUp();
                    }else{
                        $(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
                        targetCollapse.slideDown();
                        targetCollapse2.slideDown();
                        targetCollapse3.slideDown();
                    }
                });
            }
        };
    })

    // =========================================================================
    // REMOVE PANEL
    // =========================================================================
    .directive('removePanel', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                element.click(function(){
                    $(this).parents('.panel').fadeOut();
                });
            }
        };
    })

    // =========================================================================
    // EXPAND PANEL
    // =========================================================================
    .directive('expandPanel', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                element.click(function(){
                    if(element.parents(".panel").hasClass('panel-fullsize'))
                    {
                        $('body').find('.panel-fullsize-backdrop').remove();
                        element.data('bs.tooltip').options.title = 'Expand';
                        element.parents(".panel").removeClass('panel-fullsize');
                    }
                    else
                    {
                        $('body').append('<div class="panel-fullsize-backdrop"></div>');
                        element.data('bs.tooltip').options.title = 'Minimize';
                        element.parents(".panel").addClass('panel-fullsize');
                    }
                });
            }
        };
    })

    // =========================================================================
    // SEARCH PANEL
    // =========================================================================
    .directive('searchPanel', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                element.click(function(){
                    element.parents('.panel').find('.panel-search').toggle(100);
                    return false;
                });
            }
        };
    })

    // =========================================================================
    // TOOLTIP
    // =========================================================================
    .directive('tooltip', function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                $(element).hover(function(){
                    // on mouseenter
                    $(element).tooltip('show');
                }, function(){
                    // on mouseleave
                    $(element).tooltip('hide');
                });
            }
        };
    })

    // =========================================================================
    // GO TO TOP TRIGGER
    // =========================================================================
    .directive('backTop', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.hide();
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        element.addClass('show animated pulse');
                    } else {
                        element.removeClass('show animated pulse');
                    }
                });
                // scroll body to 0px on click
                element.click(function () {
                    // Add sound
                    ion.sound.play("cd_tray");
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            }
        }
    })

    // =========================================================================
    // NICESCROLL
    // =========================================================================
    .directive('nicescroll', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.niceScroll({
                    cursorwidth: '3px',
                    cursorborder: '0px'
                });
            }
        }
    })

    // =========================================================================
    // CHOSEN SELECT
    // =========================================================================
    .directive('chosenSelect', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.chosen();
            }
        }
    })

    // =========================================================================
    // FULLSCREEN
    // =========================================================================
    .directive('fullscreen', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                var state;
                element.on('click', function() {
                    state = !state;
                    if (state) {
                        // Trigger for fullscreen
                        // Add effect sound bell ring
                        if($('.page-sound').length){
                            ion.sound.play("bell_ring");
                        }
                        $(this).toggleClass('fg-theme');
                        $(this).attr('data-original-title','Exit Fullscreen');
                        var docElement, request;
                        docElement = document.documentElement;
                        request = docElement.requestFullScreen || docElement.webkitRequestFullScreen || docElement.mozRequestFullScreen || docElement.msRequestFullScreen;
                        if(typeof request!="undefined" && request){
                            request.call(docElement);
                        }
                    } else {
                        // Trigger for exit fullscreen
                        // Add effect sound bell ring
                        if($('.page-sound').length){
                            ion.sound.play("bell_ring");
                        }
                        $(this).removeClass('fg-theme');
                        $(this).attr('data-original-title','Fullscreen')
                        var docElement, request;
                        docElement = document;
                        request = docElement.cancelFullScreen|| docElement.webkitCancelFullScreen || docElement.mozCancelFullScreen || docElement.msCancelFullScreen || docElement.exitFullscreen;
                        if(typeof request!="undefined" && request){
                            request.call(docElement);
                        }
                    }
                });
            }
        }
    })

    // =========================================================================
    // CLEAR ALL COOKIE
    // =========================================================================
    .directive('resetSetting', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.on('click', function(){
                    var cookies = $.cookie();
                    for(var cookie in cookies) {
                        $.removeCookie(cookie);
                    }
                    location.reload(true);
                });
            }
        }
    })

    // =========================================================================
    // BOX MODAL
    // =========================================================================
    .directive('setting', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.on('click', function(){
                    // Add sound
                    ion.sound.play('camera_flashing');
                    bootbox.dialog({
                        message: 'I am a custom dialog setting',
                        title: 'Custom setting',
                        className: 'modal-success modal-center',
                        buttons: {
                            success: {
                                label: 'Success!',
                                className: 'btn-success',
                                callback: function() {
                                    alert('You are so calm!');
                                }
                            },
                            danger: {
                                label: 'Danger!',
                                className: 'btn-danger',
                                callback: function() {
                                    alert('You are so hot!');
                                }
                            },
                            main: {
                                label: 'Click ME!',
                                className: 'btn-primary',
                                callback: function() {
                                    alert('Hello World');
                                }
                            }
                        }
                    });
                });
            }
        }
    })

    .directive('lockScreen', function(settings){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.on('click', function(){
                    // Add sound
                    ion.sound.play('camera_flashing');
                    bootbox.dialog({
                        message: 'Locker with notification display, Receive your notifications directly on your lock screen',
                        title: 'Lock Screen',
                        className: 'modal-lilac modal-center',
                        buttons: {
                            danger: {
                                label: 'No',
                                className: 'btn-danger'
                            },
                            success: {
                                label: 'Yes',
                                className: 'btn-success',
                                callback: function() {
                                    window.location = settings.baseURL+'/production/admin/angularjs/account.html#/lock-screen';
                                }
                            }
                        }
                    });
                });
            }
        }
    })

    .directive('logout', function(settings){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.on('click', function(){
                    // Add sound
                    ion.sound.play('camera_flashing');
                    bootbox.dialog({
                        message: 'Do you want to exit from Blankon?',
                        title: 'Logout',
                        className: 'modal-danger modal-center',
                        buttons: {
                            danger: {
                                label: 'No',
                                className: 'btn-danger'
                            },
                            success: {
                                label: 'Yes',
                                className: 'btn-success',
                                callback: function() {
                                    window.location = settings.baseURL+'/production/admin/angularjs/account.html#/sign-in';
                                }
                            }
                        }
                    });
                });
            }
        }
    })

    //---------------------------------------------------------------
    // SPARKLINE
    //---------------------------------------------------------------
    // average
    .directive('sparklineAverage', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.sparkline('html',{type: 'bar', barColor: '#37BC9B', height: '30px'});
            }
        }
    })
    // traffic
    .directive('sparklineTraffic', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.sparkline('html',{type: 'bar', barColor: '#8CC152', height: '30px'});
            }
        }
    })
    // disk
    .directive('sparklineDisk', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.sparkline('html',{type: 'bar', barColor: '#E9573F', height: '30px'});
            }
        }
    })
    // average
    .directive('sparklineCpu', function(){
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.sparkline('html',{type: 'bar', barColor: '#F6BB42', height: '30px'});
            }
        }
    })

    //---------------------------------------------------------------
    // HANDLE GLOBAL LINK CLICK
    //---------------------------------------------------------------
    .directive('a', function(){
        return {
            restrict: 'E',
            link: function(scope, element, attrs) {
                if (attrs.ngClick || attrs.href === '' || attrs.href === '#' || element.data('toggle') || element.data('slide')) {
                    element.on('click', function(e) {
                        e.preventDefault(); // prevent link click for above criteria
                    });
                }
            }
        }
    })

    //---------------------------------------------------------------
    // DIRECTIVE HEADER
    //---------------------------------------------------------------
    // scroll on messages area
    .directive('navbarMessage', function () {
        return {
            restrict: 'A',
            controller: function ($scope) {
                $scope.messages = [
                    {
                        image: '',
                        name: 'john kribo',
                        message: 'I was impressed how fast the content is loaded. Congratulations. nice design.',
                        meta: {
                            reply: '',
                            attach: ''
                        },
                        time: ''
                    }
                ]
            }
            //link: function (scope, element) {
            //    element.niceScroll({
            //        cursorwidth: '3px',
            //        cursorborder: '0px'
            //    });
            //}
        };
    })

    //---------------------------------------------------------------
    // DIRECTIVE SIDEBAR LEFT
    //---------------------------------------------------------------
    // Add class active on current MENU selected
    .directive('activeMenu', function ($location) {
        return {
            link: function postLink(scope, element, attrs) {
                scope.$on("$stateChangeSuccess", function (event, current, previous) {
                    if(attrs.href!=undefined){// this directive is called twice for some reason
                        // this var grabs the tab-level off the attribute, or defaults to 1
                        var pathLevel = attrs.activeTab || 1,
                        // this var finds what the path is at the level specified
                            pathToCheck = $location.path().split('/')[pathLevel],
                        // this var finds grabs the same level of the href attribute
                            tabLink = attrs.href.split('/')[pathLevel];
                        // now compare the two:
                        if (pathToCheck === tabLink) {
                            if(element.closest('.submenu').length){
                                element.closest('.submenu').addClass('active');
                                element.closest('.submenu').parents('.submenu').addClass('active');
                                element.append('<span class="selected"></span>'); // add selected mark
                            }
                            element.parent().addClass("active"); // parent to get the <li>
                            element.append('<span class="selected"></span>'); // add selected mark
                        }
                        else {
                            element.parent().removeClass("active");
                            element.find('.selected').remove(); // remove element contain selected mark
                        }
                    }
                });
            }
        };
    })

    // Trigger dropdown sidebar menu
    .directive('collapseMenu', ['settings', function(settings){
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                /* Create trigger click for open menu sidebar */
                element.find('a').on('click', function() {

                    var parentElementMenu = $(this).parent('li'),
                        parentElementSubmenu = $(this).parent('.submenu'),
                        nextElement = $(this).nextAll(),
                        arrowIcon = $(this).find('.arrow'),
                        plusIcon = $(this).find('.plus');

                    /* Add effect sound button click */
                    if($('.page-sound').length){
                        ion.sound.play("button_click_on");
                    }

                    parentElementMenu.siblings().removeClass('active');

                    if(parentElementSubmenu.parent('ul').find('ul:visible')){
                        parentElementSubmenu.parent('ul').find('ul:visible').slideUp('fast');
                        parentElementSubmenu.parent('ul').find('.open').removeClass('open');
                        parentElementSubmenu.siblings().children('a').find('.selected').remove();
                        parentElementMenu.siblings().children('a').find('.selected').remove();
                    }

                    if(nextElement.is('ul:visible')) {
                        arrowIcon.removeClass('open');
                        plusIcon.removeClass('open');
                        nextElement.slideUp('fast');
                    }

                    if(!nextElement.is('ul:visible')) {
                        nextElement.slideDown('fast');
                        parentElementMenu.children('a').append('<span class="selected"></span>'); // add selected mark
                        parentElementSubmenu.addClass('active');
                        parentElementSubmenu.children('a').append('<span class="selected"></span>');
                        arrowIcon.addClass('open');
                        plusIcon.addClass('open');
                    }

                });

            }
        }
    }])

    // Setting sidebar nicescroll
    .directive('sidebarLeftNicescroll', function () {
        return {
            restrict: 'A',
            link: function () {
                // Optimalisation: Store the references outside the event handler:
                function checkHeightSidebar() {
                    // Check if there is class page-sidebar-fixed
                    if($('.page-sidebar-fixed').length){
                        // =========================================================================
                        // SIDEBAR LEFT
                        // =========================================================================
                        // Setting dinamic height sidebar menu
                        var heightSidebarLeft       = $(window).outerHeight() - $('#header').outerHeight() - $('.sidebar-footer').outerHeight() - $('.sidebar-content').outerHeight(),
                            heightSidebarRight      = $(window).outerHeight() - $('#sidebar-right .panel-heading').outerHeight(),
                            heightSidebarRightChat  = $(window).outerHeight() - $('#sidebar-right .panel-heading').outerHeight() - $('#sidebar-chat .form-horizontal').outerHeight();
                        $('#sidebar-left .sidebar-menu').height(heightSidebarLeft)
                            .niceScroll({
                                cursorwidth: '3px',
                                cursorborder: '0px',
                                railalign: 'left'
                            });

                        // =========================================================================
                        // SIDEBAR RIGHT PROFILE
                        // =========================================================================
                        $('#sidebar-profile .sidebar-menu').height(heightSidebarRight)
                            .niceScroll({
                                cursorwidth: '3px',
                                cursorborder: '0px'
                            });

                        // =========================================================================
                        // SIDEBAR RIGHT LAYOUT
                        // =========================================================================
                        $('#sidebar-layout .sidebar-menu').height(heightSidebarRight)
                            .niceScroll({
                                cursorwidth: '3px',
                                cursorborder: '0px'
                            });

                        // =========================================================================
                        // SIDEBAR RIGHT SETTING
                        // =========================================================================
                        $('#sidebar-setting .sidebar-menu').height(heightSidebarRight)
                            .niceScroll({
                                cursorwidth: '3px',
                                cursorborder: '0px'
                            });

                        // =========================================================================
                        // SIDEBAR RIGHT CHAT
                        // =========================================================================
                        $('#sidebar-chat .sidebar-menu').height(heightSidebarRightChat)
                            .niceScroll({
                                cursorwidth: '3px',
                                cursorborder: '0px'
                            });

                    }
                }
                // Execute on load
                checkHeightSidebar();
                // Bind event listener
                $(window).resize(checkHeightSidebar);
            }
        }
    })

    // Trigger sidebar left minimize
    .directive('sidebarMinimize', function () {
        return {
            restrict: 'A',
            link: function (scope, element) {
                // Optimalisation: Store the references outside the event handler:
                var $window = $(window),
                    sidebarMinimize = $('.navbar-minimize a'),
                    settingMinimize = $('.navbar-setting a'),
                    sidebarMobileLeftMinimize = $('.navbar-minimize-mobile.left'),
                    sidebarMobileRightMinimize = $('.navbar-minimize-mobile.right')
                function checkWidth() {
                    var windowsize = $window.width();
                    // Check if view screen on greater then 720px and smaller then 1024px
                    if (windowsize > 768 && windowsize <= 1024) {
                        $('body').addClass('page-sidebar-minimize-auto');
                    }
                    else if (windowsize <= 768) {
                        $('body').removeClass('page-sidebar-minimize');
                        $('body').removeClass('page-sidebar-minimize-auto');
                    }
                    else{
                        $('body').removeClass('page-sidebar-minimize-auto');
                    }
                }
                // Execute on load
                checkWidth();
                // Bind event listener
                $(window).resize(checkWidth);

                // When the minimize trigger is clicked
                sidebarMinimize.on('click',function(){

                    // Add effect sound button click
                    if($('.page-sound').length){
                        ion.sound.play("button_click");
                    }

                    // Check class sidebar right show
                    if($('.page-sidebar-right-show').length){
                        $('body').removeClass('page-sidebar-right-show');
                    }

                    // Check class sidebar minimize auto
                    if($('.page-sidebar-minimize-auto').length){
                        $('body').removeClass('page-sidebar-minimize-auto');
                    }else{
                        // Toggle the class to the body
                        $('body').toggleClass('page-sidebar-minimize');
                    }

                    // Check the current cookie value
                    // If the cookie is empty or set to not active, then add page_sidebar_minimize
                    if ($.cookie('page_sidebar_minimize') == "undefined" || $.cookie('page_sidebar_minimize') == "not_active") {

                        // Set cookie value to active
                        $.cookie('page_sidebar_minimize','active', {expires: 1});
                    }

                    // If the cookie was already set to active then remove it
                    else {

                        // Remove cookie with name page_sidebar_minimize
                        $.removeCookie('page_sidebar_minimize');

                        // Create cookie with value to not_active
                        $.cookie('page_sidebar_minimize','not_active',  {expires: 1});

                    }

                });

                settingMinimize.on('click',function(){
                    // Add effect sound button click
                    if($('.page-sound').length){
                        ion.sound.play("button_click");
                    }
                    if($('.page-sidebar-minimize.page-sidebar-right-show').length){
                        $('body').toggleClass('page-sidebar-minimize page-sidebar-right-show');
                    }
                    else if($('.page-sidebar-minimize').length){
                        $('body').toggleClass('page-sidebar-right-show');
                    }else{
                        $('body').toggleClass('page-sidebar-minimize page-sidebar-right-show');
                    }
                });

                // This action available on mobile view
                sidebarMobileLeftMinimize.on('click',function(){
                    // Add effect sound button click
                    if($('.page-sound').length){
                        ion.sound.play("button_click");
                    }
                    if($('body.page-sidebar-right-show').length){
                        $('body').removeClass('page-sidebar-right-show');
                        $('body').removeClass('page-sidebar-minimize');
                    }
                    $('body').toggleClass('page-sidebar-left-show');
                });
                sidebarMobileRightMinimize.on('click',function(){
                    // Add effect sound button click
                    if($('.page-sound').length){
                        ion.sound.play("button_click");
                    }
                    if($('body.page-sidebar-left-show').length){
                        $('body').removeClass('page-sidebar-left-show');
                        $('body').removeClass('page-sidebar-minimize');
                    }
                    $('body').toggleClass('page-sidebar-right-show');
                });
            }
        }
    })

    //===============================================================
    // CHOOSE THEMES
    //===============================================================
    .directive('chooseThemes', function(){
        return {
            restrict: 'A',
            link: function (scope, element){
                var selectedTheme = element.find('.theme');
                // Check cookie for color schemes
                if ($.cookie('color_schemes')) {
                    $('link#theme').attr('href', '../../../assets/admin/css/themes/'+$.cookie('color_schemes')+'.theme.css');
                }
                // Check cookie for navbar color
                if ($.cookie('navbar_color')) {
                    $('.navbar-toolbar').attr('class', 'navbar navbar-toolbar navbar-'+$.cookie('navbar_color'));
                }
                // Check cookie for sidebar color
                if ($.cookie('sidebar_color')) {
                    // Check variant sidebar class
                    if($('#sidebar-left').hasClass('sidebar-box')){
                        $('#sidebar-left').attr('class','sidebar-box sidebar-'+$.cookie('sidebar_color'));
                    }
                    else if($('#sidebar-left').hasClass('sidebar-rounded')){
                        $('#sidebar-left').attr('class','sidebar-rounded sidebar-'+$.cookie('sidebar_color'));
                    }
                    else if($('#sidebar-left').hasClass('sidebar-circle')){
                        $('#sidebar-left').attr('class','sidebar-circle sidebar-'+$.cookie('sidebar_color'));
                    }
                    else if($('#sidebar-left').attr('class') == ''){
                        $('#sidebar-left').attr('class','sidebar-'+$.cookie('sidebar_color'));
                    }
                }

                selectedTheme.on('click',function(){

                    // Create variable name selector file css
                    var themename = $(this).find('.hide').text();

                    // Add effect sound
                    if($('.page-sound').length){
                        ion.sound.play("camera_flashing_2");
                    }

                    // Add attribut href css theme
                    $('link#theme').attr('href', '../../../assets/admin/css/themes/'+themename+'.theme.css');

                    // Set cookie theme name value to variable themename
                    $.cookie('color_schemes',themename, {expires: 1});

                });
            }
        };
    })

    //===============================================================
    // NAVBAR COLOR
    //===============================================================
    .directive('navbarColor', function(){
        return {
            restrict: 'A',
            link: function (scope, element){
                var selectedColor = element.find('.theme-navbar');
                selectedColor.on('click',function(){
                    // Create variable name selector file css
                    var classname = $(this).find('.hide').text();
                    // Add effect sound
                    if($('.page-sound').length){
                        ion.sound.play("camera_flashing_2");
                    }
                    // Add class navbar-color
                    $('.navbar-toolbar').attr('class', 'navbar navbar-toolbar navbar-'+classname);
                    // Set cookie theme name value to variable classname
                    $.cookie('navbar_color',classname, {expires: 1});
                });
            }
        };
    })

    //===============================================================
    // SIDEBAR COLOR
    //===============================================================
    .directive('sidebarColor', function(){
        return {
            restrict: 'A',
            link: function (scope, element){
                var selectedColor = element.find('.theme-sidebar');
                selectedColor.on('click',function(){
                    // Create variable name selector file css
                    var classname = $(this).find('.hide').text();
                    // Add effect sound
                    if($('.page-sound').length){
                        ion.sound.play("camera_flashing_2");
                    }
                    // Check variant sidebar class
                    if($('#sidebar-left').hasClass('sidebar-box')){
                        $('#sidebar-left').attr('class','sidebar-box sidebar-'+classname);
                    }
                    else if($('#sidebar-left').hasClass('sidebar-rounded')){
                        $('#sidebar-left').attr('class','sidebar-rounded sidebar-'+classname);
                    }
                    else if($('#sidebar-left').hasClass('sidebar-circle')){
                        $('#sidebar-left').attr('class','sidebar-circle sidebar-'+classname);
                    }
                    else if($('#sidebar-left').attr('class') == ''){
                        $('#sidebar-left').attr('class','sidebar-'+classname);
                    }
                    // Set cookie theme name value to variable classname
                    $.cookie('sidebar_color',classname, {expires: 1});
                });
            }
        };
    })

    //===============================================================
    // LAYOUT SETTING
    //===============================================================
    .directive('layoutSetting', function(){
        return {
            restrict: 'A',
            link: function (scope, element){
                var layoutSetting = $('.layout-setting').find('input'),
                    layoutHeaderSetting = $('.header-layout-setting').find('input'),
                    layoutSidebarSetting = $('.sidebar-layout-setting').find('input'),
                    layoutSidebarTypeSetting = $('.sidebar-type-setting').find('input'),
                    layoutFooterSetting = $('.footer-layout-setting').find('input');
                // Check cookie for layout setting
                if ($.cookie('layout_setting')) {
                    $('body').addClass($.cookie('layout_setting'));
                }

                // Check cookie for header layout setting
                if ($.cookie('header_layout_setting')) {
                    $('body').addClass($.cookie('header_layout_setting'));
                }

                // Check cookie for sidebar layout setting
                if ($.cookie('sidebar_layout_setting')) {
                    $('#sidebar-left').addClass($.cookie('sidebar_layout_setting'));
                }

                // Check cookie for sidebar type layout setting
                if ($.cookie('sidebar_type_setting')) {
                    $('#sidebar-left').addClass($.cookie('sidebar_type_setting'));
                }

                // Check cookie for footer layout setting
                if ($.cookie('footer_layout_setting')) {
                    $('body').addClass($.cookie('footer_layout_setting'));
                }

                // Check checked status input on layout setting
                if($('body').not('.page-boxed')){
                    $('.layout-setting li:eq(0) input').attr('checked','checked');
                }
                if($('body').hasClass('page-boxed')){
                    $('.layout-setting li:eq(1) input').attr('checked','checked');
                    $('body').removeClass('page-header-fixed');
                    $('body').removeClass('page-sidebar-fixed');
                    $('body').removeClass('page-footer-fixed');
                    $('.header-layout-setting li:eq(1) input').attr('disabled','disabled').next().css('text-decoration','line-through').parent('.rdio').attr({'data-toggle':'tooltip','data-container':'body','data-placement':'left','data-title':'Not working on page boxed'}).tooltip();
                    $('.sidebar-layout-setting li:eq(1) input').attr('disabled','disabled').next().css('text-decoration','line-through').parent('.rdio').attr({'data-toggle':'tooltip','data-container':'body','data-placement':'left','data-title':'Not working on page boxed'}).tooltip();
                    $('.footer-layout-setting li:eq(1) input').attr('disabled','disabled').next().css('text-decoration','line-through').parent('.rdio').attr({'data-toggle':'tooltip','data-container':'body','data-placement':'left','data-title':'Not working on page boxed'}).tooltip();
                }

                // Check checked status input on header layout setting
                if($('body').not('.page-header-fixed')){
                    $('.header-layout-setting li:eq(0) input').attr('checked','checked');
                }
                if($('body').hasClass('page-header-fixed')){
                    $('.header-layout-setting li:eq(1) input').attr('checked','checked');
                }

                // Check checked status input on sidebar layout setting
                if($('body').not('.page-sidebar-fixed')){
                    $('.sidebar-layout-setting li:eq(0) input').attr('checked','checked');
                }
                if($('body').hasClass('page-sidebar-fixed')){
                    $('.sidebar-layout-setting li:eq(1) input').attr('checked','checked');
                }

                // Check checked status input on sidebar type layout setting
                if($('#sidebar-left').not('.sidebar-box, .sidebar-rounded, .sidebar-circle')){
                    $('.sidebar-type-setting li:eq(0) input').attr('checked','checked');
                }
                if($('#sidebar-left').hasClass('sidebar-box')){
                    $('.sidebar-type-setting li:eq(1) input').attr('checked','checked');
                }
                if($('#sidebar-left').hasClass('sidebar-rounded')){
                    $('.sidebar-type-setting li:eq(2) input').attr('checked','checked');
                }
                if($('#sidebar-left').hasClass('sidebar-circle')){
                    $('.sidebar-type-setting li:eq(3) input').attr('checked','checked');
                }

                // Check checked status input on footer layout setting
                if($('body').not('.page-footer-fixed')){
                    $('.footer-layout-setting li:eq(0) input').attr('checked','checked');
                }
                if($('body').hasClass('page-footer-fixed')){
                    $('.footer-layout-setting li:eq(1) input').attr('checked','checked');
                }


                layoutSetting.change(function(){

                    // Create variable class name for layout setting
                    var classname = $(this).val();

                    // Add trigger change class on body HTML
                    if($('body').hasClass('page-boxed')){
                        $('body').removeClass('page-boxed');
                        $('body').removeClass('page-header-fixed');
                        $('body').removeClass('page-sidebar-fixed');
                        $('body').removeClass('page-footer-fixed');
                        $('.header-layout-setting li:eq(1) input').removeAttr('disabled').next().css('text-decoration','inherit').parent('.rdio').tooltip('destroy');
                        $('.sidebar-layout-setting li:eq(1) input').removeAttr('disabled').next().css('text-decoration','inherit').parent('.rdio').tooltip('destroy');
                        $('.footer-layout-setting li:eq(1) input').removeAttr('disabled').next().css('text-decoration','inherit').parent('.rdio').tooltip('destroy');
                    }else{
                        $('body').addClass($(this).val());
                        $('body').removeClass('page-header-fixed');
                        $('body').removeClass('page-sidebar-fixed');
                        $('body').removeClass('page-footer-fixed');
                        $('.header-layout-setting li:eq(1) input').attr('disabled','disabled').next().css('text-decoration','line-through').parent('.rdio').attr({'data-toggle':'tooltip','data-container':'body','data-placement':'left','data-title':'Not working on page boxed'}).tooltip();
                        $('.sidebar-layout-setting li:eq(1) input').attr('disabled','disabled').next().css('text-decoration','line-through').parent('.rdio').attr({'data-toggle':'tooltip','data-container':'body','data-placement':'left','data-title':'Not working on page boxed'}).tooltip();
                        $('.footer-layout-setting li:eq(1) input').attr('disabled','disabled').next().css('text-decoration','line-through').parent('.rdio').attr({'data-toggle':'tooltip','data-container':'body','data-placement':'left','data-title':'Not working on page boxed'}).tooltip();
                    }

                    // Set cookie theme name value to variable classname
                    $.cookie('layout_setting',classname, {expires: 1});

                });

                layoutHeaderSetting.change(function(){

                    // Create variable class name for layout setting
                    var classname = $(this).val();

                    // Add trigger change class on body HTML
                    if($('body').hasClass('page-header-fixed')){
                        $('body').removeClass('page-header-fixed');
                        $('body').addClass($(this).val());
                    }

                    $('body').addClass($(this).val());

                    // Set cookie theme name value to variable classname
                    $.cookie('header_setting',classname, {expires: 1});

                });

                layoutSidebarSetting.change(function(){

                    // Create variable class name for layout setting
                    var classname = $(this).val();

                    // Add trigger change class on body HTML
                    if($('body').hasClass('page-sidebar-fixed')){
                        $('body').removeClass('page-sidebar-fixed');
                        $('.header-layout-setting li:eq(0) input').removeAttr('disabled').next().css('text-decoration','inherit').parent('.rdio').tooltip('destroy');
                    }else{
                        $('body').addClass($(this).val());
                        $('body').addClass('page-header-fixed');
                        $('.header-layout-setting li:eq(0) input').attr('disabled','disabled').next().css('text-decoration','line-through').parent('.rdio').attr({'data-toggle':'tooltip','data-container':'body','data-placement':'left','data-title':'Not working on sidebar fixed'}).tooltip();
                        $('.header-layout-setting li:eq(1) input').attr('checked','checked');
                    }

                    // Set cookie theme name value to variable classname
                    $.cookie('sidebar_layout_setting',classname, {expires: 1});

                });

                layoutSidebarTypeSetting.change(function(){

                    // Create variable class name for layout setting
                    var classname = $(this).val();

                    // Add trigger change class on sidebar left element
                    if($('#sidebar-left').hasClass('sidebar-circle')){
                        $('#sidebar-left').removeClass('sidebar-circle');
                        $('#sidebar-left').addClass($(this).val());
                    }

                    if($('#sidebar-left').hasClass('sidebar-box')){
                        $('#sidebar-left').removeClass('sidebar-box');
                        $('#sidebar-left').addClass($(this).val());
                    }

                    if($('#sidebar-left').hasClass('sidebar-rounded')){
                        $('#sidebar-left').removeClass('sidebar-rounded');
                        $('#sidebar-left').addClass($(this).val());
                    }

                    $('#sidebar-left').addClass($(this).val());

                    // Set cookie theme name value to variable classname
                    $.cookie('sidebar_type_setting',classname, {expires: 1});

                });

                layoutFooterSetting.change(function(){

                    // Create variable class name for layout setting
                    var classname = $(this).val();

                    // Add trigger change class on body HTML
                    if($('body').hasClass('page-footer-fixed')){
                        $('body').removeClass('page-footer-fixed')
                    }else{
                        $('body').addClass($(this).val());
                    }

                    // Set cookie theme name value to variable classname
                    $.cookie('footer_layout_setting',classname, {expires: 1});

                });
            }
        };
    });

})();