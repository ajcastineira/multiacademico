define(["modules/tables/module","datatables.net","datatables.net-responsive.bootstrap","datatables.net-buttons.colvis","datatables.net-buttons.html5","datatables.net-buttons.flash","datatables.net-buttons.print","datatables.net-buttons.bootstrap","datatables.net-bs","pdfmake","pdfmakefonts","jszip"],function(a){"use strict";return a.registerDirective("datatableBasic",["$compile",function(a){return{restrict:"A",scope:{tableOptions:"="},link:function(b,c,d){var e={sDom:"<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>t<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",oLanguage:{sSearch:"<span class='input-group-addon input-sm'><i class='glyphicon glyphicon-search'></i></span> ",sLengthMenu:"_MENU_"},autoWidth:!1,smartResponsiveHelper:null,preDrawCallback:function(){this.smartResponsiveHelper||(this.smartResponsiveHelper=new ResponsiveDatatablesHelper(c,{tablet:1024,phone:480}))},rowCallback:function(a){this.smartResponsiveHelper.createExpandIcon(a)},drawCallback:function(a){this.smartResponsiveHelper.respond()}};d.tableOptions&&(e=angular.extend(e,b.tableOptions));var f,g=c.find(".smart-datatable-child-format");if(g.length){var h=g.remove().html();c.on("click",g.data("childControl"),function(){var c=$(this).closest("tr"),d=f.row(c);if(d.child.isShown())d.child.hide(),c.removeClass("shown");else{var e=b.$new();e.d=d.data();var g=a(h)(e);d.child(g).show(),c.addClass("shown")}})}f=c.DataTable(e)}}}])});