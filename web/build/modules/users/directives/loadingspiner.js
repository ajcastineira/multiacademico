define(["modules/users/module"],function(a){"use strict";a.registerDirective("loadingspiner",["$http",function(a){return{restrict:"A",link:function(a,b,c){a.isLoading=function(){return a.loading},a.$watch(a.isLoading,function(a){a?(b.show(),$(".fileinput").hide()):(b.hide(),$(".fileinput").show())})}}}])});