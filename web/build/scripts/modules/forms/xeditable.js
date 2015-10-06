"use strict";!function(){angular.module("blankonApp.forms.xeditable",["xeditable"]).run(["editableOptions",function(a){a.theme="bs3"}]).controller("TextSimpleCtrl",["$scope",function(a){a.user={name:"awesome user"}}]).controller("SelectLocalCtrl",["$scope","$filter",function(a,b){a.user={status:2},a.statuses=[{value:1,text:"status1"},{value:2,text:"status2"},{value:3,text:"status3"},{value:4,text:"status4"}],a.showStatus=function(){var c=b("filter")(a.statuses,{value:a.user.status});return a.user.status&&c.length?c[0].text:"Not set"}}]).controller("Html5InputsCtrl",["$scope",function(a){a.user={email:"email@example.com",tel:"123-45-67",number:29,range:10,url:"http://example.com",search:"blabla",color:"#6a4415",date:null,time:"12:30",datetime:null,month:null,week:null}}]).controller("TextareaCtrl",["$scope",function(a){a.user={desc:"Awesome user \ndescription!"}}]).controller("CheckboxCtrl",["$scope",function(a){a.user={remember:!0}}]).controller("ChecklistCtrl",["$scope","$filter",function(a,b){a.user={status:[2,3]},a.statuses=[{value:1,text:"status1"},{value:2,text:"status2"},{value:3,text:"status3"}],a.showStatus=function(){var b=[];return angular.forEach(a.statuses,function(c){a.user.status.indexOf(c.value)>=0&&b.push(c.text)}),b.length?b.join(", "):"Not set"}}]).controller("RadiolistCtrl",["$scope","$filter",function(a,b){a.user={status:2},a.statuses=[{value:1,text:"status1"},{value:2,text:"status2"}],a.showStatus=function(){var c=b("filter")(a.statuses,{value:a.user.status});return a.user.status&&c.length?c[0].text:"Not set"}}])}();