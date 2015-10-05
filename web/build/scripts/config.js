define(["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("blankonConfig",[]).factory("settings",["$rootScope",function(a){var b="http://localhost/multicad",c={baseURL:b,pluginPath:"../vendor",pluginCommercialPath:b+"/assets/commercial/plugins",globalImagePath:"img",adminImagePath:b+"/assets/admin/img",cssPath:"styles",jsPath:"scripts",dataPath:"data",additionalPath:b+"/assets/global/plugins/bower_components"};return a.settings=c,c}]).config(function(a){a.includeSpinner=!0}).config(["$ocLazyLoadProvider",function(a){a.config({events:!0,debug:!0,cache:!1,cssFilesInsertBefore:"ng_load_plugins_before",modules:[{name:"blankonApp.core.demo",files:["scripts/modules/core/demo.js"]}]})}]).config(function(a,b,c){c.otherwise("page-error-404"),a.state("signin",{url:"/sign-in",templateUrl:"views/sign/sign-in.html",data:{pageTitle:"SIGN IN"},controller:"SigninCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.pluginPath,e=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/sign.css"]},{files:[d+"/jquery-validation/dist/jquery.validate.min.js"]},{name:"blankonApp.account.signin",files:[e+"/modules/sign/signin.js"]}])}]}}).state("signintype2",{url:"/sign-in-type-2",templateUrl:"views/sign/sign-in-type-2.html",data:{pageTitle:"SIGN IN TYPE 2"},controller:"SigninCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.pluginPath,e=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/sign-type-2.css"]},{files:[d+"/jquery-validation/dist/jquery.validate.min.js",d+"/jquery-backstretch/jquery.backstretch.min.js"]},{name:"blankonApp.account.signin.type2",files:[e+"/modules/sign/signin-type2.js"]}])}]}}).state("signUp",{url:"/sign-up",templateUrl:"views/sign/sign-up.html",data:{pageTitle:"SIGN UP"},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/sign.css"]}])}]}}).state("lostPassword",{url:"/lost-password",templateUrl:"views/sign/lost-password.html",data:{pageTitle:"LOST PASSWORD"},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/sign.css"]}])}]}}).state("lockScreen",{url:"/lock-screen",templateUrl:"views/sign/lock-screen.html",data:{pageTitle:"LOCK SCREEN"},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/sign.css"]}])}]}}).state("blankonVersions",{url:"/blankon-versions",templateUrl:"views/blankon-versions.html",data:{pageTitle:"BLANKON VERSIONS",pageHeader:{icon:"fa fa-dropbox",title:"Blankon Versions",subtitle:"all within bundle"},breadcrumbs:[{title:"Blankon Versions"}]}}).state("frontendThemes",{url:"/frontend-themes",templateUrl:"views/frontend-themes.html",data:{pageTitle:"FRONTEND THEMES",pageHeader:{icon:"fa fa-leaf",title:"Frontend Themes",subtitle:"All within bundle AngularJS version"},breadcrumbs:[{title:"Frontend Themes"}]},controller:"FrontendThemesCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.pluginPath,e=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/frontend-themes.css",d+"/jquery.gritter/css/jquery.gritter.css"]},{name:"blankonApp.frontendThemes",files:[e+"/modules/frontend-themes.js"]}])}]}}).state("blogGrid",{url:"/blog-grid",templateUrl:"views/blog/blog-grid.html",data:{pageTitle:"BLOG GRID",pageHeader:{icon:"fa fa-file-text",title:"Blog Grid",subtitle:"blog grid type and post samples"},breadcrumbs:[{title:"Pages"},{title:"Blog Grid"}]},controller:"BlogCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"blankonApp.blog.blogGrid",files:[c+"/masonry/dist/masonry.pkgd.min.js",d+"/modules/blog/grid.js"]}])}]}}).state("blogList",{url:"/blog-list",templateUrl:"views/blog/blog-list.html",data:{pageTitle:"BLOG LIST",pageHeader:{icon:"fa fa-file-text",title:"Blog List",subtitle:"blog list type and post samples"},breadcrumbs:[{title:"Pages"},{title:"Blog List"}]}}).state("blogSingle",{url:"/blog-single",templateUrl:"views/blog/blog-single.html",data:{pageTitle:"BLOG SINGLE",pageHeader:{icon:"fa fa-file-text",title:"Blog Single",subtitle:"blog single sample"},breadcrumbs:[{title:"Pages"},{title:"Blog Single"}]},controller:"BlogSingleCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css"]},{name:"blankonApp.blog.single",files:[c+"/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js",c+"/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js",d+"/modules/blog/single.js"]}])}]}}).state("mailInbox",{url:"/mail-inbox",templateUrl:"views/mail/mail-inbox.html",data:{pageTitle:"MAIL INBOX",pageHeader:{icon:"fa fa-inbox",title:"Inbox",subtitle:"mail inbox sample"},breadcrumbs:[{title:"Mail"},{title:"Inbox"}]},controller:"MailInboxCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/mail.css"]},{name:"blankonApp.mail.inbox",files:[d+"/modules/mail/inbox.js"]}])}]}}).state("mailCompose",{url:"/mail-compose",templateUrl:"views/mail/mail-compose.html",data:{pageTitle:"MAIL COMPOSE",pageHeader:{icon:"fa fa-pencil",title:"Compose",subtitle:"mail compose sample"},breadcrumbs:[{title:"Mail"},{title:"Compose"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.cssPath,e=b.jsPath,f=b.additionalPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css",f+"/bootstrap-fileupload/css/bootstrap-fileupload.min.css",d+"/pages/mail.css"]},{name:"blankonApp.mail.compose",files:[c+"/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js",c+"/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js",f+"/bootstrap-fileupload/js/bootstrap-fileupload.min.js",e+"/modules/mail/compose.js"]}])}]}}).state("mailView",{url:"/mail-view",templateUrl:"views/mail/mail-view.html",data:{pageTitle:"MAIL VIEW",pageHeader:{icon:"fa fa-eye",title:"View",subtitle:"mail view sample"},breadcrumbs:[{title:"Mail"},{title:"View"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/mail.css"]}])}]}}).state("pageGallery",{url:"/page-gallery",templateUrl:"views/pages/page-gallery.html",data:{pageTitle:"GALLERY",pageHeader:{icon:"fa fa-picture-o",title:"Gallery",subtitle:"gallery style"},breadcrumbs:[{title:"Pages"},{title:"Gallery"}]},controller:"GalleryCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.pluginPath,e=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/gallery.css"]},{name:"blankonApp.pages.gallery",files:[d+"/mixitup/build/jquery.mixitup.min.js",e+"/modules/pages/gallery.js"]}])}]}}).state("pageFAQ",{url:"/page-faq",templateUrl:"views/pages/page-faq.html",data:{pageTitle:"FAQ",pageHeader:{icon:"fa fa-comments",title:"FAQ",subtitle:"frequently asked questions"},breadcrumbs:[{title:"Pages"},{title:"FAQ"}]},controller:"FAQCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.pluginCommercialPath,e=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[d+"/cube-portfolio/cubeportfolio/css/cubeportfolio.css",c+"/pages/faq.css"]},{name:"blankonApp.pages.faq",files:[d+"/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js",e+"/modules/pages/faq.js"]}])}]}}).state("pageInvoice",{url:"/page-invoice",templateUrl:"views/pages/page-invoice.html",data:{pageTitle:"INVOICE",pageHeader:{icon:"fa fa-file-o",title:"Invoice",subtitle:"invoice sample"},breadcrumbs:[{title:"Pages"},{title:"Invoice"}]},controller:"InvoiceCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/invoice.css"]},{name:"blankonApp.pages.invoice",files:[d+"/modules/pages/invoice.js"]}])}]}}).state("pageMessages",{url:"/page-messages",templateUrl:"views/pages/page-messages.html",data:{pageTitle:"MESSAGES",pageHeader:{icon:"fa fa-comments",title:"Messages",subtitle:"messages sample"},breadcrumbs:[{title:"Pages"},{title:"Messages"}]},controller:"MessagesCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/messages.css"]},{name:"blankonApp.pages.messages",files:[d+"/modules/pages/messages.js"]}])}]}}).state("pageTimeline",{url:"/page-timeline",templateUrl:"views/pages/page-timeline.html",data:{pageTitle:"TIMELINE",pageHeader:{icon:"fa fa-child",title:"Timeline",subtitle:"timeline activity"},breadcrumbs:[{title:"Pages"},{title:"Timeline"}]},controller:"TimelineCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.cssPath,e=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[d+"/pages/timeline.css"]},{name:"blankonApp.pages.timeline",files:[c+"/gmap3/dist/gmap3.min.js",e+"/modules/pages/timeline.js"]}])}]}}).state("pageProfile",{url:"/page-profile",templateUrl:"views/pages/page-profile.html",data:{pageTitle:"PROFILE",pageHeader:{icon:"fa fa-male",title:"Profile",subtitle:"profile sample"},breadcrumbs:[{title:"Pages"},{title:"Profile"}]}}).state("pageSearchCourse",{url:"/page-search-course",templateUrl:"views/pages/page-search-course.html",data:{pageTitle:"SEARCH COURSE",pageHeader:{icon:"fa fa-pencil",title:"Search Course",subtitle:"Search Result Course Page"},breadcrumbs:[{title:"Pages"},{title:"Search Course"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.pluginPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/search.css",d+"/chosen/chosen.min.css"]},{files:[d+"/chosen/chosen.jquery.min.js"]}])}]}}).state("pageError403",{url:"/page-error-403",templateUrl:"views/pages/page-error-403.html",data:{pageTitle:"ERROR 403",pageHeader:{icon:"fa fa-ban",title:"Error 403",subtitle:"access is denied"},breadcrumbs:[{title:"Pages"},{title:"Error 403"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/error-page.css"]}])}]}}).state("pageError404",{url:"/page-error-404",templateUrl:"views/pages/page-error-404.html",data:{pageTitle:"ERROR 404",pageHeader:{icon:"fa fa-ban",title:"Error 404",subtitle:"page not found"},breadcrumbs:[{title:"Pages"},{title:"Error 404"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/error-page.css"]}])}]}}).state("pageError500",{url:"/page-error-500",templateUrl:"views/pages/page-error-500.html",data:{pageTitle:"ERROR 500",pageHeader:{icon:"fa fa-ban",title:"Error 500",subtitle:"internal server error"},breadcrumbs:[{title:"Pages"},{title:"Error 500"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/error-page.css"]}])}]}}).state("formElement",{url:"/form-element",templateUrl:"views/forms/form-element.html",data:{pageTitle:"FORM ELEMENT",pageHeader:{icon:"fa fa-list-alt",title:"Form Elements",subtitle:"form elements and more"},breadcrumbs:[{title:"Forms"},{title:"Form Elements"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath,e=b.additionalPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",e+"/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css",c+"/chosen/chosen.min.css"]},{name:"blankonApp.forms.element",files:[c+"/bootstrap-tagsinput/dist/bootstrap-tagsinput-angular.min.js",e+"/jasny-bootstrap-fileinput/js/jasny-bootstrap.fileinput.min.js",c+"/holderjs/holder.js",c+"/bootstrap-maxlength/bootstrap-maxlength.min.js",e+"/jquery-autosize/jquery.autosize.min.js",c+"/chosen/chosen.jquery.min.js",d+"/modules/forms/element.js"]}])}]}}).state("formAdvanced",{url:"/form-advanced",templateUrl:"views/forms/form-advanced.html",data:{pageTitle:"FORM ADVANCED",pageHeader:{icon:"fa fa-list-alt",title:"Form Advanced",subtitle:"form advanced plugins"},breadcrumbs:[{title:"Forms"},{title:"Form Advanced"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/dropzone/dist/min/dropzone.min.css",c+"/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css",c+"/bootstrap-datepicker-vitalets/css/datepicker.css"]},{name:"blankonApp.forms.advanced",files:[c+"/dropzone/dist/min/dropzone.min.js",c+"/bootstrap-switch/dist/js/bootstrap-switch.min.js",c+"/jquery.inputmask/dist/jquery.inputmask.bundle.min.js",c+"/bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js",d+"/modules/forms/advanced.js"]}])}]}}).state("formLayout",{url:"/form-layout",templateUrl:"views/forms/form-layout.html",data:{pageTitle:"FORM LAYOUT",pageHeader:{icon:"fa fa-list-alt",title:"Form Layouts",subtitle:"variant form layouts"},breadcrumbs:[{title:"Forms"},{title:"Form Layouts"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath,e=b.additionalPath;return a.load([{insertBefore:"#load_css_before",files:[e+"/bootstrap-fileupload/css/bootstrap-fileupload.min.css",c+"/chosen/chosen.min.css"]},{name:"blankonApp.forms.layout",files:[e+"/bootstrap-fileupload/js/bootstrap-fileupload.min.js",c+"/chosen/chosen.jquery.min.js",d+"/modules/forms/layout.js"]}])}]}}).state("formValidation",{url:"/form-validation",templateUrl:"views/forms/form-validation.html",data:{pageTitle:"FORM VALIDATION",pageHeader:{icon:"fa fa-warning",title:"Form Validations",subtitle:"form validation samples"},breadcrumbs:[{title:"Forms"},{title:"Form Validations"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"blankonApp.forms.validation",files:[c+"/chosen/chosen.jquery.min.js",c+"/jquery-mockjax/dist/jquery.mockjax.min.js",c+"/jquery-validation/dist/jquery.validate.min.js",d+"/modules/forms/validation.js"]}])}]}}).state("formWizard",{url:"/form-wizard",templateUrl:"views/forms/form-wizard.html",data:{pageTitle:"FORM WIZARD",pageHeader:{icon:"fa fa-th-list",title:"Form Wizard",subtitle:"form wizard sample"},breadcrumbs:[{title:"Forms"},{title:"Form Wizard"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath,e=b.additionalPath;return a.load([{name:"blankonApp.forms.wizard",files:[c+"/jquery-validation/dist/jquery.validate.min.js",e+"/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js",d+"/modules/forms/wizard.js"]}])}]}}).state("formWysiwyg",{url:"/form-wysiwyg",templateUrl:"views/forms/form-wysiwyg.html",data:{pageTitle:"FORM WYSIWYG",pageHeader:{icon:"fa fa-edit",title:"WYSIWYG",subtitle:"form text editor"},breadcrumbs:[{title:"Forms"},{title:"WYSIWYG"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css",c+"/summernote/dist/summernote.css"]},{name:"blankonApp.forms.wysiwyg",files:[c+"/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js",c+"/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js",c+"/summernote/dist/summernote.min.js",d+"/modules/forms/wysiwyg.js"]}])}]}}).state("formXeditable",{url:"/form-xeditable",templateUrl:"views/forms/form-xeditable.html",data:{pageTitle:"FORM X-EDITABLE",pageHeader:{icon:"fa fa-edit",title:"X-Editable",subtitle:"form x-editable"},breadcrumbs:[{title:"Forms"},{title:"X-Editable"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/angular-xeditable/dist/css/xeditable.css"]},{name:"blankonApp.forms.xeditable",files:[c+"/angular-mocks/angular-mocks.js",c+"/angular-xeditable/dist/js/xeditable.min.js",d+"/modules/forms/xeditable.js"]}])}]}}).state("tableDefault",{url:"/table-default",templateUrl:"views/tables/table-default.html",data:{pageTitle:"TABLE DEFAULT",pageHeader:{icon:"fa fa-table",title:"Table",subtitle:"basic table samples"},breadcrumbs:[{title:"Tables"},{title:"Table Default"}]},controller:"TableDefaultCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.jsPath;return a.load([{name:"blankonApp.tables.default",files:[c+"/modules/tables/default.js"]}])}]}}).state("tableColor",{url:"/table-color",templateUrl:"views/tables/table-color.html",data:{pageTitle:"TABLE COLOR",pageHeader:{icon:"fa fa-table",title:"Table Color",subtitle:"variant table colors"},breadcrumbs:[{title:"Tables"},{title:"Table Color"}]},controller:"TableColorCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.jsPath;return a.load([{name:"blankonApp.tables.color",files:[c+"/modules/tables/color.js"]}])}]}}).state("tableDatatable",{url:"/table-datatable",templateUrl:"views/tables/table-datatable.html",data:{pageTitle:"DATATABLE",pageHeader:{icon:"fa fa-table",title:"Datatable",subtitle:"responsive datatable samples"},breadcrumbs:[{title:"Tables"},{title:"Datatable"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath,e=b.additionalPath;return a.load([{insertBefore:"#load_css_before",files:[e+"/datatables/css/dataTables.bootstrap.css",e+"/datatables/css/datatables.responsive.css",c+"/fuelux/dist/css/fuelux.min.css"]},{name:"blankonApp.tables.datatable",files:[e+"/datatables/js/jquery.dataTables.min.js",e+"/datatables/js/dataTables.bootstrap.js",e+"/datatables/js/datatables.responsive.js",c+"/fuelux/dist/js/fuelux.min.js",d+"/modules/tables/datatable.js"]}])}]}}).state("mapGoogle",{url:"/maps-google",templateUrl:"views/maps/maps-google.html",data:{pageTitle:"GOOGLE MAPS",pageHeader:{icon:"fa fa-map-marker",title:"Google Map",subtitle:"google map samples"},breadcrumbs:[{title:"Maps"},{title:"Google Map"}]},controller:"GoogleMapCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"blankonApp.maps.google",files:[c+"/gmap3/dist/gmap3.min.js",d+"/modules/maps/map-google.js"]}])}]}}).state("mapVector",{url:"/maps-vector",templateUrl:"views/maps/maps-vector.html",data:{pageTitle:"VECTOR MAPS",pageHeader:{icon:"fa fa-globe",title:"Vector Map",subtitle:"interactive vector map samples"},breadcrumbs:[{title:"Maps"},{title:"Vector Map"}]},controller:"VectorMapCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/jqvmap/jqvmap/jqvmap.css"]},{name:"blankonApp.maps.vector",files:[c+"/jqvmap/jqvmap/jquery.vmap.min.js",c+"/jqvmap/jqvmap/maps/jquery.vmap.world.js",c+"/jqvmap/jqvmap/maps/jquery.vmap.usa.js",c+"/jqvmap/jqvmap/maps/jquery.vmap.russia.js",c+"/jqvmap/jqvmap/maps/jquery.vmap.algeria.js",c+"/jqvmap/jqvmap/maps/jquery.vmap.germany.js",c+"/jqvmap/jqvmap/maps/continents/jquery.vmap.africa.js",c+"/jqvmap/jqvmap/maps/continents/jquery.vmap.asia.js",c+"/jqvmap/jqvmap/maps/continents/jquery.vmap.australia.js",c+"/jqvmap/jqvmap/maps/continents/jquery.vmap.europe.js",c+"/jqvmap/jqvmap/maps/continents/jquery.vmap.north-america.js",c+"/jqvmap/jqvmap/maps/continents/jquery.vmap.south-america.js",c+"/jqvmap/jqvmap/data/jquery.vmap.sampledata.js",d+"/modules/maps/map-vector.js"]}])}]}}).state("chartFlot",{url:"/chart-flot",templateUrl:"views/charts/chart-flot.html",data:{pageTitle:"FLOT CHART",pageHeader:{icon:"fa fa-signal",title:"Flot Charts",subtitle:"visual charts & graphs"},breadcrumbs:[{title:"Charts"},{title:"Flot Charts"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"blankonApp.charts.flot",files:[c+"/flot/jquery.flot.js",c+"/flot/jquery.flot.spline.min.js",c+"/flot/jquery.flot.tooltip.min.js",c+"/flot/jquery.flot.resize.js",c+"/flot/jquery.flot.categories.js",c+"/flot/jquery.flot.pie.js",d+"/modules/charts/flot.js"]}])}]}}).state("chartMorris",{url:"/chart-morris",templateUrl:"views/charts/chart-morris.html",data:{pageTitle:"MORRIS CHART",pageHeader:{icon:"fa fa-signal",title:"Morris Charts",subtitle:"visual charts & graphs"},breadcrumbs:[{title:"Charts"},{title:"Morris Charts"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/morris.js/morris.css"]},{name:"blankonApp.charts.morris",files:[c+"/raphael/raphael-min.js",c+"/morris.js/morris.min.js",d+"/modules/charts/morris.js"]}])}]}}).state("chartChartjs",{url:"/chart-chartjs",templateUrl:"views/charts/chart-chartjs.html",data:{pageTitle:"CHARTJS CHART",pageHeader:{icon:"fa fa-signal",title:"Chartjs",subtitle:"visual charts & graphs"},breadcrumbs:[{title:"Charts"},{title:"Chartjs"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"blankonApp.charts.chartjs",files:[c+"/Chart.js/Chart.min.js",d+"/modules/charts/chartjs.js"]},{name:"tc.chartjs",files:[c+"/tc-angular-chartjs/dist/tc-angular-chartjs.min.js"]}])}]}}).state("chartC3JS",{url:"/chart-c3js",templateUrl:"views/charts/chart-c3js.html",data:{pageTitle:"FLOT CHART",pageHeader:{icon:"fa fa-signal",title:"C3js chart",subtitle:"visual charts & graphs"},breadcrumbs:[{title:"Charts"},{title:"C3js chart"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/c3/c3.min.css"]},{name:"gridshore.c3js.chart",files:[c+"/d3/d3.min.js",c+"/c3/c3.min.js",c+"/c3-angular/c3js-directive.js"]},{name:"blankonApp.charts.c3js",files:[d+"/modules/charts/c3js.js"]}])}]}}).state("componentGridSystem",{url:"/component-grid-system",templateUrl:"views/components/component-grid-system.html",data:{pageTitle:"GRID SYSTEM",pageHeader:{icon:"fa fa-columns",title:"Grid Layout",subtitle:"grid system support"},breadcrumbs:[{title:"Layout"},{title:"Grid"}]}}).state("componentButtons",{url:"/component-buttons",templateUrl:"views/components/component-buttons.html",data:{pageTitle:"BUTTONS",pageHeader:{icon:"fa fa-square",title:"Buttons",subtitle:"general ui components"},breadcrumbs:[{title:"Components"},{title:"Buttons"}]}}).state("componentTypography",{url:"/component-typography",templateUrl:"views/components/component-typography.html",data:{pageTitle:"TYPOGRAPHY",pageHeader:{icon:"fa fa-text-height",title:"Typography",subtitle:"general ui components"},breadcrumbs:[{title:"Components"},{title:"Typography"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/google-code-prettify/bin/prettify.min.css"]},{name:"blankonApp.components.typography",files:[c+"/google-code-prettify/bin/prettify.min.js",d+"/modules/components/typography.js"]}])}]}}).state("componentPanel",{url:"/component-panel",templateUrl:"views/components/component-panel.html",data:{pageTitle:"PANELS",pageHeader:{icon:"fa fa-list-alt",title:"Panel",subtitle:"general ui components"},breadcrumbs:[{title:"Components"},{title:"Panel"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/c3/c3.min.css"]},{name:"gridshore.c3js.chart",files:[c+"/d3/d3.min.js",c+"/c3/c3.min.js",c+"/c3-angular/c3js-directive.js"]},{name:"blankonApp.charts.c3js",files:[d+"/modules/charts/c3js.js"]}])}]}}).state("componentAlerts",{url:"/component-alerts",templateUrl:"views/components/component-alerts.html",data:{pageTitle:"ALERTS",pageHeader:{icon:"fa fa-info-circle",title:"Alerts",subtitle:"general ui components"},breadcrumbs:[{title:"Components"},{title:"Alerts"}]},controller:"AlertCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"ui.bootstrap",files:[c+"/angular-bootstrap/ui-bootstrap-tpls.min.js"]},{name:"ui.bootstrap.alert",files:[d+"/modules/bootstrap/alert.js"]}])}]}}).state("componentModals",{url:"/component-modals",templateUrl:"views/components/component-modals.html",data:{pageTitle:"MODALS",pageHeader:{icon:"fa fa-circle-o-notch",title:"Modals",subtitle:"general ui components"},breadcrumbs:[{title:"Components"},{title:"Modals"}]},controller:"AccordionCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"ui.bootstrap",files:[c+"/angular-bootstrap/ui-bootstrap-tpls.min.js"]},{name:"ui.bootstrap.accordion",files:[d+"/modules/bootstrap/accordion.js"]}])}]}}).state("componentVideo",{url:"/component-video",templateUrl:"views/components/component-video.html",data:{pageTitle:"VIDEO",pageHeader:{icon:"fa fa-video-camera",title:"Video",subtitle:"responsive embed"},breadcrumbs:[{title:"Components"},{title:"Video"}]}}).state("componentTabsaccordion",{url:"/component-tabsaccordion",templateUrl:"views/components/component-tabsaccordion.html",data:{pageTitle:"TABS & ACCORDION",pageHeader:{icon:"fa fa-bars",title:"Tabs & Accordion",subtitle:"general ui components"},breadcrumbs:[{title:"Components"},{title:"Tabs & Accordion"}]},controller:"AccordionCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"ui.bootstrap",files:[c+"/angular-bootstrap/ui-bootstrap-tpls.min.js"]},{name:"ui.bootstrap.accordion",files:[d+"/modules/bootstrap/accordion.js"]}])}]}}).state("componentSliders",{url:"/component-sliders",templateUrl:"views/components/component-sliders.html",data:{pageTitle:"SLIDERS",pageHeader:{icon:"fa fa-sliders",title:"Sliders",subtitle:"general ui components"},breadcrumbs:[{title:"Components"},{title:"Sliders"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/ion.rangeSlider/css/ion.rangeSlider.css"]},{name:"blankonApp.components.slider",files:[c+"/ion.rangeSlider/js/ion.rangeSlider.min.js",d+"/modules/pages/slider.js"]}])}]}}).state("componentGlyphicons",{url:"/component-glyphicons",templateUrl:"views/components/component-glyphicons.html",data:{pageTitle:"GLYPHICONS",pageHeader:{icon:"fa fa-paw",title:"Glyphicons",subtitle:"icon components"},breadcrumbs:[{title:"Components"},{title:"Icons"},{title:"Glyphicons"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/glyphicons.css"]}])}]}}).state("componentGlyphiconsPro",{url:"/component-glyphicons-pro",templateUrl:"views/components/component-glyphicons-pro.html",data:{pageTitle:"GLYPHICONS PRO",pageHeader:{icon:"fa fa-plus-square",title:"Glyphicons PRO",subtitle:"icon components"},breadcrumbs:[{title:"Components"},{title:"Icons"},{title:"Glyphicons PRO"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.pluginCommercialPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/glyphicons.css",d+"/glyphicons-pro/glyphicons/web/html_css/css/glyphicons.css"]}])}]}}).state("componentFontAwesome",{url:"/component-font-awesome",templateUrl:"views/components/component-font-awesome.html",data:{pageTitle:"FONT AWESOME",pageHeader:{icon:"fa fa-paw",title:"Font Awesome",subtitle:"icon components"},breadcrumbs:[{title:"Components"},{title:"Icons"},{title:"Font Awesome"}]}}).state("componentWeatherIcons",{url:"/component-weather-icons",templateUrl:"views/components/component-weather-icons.html",data:{pageTitle:"WEATHER ICONS",pageHeader:{icon:"wi wi-day-sunny-overcast",title:"Weather Icons",subtitle:"icon components"},breadcrumbs:[{title:"Components"},{title:"Icons"},{title:"Weather Icons"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.pluginPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/weather-icons.css",d+"/weather-icons/css/weather-icons.min.css"]}])}]}}).state("componentMapIcons",{url:"/component-map-icons",templateUrl:"views/components/component-map-icons.html",data:{pageTitle:"MAP ICONS",pageHeader:{icon:"fa fa-paw",title:"Icons Map",subtitle:"Icon font for use with Google Maps API"},breadcrumbs:[{title:"Components"},{title:"Icons"},{title:"Icons Map"}]},controller:"IconMapCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/map-icons/css/map-icons.css"]},{name:"blankonApp.maps.icon",files:[c+"/map-icons/js/map-icons.min.js",d+"/modules/maps/map-icons.js"]}])}]}}).state("componentSimpleLineIcons",{url:"/component-simple-line-icons",templateUrl:"views/components/component-simple-line-icons.html",data:{pageTitle:"SIMPLE LINE ICONS",pageHeader:{icon:"fa fa-paw",title:"Simple Line Icons",subtitle:"icon components"},breadcrumbs:[{title:"Components"},{title:"Icons"},{title:"Simple Line Icons"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath,d=b.pluginPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/icon.css",d+"/simple-line-icons/css/simple-line-icons.css"]}])}]}}).state("componentOther",{url:"/component-other",templateUrl:"views/components/component-other.html",data:{pageTitle:"OTHER COMPONENT",pageHeader:{icon:"fa fa-slack",title:"Other Component",subtitle:"general ui components"},breadcrumbs:[{title:"Components"},{title:"Icons"},{title:"Others"}]}}).state("animate",{url:"/animate",templateUrl:"views/animate.html",data:{pageTitle:"ANIMATE.CSS",pageHeader:{icon:"fa fa-forumbee",title:"Animate.css",subtitle:"Just-add-water CSS animations"},breadcrumbs:[{title:"Animate.css"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.jsPath;return a.load([{name:"blankonApp.animate",files:[c+"/modules/animate.js"]}])}]}}).state("widgetOverview",{url:"/widget-overview",templateUrl:"views/widget/widget-overview.html",data:{pageTitle:"OVERVIEW WIDGET",pageHeader:{icon:"fa fa-bar-chart-o",title:"Overview Widget",subtitle:"overview widget and more"},breadcrumbs:[{title:"Widget"},{title:"Overview"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"blankonApp.widget.overview",files:[c+"/raphael/raphael-min.js",c+"/flot/jquery.flot.pack.js",c+"/morris.js/morris.min.js",d+"/modules/widget/overview.js"]}])}]}}).state("widgetSocial",{url:"/widget-social",templateUrl:"views/widget/widget-social.html",data:{pageTitle:"SOCIAL WIDGET",pageHeader:{icon:"fa fa-share-alt",title:"Social Widget",subtitle:"social widget and more"},breadcrumbs:[{title:"Widget"},{title:"Social"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/timeline.css"]}])}]}}).state("widgetBlog",{url:"/widget-blog",templateUrl:"views/widget/widget-blog.html",data:{pageTitle:"BLOG WIDGET",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget and more"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("widgetWeather",{url:"/widget-weather",templateUrl:"views/widget/widget-weather.html",data:{pageTitle:"WEATHER WIDGET",pageHeader:{icon:"wi wi-day-sunny-overcast",title:"Weather Widget",subtitle:"weather widget and more"},breadcrumbs:[{title:"Widget"},{title:"Weather"}]},controller:"widgetWeatherCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.jsPath;return a.load([{name:"blankonApp.widget.weather",files:[c+"/skycons-html5/skycons.js",d+"/modules/widget/weather.js"]}])}]}}).state("widgetMisc",{url:"/widget-misc",templateUrl:"views/widget/widget-misc.html",data:{pageTitle:"MISC WIDGET",pageHeader:{icon:"fa fa-puzzle-piece",title:"Misc Widget",subtitle:"miscellanous widget and more"},breadcrumbs:[{title:"Widget"},{title:"Misc"}]}})}).run(["$rootScope","settings","$state",function(a,b,c,d){a.$state=c,a.$location=d,a.settings=b}]);return b.configureApp(c),c});