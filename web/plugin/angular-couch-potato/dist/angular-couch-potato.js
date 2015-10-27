(function(){var CouchPotato=function(angular){var module=angular.module('scs.couch-potato',['ng']);function CouchPotatoProvider($controllerProvider,$compileProvider,$provide,$filterProvider){var rootScope=null;function registerValue(value,apply){$provide.value.apply(null,value);if(apply){rootScope.$apply();}}
function registerFactory(factory,apply){$provide.factory.apply(null,factory);if(apply){rootScope.$apply();}}
function registerService(service,apply){$provide.service.apply(null,service);if(apply){rootScope.$apply();}}
function registerFilter(filter,apply){$filterProvider.register.apply(null,filter);if(apply){rootScope.$apply();}}
function registerDirective(directive,apply){$compileProvider.directive.apply(null,directive);if(apply){rootScope.$apply();}}
function registerController(controller,apply){$controllerProvider.register.apply(null,controller);if(apply){rootScope.$apply();}}
function registerDecorator(decorator,apply){$provide.decorator.apply(null,decorator);if(apply){rootScope.$apply();}}
function registerProvider(service,apply){$provide.provider.apply(null,service);if(apply){rootScope.$apply();}}
function resolve(dependencies,returnIndex,returnSubId){if(dependencies.dependencies){return resolveDependenciesProperty(dependencies,returnIndex,returnSubId);}
else{return resolveDependencies(dependencies,returnIndex,returnSubId);}}
this.resolve=resolve;function resolveDependencies(dependencies,returnIndex,returnSubId){function delay($q,$rootScope){var defer=$q.defer();require(dependencies,function(){var args=Array.prototype.slice(arguments);var out;if(returnIndex===undefined){out=arguments[arguments.length-1];}
else{argForOut=arguments[returnIndex];if(returnSubId===undefined){out=argForOut;}
else{out=argForOut[returnSubId];}}
defer.resolve(out);$rootScope.$apply();});return defer.promise;}
delay.$inject=['$q','$rootScope'];return delay;}
this.resolveDependencies=resolveDependencies;function resolveDependenciesProperty(configProperties){if(configProperties.dependencies){var resolveConfig=configProperties;var deps=configProperties.dependencies;delete resolveConfig['dependencies'];resolveConfig.resolve={};resolveConfig.resolve.delay=resolveDependencies(deps);return resolveConfig;}
else
{return configProperties;}}
this.resolveDependenciesProperty=resolveDependenciesProperty;this.$get=function($rootScope){var svc={};rootScope=$rootScope;svc.registerValue=registerValue;svc.registerFactory=registerFactory;svc.registerService=registerService;svc.registerFilter=registerFilter;svc.registerDirective=registerDirective;svc.registerController=registerController;svc.registerDecorator=registerDecorator;svc.registerProvider=registerProvider;svc.resolveDependenciesProperty=resolveDependenciesProperty;svc.resolveDependencies=resolveDependencies;svc.resolve=resolve;return svc;};this.$get.$inject=['$rootScope'];}
CouchPotatoProvider.$inject=['$controllerProvider','$compileProvider','$provide','$filterProvider'];module.provider('$couchPotato',CouchPotatoProvider);this.configureApp=function(app){app.registerController=function(name,controller){if(app.lazy){app.lazy.registerController([name,controller]);}
else{app.controller(name,controller);}
return app;};app.registerFactory=function(name,factory){if(app.lazy){app.lazy.registerFactory([name,factory]);}
else{app.factory(name,factory);}
return app;};app.registerService=function(name,service){if(app.lazy){app.lazy.registerService([name,service]);}
else{app.service(name,service);}
return app;};app.registerDirective=function(name,directive){if(app.lazy){app.lazy.registerDirective([name,directive]);}
else{app.directive(name,directive);}
return app;};app.registerDecorator=function(name,decorator){if(app.lazy){app.lazy.registerDecorator([name,decorator]);}
else{app.decorator(name,decorator);}
return app;};app.registerProvider=function(name,provider){if(app.lazy){app.lazy.registerProvider([name,provider]);}
else{app.provider(name,provider);}
return app;};app.registerValue=function(name,value){if(app.lazy){app.lazy.registerValue([name,value]);}
else{app.value(name,value);}
return app;};app.registerFilter=function(name,filter){if(app.lazy){app.lazy.registerFilter([name,filter]);}
else{app.filter(name,filter);}
return app;};app.extendInjectable=function(parent,child){function disassembleInjected(object){if(angular.isArray(object)){var func=object.slice(object.length-1)[0];return[func,object.slice(0,object.length-1)];}
else{var injections=object.$inject;return[object,injections||[]];}}
parentPieces=disassembleInjected(parent);childPieces=disassembleInjected(child);function CombinedConstructor(){var args=Array.prototype.slice.call(arguments);parentPieces[0].apply(this,args.slice(0,parentPieces[1].length));childPieces[0].apply(this,args.slice(parentPieces[1].length));}
function Inherit(){}
Inherit.prototype=parentPieces[0].prototype;CombinedConstructor.prototype=new Inherit();CombinedConstructor.$inject=[].concat(parentPieces[1]).concat(childPieces[1]);return CombinedConstructor;};};};if(typeof(define)==='function'&&define.amd){define(['angular'],function(){return new CouchPotato(window.angular);});}
else{window.couchPotato=new CouchPotato(angular);}}());