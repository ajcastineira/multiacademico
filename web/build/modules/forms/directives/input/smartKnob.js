define(["modules/forms/module","jquery-knob"],function(a){"use strict";return a.registerDirective("smartKnob",function(){return{restrict:"A",compile:function(a,b){a.removeAttr("smart-knob data-smart-knob"),a.knob()}}})});