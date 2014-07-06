/*! jQuery UI - v1.10.3 - 2013-09-28
* http://jqueryui.com
* Includes: jquery.ui.core.js, jquery.ui.widget.js, jquery.ui.mouse.js, jquery.ui.draggable.js, jquery.ui.resizable.js
* Copyright 2013 jQuery Foundation and other contributors; Licensed MIT */

(function(e,t){function i(t,i){var s,a,o,r=t.nodeName.toLowerCase();return"area"===r?(s=t.parentNode,a=s.name,t.href&&a&&"map"===s.nodeName.toLowerCase()?(o=e("img[usemap=#"+a+"]")[0],!!o&&n(o)):!1):(/input|select|textarea|button|object/.test(r)?!t.disabled:"a"===r?t.href||i:i)&&n(t)}function n(t){return e.expr.filters.visible(t)&&!e(t).parents().addBack().filter(function(){return"hidden"===e.css(this,"visibility")}).length}var s=0,a=/^ui-id-\d+$/;e.ui=e.ui||{},e.extend(e.ui,{version:"1.10.3",keyCode:{BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38}}),e.fn.extend({focus:function(t){return function(i,n){return"number"==typeof i?this.each(function(){var t=this;setTimeout(function(){e(t).focus(),n&&n.call(t)},i)}):t.apply(this,arguments)}}(e.fn.focus),scrollParent:function(){var t;return t=e.ui.ie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?this.parents().filter(function(){return/(relative|absolute|fixed)/.test(e.css(this,"position"))&&/(auto|scroll)/.test(e.css(this,"overflow")+e.css(this,"overflow-y")+e.css(this,"overflow-x"))}).eq(0):this.parents().filter(function(){return/(auto|scroll)/.test(e.css(this,"overflow")+e.css(this,"overflow-y")+e.css(this,"overflow-x"))}).eq(0),/fixed/.test(this.css("position"))||!t.length?e(document):t},zIndex:function(i){if(i!==t)return this.css("zIndex",i);if(this.length)for(var n,s,a=e(this[0]);a.length&&a[0]!==document;){if(n=a.css("position"),("absolute"===n||"relative"===n||"fixed"===n)&&(s=parseInt(a.css("zIndex"),10),!isNaN(s)&&0!==s))return s;a=a.parent()}return 0},uniqueId:function(){return this.each(function(){this.id||(this.id="ui-id-"+ ++s)})},removeUniqueId:function(){return this.each(function(){a.test(this.id)&&e(this).removeAttr("id")})}}),e.extend(e.expr[":"],{data:e.expr.createPseudo?e.expr.createPseudo(function(t){return function(i){return!!e.data(i,t)}}):function(t,i,n){return!!e.data(t,n[3])},focusable:function(t){return i(t,!isNaN(e.attr(t,"tabindex")))},tabbable:function(t){var n=e.attr(t,"tabindex"),s=isNaN(n);return(s||n>=0)&&i(t,!s)}}),e("<a>").outerWidth(1).jquery||e.each(["Width","Height"],function(i,n){function s(t,i,n,s){return e.each(a,function(){i-=parseFloat(e.css(t,"padding"+this))||0,n&&(i-=parseFloat(e.css(t,"border"+this+"Width"))||0),s&&(i-=parseFloat(e.css(t,"margin"+this))||0)}),i}var a="Width"===n?["Left","Right"]:["Top","Bottom"],o=n.toLowerCase(),r={innerWidth:e.fn.innerWidth,innerHeight:e.fn.innerHeight,outerWidth:e.fn.outerWidth,outerHeight:e.fn.outerHeight};e.fn["inner"+n]=function(i){return i===t?r["inner"+n].call(this):this.each(function(){e(this).css(o,s(this,i)+"px")})},e.fn["outer"+n]=function(t,i){return"number"!=typeof t?r["outer"+n].call(this,t):this.each(function(){e(this).css(o,s(this,t,!0,i)+"px")})}}),e.fn.addBack||(e.fn.addBack=function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}),e("<a>").data("a-b","a").removeData("a-b").data("a-b")&&(e.fn.removeData=function(t){return function(i){return arguments.length?t.call(this,e.camelCase(i)):t.call(this)}}(e.fn.removeData)),e.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()),e.support.selectstart="onselectstart"in document.createElement("div"),e.fn.extend({disableSelection:function(){return this.bind((e.support.selectstart?"selectstart":"mousedown")+".ui-disableSelection",function(e){e.preventDefault()})},enableSelection:function(){return this.unbind(".ui-disableSelection")}}),e.extend(e.ui,{plugin:{add:function(t,i,n){var s,a=e.ui[t].prototype;for(s in n)a.plugins[s]=a.plugins[s]||[],a.plugins[s].push([i,n[s]])},call:function(e,t,i){var n,s=e.plugins[t];if(s&&e.element[0].parentNode&&11!==e.element[0].parentNode.nodeType)for(n=0;s.length>n;n++)e.options[s[n][0]]&&s[n][1].apply(e.element,i)}},hasScroll:function(t,i){if("hidden"===e(t).css("overflow"))return!1;var n=i&&"left"===i?"scrollLeft":"scrollTop",s=!1;return t[n]>0?!0:(t[n]=1,s=t[n]>0,t[n]=0,s)}})})(jQuery);(function(t,e){var i=0,s=Array.prototype.slice,n=t.cleanData;t.cleanData=function(e){for(var i,s=0;null!=(i=e[s]);s++)try{t(i).triggerHandler("remove")}catch(o){}n(e)},t.widget=function(i,s,n){var o,a,r,h,l={},c=i.split(".")[0];i=i.split(".")[1],o=c+"-"+i,n||(n=s,s=t.Widget),t.expr[":"][o.toLowerCase()]=function(e){return!!t.data(e,o)},t[c]=t[c]||{},a=t[c][i],r=t[c][i]=function(t,i){return this._createWidget?(arguments.length&&this._createWidget(t,i),e):new r(t,i)},t.extend(r,a,{version:n.version,_proto:t.extend({},n),_childConstructors:[]}),h=new s,h.options=t.widget.extend({},h.options),t.each(n,function(i,n){return t.isFunction(n)?(l[i]=function(){var t=function(){return s.prototype[i].apply(this,arguments)},e=function(t){return s.prototype[i].apply(this,t)};return function(){var i,s=this._super,o=this._superApply;return this._super=t,this._superApply=e,i=n.apply(this,arguments),this._super=s,this._superApply=o,i}}(),e):(l[i]=n,e)}),r.prototype=t.widget.extend(h,{widgetEventPrefix:a?h.widgetEventPrefix:i},l,{constructor:r,namespace:c,widgetName:i,widgetFullName:o}),a?(t.each(a._childConstructors,function(e,i){var s=i.prototype;t.widget(s.namespace+"."+s.widgetName,r,i._proto)}),delete a._childConstructors):s._childConstructors.push(r),t.widget.bridge(i,r)},t.widget.extend=function(i){for(var n,o,a=s.call(arguments,1),r=0,h=a.length;h>r;r++)for(n in a[r])o=a[r][n],a[r].hasOwnProperty(n)&&o!==e&&(i[n]=t.isPlainObject(o)?t.isPlainObject(i[n])?t.widget.extend({},i[n],o):t.widget.extend({},o):o);return i},t.widget.bridge=function(i,n){var o=n.prototype.widgetFullName||i;t.fn[i]=function(a){var r="string"==typeof a,h=s.call(arguments,1),l=this;return a=!r&&h.length?t.widget.extend.apply(null,[a].concat(h)):a,r?this.each(function(){var s,n=t.data(this,o);return n?t.isFunction(n[a])&&"_"!==a.charAt(0)?(s=n[a].apply(n,h),s!==n&&s!==e?(l=s&&s.jquery?l.pushStack(s.get()):s,!1):e):t.error("no such method '"+a+"' for "+i+" widget instance"):t.error("cannot call methods on "+i+" prior to initialization; "+"attempted to call method '"+a+"'")}):this.each(function(){var e=t.data(this,o);e?e.option(a||{})._init():t.data(this,o,new n(a,this))}),l}},t.Widget=function(){},t.Widget._childConstructors=[],t.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{disabled:!1,create:null},_createWidget:function(e,s){s=t(s||this.defaultElement||this)[0],this.element=t(s),this.uuid=i++,this.eventNamespace="."+this.widgetName+this.uuid,this.options=t.widget.extend({},this.options,this._getCreateOptions(),e),this.bindings=t(),this.hoverable=t(),this.focusable=t(),s!==this&&(t.data(s,this.widgetFullName,this),this._on(!0,this.element,{remove:function(t){t.target===s&&this.destroy()}}),this.document=t(s.style?s.ownerDocument:s.document||s),this.window=t(this.document[0].defaultView||this.document[0].parentWindow)),this._create(),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:t.noop,_getCreateEventData:t.noop,_create:t.noop,_init:t.noop,destroy:function(){this._destroy(),this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(t.camelCase(this.widgetFullName)),this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName+"-disabled "+"ui-state-disabled"),this.bindings.unbind(this.eventNamespace),this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus")},_destroy:t.noop,widget:function(){return this.element},option:function(i,s){var n,o,a,r=i;if(0===arguments.length)return t.widget.extend({},this.options);if("string"==typeof i)if(r={},n=i.split("."),i=n.shift(),n.length){for(o=r[i]=t.widget.extend({},this.options[i]),a=0;n.length-1>a;a++)o[n[a]]=o[n[a]]||{},o=o[n[a]];if(i=n.pop(),s===e)return o[i]===e?null:o[i];o[i]=s}else{if(s===e)return this.options[i]===e?null:this.options[i];r[i]=s}return this._setOptions(r),this},_setOptions:function(t){var e;for(e in t)this._setOption(e,t[e]);return this},_setOption:function(t,e){return this.options[t]=e,"disabled"===t&&(this.widget().toggleClass(this.widgetFullName+"-disabled ui-state-disabled",!!e).attr("aria-disabled",e),this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus")),this},enable:function(){return this._setOption("disabled",!1)},disable:function(){return this._setOption("disabled",!0)},_on:function(i,s,n){var o,a=this;"boolean"!=typeof i&&(n=s,s=i,i=!1),n?(s=o=t(s),this.bindings=this.bindings.add(s)):(n=s,s=this.element,o=this.widget()),t.each(n,function(n,r){function h(){return i||a.options.disabled!==!0&&!t(this).hasClass("ui-state-disabled")?("string"==typeof r?a[r]:r).apply(a,arguments):e}"string"!=typeof r&&(h.guid=r.guid=r.guid||h.guid||t.guid++);var l=n.match(/^(\w+)\s*(.*)$/),c=l[1]+a.eventNamespace,u=l[2];u?o.delegate(u,c,h):s.bind(c,h)})},_off:function(t,e){e=(e||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,t.unbind(e).undelegate(e)},_delay:function(t,e){function i(){return("string"==typeof t?s[t]:t).apply(s,arguments)}var s=this;return setTimeout(i,e||0)},_hoverable:function(e){this.hoverable=this.hoverable.add(e),this._on(e,{mouseenter:function(e){t(e.currentTarget).addClass("ui-state-hover")},mouseleave:function(e){t(e.currentTarget).removeClass("ui-state-hover")}})},_focusable:function(e){this.focusable=this.focusable.add(e),this._on(e,{focusin:function(e){t(e.currentTarget).addClass("ui-state-focus")},focusout:function(e){t(e.currentTarget).removeClass("ui-state-focus")}})},_trigger:function(e,i,s){var n,o,a=this.options[e];if(s=s||{},i=t.Event(i),i.type=(e===this.widgetEventPrefix?e:this.widgetEventPrefix+e).toLowerCase(),i.target=this.element[0],o=i.originalEvent)for(n in o)n in i||(i[n]=o[n]);return this.element.trigger(i,s),!(t.isFunction(a)&&a.apply(this.element[0],[i].concat(s))===!1||i.isDefaultPrevented())}},t.each({show:"fadeIn",hide:"fadeOut"},function(e,i){t.Widget.prototype["_"+e]=function(s,n,o){"string"==typeof n&&(n={effect:n});var a,r=n?n===!0||"number"==typeof n?i:n.effect||i:e;n=n||{},"number"==typeof n&&(n={duration:n}),a=!t.isEmptyObject(n),n.complete=o,n.delay&&s.delay(n.delay),a&&t.effects&&t.effects.effect[r]?s[e](n):r!==e&&s[r]?s[r](n.duration,n.easing,o):s.queue(function(i){t(this)[e](),o&&o.call(s[0]),i()})}})})(jQuery);(function(t){var e=!1;t(document).mouseup(function(){e=!1}),t.widget("ui.mouse",{version:"1.10.3",options:{cancel:"input,textarea,button,select,option",distance:1,delay:0},_mouseInit:function(){var e=this;this.element.bind("mousedown."+this.widgetName,function(t){return e._mouseDown(t)}).bind("click."+this.widgetName,function(i){return!0===t.data(i.target,e.widgetName+".preventClickEvent")?(t.removeData(i.target,e.widgetName+".preventClickEvent"),i.stopImmediatePropagation(),!1):undefined}),this.started=!1},_mouseDestroy:function(){this.element.unbind("."+this.widgetName),this._mouseMoveDelegate&&t(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate)},_mouseDown:function(i){if(!e){this._mouseStarted&&this._mouseUp(i),this._mouseDownEvent=i;var s=this,n=1===i.which,a="string"==typeof this.options.cancel&&i.target.nodeName?t(i.target).closest(this.options.cancel).length:!1;return n&&!a&&this._mouseCapture(i)?(this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){s.mouseDelayMet=!0},this.options.delay)),this._mouseDistanceMet(i)&&this._mouseDelayMet(i)&&(this._mouseStarted=this._mouseStart(i)!==!1,!this._mouseStarted)?(i.preventDefault(),!0):(!0===t.data(i.target,this.widgetName+".preventClickEvent")&&t.removeData(i.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(t){return s._mouseMove(t)},this._mouseUpDelegate=function(t){return s._mouseUp(t)},t(document).bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate),i.preventDefault(),e=!0,!0)):!0}},_mouseMove:function(e){return t.ui.ie&&(!document.documentMode||9>document.documentMode)&&!e.button?this._mouseUp(e):this._mouseStarted?(this._mouseDrag(e),e.preventDefault()):(this._mouseDistanceMet(e)&&this._mouseDelayMet(e)&&(this._mouseStarted=this._mouseStart(this._mouseDownEvent,e)!==!1,this._mouseStarted?this._mouseDrag(e):this._mouseUp(e)),!this._mouseStarted)},_mouseUp:function(e){return t(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,e.target===this._mouseDownEvent.target&&t.data(e.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(e)),!1},_mouseDistanceMet:function(t){return Math.max(Math.abs(this._mouseDownEvent.pageX-t.pageX),Math.abs(this._mouseDownEvent.pageY-t.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return!0}})})(jQuery);(function(t){t.widget("ui.draggable",t.ui.mouse,{version:"1.10.3",widgetEventPrefix:"drag",options:{addClasses:!0,appendTo:"parent",axis:!1,connectToSortable:!1,containment:!1,cursor:"auto",cursorAt:!1,grid:!1,handle:!1,helper:"original",iframeFix:!1,opacity:!1,refreshPositions:!1,revert:!1,revertDuration:500,scope:"default",scroll:!0,scrollSensitivity:20,scrollSpeed:20,snap:!1,snapMode:"both",snapTolerance:20,stack:!1,zIndex:!1,drag:null,start:null,stop:null},_create:function(){"original"!==this.options.helper||/^(?:r|a|f)/.test(this.element.css("position"))||(this.element[0].style.position="relative"),this.options.addClasses&&this.element.addClass("ui-draggable"),this.options.disabled&&this.element.addClass("ui-draggable-disabled"),this._mouseInit()},_destroy:function(){this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"),this._mouseDestroy()},_mouseCapture:function(e){var i=this.options;return this.helper||i.disabled||t(e.target).closest(".ui-resizable-handle").length>0?!1:(this.handle=this._getHandle(e),this.handle?(t(i.iframeFix===!0?"iframe":i.iframeFix).each(function(){t("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({width:this.offsetWidth+"px",height:this.offsetHeight+"px",position:"absolute",opacity:"0.001",zIndex:1e3}).css(t(this).offset()).appendTo("body")}),!0):!1)},_mouseStart:function(e){var i=this.options;return this.helper=this._createHelper(e),this.helper.addClass("ui-draggable-dragging"),this._cacheHelperProportions(),t.ui.ddmanager&&(t.ui.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(),this.offsetParent=this.helper.offsetParent(),this.offsetParentCssPosition=this.offsetParent.css("position"),this.offset=this.positionAbs=this.element.offset(),this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left},this.offset.scroll=!1,t.extend(this.offset,{click:{left:e.pageX-this.offset.left,top:e.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()}),this.originalPosition=this.position=this._generatePosition(e),this.originalPageX=e.pageX,this.originalPageY=e.pageY,i.cursorAt&&this._adjustOffsetFromHelper(i.cursorAt),this._setContainment(),this._trigger("start",e)===!1?(this._clear(),!1):(this._cacheHelperProportions(),t.ui.ddmanager&&!i.dropBehaviour&&t.ui.ddmanager.prepareOffsets(this,e),this._mouseDrag(e,!0),t.ui.ddmanager&&t.ui.ddmanager.dragStart(this,e),!0)},_mouseDrag:function(e,i){if("fixed"===this.offsetParentCssPosition&&(this.offset.parent=this._getParentOffset()),this.position=this._generatePosition(e),this.positionAbs=this._convertPositionTo("absolute"),!i){var s=this._uiHash();if(this._trigger("drag",e,s)===!1)return this._mouseUp({}),!1;this.position=s.position}return this.options.axis&&"y"===this.options.axis||(this.helper[0].style.left=this.position.left+"px"),this.options.axis&&"x"===this.options.axis||(this.helper[0].style.top=this.position.top+"px"),t.ui.ddmanager&&t.ui.ddmanager.drag(this,e),!1},_mouseStop:function(e){var i=this,s=!1;return t.ui.ddmanager&&!this.options.dropBehaviour&&(s=t.ui.ddmanager.drop(this,e)),this.dropped&&(s=this.dropped,this.dropped=!1),"original"!==this.options.helper||t.contains(this.element[0].ownerDocument,this.element[0])?("invalid"===this.options.revert&&!s||"valid"===this.options.revert&&s||this.options.revert===!0||t.isFunction(this.options.revert)&&this.options.revert.call(this.element,s)?t(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){i._trigger("stop",e)!==!1&&i._clear()}):this._trigger("stop",e)!==!1&&this._clear(),!1):!1},_mouseUp:function(e){return t("div.ui-draggable-iframeFix").each(function(){this.parentNode.removeChild(this)}),t.ui.ddmanager&&t.ui.ddmanager.dragStop(this,e),t.ui.mouse.prototype._mouseUp.call(this,e)},cancel:function(){return this.helper.is(".ui-draggable-dragging")?this._mouseUp({}):this._clear(),this},_getHandle:function(e){return this.options.handle?!!t(e.target).closest(this.element.find(this.options.handle)).length:!0},_createHelper:function(e){var i=this.options,s=t.isFunction(i.helper)?t(i.helper.apply(this.element[0],[e])):"clone"===i.helper?this.element.clone().removeAttr("id"):this.element;return s.parents("body").length||s.appendTo("parent"===i.appendTo?this.element[0].parentNode:i.appendTo),s[0]===this.element[0]||/(fixed|absolute)/.test(s.css("position"))||s.css("position","absolute"),s},_adjustOffsetFromHelper:function(e){"string"==typeof e&&(e=e.split(" ")),t.isArray(e)&&(e={left:+e[0],top:+e[1]||0}),"left"in e&&(this.offset.click.left=e.left+this.margins.left),"right"in e&&(this.offset.click.left=this.helperProportions.width-e.right+this.margins.left),"top"in e&&(this.offset.click.top=e.top+this.margins.top),"bottom"in e&&(this.offset.click.top=this.helperProportions.height-e.bottom+this.margins.top)},_getParentOffset:function(){var e=this.offsetParent.offset();return"absolute"===this.cssPosition&&this.scrollParent[0]!==document&&t.contains(this.scrollParent[0],this.offsetParent[0])&&(e.left+=this.scrollParent.scrollLeft(),e.top+=this.scrollParent.scrollTop()),(this.offsetParent[0]===document.body||this.offsetParent[0].tagName&&"html"===this.offsetParent[0].tagName.toLowerCase()&&t.ui.ie)&&(e={top:0,left:0}),{top:e.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:e.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if("relative"===this.cssPosition){var t=this.element.position();return{top:t.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:t.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0,right:parseInt(this.element.css("marginRight"),10)||0,bottom:parseInt(this.element.css("marginBottom"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var e,i,s,n=this.options;return n.containment?"window"===n.containment?(this.containment=[t(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,t(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,t(window).scrollLeft()+t(window).width()-this.helperProportions.width-this.margins.left,t(window).scrollTop()+(t(window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top],undefined):"document"===n.containment?(this.containment=[0,0,t(document).width()-this.helperProportions.width-this.margins.left,(t(document).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top],undefined):n.containment.constructor===Array?(this.containment=n.containment,undefined):("parent"===n.containment&&(n.containment=this.helper[0].parentNode),i=t(n.containment),s=i[0],s&&(e="hidden"!==i.css("overflow"),this.containment=[(parseInt(i.css("borderLeftWidth"),10)||0)+(parseInt(i.css("paddingLeft"),10)||0),(parseInt(i.css("borderTopWidth"),10)||0)+(parseInt(i.css("paddingTop"),10)||0),(e?Math.max(s.scrollWidth,s.offsetWidth):s.offsetWidth)-(parseInt(i.css("borderRightWidth"),10)||0)-(parseInt(i.css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(e?Math.max(s.scrollHeight,s.offsetHeight):s.offsetHeight)-(parseInt(i.css("borderBottomWidth"),10)||0)-(parseInt(i.css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relative_container=i),undefined):(this.containment=null,undefined)},_convertPositionTo:function(e,i){i||(i=this.position);var s="absolute"===e?1:-1,n="absolute"!==this.cssPosition||this.scrollParent[0]!==document&&t.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent;return this.offset.scroll||(this.offset.scroll={top:n.scrollTop(),left:n.scrollLeft()}),{top:i.top+this.offset.relative.top*s+this.offset.parent.top*s-("fixed"===this.cssPosition?-this.scrollParent.scrollTop():this.offset.scroll.top)*s,left:i.left+this.offset.relative.left*s+this.offset.parent.left*s-("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():this.offset.scroll.left)*s}},_generatePosition:function(e){var i,s,n,a,o=this.options,r="absolute"!==this.cssPosition||this.scrollParent[0]!==document&&t.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,l=e.pageX,h=e.pageY;return this.offset.scroll||(this.offset.scroll={top:r.scrollTop(),left:r.scrollLeft()}),this.originalPosition&&(this.containment&&(this.relative_container?(s=this.relative_container.offset(),i=[this.containment[0]+s.left,this.containment[1]+s.top,this.containment[2]+s.left,this.containment[3]+s.top]):i=this.containment,e.pageX-this.offset.click.left<i[0]&&(l=i[0]+this.offset.click.left),e.pageY-this.offset.click.top<i[1]&&(h=i[1]+this.offset.click.top),e.pageX-this.offset.click.left>i[2]&&(l=i[2]+this.offset.click.left),e.pageY-this.offset.click.top>i[3]&&(h=i[3]+this.offset.click.top)),o.grid&&(n=o.grid[1]?this.originalPageY+Math.round((h-this.originalPageY)/o.grid[1])*o.grid[1]:this.originalPageY,h=i?n-this.offset.click.top>=i[1]||n-this.offset.click.top>i[3]?n:n-this.offset.click.top>=i[1]?n-o.grid[1]:n+o.grid[1]:n,a=o.grid[0]?this.originalPageX+Math.round((l-this.originalPageX)/o.grid[0])*o.grid[0]:this.originalPageX,l=i?a-this.offset.click.left>=i[0]||a-this.offset.click.left>i[2]?a:a-this.offset.click.left>=i[0]?a-o.grid[0]:a+o.grid[0]:a)),{top:h-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+("fixed"===this.cssPosition?-this.scrollParent.scrollTop():this.offset.scroll.top),left:l-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():this.offset.scroll.left)}},_clear:function(){this.helper.removeClass("ui-draggable-dragging"),this.helper[0]===this.element[0]||this.cancelHelperRemoval||this.helper.remove(),this.helper=null,this.cancelHelperRemoval=!1},_trigger:function(e,i,s){return s=s||this._uiHash(),t.ui.plugin.call(this,e,[i,s]),"drag"===e&&(this.positionAbs=this._convertPositionTo("absolute")),t.Widget.prototype._trigger.call(this,e,i,s)},plugins:{},_uiHash:function(){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}}),t.ui.plugin.add("draggable","connectToSortable",{start:function(e,i){var s=t(this).data("ui-draggable"),n=s.options,a=t.extend({},i,{item:s.element});s.sortables=[],t(n.connectToSortable).each(function(){var i=t.data(this,"ui-sortable");i&&!i.options.disabled&&(s.sortables.push({instance:i,shouldRevert:i.options.revert}),i.refreshPositions(),i._trigger("activate",e,a))})},stop:function(e,i){var s=t(this).data("ui-draggable"),n=t.extend({},i,{item:s.element});t.each(s.sortables,function(){this.instance.isOver?(this.instance.isOver=0,s.cancelHelperRemoval=!0,this.instance.cancelHelperRemoval=!1,this.shouldRevert&&(this.instance.options.revert=this.shouldRevert),this.instance._mouseStop(e),this.instance.options.helper=this.instance.options._helper,"original"===s.options.helper&&this.instance.currentItem.css({top:"auto",left:"auto"})):(this.instance.cancelHelperRemoval=!1,this.instance._trigger("deactivate",e,n))})},drag:function(e,i){var s=t(this).data("ui-draggable"),n=this;t.each(s.sortables,function(){var a=!1,o=this;this.instance.positionAbs=s.positionAbs,this.instance.helperProportions=s.helperProportions,this.instance.offset.click=s.offset.click,this.instance._intersectsWith(this.instance.containerCache)&&(a=!0,t.each(s.sortables,function(){return this.instance.positionAbs=s.positionAbs,this.instance.helperProportions=s.helperProportions,this.instance.offset.click=s.offset.click,this!==o&&this.instance._intersectsWith(this.instance.containerCache)&&t.contains(o.instance.element[0],this.instance.element[0])&&(a=!1),a})),a?(this.instance.isOver||(this.instance.isOver=1,this.instance.currentItem=t(n).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item",!0),this.instance.options._helper=this.instance.options.helper,this.instance.options.helper=function(){return i.helper[0]},e.target=this.instance.currentItem[0],this.instance._mouseCapture(e,!0),this.instance._mouseStart(e,!0,!0),this.instance.offset.click.top=s.offset.click.top,this.instance.offset.click.left=s.offset.click.left,this.instance.offset.parent.left-=s.offset.parent.left-this.instance.offset.parent.left,this.instance.offset.parent.top-=s.offset.parent.top-this.instance.offset.parent.top,s._trigger("toSortable",e),s.dropped=this.instance.element,s.currentItem=s.element,this.instance.fromOutside=s),this.instance.currentItem&&this.instance._mouseDrag(e)):this.instance.isOver&&(this.instance.isOver=0,this.instance.cancelHelperRemoval=!0,this.instance.options.revert=!1,this.instance._trigger("out",e,this.instance._uiHash(this.instance)),this.instance._mouseStop(e,!0),this.instance.options.helper=this.instance.options._helper,this.instance.currentItem.remove(),this.instance.placeholder&&this.instance.placeholder.remove(),s._trigger("fromSortable",e),s.dropped=!1)})}}),t.ui.plugin.add("draggable","cursor",{start:function(){var e=t("body"),i=t(this).data("ui-draggable").options;e.css("cursor")&&(i._cursor=e.css("cursor")),e.css("cursor",i.cursor)},stop:function(){var e=t(this).data("ui-draggable").options;e._cursor&&t("body").css("cursor",e._cursor)}}),t.ui.plugin.add("draggable","opacity",{start:function(e,i){var s=t(i.helper),n=t(this).data("ui-draggable").options;s.css("opacity")&&(n._opacity=s.css("opacity")),s.css("opacity",n.opacity)},stop:function(e,i){var s=t(this).data("ui-draggable").options;s._opacity&&t(i.helper).css("opacity",s._opacity)}}),t.ui.plugin.add("draggable","scroll",{start:function(){var e=t(this).data("ui-draggable");e.scrollParent[0]!==document&&"HTML"!==e.scrollParent[0].tagName&&(e.overflowOffset=e.scrollParent.offset())},drag:function(e){var i=t(this).data("ui-draggable"),s=i.options,n=!1;i.scrollParent[0]!==document&&"HTML"!==i.scrollParent[0].tagName?(s.axis&&"x"===s.axis||(i.overflowOffset.top+i.scrollParent[0].offsetHeight-e.pageY<s.scrollSensitivity?i.scrollParent[0].scrollTop=n=i.scrollParent[0].scrollTop+s.scrollSpeed:e.pageY-i.overflowOffset.top<s.scrollSensitivity&&(i.scrollParent[0].scrollTop=n=i.scrollParent[0].scrollTop-s.scrollSpeed)),s.axis&&"y"===s.axis||(i.overflowOffset.left+i.scrollParent[0].offsetWidth-e.pageX<s.scrollSensitivity?i.scrollParent[0].scrollLeft=n=i.scrollParent[0].scrollLeft+s.scrollSpeed:e.pageX-i.overflowOffset.left<s.scrollSensitivity&&(i.scrollParent[0].scrollLeft=n=i.scrollParent[0].scrollLeft-s.scrollSpeed))):(s.axis&&"x"===s.axis||(e.pageY-t(document).scrollTop()<s.scrollSensitivity?n=t(document).scrollTop(t(document).scrollTop()-s.scrollSpeed):t(window).height()-(e.pageY-t(document).scrollTop())<s.scrollSensitivity&&(n=t(document).scrollTop(t(document).scrollTop()+s.scrollSpeed))),s.axis&&"y"===s.axis||(e.pageX-t(document).scrollLeft()<s.scrollSensitivity?n=t(document).scrollLeft(t(document).scrollLeft()-s.scrollSpeed):t(window).width()-(e.pageX-t(document).scrollLeft())<s.scrollSensitivity&&(n=t(document).scrollLeft(t(document).scrollLeft()+s.scrollSpeed)))),n!==!1&&t.ui.ddmanager&&!s.dropBehaviour&&t.ui.ddmanager.prepareOffsets(i,e)}}),t.ui.plugin.add("draggable","snap",{start:function(){var e=t(this).data("ui-draggable"),i=e.options;e.snapElements=[],t(i.snap.constructor!==String?i.snap.items||":data(ui-draggable)":i.snap).each(function(){var i=t(this),s=i.offset();this!==e.element[0]&&e.snapElements.push({item:this,width:i.outerWidth(),height:i.outerHeight(),top:s.top,left:s.left})})},drag:function(e,i){var s,n,a,o,r,l,h,c,u,d,p=t(this).data("ui-draggable"),g=p.options,f=g.snapTolerance,m=i.offset.left,_=m+p.helperProportions.width,v=i.offset.top,b=v+p.helperProportions.height;for(u=p.snapElements.length-1;u>=0;u--)r=p.snapElements[u].left,l=r+p.snapElements[u].width,h=p.snapElements[u].top,c=h+p.snapElements[u].height,r-f>_||m>l+f||h-f>b||v>c+f||!t.contains(p.snapElements[u].item.ownerDocument,p.snapElements[u].item)?(p.snapElements[u].snapping&&p.options.snap.release&&p.options.snap.release.call(p.element,e,t.extend(p._uiHash(),{snapItem:p.snapElements[u].item})),p.snapElements[u].snapping=!1):("inner"!==g.snapMode&&(s=f>=Math.abs(h-b),n=f>=Math.abs(c-v),a=f>=Math.abs(r-_),o=f>=Math.abs(l-m),s&&(i.position.top=p._convertPositionTo("relative",{top:h-p.helperProportions.height,left:0}).top-p.margins.top),n&&(i.position.top=p._convertPositionTo("relative",{top:c,left:0}).top-p.margins.top),a&&(i.position.left=p._convertPositionTo("relative",{top:0,left:r-p.helperProportions.width}).left-p.margins.left),o&&(i.position.left=p._convertPositionTo("relative",{top:0,left:l}).left-p.margins.left)),d=s||n||a||o,"outer"!==g.snapMode&&(s=f>=Math.abs(h-v),n=f>=Math.abs(c-b),a=f>=Math.abs(r-m),o=f>=Math.abs(l-_),s&&(i.position.top=p._convertPositionTo("relative",{top:h,left:0}).top-p.margins.top),n&&(i.position.top=p._convertPositionTo("relative",{top:c-p.helperProportions.height,left:0}).top-p.margins.top),a&&(i.position.left=p._convertPositionTo("relative",{top:0,left:r}).left-p.margins.left),o&&(i.position.left=p._convertPositionTo("relative",{top:0,left:l-p.helperProportions.width}).left-p.margins.left)),!p.snapElements[u].snapping&&(s||n||a||o||d)&&p.options.snap.snap&&p.options.snap.snap.call(p.element,e,t.extend(p._uiHash(),{snapItem:p.snapElements[u].item})),p.snapElements[u].snapping=s||n||a||o||d)}}),t.ui.plugin.add("draggable","stack",{start:function(){var e,i=this.data("ui-draggable").options,s=t.makeArray(t(i.stack)).sort(function(e,i){return(parseInt(t(e).css("zIndex"),10)||0)-(parseInt(t(i).css("zIndex"),10)||0)});s.length&&(e=parseInt(t(s[0]).css("zIndex"),10)||0,t(s).each(function(i){t(this).css("zIndex",e+i)}),this.css("zIndex",e+s.length))}}),t.ui.plugin.add("draggable","zIndex",{start:function(e,i){var s=t(i.helper),n=t(this).data("ui-draggable").options;s.css("zIndex")&&(n._zIndex=s.css("zIndex")),s.css("zIndex",n.zIndex)},stop:function(e,i){var s=t(this).data("ui-draggable").options;s._zIndex&&t(i.helper).css("zIndex",s._zIndex)}})})(jQuery);(function(t){function e(t){return parseInt(t,10)||0}function i(t){return!isNaN(parseInt(t,10))}t.widget("ui.resizable",t.ui.mouse,{version:"1.10.3",widgetEventPrefix:"resize",options:{alsoResize:!1,animate:!1,animateDuration:"slow",animateEasing:"swing",aspectRatio:!1,autoHide:!1,containment:!1,ghost:!1,grid:!1,handles:"e,s,se",helper:!1,maxHeight:null,maxWidth:null,minHeight:10,minWidth:10,zIndex:90,resize:null,start:null,stop:null},_create:function(){var e,i,s,n,a,o=this,r=this.options;if(this.element.addClass("ui-resizable"),t.extend(this,{_aspectRatio:!!r.aspectRatio,aspectRatio:r.aspectRatio,originalElement:this.element,_proportionallyResizeElements:[],_helper:r.helper||r.ghost||r.animate?r.helper||"ui-resizable-helper":null}),this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i)&&(this.element.wrap(t("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({position:this.element.css("position"),width:this.element.outerWidth(),height:this.element.outerHeight(),top:this.element.css("top"),left:this.element.css("left")})),this.element=this.element.parent().data("ui-resizable",this.element.data("ui-resizable")),this.elementIsWrapper=!0,this.element.css({marginLeft:this.originalElement.css("marginLeft"),marginTop:this.originalElement.css("marginTop"),marginRight:this.originalElement.css("marginRight"),marginBottom:this.originalElement.css("marginBottom")}),this.originalElement.css({marginLeft:0,marginTop:0,marginRight:0,marginBottom:0}),this.originalResizeStyle=this.originalElement.css("resize"),this.originalElement.css("resize","none"),this._proportionallyResizeElements.push(this.originalElement.css({position:"static",zoom:1,display:"block"})),this.originalElement.css({margin:this.originalElement.css("margin")}),this._proportionallyResize()),this.handles=r.handles||(t(".ui-resizable-handle",this.element).length?{n:".ui-resizable-n",e:".ui-resizable-e",s:".ui-resizable-s",w:".ui-resizable-w",se:".ui-resizable-se",sw:".ui-resizable-sw",ne:".ui-resizable-ne",nw:".ui-resizable-nw"}:"e,s,se"),this.handles.constructor===String)for("all"===this.handles&&(this.handles="n,e,s,w,se,sw,ne,nw"),e=this.handles.split(","),this.handles={},i=0;e.length>i;i++)s=t.trim(e[i]),a="ui-resizable-"+s,n=t("<div class='ui-resizable-handle "+a+"'></div>"),n.css({zIndex:r.zIndex}),"se"===s&&n.addClass("ui-icon ui-icon-gripsmall-diagonal-se"),this.handles[s]=".ui-resizable-"+s,this.element.append(n);this._renderAxis=function(e){var i,s,n,a;e=e||this.element;for(i in this.handles)this.handles[i].constructor===String&&(this.handles[i]=t(this.handles[i],this.element).show()),this.elementIsWrapper&&this.originalElement[0].nodeName.match(/textarea|input|select|button/i)&&(s=t(this.handles[i],this.element),a=/sw|ne|nw|se|n|s/.test(i)?s.outerHeight():s.outerWidth(),n=["padding",/ne|nw|n/.test(i)?"Top":/se|sw|s/.test(i)?"Bottom":/^e$/.test(i)?"Right":"Left"].join(""),e.css(n,a),this._proportionallyResize()),t(this.handles[i]).length},this._renderAxis(this.element),this._handles=t(".ui-resizable-handle",this.element).disableSelection(),this._handles.mouseover(function(){o.resizing||(this.className&&(n=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)),o.axis=n&&n[1]?n[1]:"se")}),r.autoHide&&(this._handles.hide(),t(this.element).addClass("ui-resizable-autohide").mouseenter(function(){r.disabled||(t(this).removeClass("ui-resizable-autohide"),o._handles.show())}).mouseleave(function(){r.disabled||o.resizing||(t(this).addClass("ui-resizable-autohide"),o._handles.hide())})),this._mouseInit()},_destroy:function(){this._mouseDestroy();var e,i=function(e){t(e).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()};return this.elementIsWrapper&&(i(this.element),e=this.element,this.originalElement.css({position:e.css("position"),width:e.outerWidth(),height:e.outerHeight(),top:e.css("top"),left:e.css("left")}).insertAfter(e),e.remove()),this.originalElement.css("resize",this.originalResizeStyle),i(this.originalElement),this},_mouseCapture:function(e){var i,s,n=!1;for(i in this.handles)s=t(this.handles[i])[0],(s===e.target||t.contains(s,e.target))&&(n=!0);return!this.options.disabled&&n},_mouseStart:function(i){var s,n,a,o=this.options,r=this.element.position(),h=this.element;return this.resizing=!0,/absolute/.test(h.css("position"))?h.css({position:"absolute",top:h.css("top"),left:h.css("left")}):h.is(".ui-draggable")&&h.css({position:"absolute",top:r.top,left:r.left}),this._renderProxy(),s=e(this.helper.css("left")),n=e(this.helper.css("top")),o.containment&&(s+=t(o.containment).scrollLeft()||0,n+=t(o.containment).scrollTop()||0),this.offset=this.helper.offset(),this.position={left:s,top:n},this.size=this._helper?{width:h.outerWidth(),height:h.outerHeight()}:{width:h.width(),height:h.height()},this.originalSize=this._helper?{width:h.outerWidth(),height:h.outerHeight()}:{width:h.width(),height:h.height()},this.originalPosition={left:s,top:n},this.sizeDiff={width:h.outerWidth()-h.width(),height:h.outerHeight()-h.height()},this.originalMousePosition={left:i.pageX,top:i.pageY},this.aspectRatio="number"==typeof o.aspectRatio?o.aspectRatio:this.originalSize.width/this.originalSize.height||1,a=t(".ui-resizable-"+this.axis).css("cursor"),t("body").css("cursor","auto"===a?this.axis+"-resize":a),h.addClass("ui-resizable-resizing"),this._propagate("start",i),!0},_mouseDrag:function(e){var i,s=this.helper,n={},a=this.originalMousePosition,o=this.axis,r=this.position.top,h=this.position.left,l=this.size.width,c=this.size.height,u=e.pageX-a.left||0,d=e.pageY-a.top||0,p=this._change[o];return p?(i=p.apply(this,[e,u,d]),this._updateVirtualBoundaries(e.shiftKey),(this._aspectRatio||e.shiftKey)&&(i=this._updateRatio(i,e)),i=this._respectSize(i,e),this._updateCache(i),this._propagate("resize",e),this.position.top!==r&&(n.top=this.position.top+"px"),this.position.left!==h&&(n.left=this.position.left+"px"),this.size.width!==l&&(n.width=this.size.width+"px"),this.size.height!==c&&(n.height=this.size.height+"px"),s.css(n),!this._helper&&this._proportionallyResizeElements.length&&this._proportionallyResize(),t.isEmptyObject(n)||this._trigger("resize",e,this.ui()),!1):!1},_mouseStop:function(e){this.resizing=!1;var i,s,n,a,o,r,h,l=this.options,c=this;return this._helper&&(i=this._proportionallyResizeElements,s=i.length&&/textarea/i.test(i[0].nodeName),n=s&&t.ui.hasScroll(i[0],"left")?0:c.sizeDiff.height,a=s?0:c.sizeDiff.width,o={width:c.helper.width()-a,height:c.helper.height()-n},r=parseInt(c.element.css("left"),10)+(c.position.left-c.originalPosition.left)||null,h=parseInt(c.element.css("top"),10)+(c.position.top-c.originalPosition.top)||null,l.animate||this.element.css(t.extend(o,{top:h,left:r})),c.helper.height(c.size.height),c.helper.width(c.size.width),this._helper&&!l.animate&&this._proportionallyResize()),t("body").css("cursor","auto"),this.element.removeClass("ui-resizable-resizing"),this._propagate("stop",e),this._helper&&this.helper.remove(),!1},_updateVirtualBoundaries:function(t){var e,s,n,a,o,r=this.options;o={minWidth:i(r.minWidth)?r.minWidth:0,maxWidth:i(r.maxWidth)?r.maxWidth:1/0,minHeight:i(r.minHeight)?r.minHeight:0,maxHeight:i(r.maxHeight)?r.maxHeight:1/0},(this._aspectRatio||t)&&(e=o.minHeight*this.aspectRatio,n=o.minWidth/this.aspectRatio,s=o.maxHeight*this.aspectRatio,a=o.maxWidth/this.aspectRatio,e>o.minWidth&&(o.minWidth=e),n>o.minHeight&&(o.minHeight=n),o.maxWidth>s&&(o.maxWidth=s),o.maxHeight>a&&(o.maxHeight=a)),this._vBoundaries=o},_updateCache:function(t){this.offset=this.helper.offset(),i(t.left)&&(this.position.left=t.left),i(t.top)&&(this.position.top=t.top),i(t.height)&&(this.size.height=t.height),i(t.width)&&(this.size.width=t.width)},_updateRatio:function(t){var e=this.position,s=this.size,n=this.axis;return i(t.height)?t.width=t.height*this.aspectRatio:i(t.width)&&(t.height=t.width/this.aspectRatio),"sw"===n&&(t.left=e.left+(s.width-t.width),t.top=null),"nw"===n&&(t.top=e.top+(s.height-t.height),t.left=e.left+(s.width-t.width)),t},_respectSize:function(t){var e=this._vBoundaries,s=this.axis,n=i(t.width)&&e.maxWidth&&e.maxWidth<t.width,a=i(t.height)&&e.maxHeight&&e.maxHeight<t.height,o=i(t.width)&&e.minWidth&&e.minWidth>t.width,r=i(t.height)&&e.minHeight&&e.minHeight>t.height,h=this.originalPosition.left+this.originalSize.width,l=this.position.top+this.size.height,c=/sw|nw|w/.test(s),u=/nw|ne|n/.test(s);return o&&(t.width=e.minWidth),r&&(t.height=e.minHeight),n&&(t.width=e.maxWidth),a&&(t.height=e.maxHeight),o&&c&&(t.left=h-e.minWidth),n&&c&&(t.left=h-e.maxWidth),r&&u&&(t.top=l-e.minHeight),a&&u&&(t.top=l-e.maxHeight),t.width||t.height||t.left||!t.top?t.width||t.height||t.top||!t.left||(t.left=null):t.top=null,t},_proportionallyResize:function(){if(this._proportionallyResizeElements.length){var t,e,i,s,n,a=this.helper||this.element;for(t=0;this._proportionallyResizeElements.length>t;t++){if(n=this._proportionallyResizeElements[t],!this.borderDif)for(this.borderDif=[],i=[n.css("borderTopWidth"),n.css("borderRightWidth"),n.css("borderBottomWidth"),n.css("borderLeftWidth")],s=[n.css("paddingTop"),n.css("paddingRight"),n.css("paddingBottom"),n.css("paddingLeft")],e=0;i.length>e;e++)this.borderDif[e]=(parseInt(i[e],10)||0)+(parseInt(s[e],10)||0);n.css({height:a.height()-this.borderDif[0]-this.borderDif[2]||0,width:a.width()-this.borderDif[1]-this.borderDif[3]||0})}}},_renderProxy:function(){var e=this.element,i=this.options;this.elementOffset=e.offset(),this._helper?(this.helper=this.helper||t("<div style='overflow:hidden;'></div>"),this.helper.addClass(this._helper).css({width:this.element.outerWidth()-1,height:this.element.outerHeight()-1,position:"absolute",left:this.elementOffset.left+"px",top:this.elementOffset.top+"px",zIndex:++i.zIndex}),this.helper.appendTo("body").disableSelection()):this.helper=this.element},_change:{e:function(t,e){return{width:this.originalSize.width+e}},w:function(t,e){var i=this.originalSize,s=this.originalPosition;return{left:s.left+e,width:i.width-e}},n:function(t,e,i){var s=this.originalSize,n=this.originalPosition;return{top:n.top+i,height:s.height-i}},s:function(t,e,i){return{height:this.originalSize.height+i}},se:function(e,i,s){return t.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[e,i,s]))},sw:function(e,i,s){return t.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[e,i,s]))},ne:function(e,i,s){return t.extend(this._change.n.apply(this,arguments),this._change.e.apply(this,[e,i,s]))},nw:function(e,i,s){return t.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[e,i,s]))}},_propagate:function(e,i){t.ui.plugin.call(this,e,[i,this.ui()]),"resize"!==e&&this._trigger(e,i,this.ui())},plugins:{},ui:function(){return{originalElement:this.originalElement,element:this.element,helper:this.helper,position:this.position,size:this.size,originalSize:this.originalSize,originalPosition:this.originalPosition}}}),t.ui.plugin.add("resizable","animate",{stop:function(e){var i=t(this).data("ui-resizable"),s=i.options,n=i._proportionallyResizeElements,a=n.length&&/textarea/i.test(n[0].nodeName),o=a&&t.ui.hasScroll(n[0],"left")?0:i.sizeDiff.height,r=a?0:i.sizeDiff.width,h={width:i.size.width-r,height:i.size.height-o},l=parseInt(i.element.css("left"),10)+(i.position.left-i.originalPosition.left)||null,c=parseInt(i.element.css("top"),10)+(i.position.top-i.originalPosition.top)||null;i.element.animate(t.extend(h,c&&l?{top:c,left:l}:{}),{duration:s.animateDuration,easing:s.animateEasing,step:function(){var s={width:parseInt(i.element.css("width"),10),height:parseInt(i.element.css("height"),10),top:parseInt(i.element.css("top"),10),left:parseInt(i.element.css("left"),10)};n&&n.length&&t(n[0]).css({width:s.width,height:s.height}),i._updateCache(s),i._propagate("resize",e)}})}}),t.ui.plugin.add("resizable","containment",{start:function(){var i,s,n,a,o,r,h,l=t(this).data("ui-resizable"),c=l.options,u=l.element,d=c.containment,p=d instanceof t?d.get(0):/parent/.test(d)?u.parent().get(0):d;p&&(l.containerElement=t(p),/document/.test(d)||d===document?(l.containerOffset={left:0,top:0},l.containerPosition={left:0,top:0},l.parentData={element:t(document),left:0,top:0,width:t(document).width(),height:t(document).height()||document.body.parentNode.scrollHeight}):(i=t(p),s=[],t(["Top","Right","Left","Bottom"]).each(function(t,n){s[t]=e(i.css("padding"+n))}),l.containerOffset=i.offset(),l.containerPosition=i.position(),l.containerSize={height:i.innerHeight()-s[3],width:i.innerWidth()-s[1]},n=l.containerOffset,a=l.containerSize.height,o=l.containerSize.width,r=t.ui.hasScroll(p,"left")?p.scrollWidth:o,h=t.ui.hasScroll(p)?p.scrollHeight:a,l.parentData={element:p,left:n.left,top:n.top,width:r,height:h}))},resize:function(e){var i,s,n,a,o=t(this).data("ui-resizable"),r=o.options,h=o.containerOffset,l=o.position,c=o._aspectRatio||e.shiftKey,u={top:0,left:0},d=o.containerElement;d[0]!==document&&/static/.test(d.css("position"))&&(u=h),l.left<(o._helper?h.left:0)&&(o.size.width=o.size.width+(o._helper?o.position.left-h.left:o.position.left-u.left),c&&(o.size.height=o.size.width/o.aspectRatio),o.position.left=r.helper?h.left:0),l.top<(o._helper?h.top:0)&&(o.size.height=o.size.height+(o._helper?o.position.top-h.top:o.position.top),c&&(o.size.width=o.size.height*o.aspectRatio),o.position.top=o._helper?h.top:0),o.offset.left=o.parentData.left+o.position.left,o.offset.top=o.parentData.top+o.position.top,i=Math.abs((o._helper?o.offset.left-u.left:o.offset.left-u.left)+o.sizeDiff.width),s=Math.abs((o._helper?o.offset.top-u.top:o.offset.top-h.top)+o.sizeDiff.height),n=o.containerElement.get(0)===o.element.parent().get(0),a=/relative|absolute/.test(o.containerElement.css("position")),n&&a&&(i-=o.parentData.left),i+o.size.width>=o.parentData.width&&(o.size.width=o.parentData.width-i,c&&(o.size.height=o.size.width/o.aspectRatio)),s+o.size.height>=o.parentData.height&&(o.size.height=o.parentData.height-s,c&&(o.size.width=o.size.height*o.aspectRatio))},stop:function(){var e=t(this).data("ui-resizable"),i=e.options,s=e.containerOffset,n=e.containerPosition,a=e.containerElement,o=t(e.helper),r=o.offset(),h=o.outerWidth()-e.sizeDiff.width,l=o.outerHeight()-e.sizeDiff.height;e._helper&&!i.animate&&/relative/.test(a.css("position"))&&t(this).css({left:r.left-n.left-s.left,width:h,height:l}),e._helper&&!i.animate&&/static/.test(a.css("position"))&&t(this).css({left:r.left-n.left-s.left,width:h,height:l})}}),t.ui.plugin.add("resizable","alsoResize",{start:function(){var e=t(this).data("ui-resizable"),i=e.options,s=function(e){t(e).each(function(){var e=t(this);e.data("ui-resizable-alsoresize",{width:parseInt(e.width(),10),height:parseInt(e.height(),10),left:parseInt(e.css("left"),10),top:parseInt(e.css("top"),10)})})};"object"!=typeof i.alsoResize||i.alsoResize.parentNode?s(i.alsoResize):i.alsoResize.length?(i.alsoResize=i.alsoResize[0],s(i.alsoResize)):t.each(i.alsoResize,function(t){s(t)})},resize:function(e,i){var s=t(this).data("ui-resizable"),n=s.options,a=s.originalSize,o=s.originalPosition,r={height:s.size.height-a.height||0,width:s.size.width-a.width||0,top:s.position.top-o.top||0,left:s.position.left-o.left||0},h=function(e,s){t(e).each(function(){var e=t(this),n=t(this).data("ui-resizable-alsoresize"),a={},o=s&&s.length?s:e.parents(i.originalElement[0]).length?["width","height"]:["width","height","top","left"];t.each(o,function(t,e){var i=(n[e]||0)+(r[e]||0);i&&i>=0&&(a[e]=i||null)}),e.css(a)})};"object"!=typeof n.alsoResize||n.alsoResize.nodeType?h(n.alsoResize):t.each(n.alsoResize,function(t,e){h(t,e)})},stop:function(){t(this).removeData("resizable-alsoresize")}}),t.ui.plugin.add("resizable","ghost",{start:function(){var e=t(this).data("ui-resizable"),i=e.options,s=e.size;e.ghost=e.originalElement.clone(),e.ghost.css({opacity:.25,display:"block",position:"relative",height:s.height,width:s.width,margin:0,left:0,top:0}).addClass("ui-resizable-ghost").addClass("string"==typeof i.ghost?i.ghost:""),e.ghost.appendTo(e.helper)},resize:function(){var e=t(this).data("ui-resizable");e.ghost&&e.ghost.css({position:"relative",height:e.size.height,width:e.size.width})},stop:function(){var e=t(this).data("ui-resizable");e.ghost&&e.helper&&e.helper.get(0).removeChild(e.ghost.get(0))}}),t.ui.plugin.add("resizable","grid",{resize:function(){var e=t(this).data("ui-resizable"),i=e.options,s=e.size,n=e.originalSize,a=e.originalPosition,o=e.axis,r="number"==typeof i.grid?[i.grid,i.grid]:i.grid,h=r[0]||1,l=r[1]||1,c=Math.round((s.width-n.width)/h)*h,u=Math.round((s.height-n.height)/l)*l,d=n.width+c,p=n.height+u,f=i.maxWidth&&d>i.maxWidth,g=i.maxHeight&&p>i.maxHeight,m=i.minWidth&&i.minWidth>d,v=i.minHeight&&i.minHeight>p;i.grid=r,m&&(d+=h),v&&(p+=l),f&&(d-=h),g&&(p-=l),/^(se|s|e)$/.test(o)?(e.size.width=d,e.size.height=p):/^(ne)$/.test(o)?(e.size.width=d,e.size.height=p,e.position.top=a.top-u):/^(sw)$/.test(o)?(e.size.width=d,e.size.height=p,e.position.left=a.left-c):(e.size.width=d,e.size.height=p,e.position.top=a.top-u,e.position.left=a.left-c)}})})(jQuery);


//===========================================================================


/*! jQuery UI - v1.10.3 - 2013-10-20
* http://jqueryui.com
* Copyright 2013 jQuery Foundation and other contributors; Licensed MIT */

(function(e,t){var i="ui-effects-";e.effects={effect:{}},function(e,t){function i(e,t,i){var s=c[t.type]||{};return null==e?i||!t.def?null:t.def:(e=s.floor?~~e:parseFloat(e),isNaN(e)?t.def:s.mod?(e+s.mod)%s.mod:0>e?0:e>s.max?s.max:e)}function s(i){var s=l(),a=s._rgba=[];return i=i.toLowerCase(),f(h,function(e,n){var r,o=n.re.exec(i),h=o&&n.parse(o),l=n.space||"rgba";return h?(r=s[l](h),s[u[l].cache]=r[u[l].cache],a=s._rgba=r._rgba,!1):t}),a.length?("0,0,0,0"===a.join()&&e.extend(a,n.transparent),s):n[i]}function a(e,t,i){return i=(i+1)%1,1>6*i?e+6*(t-e)*i:1>2*i?t:2>3*i?e+6*(t-e)*(2/3-i):e}var n,r="backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",o=/^([\-+])=\s*(\d+\.?\d*)/,h=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(e){return[e[1],e[2],e[3],e[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(e){return[2.55*e[1],2.55*e[2],2.55*e[3],e[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(e){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(e){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(e){return[e[1],e[2]/100,e[3]/100,e[4]]}}],l=e.Color=function(t,i,s,a){return new e.Color.fn.parse(t,i,s,a)},u={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0,type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},c={"byte":{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},d=l.support={},p=e("<p>")[0],f=e.each;p.style.cssText="background-color:rgba(1,1,1,.5)",d.rgba=p.style.backgroundColor.indexOf("rgba")>-1,f(u,function(e,t){t.cache="_"+e,t.props.alpha={idx:3,type:"percent",def:1}}),l.fn=e.extend(l.prototype,{parse:function(a,r,o,h){if(a===t)return this._rgba=[null,null,null,null],this;(a.jquery||a.nodeType)&&(a=e(a).css(r),r=t);var c=this,d=e.type(a),p=this._rgba=[];return r!==t&&(a=[a,r,o,h],d="array"),"string"===d?this.parse(s(a)||n._default):"array"===d?(f(u.rgba.props,function(e,t){p[t.idx]=i(a[t.idx],t)}),this):"object"===d?(a instanceof l?f(u,function(e,t){a[t.cache]&&(c[t.cache]=a[t.cache].slice())}):f(u,function(t,s){var n=s.cache;f(s.props,function(e,t){if(!c[n]&&s.to){if("alpha"===e||null==a[e])return;c[n]=s.to(c._rgba)}c[n][t.idx]=i(a[e],t,!0)}),c[n]&&0>e.inArray(null,c[n].slice(0,3))&&(c[n][3]=1,s.from&&(c._rgba=s.from(c[n])))}),this):t},is:function(e){var i=l(e),s=!0,a=this;return f(u,function(e,n){var r,o=i[n.cache];return o&&(r=a[n.cache]||n.to&&n.to(a._rgba)||[],f(n.props,function(e,i){return null!=o[i.idx]?s=o[i.idx]===r[i.idx]:t})),s}),s},_space:function(){var e=[],t=this;return f(u,function(i,s){t[s.cache]&&e.push(i)}),e.pop()},transition:function(e,t){var s=l(e),a=s._space(),n=u[a],r=0===this.alpha()?l("transparent"):this,o=r[n.cache]||n.to(r._rgba),h=o.slice();return s=s[n.cache],f(n.props,function(e,a){var n=a.idx,r=o[n],l=s[n],u=c[a.type]||{};null!==l&&(null===r?h[n]=l:(u.mod&&(l-r>u.mod/2?r+=u.mod:r-l>u.mod/2&&(r-=u.mod)),h[n]=i((l-r)*t+r,a)))}),this[a](h)},blend:function(t){if(1===this._rgba[3])return this;var i=this._rgba.slice(),s=i.pop(),a=l(t)._rgba;return l(e.map(i,function(e,t){return(1-s)*a[t]+s*e}))},toRgbaString:function(){var t="rgba(",i=e.map(this._rgba,function(e,t){return null==e?t>2?1:0:e});return 1===i[3]&&(i.pop(),t="rgb("),t+i.join()+")"},toHslaString:function(){var t="hsla(",i=e.map(this.hsla(),function(e,t){return null==e&&(e=t>2?1:0),t&&3>t&&(e=Math.round(100*e)+"%"),e});return 1===i[3]&&(i.pop(),t="hsl("),t+i.join()+")"},toHexString:function(t){var i=this._rgba.slice(),s=i.pop();return t&&i.push(~~(255*s)),"#"+e.map(i,function(e){return e=(e||0).toString(16),1===e.length?"0"+e:e}).join("")},toString:function(){return 0===this._rgba[3]?"transparent":this.toRgbaString()}}),l.fn.parse.prototype=l.fn,u.hsla.to=function(e){if(null==e[0]||null==e[1]||null==e[2])return[null,null,null,e[3]];var t,i,s=e[0]/255,a=e[1]/255,n=e[2]/255,r=e[3],o=Math.max(s,a,n),h=Math.min(s,a,n),l=o-h,u=o+h,c=.5*u;return t=h===o?0:s===o?60*(a-n)/l+360:a===o?60*(n-s)/l+120:60*(s-a)/l+240,i=0===l?0:.5>=c?l/u:l/(2-u),[Math.round(t)%360,i,c,null==r?1:r]},u.hsla.from=function(e){if(null==e[0]||null==e[1]||null==e[2])return[null,null,null,e[3]];var t=e[0]/360,i=e[1],s=e[2],n=e[3],r=.5>=s?s*(1+i):s+i-s*i,o=2*s-r;return[Math.round(255*a(o,r,t+1/3)),Math.round(255*a(o,r,t)),Math.round(255*a(o,r,t-1/3)),n]},f(u,function(s,a){var n=a.props,r=a.cache,h=a.to,u=a.from;l.fn[s]=function(s){if(h&&!this[r]&&(this[r]=h(this._rgba)),s===t)return this[r].slice();var a,o=e.type(s),c="array"===o||"object"===o?s:arguments,d=this[r].slice();return f(n,function(e,t){var s=c["object"===o?e:t.idx];null==s&&(s=d[t.idx]),d[t.idx]=i(s,t)}),u?(a=l(u(d)),a[r]=d,a):l(d)},f(n,function(t,i){l.fn[t]||(l.fn[t]=function(a){var n,r=e.type(a),h="alpha"===t?this._hsla?"hsla":"rgba":s,l=this[h](),u=l[i.idx];return"undefined"===r?u:("function"===r&&(a=a.call(this,u),r=e.type(a)),null==a&&i.empty?this:("string"===r&&(n=o.exec(a),n&&(a=u+parseFloat(n[2])*("+"===n[1]?1:-1))),l[i.idx]=a,this[h](l)))})})}),l.hook=function(t){var i=t.split(" ");f(i,function(t,i){e.cssHooks[i]={set:function(t,a){var n,r,o="";if("transparent"!==a&&("string"!==e.type(a)||(n=s(a)))){if(a=l(n||a),!d.rgba&&1!==a._rgba[3]){for(r="backgroundColor"===i?t.parentNode:t;(""===o||"transparent"===o)&&r&&r.style;)try{o=e.css(r,"backgroundColor"),r=r.parentNode}catch(h){}a=a.blend(o&&"transparent"!==o?o:"_default")}a=a.toRgbaString()}try{t.style[i]=a}catch(h){}}},e.fx.step[i]=function(t){t.colorInit||(t.start=l(t.elem,i),t.end=l(t.end),t.colorInit=!0),e.cssHooks[i].set(t.elem,t.start.transition(t.end,t.pos))}})},l.hook(r),e.cssHooks.borderColor={expand:function(e){var t={};return f(["Top","Right","Bottom","Left"],function(i,s){t["border"+s+"Color"]=e}),t}},n=e.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"}}(jQuery),function(){function i(t){var i,s,a=t.ownerDocument.defaultView?t.ownerDocument.defaultView.getComputedStyle(t,null):t.currentStyle,n={};if(a&&a.length&&a[0]&&a[a[0]])for(s=a.length;s--;)i=a[s],"string"==typeof a[i]&&(n[e.camelCase(i)]=a[i]);else for(i in a)"string"==typeof a[i]&&(n[i]=a[i]);return n}function s(t,i){var s,a,r={};for(s in i)a=i[s],t[s]!==a&&(n[s]||(e.fx.step[s]||!isNaN(parseFloat(a)))&&(r[s]=a));return r}var a=["add","remove","toggle"],n={border:1,borderBottom:1,borderColor:1,borderLeft:1,borderRight:1,borderTop:1,borderWidth:1,margin:1,padding:1};e.each(["borderLeftStyle","borderRightStyle","borderBottomStyle","borderTopStyle"],function(t,i){e.fx.step[i]=function(e){("none"!==e.end&&!e.setAttr||1===e.pos&&!e.setAttr)&&(jQuery.style(e.elem,i,e.end),e.setAttr=!0)}}),e.fn.addBack||(e.fn.addBack=function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}),e.effects.animateClass=function(t,n,r,o){var h=e.speed(n,r,o);return this.queue(function(){var n,r=e(this),o=r.attr("class")||"",l=h.children?r.find("*").addBack():r;l=l.map(function(){var t=e(this);return{el:t,start:i(this)}}),n=function(){e.each(a,function(e,i){t[i]&&r[i+"Class"](t[i])})},n(),l=l.map(function(){return this.end=i(this.el[0]),this.diff=s(this.start,this.end),this}),r.attr("class",o),l=l.map(function(){var t=this,i=e.Deferred(),s=e.extend({},h,{queue:!1,complete:function(){i.resolve(t)}});return this.el.animate(this.diff,s),i.promise()}),e.when.apply(e,l.get()).done(function(){n(),e.each(arguments,function(){var t=this.el;e.each(this.diff,function(e){t.css(e,"")})}),h.complete.call(r[0])})})},e.fn.extend({addClass:function(t){return function(i,s,a,n){return s?e.effects.animateClass.call(this,{add:i},s,a,n):t.apply(this,arguments)}}(e.fn.addClass),removeClass:function(t){return function(i,s,a,n){return arguments.length>1?e.effects.animateClass.call(this,{remove:i},s,a,n):t.apply(this,arguments)}}(e.fn.removeClass),toggleClass:function(i){return function(s,a,n,r,o){return"boolean"==typeof a||a===t?n?e.effects.animateClass.call(this,a?{add:s}:{remove:s},n,r,o):i.apply(this,arguments):e.effects.animateClass.call(this,{toggle:s},a,n,r)}}(e.fn.toggleClass),switchClass:function(t,i,s,a,n){return e.effects.animateClass.call(this,{add:i,remove:t},s,a,n)}})}(),function(){function s(t,i,s,a){return e.isPlainObject(t)&&(i=t,t=t.effect),t={effect:t},null==i&&(i={}),e.isFunction(i)&&(a=i,s=null,i={}),("number"==typeof i||e.fx.speeds[i])&&(a=s,s=i,i={}),e.isFunction(s)&&(a=s,s=null),i&&e.extend(t,i),s=s||i.duration,t.duration=e.fx.off?0:"number"==typeof s?s:s in e.fx.speeds?e.fx.speeds[s]:e.fx.speeds._default,t.complete=a||i.complete,t}function a(t){return!t||"number"==typeof t||e.fx.speeds[t]?!0:"string"!=typeof t||e.effects.effect[t]?e.isFunction(t)?!0:"object"!=typeof t||t.effect?!1:!0:!0}e.extend(e.effects,{version:"1.10.3",save:function(e,t){for(var s=0;t.length>s;s++)null!==t[s]&&e.data(i+t[s],e[0].style[t[s]])},restore:function(e,s){var a,n;for(n=0;s.length>n;n++)null!==s[n]&&(a=e.data(i+s[n]),a===t&&(a=""),e.css(s[n],a))},setMode:function(e,t){return"toggle"===t&&(t=e.is(":hidden")?"show":"hide"),t},getBaseline:function(e,t){var i,s;switch(e[0]){case"top":i=0;break;case"middle":i=.5;break;case"bottom":i=1;break;default:i=e[0]/t.height}switch(e[1]){case"left":s=0;break;case"center":s=.5;break;case"right":s=1;break;default:s=e[1]/t.width}return{x:s,y:i}},createWrapper:function(t){if(t.parent().is(".ui-effects-wrapper"))return t.parent();var i={width:t.outerWidth(!0),height:t.outerHeight(!0),"float":t.css("float")},s=e("<div></div>").addClass("ui-effects-wrapper").css({fontSize:"100%",background:"transparent",border:"none",margin:0,padding:0}),a={width:t.width(),height:t.height()},n=document.activeElement;try{n.id}catch(r){n=document.body}return t.wrap(s),(t[0]===n||e.contains(t[0],n))&&e(n).focus(),s=t.parent(),"static"===t.css("position")?(s.css({position:"relative"}),t.css({position:"relative"})):(e.extend(i,{position:t.css("position"),zIndex:t.css("z-index")}),e.each(["top","left","bottom","right"],function(e,s){i[s]=t.css(s),isNaN(parseInt(i[s],10))&&(i[s]="auto")}),t.css({position:"relative",top:0,left:0,right:"auto",bottom:"auto"})),t.css(a),s.css(i).show()},removeWrapper:function(t){var i=document.activeElement;return t.parent().is(".ui-effects-wrapper")&&(t.parent().replaceWith(t),(t[0]===i||e.contains(t[0],i))&&e(i).focus()),t},setTransition:function(t,i,s,a){return a=a||{},e.each(i,function(e,i){var n=t.cssUnit(i);n[0]>0&&(a[i]=n[0]*s+n[1])}),a}}),e.fn.extend({effect:function(){function t(t){function s(){e.isFunction(n)&&n.call(a[0]),e.isFunction(t)&&t()}var a=e(this),n=i.complete,o=i.mode;(a.is(":hidden")?"hide"===o:"show"===o)?(a[o](),s()):r.call(a[0],i,s)}var i=s.apply(this,arguments),a=i.mode,n=i.queue,r=e.effects.effect[i.effect];return e.fx.off||!r?a?this[a](i.duration,i.complete):this.each(function(){i.complete&&i.complete.call(this)}):n===!1?this.each(t):this.queue(n||"fx",t)},show:function(e){return function(t){if(a(t))return e.apply(this,arguments);var i=s.apply(this,arguments);return i.mode="show",this.effect.call(this,i)}}(e.fn.show),hide:function(e){return function(t){if(a(t))return e.apply(this,arguments);var i=s.apply(this,arguments);return i.mode="hide",this.effect.call(this,i)}}(e.fn.hide),toggle:function(e){return function(t){if(a(t)||"boolean"==typeof t)return e.apply(this,arguments);var i=s.apply(this,arguments);return i.mode="toggle",this.effect.call(this,i)}}(e.fn.toggle),cssUnit:function(t){var i=this.css(t),s=[];return e.each(["em","px","%","pt"],function(e,t){i.indexOf(t)>0&&(s=[parseFloat(i),t])}),s}})}(),function(){var t={};e.each(["Quad","Cubic","Quart","Quint","Expo"],function(e,i){t[i]=function(t){return Math.pow(t,e+2)}}),e.extend(t,{Sine:function(e){return 1-Math.cos(e*Math.PI/2)},Circ:function(e){return 1-Math.sqrt(1-e*e)},Elastic:function(e){return 0===e||1===e?e:-Math.pow(2,8*(e-1))*Math.sin((80*(e-1)-7.5)*Math.PI/15)},Back:function(e){return e*e*(3*e-2)},Bounce:function(e){for(var t,i=4;((t=Math.pow(2,--i))-1)/11>e;);return 1/Math.pow(4,3-i)-7.5625*Math.pow((3*t-2)/22-e,2)}}),e.each(t,function(t,i){e.easing["easeIn"+t]=i,e.easing["easeOut"+t]=function(e){return 1-i(1-e)},e.easing["easeInOut"+t]=function(e){return.5>e?i(2*e)/2:1-i(-2*e+2)/2}})}()})(jQuery);

//===========================================================================

/*! jQuery UI - v1.10.3 - 2013-10-20
* http://jqueryui.com
* Copyright 2013 jQuery Foundation and other contributors; Licensed MIT */

(function(e){e.effects.effect.drop=function(t,i){var a,s=e(this),n=["position","top","bottom","left","right","opacity","height","width"],r=e.effects.setMode(s,t.mode||"hide"),o="show"===r,l=t.direction||"left",h="up"===l||"down"===l?"top":"left",u="up"===l||"left"===l?"pos":"neg",d={opacity:o?1:0};e.effects.save(s,n),s.show(),e.effects.createWrapper(s),a=t.distance||s["top"===h?"outerHeight":"outerWidth"](!0)/2,o&&s.css("opacity",0).css(h,"pos"===u?-a:a),d[h]=(o?"pos"===u?"+=":"-=":"pos"===u?"-=":"+=")+a,s.animate(d,{queue:!1,duration:t.duration,easing:t.easing,complete:function(){"hide"===r&&s.hide(),e.effects.restore(s,n),e.effects.removeWrapper(s),i()}})}})(jQuery);

//===========================================================================

/*! jQuery UI - v1.10.3 - 2013-10-20
* http://jqueryui.com
* Copyright 2013 jQuery Foundation and other contributors; Licensed MIT */

(function(e){e.effects.effect.slide=function(t,i){var s,a=e(this),n=["position","top","bottom","left","right","width","height"],r=e.effects.setMode(a,t.mode||"show"),o="show"===r,h=t.direction||"left",l="up"===h||"down"===h?"top":"left",u="up"===h||"left"===h,d={};e.effects.save(a,n),a.show(),s=t.distance||a["top"===l?"outerHeight":"outerWidth"](!0),e.effects.createWrapper(a).css({overflow:"hidden"}),o&&a.css(l,u?isNaN(s)?"-"+s:-s:s),d[l]=(o?u?"+=":"-=":u?"-=":"+=")+s,a.animate(d,{queue:!1,duration:t.duration,easing:t.easing,complete:function(){"hide"===r&&a.hide(),e.effects.restore(a,n),e.effects.removeWrapper(a),i()}})}})(jQuery);

//===========================================================================

/* Copyright (c) 2010 Brandon Aaron (http://brandonaaron.net)
 * Dual licensed under the MIT (MIT_LICENSE.txt)
 * and GPL Version 2 (GPL_LICENSE.txt) licenses.
 *
 * Version: 1.1.1
 * Requires jQuery 1.3+
 * Docs: http://docs.jquery.com/Plugins/livequery
 */
(function(a){a.extend(a.fn,{livequery:function(e,d,c){var b=this,f;if(a.isFunction(e)){c=d,d=e,e=undefined}a.each(a.livequery.queries,function(g,h){if(b.selector==h.selector&&b.context==h.context&&e==h.type&&(!d||d.$lqguid==h.fn.$lqguid)&&(!c||c.$lqguid==h.fn2.$lqguid)){return(f=h)&&false}});f=f||new a.livequery(this.selector,this.context,e,d,c);f.stopped=false;f.run();return this},expire:function(e,d,c){var b=this;if(a.isFunction(e)){c=d,d=e,e=undefined}a.each(a.livequery.queries,function(f,g){if(b.selector==g.selector&&b.context==g.context&&(!e||e==g.type)&&(!d||d.$lqguid==g.fn.$lqguid)&&(!c||c.$lqguid==g.fn2.$lqguid)&&!this.stopped){a.livequery.stop(g.id)}});return this}});a.livequery=function(b,d,f,e,c){this.selector=b;this.context=d;this.type=f;this.fn=e;this.fn2=c;this.elements=[];this.stopped=false;this.id=a.livequery.queries.push(this)-1;e.$lqguid=e.$lqguid||a.livequery.guid++;if(c){c.$lqguid=c.$lqguid||a.livequery.guid++}return this};a.livequery.prototype={stop:function(){var b=this;if(this.type){this.elements.unbind(this.type,this.fn)}else{if(this.fn2){this.elements.each(function(c,d){b.fn2.apply(d)})}}this.elements=[];this.stopped=true},run:function(){if(this.stopped){return}var d=this;var e=this.elements,c=a(this.selector,this.context),b=c.not(e);this.elements=c;if(this.type){b.bind(this.type,this.fn);if(e.length>0){a.each(e,function(f,g){if(a.inArray(g,c)<0){a.event.remove(g,d.type,d.fn)}})}}else{b.each(function(){d.fn.apply(this)});if(this.fn2&&e.length>0){a.each(e,function(f,g){if(a.inArray(g,c)<0){d.fn2.apply(g)}})}}}};a.extend(a.livequery,{guid:0,queries:[],queue:[],running:false,timeout:null,checkQueue:function(){if(a.livequery.running&&a.livequery.queue.length){var b=a.livequery.queue.length;while(b--){a.livequery.queries[a.livequery.queue.shift()].run()}}},pause:function(){a.livequery.running=false},play:function(){a.livequery.running=true;a.livequery.run()},registerPlugin:function(){a.each(arguments,function(c,d){if(!a.fn[d]){return}var b=a.fn[d];a.fn[d]=function(){var e=b.apply(this,arguments);a.livequery.run();return e}})},run:function(b){if(b!=undefined){if(a.inArray(b,a.livequery.queue)<0){a.livequery.queue.push(b)}}else{a.each(a.livequery.queries,function(c){if(a.inArray(c,a.livequery.queue)<0){a.livequery.queue.push(c)}})}if(a.livequery.timeout){clearTimeout(a.livequery.timeout)}a.livequery.timeout=setTimeout(a.livequery.checkQueue,20)},stop:function(b){if(b!=undefined){a.livequery.queries[b].stop()}else{a.each(a.livequery.queries,function(c){a.livequery.queries[c].stop()})}}});a.livequery.registerPlugin("append","prepend","after","before","wrap","attr","removeAttr","addClass","removeClass","toggleClass","empty","remove","html");a(function(){a.livequery.play()})})(jQuery);


//===========================================================================

jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,t,n,r,i){return jQuery.easing[jQuery.easing.def](e,t,n,r,i)},easeInQuad:function(e,t,n,r,i){return r*(t/=i)*t+n},easeOutQuad:function(e,t,n,r,i){return-r*(t/=i)*(t-2)+n},easeInOutQuad:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t+n;return-r/2*(--t*(t-2)-1)+n},easeInCubic:function(e,t,n,r,i){return r*(t/=i)*t*t+n},easeOutCubic:function(e,t,n,r,i){return r*((t=t/i-1)*t*t+1)+n},easeInOutCubic:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t+n;return r/2*((t-=2)*t*t+2)+n},easeInQuart:function(e,t,n,r,i){return r*(t/=i)*t*t*t+n},easeOutQuart:function(e,t,n,r,i){return-r*((t=t/i-1)*t*t*t-1)+n},easeInOutQuart:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t+n;return-r/2*((t-=2)*t*t*t-2)+n},easeInQuint:function(e,t,n,r,i){return r*(t/=i)*t*t*t*t+n},easeOutQuint:function(e,t,n,r,i){return r*((t=t/i-1)*t*t*t*t+1)+n},easeInOutQuint:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t*t+n;return r/2*((t-=2)*t*t*t*t+2)+n},easeInSine:function(e,t,n,r,i){return-r*Math.cos(t/i*(Math.PI/2))+r+n},easeOutSine:function(e,t,n,r,i){return r*Math.sin(t/i*(Math.PI/2))+n},easeInOutSine:function(e,t,n,r,i){return-r/2*(Math.cos(Math.PI*t/i)-1)+n},easeInExpo:function(e,t,n,r,i){return t==0?n:r*Math.pow(2,10*(t/i-1))+n},easeOutExpo:function(e,t,n,r,i){return t==i?n+r:r*(-Math.pow(2,-10*t/i)+1)+n},easeInOutExpo:function(e,t,n,r,i){if(t==0)return n;if(t==i)return n+r;if((t/=i/2)<1)return r/2*Math.pow(2,10*(t-1))+n;return r/2*(-Math.pow(2,-10*--t)+2)+n},easeInCirc:function(e,t,n,r,i){return-r*(Math.sqrt(1-(t/=i)*t)-1)+n},easeOutCirc:function(e,t,n,r,i){return r*Math.sqrt(1-(t=t/i-1)*t)+n},easeInOutCirc:function(e,t,n,r,i){if((t/=i/2)<1)return-r/2*(Math.sqrt(1-t*t)-1)+n;return r/2*(Math.sqrt(1-(t-=2)*t)+1)+n},easeInElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return-(u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o))+n},easeOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return u*Math.pow(2,-10*t)*Math.sin((t*i-s)*2*Math.PI/o)+r+n},easeInOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i/2)==2)return n+r;if(!o)o=i*.3*1.5;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);if(t<1)return-.5*u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)+n;return u*Math.pow(2,-10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)*.5+r+n},easeInBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*(t/=i)*t*((s+1)*t-s)+n},easeOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*((t=t/i-1)*t*((s+1)*t+s)+1)+n},easeInOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;if((t/=i/2)<1)return r/2*t*t*(((s*=1.525)+1)*t-s)+n;return r/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+n},easeInBounce:function(e,t,n,r,i){return r-jQuery.easing.easeOutBounce(e,i-t,0,r,i)+n},easeOutBounce:function(e,t,n,r,i){if((t/=i)<1/2.75){return r*7.5625*t*t+n}else if(t<2/2.75){return r*(7.5625*(t-=1.5/2.75)*t+.75)+n}else if(t<2.5/2.75){return r*(7.5625*(t-=2.25/2.75)*t+.9375)+n}else{return r*(7.5625*(t-=2.625/2.75)*t+.984375)+n}},easeInOutBounce:function(e,t,n,r,i){if(t<i/2)return jQuery.easing.easeInBounce(e,t*2,0,r,i)*.5+n;return jQuery.easing.easeOutBounce(e,t*2-i,0,r,i)*.5+r*.5+n}});

//===========================================================================

/*!
 *  GMAP3 Plugin for JQuery
 *  Version   : 5.1.1
 *  Date      : 2013-05-25
 *  Licence   : GPL v3 : http://www.gnu.org/licenses/gpl.html
 *  Author    : DEMONTE Jean-Baptiste
 *  Contact   : jbdemonte@gmail.com
 *  Web site  : http://gmap3.net
 */
(function(y,t){var z,i=0;function J(){if(!z){z={verbose:false,queryLimit:{attempt:5,delay:250,random:250},classes:{Map:google.maps.Map,Marker:google.maps.Marker,InfoWindow:google.maps.InfoWindow,Circle:google.maps.Circle,Rectangle:google.maps.Rectangle,OverlayView:google.maps.OverlayView,StreetViewPanorama:google.maps.StreetViewPanorama,KmlLayer:google.maps.KmlLayer,TrafficLayer:google.maps.TrafficLayer,BicyclingLayer:google.maps.BicyclingLayer,GroundOverlay:google.maps.GroundOverlay,StyledMapType:google.maps.StyledMapType,ImageMapType:google.maps.ImageMapType},map:{mapTypeId:google.maps.MapTypeId.ROADMAP,center:[46.578498,2.457275],zoom:2},overlay:{pane:"floatPane",content:"",offset:{x:0,y:0}},geoloc:{getCurrentPosition:{maximumAge:60000,timeout:5000}}}}}function k(M,L){return M!==t?M:"gmap3_"+(L?i+1:++i)}function d(L){var O=function(P){return parseInt(P,10)},N=google.maps.version.split(".").map(O),M;L=L.split(".").map(O);for(M=0;M<L.length;M++){if(N.hasOwnProperty(M)){if(N[M]<L[M]){return false}}else{return false}}return true}function n(P,L,N,Q,O){if(L.todo.events||L.todo.onces){var M={id:Q,data:L.todo.data,tag:L.todo.tag};if(L.todo.events){y.each(L.todo.events,function(R,U){var T=P,S=U;if(y.isArray(U)){T=U[0];S=U[1]}google.maps.event.addListener(N,R,function(V){S.apply(T,[O?O:N,V,M])})})}if(L.todo.onces){y.each(L.todo.onces,function(R,U){var T=P,S=U;if(y.isArray(U)){T=U[0];S=U[1]}google.maps.event.addListenerOnce(N,R,function(V){S.apply(T,[O?O:N,V,M])})})}}}function l(){var L=[];this.empty=function(){return !L.length};this.add=function(M){L.push(M)};this.get=function(){return L.length?L[0]:false};this.ack=function(){L.shift()}}function w(T,L,N){var R={},P=this,Q,S={latLng:{map:false,marker:false,infowindow:false,circle:false,overlay:false,getlatlng:false,getmaxzoom:false,getelevation:false,streetviewpanorama:false,getaddress:true},geoloc:{getgeoloc:true}};if(typeof N==="string"){N=M(N)}function M(V){var U={};U[V]={};return U}function O(){var U;for(U in N){if(U in R){continue}return U}}this.run=function(){var U,V;while(U=O()){if(typeof T[U]==="function"){Q=U;V=y.extend(true,{},z[U]||{},N[U].options||{});if(U in S.latLng){if(N[U].values){x(N[U].values,T,T[U],{todo:N[U],opts:V,session:R})}else{v(T,T[U],S.latLng[U],{todo:N[U],opts:V,session:R})}}else{if(U in S.geoloc){o(T,T[U],{todo:N[U],opts:V,session:R})}else{T[U].apply(T,[{todo:N[U],opts:V,session:R}])}}return}else{R[U]=null}}L.apply(T,[N,R])};this.ack=function(U){R[Q]=U;P.run.apply(P,[])}}function c(N){var L,M=[];for(L in N){M.push(L)}return M}function b(N,Q){var L={};if(N.todo){for(var M in N.todo){if((M!=="options")&&(M!=="values")){L[M]=N.todo[M]}}}var O,P=["data","tag","id","events","onces"];for(O=0;O<P.length;O++){A(L,P[O],Q,N.todo)}L.options=y.extend({},N.opts||{},Q.options||{});return L}function A(N,M){for(var L=2;L<arguments.length;L++){if(M in arguments[L]){N[M]=arguments[L][M];return}}}function r(){var L=[];this.get=function(S){if(L.length){var P,O,N,R,M,Q=c(S);for(P=0;P<L.length;P++){R=L[P];M=Q.length==R.keys.length;for(O=0;(O<Q.length)&&M;O++){N=Q[O];M=N in R.request;if(M){if((typeof S[N]==="object")&&("equals" in S[N])&&(typeof S[N]==="function")){M=S[N].equals(R.request[N])}else{M=S[N]===R.request[N]}}}if(M){return R.results}}}};this.store=function(N,M){L.push({request:N,keys:c(N),results:M})}}function e(Q,P,O,L){var N=this,M=[];z.classes.OverlayView.call(this);this.setMap(Q);this.onAdd=function(){var R=this.getPanes();if(P.pane in R){y(R[P.pane]).append(L)}y.each("dblclick click mouseover mousemove mouseout mouseup mousedown".split(" "),function(T,S){M.push(google.maps.event.addDomListener(L[0],S,function(U){y.Event(U).stopPropagation();google.maps.event.trigger(N,S,[U]);N.draw()}))});M.push(google.maps.event.addDomListener(L[0],"contextmenu",function(S){y.Event(S).stopPropagation();google.maps.event.trigger(N,"rightclick",[S]);N.draw()}))};this.getPosition=function(){return O};this.draw=function(){var R=this.getProjection().fromLatLngToDivPixel(O);L.css("left",(R.x+P.offset.x)+"px").css("top",(R.y+P.offset.y)+"px")};this.onRemove=function(){for(var R=0;R<M.length;R++){google.maps.event.removeListener(M[R])}L.remove()};this.hide=function(){L.hide()};this.show=function(){L.show()};this.toggle=function(){if(L){if(L.is(":visible")){this.show()}else{this.hide()}}};this.toggleDOM=function(){if(this.getMap()){this.setMap(null)}else{this.setMap(Q)}};this.getDOMElement=function(){return L[0]}}function f(O,L){function M(){this.onAdd=function(){};this.onRemove=function(){};this.draw=function(){};return z.classes.OverlayView.apply(this,[])}M.prototype=z.classes.OverlayView.prototype;var N=new M();N.setMap(O);return N}function F(ae,ao,aa){var an=false,ai=false,af=false,Z=false,W=true,V=this,N=[],T={},ad={},U={},aj=[],ah=[],O=[],ak=f(ao,aa.radius),Y,ap,am,P,Q;S();function L(aq){if(!aj[aq]){delete ah[aq].options.map;aj[aq]=new z.classes.Marker(ah[aq].options);n(ae,{todo:ah[aq]},aj[aq],ah[aq].id)}}this.getById=function(aq){if(aq in ad){L(ad[aq]);return aj[ad[aq]]}return false};this.rm=function(ar){var aq=ad[ar];if(aj[aq]){aj[aq].setMap(null)}delete aj[aq];aj[aq]=false;delete ah[aq];ah[aq]=false;delete O[aq];O[aq]=false;delete ad[ar];delete U[aq];ai=true};this.clearById=function(aq){if(aq in ad){this.rm(aq);return true}};this.clear=function(az,av,aA){var ar,ay,at,aw,au,ax=[],aq=C(aA);if(az){ar=ah.length-1;ay=-1;at=-1}else{ar=0;ay=ah.length;at=1}for(aw=ar;aw!=ay;aw+=at){if(ah[aw]){if(!aq||aq(ah[aw].tag)){ax.push(U[aw]);if(av||az){break}}}}for(au=0;au<ax.length;au++){this.rm(ax[au])}};this.add=function(aq,ar){aq.id=k(aq.id);this.clearById(aq.id);ad[aq.id]=aj.length;U[aj.length]=aq.id;aj.push(null);ah.push(aq);O.push(ar);ai=true};this.addMarker=function(ar,aq){aq=aq||{};aq.id=k(aq.id);this.clearById(aq.id);if(!aq.options){aq.options={}}aq.options.position=ar.getPosition();n(ae,{todo:aq},ar,aq.id);ad[aq.id]=aj.length;U[aj.length]=aq.id;aj.push(ar);ah.push(aq);O.push(aq.data||{});ai=true};this.todo=function(aq){return ah[aq]};this.value=function(aq){return O[aq]};this.marker=function(aq){if(aq in aj){L(aq);return aj[aq]}return false};this.markerIsSet=function(aq){return Boolean(aj[aq])};this.setMarker=function(ar,aq){aj[ar]=aq};this.store=function(aq,ar,at){T[aq.ref]={obj:ar,shadow:at}};this.free=function(){for(var aq=0;aq<N.length;aq++){google.maps.event.removeListener(N[aq])}N=[];y.each(T,function(ar){ac(ar)});T={};y.each(ah,function(ar){ah[ar]=null});ah=[];y.each(aj,function(ar){if(aj[ar]){aj[ar].setMap(null);delete aj[ar]}});aj=[];y.each(O,function(ar){delete O[ar]});O=[];ad={};U={}};this.filter=function(aq){am=aq;ag()};this.enable=function(aq){if(W!=aq){W=aq;ag()}};this.display=function(aq){P=aq};this.error=function(aq){Q=aq};this.beginUpdate=function(){an=true};this.endUpdate=function(){an=false;if(ai){ag()}};this.autofit=function(ar){for(var aq=0;aq<ah.length;aq++){if(ah[aq]){ar.extend(ah[aq].options.position)}}};function S(){ap=ak.getProjection();if(!ap){setTimeout(function(){S.apply(V,[])},25);return}Z=true;N.push(google.maps.event.addListener(ao,"zoom_changed",function(){al()}));N.push(google.maps.event.addListener(ao,"bounds_changed",function(){al()}));ag()}function ac(aq){if(typeof T[aq]==="object"){if(typeof(T[aq].obj.setMap)==="function"){T[aq].obj.setMap(null)}if(typeof(T[aq].obj.remove)==="function"){T[aq].obj.remove()}if(typeof(T[aq].shadow.remove)==="function"){T[aq].obj.remove()}if(typeof(T[aq].shadow.setMap)==="function"){T[aq].shadow.setMap(null)}delete T[aq].obj;delete T[aq].shadow}else{if(aj[aq]){aj[aq].setMap(null)}}delete T[aq]}function M(){var ay,ax,aw,au,av,at,ar,aq;if(arguments[0] instanceof google.maps.LatLng){ay=arguments[0].lat();aw=arguments[0].lng();if(arguments[1] instanceof google.maps.LatLng){ax=arguments[1].lat();au=arguments[1].lng()}else{ax=arguments[1];au=arguments[2]}}else{ay=arguments[0];aw=arguments[1];if(arguments[2] instanceof google.maps.LatLng){ax=arguments[2].lat();au=arguments[2].lng()}else{ax=arguments[2];au=arguments[3]}}av=Math.PI*ay/180;at=Math.PI*aw/180;ar=Math.PI*ax/180;aq=Math.PI*au/180;return 1000*6371*Math.acos(Math.min(Math.cos(av)*Math.cos(ar)*Math.cos(at)*Math.cos(aq)+Math.cos(av)*Math.sin(at)*Math.cos(ar)*Math.sin(aq)+Math.sin(av)*Math.sin(ar),1))}function R(){var aq=M(ao.getCenter(),ao.getBounds().getNorthEast()),ar=new google.maps.Circle({center:ao.getCenter(),radius:1.25*aq});return ar.getBounds()}function X(){var ar={},aq;for(aq in T){ar[aq]=true}return ar}function al(){clearTimeout(Y);Y=setTimeout(function(){ag()},25)}function ab(ar){var au=ap.fromLatLngToDivPixel(ar),at=ap.fromDivPixelToLatLng(new google.maps.Point(au.x+aa.radius,au.y-aa.radius)),aq=ap.fromDivPixelToLatLng(new google.maps.Point(au.x-aa.radius,au.y+aa.radius));return new google.maps.LatLngBounds(aq,at)}function ag(){if(an||af||!Z){return}var aE=[],aG={},aF=ao.getZoom(),aH=("maxZoom" in aa)&&(aF>aa.maxZoom),aw=X(),av,au,at,aA,ar=false,aq,aD,ay,az,aB,aC,ax;ai=false;if(aF>3){aq=R();ar=aq.getSouthWest().lng()<aq.getNorthEast().lng()}for(av=0;av<ah.length;av++){if(ah[av]&&(!ar||aq.contains(ah[av].options.position))&&(!am||am(O[av]))){aE.push(av)}}while(1){av=0;while(aG[av]&&(av<aE.length)){av++}if(av==aE.length){break}aA=[];if(W&&!aH){ax=10;do{az=aA;aA=[];ax--;if(az.length){ay=aq.getCenter()}else{ay=ah[aE[av]].options.position}aq=ab(ay);for(au=av;au<aE.length;au++){if(aG[au]){continue}if(aq.contains(ah[aE[au]].options.position)){aA.push(au)}}}while((az.length<aA.length)&&(aA.length>1)&&ax)}else{for(au=av;au<aE.length;au++){if(aG[au]){continue}aA.push(au);break}}aD={indexes:[],ref:[]};aB=aC=0;for(at=0;at<aA.length;at++){aG[aA[at]]=true;aD.indexes.push(aE[aA[at]]);aD.ref.push(aE[aA[at]]);aB+=ah[aE[aA[at]]].options.position.lat();aC+=ah[aE[aA[at]]].options.position.lng()}aB/=aA.length;aC/=aA.length;aD.latLng=new google.maps.LatLng(aB,aC);aD.ref=aD.ref.join("-");if(aD.ref in aw){delete aw[aD.ref]}else{if(aA.length===1){T[aD.ref]=true}P(aD)}}y.each(aw,function(aI){ac(aI)});af=false}}function a(M,L){this.id=function(){return M};this.filter=function(N){L.filter(N)};this.enable=function(){L.enable(true)};this.disable=function(){L.enable(false)};this.add=function(O,N,P){if(!P){L.beginUpdate()}L.addMarker(O,N);if(!P){L.endUpdate()}};this.getById=function(N){return L.getById(N)};this.clearById=function(P,O){var N;if(!O){L.beginUpdate()}N=L.clearById(P);if(!O){L.endUpdate()}return N};this.clear=function(P,Q,N,O){if(!O){L.beginUpdate()}L.clear(P,Q,N);if(!O){L.endUpdate()}}}function D(){var M={},N={};function L(P){return{id:P.id,name:P.name,object:P.obj,tag:P.tag,data:P.data}}this.add=function(R,Q,T,S){var P=R.todo||{},U=k(P.id);if(!M[Q]){M[Q]=[]}if(U in N){this.clearById(U)}N[U]={obj:T,sub:S,name:Q,id:U,tag:P.tag,data:P.data};M[Q].push(U);return U};this.getById=function(R,Q,P){if(R in N){if(Q){return N[R].sub}else{if(P){return L(N[R])}}return N[R].obj}return false};this.get=function(R,T,P,S){var V,U,Q=C(P);if(!M[R]||!M[R].length){return null}V=M[R].length;while(V){V--;U=M[R][T?V:M[R].length-V-1];if(U&&N[U]){if(Q&&!Q(N[U].tag)){continue}return S?L(N[U]):N[U].obj}}return null};this.all=function(S,Q,T){var P=[],R=C(Q),U=function(X){var V,W;for(V=0;V<M[X].length;V++){W=M[X][V];if(W&&N[W]){if(R&&!R(N[W].tag)){continue}P.push(T?L(N[W]):N[W].obj)}}};if(S in M){U(S)}else{if(S===t){for(S in M){U(S)}}}return P};function O(P){if(typeof(P.setMap)==="function"){P.setMap(null)}if(typeof(P.remove)==="function"){P.remove()}if(typeof(P.free)==="function"){P.free()}P=null}this.rm=function(S,Q,R){var P,T;if(!M[S]){return false}if(Q){if(R){for(P=M[S].length-1;P>=0;P--){T=M[S][P];if(Q(N[T].tag)){break}}}else{for(P=0;P<M[S].length;P++){T=M[S][P];if(Q(N[T].tag)){break}}}}else{P=R?M[S].length-1:0}if(!(P in M[S])){return false}return this.clearById(M[S][P],P)};this.clearById=function(S,P){if(S in N){var R,Q=N[S].name;for(R=0;P===t&&R<M[Q].length;R++){if(S===M[Q][R]){P=R}}O(N[S].obj);if(N[S].sub){O(N[S].sub)}delete N[S];M[Q].splice(P,1);return true}return false};this.objGetById=function(R){var Q;if(M.clusterer){for(var P in M.clusterer){if((Q=N[M.clusterer[P]].obj.getById(R))!==false){return Q}}}return false};this.objClearById=function(Q){if(M.clusterer){for(var P in M.clusterer){if(N[M.clusterer[P]].obj.clearById(Q)){return true}}}return null};this.clear=function(V,U,W,P){var R,T,S,Q=C(P);if(!V||!V.length){V=[];for(R in M){V.push(R)}}else{V=g(V)}for(T=0;T<V.length;T++){S=V[T];if(U){this.rm(S,Q,true)}else{if(W){this.rm(S,Q,false)}else{while(this.rm(S,Q,false)){}}}}};this.objClear=function(S,R,T,Q){if(M.clusterer&&(y.inArray("marker",S)>=0||!S.length)){for(var P in M.clusterer){N[M.clusterer[P]].obj.clear(R,T,Q)}}}}var m={},H=new r();function p(){if(!m.geocoder){m.geocoder=new google.maps.Geocoder()}return m.geocoder}function G(){if(!m.directionsService){m.directionsService=new google.maps.DirectionsService()}return m.directionsService}function h(){if(!m.elevationService){m.elevationService=new google.maps.ElevationService()}return m.elevationService}function q(){if(!m.maxZoomService){m.maxZoomService=new google.maps.MaxZoomService()}return m.maxZoomService}function B(){if(!m.distanceMatrixService){m.distanceMatrixService=new google.maps.DistanceMatrixService()}return m.distanceMatrixService}function u(){if(z.verbose){var L,M=[];if(window.console&&(typeof console.error==="function")){for(L=0;L<arguments.length;L++){M.push(arguments[L])}console.error.apply(console,M)}else{M="";for(L=0;L<arguments.length;L++){M+=arguments[L].toString()+" "}alert(M)}}}function E(L){return(typeof(L)==="number"||typeof(L)==="string")&&L!==""&&!isNaN(L)}function g(N){var M,L=[];if(N!==t){if(typeof(N)==="object"){if(typeof(N.length)==="number"){L=N}else{for(M in N){L.push(N[M])}}}else{L.push(N)}}return L}function C(L){if(L){if(typeof L==="function"){return L}L=g(L);return function(N){if(N===t){return false}if(typeof N==="object"){for(var M=0;M<N.length;M++){if(y.inArray(N[M],L)>=0){return true}}return false}return y.inArray(N,L)>=0}}}function I(M,O,L){var N=O?M:null;if(!M||(typeof M==="string")){return N}if(M.latLng){return I(M.latLng)}if(M instanceof google.maps.LatLng){return M}else{if(E(M.lat)){return new google.maps.LatLng(M.lat,M.lng)}else{if(!L&&y.isArray(M)){if(!E(M[0])||!E(M[1])){return N}return new google.maps.LatLng(M[0],M[1])}}}return N}function j(M){var N,L;if(!M||M instanceof google.maps.LatLngBounds){return M||null}if(y.isArray(M)){if(M.length==2){N=I(M[0]);L=I(M[1])}else{if(M.length==4){N=I([M[0],M[1]]);L=I([M[2],M[3]])}}}else{if(("ne" in M)&&("sw" in M)){N=I(M.ne);L=I(M.sw)}else{if(("n" in M)&&("e" in M)&&("s" in M)&&("w" in M)){N=I([M.n,M.e]);L=I([M.s,M.w])}}}if(N&&L){return new google.maps.LatLngBounds(L,N)}return null}function v(T,L,O,S,P){var N=O?I(S.todo,false,true):false,R=N?{latLng:N}:(S.todo.address?(typeof(S.todo.address)==="string"?{address:S.todo.address}:S.todo.address):false),M=R?H.get(R):false,Q=this;if(R){P=P||0;if(M){S.latLng=M.results[0].geometry.location;S.results=M.results;S.status=M.status;L.apply(T,[S])}else{if(R.location){R.location=I(R.location)}if(R.bounds){R.bounds=j(R.bounds)}p().geocode(R,function(V,U){if(U===google.maps.GeocoderStatus.OK){H.store(R,{results:V,status:U});S.latLng=V[0].geometry.location;S.results=V;S.status=U;L.apply(T,[S])}else{if((U===google.maps.GeocoderStatus.OVER_QUERY_LIMIT)&&(P<z.queryLimit.attempt)){setTimeout(function(){v.apply(Q,[T,L,O,S,P+1])},z.queryLimit.delay+Math.floor(Math.random()*z.queryLimit.random))}else{u("geocode failed",U,R);S.latLng=S.results=false;S.status=U;L.apply(T,[S])}}})}}else{S.latLng=I(S.todo,false,true);L.apply(T,[S])}}function x(Q,L,R,M){var O=this,N=-1;function P(){do{N++}while((N<Q.length)&&!("address" in Q[N]));if(N>=Q.length){R.apply(L,[M]);return}v(O,function(S){delete S.todo;y.extend(Q[N],S);P.apply(O,[])},true,{todo:Q[N]})}P()}function o(L,O,M){var N=false;if(navigator&&navigator.geolocation){navigator.geolocation.getCurrentPosition(function(P){if(N){return}N=true;M.latLng=new google.maps.LatLng(P.coords.latitude,P.coords.longitude);O.apply(L,[M])},function(){if(N){return}N=true;M.latLng=false;O.apply(L,[M])},M.opts.getCurrentPosition)}else{M.latLng=false;O.apply(L,[M])}}function K(T){var S=this,U=new l(),V=new D(),N=null,P;this._plan=function(Z){for(var Y=0;Y<Z.length;Y++){U.add(new w(S,R,Z[Y]))}Q()};function Q(){if(!P&&(P=U.get())){P.run()}}function R(){P=null;U.ack();Q.call(S)}function X(Y){if(Y.todo.callback){var Z=Array.prototype.slice.call(arguments,1);if(typeof Y.todo.callback==="function"){Y.todo.callback.apply(T,Z)}else{if(y.isArray(Y.todo.callback)){if(typeof Y.todo.callback[1]==="function"){Y.todo.callback[1].apply(Y.todo.callback[0],Z)}}}}}function O(Y,Z,aa){if(aa){n(T,Y,Z,aa)}X(Y,Z);P.ack(Z)}function L(aa,Y){Y=Y||{};if(N){if(Y.todo&&Y.todo.options){if(Y.todo.options.center){Y.todo.options.center=I(Y.todo.options.center)}N.setOptions(Y.todo.options)}}else{var Z=Y.opts||y.extend(true,{},z.map,Y.todo&&Y.todo.options?Y.todo.options:{});Z.center=aa||I(Z.center);N=new z.classes.Map(T.get(0),Z)}}this.map=function(Y){L(Y.latLng,Y);n(T,Y,N);O(Y,N)};this.destroy=function(Y){V.clear();T.empty();if(N){N=null}O(Y,true)};this.infowindow=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){if(Z.latLng){Z.opts.position=Z.latLng}Z.todo.values=[{options:Z.opts}]}y.each(Z.todo.values,function(ac,ad){var af,ae,ab=b(Z,ad);ab.options.position=ab.options.position?I(ab.options.position):I(ad.latLng);if(!N){L(ab.options.position)}ae=new z.classes.InfoWindow(ab.options);if(ae&&((ab.open===t)||ab.open)){if(Y){ae.open(N,ab.anchor?ab.anchor:t)}else{ae.open(N,ab.anchor?ab.anchor:(Z.latLng?t:(Z.session.marker?Z.session.marker:t)))}}aa.push(ae);af=V.add({todo:ab},"infowindow",ae);n(T,{todo:ab},ae,af)});O(Z,Y?aa:aa[0])};this.circle=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){Z.opts.center=Z.latLng||I(Z.opts.center);Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}y.each(Z.todo.values,function(ac,ad){var af,ae,ab=b(Z,ad);ab.options.center=ab.options.center?I(ab.options.center):I(ad);if(!N){L(ab.options.center)}ab.options.map=N;ae=new z.classes.Circle(ab.options);aa.push(ae);af=V.add({todo:ab},"circle",ae);n(T,{todo:ab},ae,af)});O(Z,Y?aa:aa[0])};this.overlay=function(aa,Z){var ab=[],Y="values" in aa.todo;if(!Y){aa.todo.values=[{latLng:aa.latLng,options:aa.opts}]}if(!aa.todo.values.length){O(aa,false);return}if(!e.__initialised){e.prototype=new z.classes.OverlayView();e.__initialised=true}y.each(aa.todo.values,function(ae,af){var ah,ag,ac=b(aa,af),ad=y(document.createElement("div")).css({border:"none",borderWidth:"0px",position:"absolute"});ad.append(ac.options.content);ag=new e(N,ac.options,I(ac)||I(af),ad);ab.push(ag);ad=null;if(!Z){ah=V.add(aa,"overlay",ag);n(T,{todo:ac},ag,ah)}});if(Z){return ab[0]}O(aa,Y?ab:ab[0])};this.getaddress=function(Y){X(Y,Y.results,Y.status);P.ack()};this.getlatlng=function(Y){X(Y,Y.results,Y.status);P.ack()};this.getmaxzoom=function(Y){q().getMaxZoomAtLatLng(Y.latLng,function(Z){X(Y,Z.status===google.maps.MaxZoomStatus.OK?Z.zoom:false,status);P.ack()})};this.getelevation=function(Z){var aa,Y=[],ab=function(ad,ac){X(Z,ac===google.maps.ElevationStatus.OK?ad:false,ac);P.ack()};if(Z.latLng){Y.push(Z.latLng)}else{Y=g(Z.todo.locations||[]);for(aa=0;aa<Y.length;aa++){Y[aa]=I(Y[aa])}}if(Y.length){h().getElevationForLocations({locations:Y},ab)}else{if(Z.todo.path&&Z.todo.path.length){for(aa=0;aa<Z.todo.path.length;aa++){Y.push(I(Z.todo.path[aa]))}}if(Y.length){h().getElevationAlongPath({path:Y,samples:Z.todo.samples},ab)}else{P.ack()}}};this.defaults=function(Y){y.each(Y.todo,function(Z,aa){if(typeof z[Z]==="object"){z[Z]=y.extend({},z[Z],aa)}else{z[Z]=aa}});P.ack(true)};this.rectangle=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}y.each(Z.todo.values,function(ac,ad){var af,ae,ab=b(Z,ad);ab.options.bounds=ab.options.bounds?j(ab.options.bounds):j(ad);if(!N){L(ab.options.bounds.getCenter())}ab.options.map=N;ae=new z.classes.Rectangle(ab.options);aa.push(ae);af=V.add({todo:ab},"rectangle",ae);n(T,{todo:ab},ae,af)});O(Z,Y?aa:aa[0])};function M(Z,aa,ab){var ac=[],Y="values" in Z.todo;if(!Y){Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}L();y.each(Z.todo.values,function(af,ah){var aj,ag,ae,ai,ad=b(Z,ah);if(ad.options[ab]){if(ad.options[ab][0][0]&&y.isArray(ad.options[ab][0][0])){for(ag=0;ag<ad.options[ab].length;ag++){for(ae=0;ae<ad.options[ab][ag].length;ae++){ad.options[ab][ag][ae]=I(ad.options[ab][ag][ae])}}}else{for(ag=0;ag<ad.options[ab].length;ag++){ad.options[ab][ag]=I(ad.options[ab][ag])}}}ad.options.map=N;ai=new google.maps[aa](ad.options);ac.push(ai);aj=V.add({todo:ad},aa.toLowerCase(),ai);n(T,{todo:ad},ai,aj)});O(Z,Y?ac:ac[0])}this.polyline=function(Y){M(Y,"Polyline","path")};this.polygon=function(Y){M(Y,"Polygon","paths")};this.trafficlayer=function(Y){L();var Z=V.get("trafficlayer");if(!Z){Z=new z.classes.TrafficLayer();Z.setMap(N);V.add(Y,"trafficlayer",Z)}O(Y,Z)};this.bicyclinglayer=function(Y){L();var Z=V.get("bicyclinglayer");if(!Z){Z=new z.classes.BicyclingLayer();Z.setMap(N);V.add(Y,"bicyclinglayer",Z)}O(Y,Z)};this.groundoverlay=function(Y){Y.opts.bounds=j(Y.opts.bounds);if(Y.opts.bounds){L(Y.opts.bounds.getCenter())}var aa,Z=new z.classes.GroundOverlay(Y.opts.url,Y.opts.bounds,Y.opts.opts);Z.setMap(N);aa=V.add(Y,"groundoverlay",Z);O(Y,Z,aa)};this.streetviewpanorama=function(Y){if(!Y.opts.opts){Y.opts.opts={}}if(Y.latLng){Y.opts.opts.position=Y.latLng}else{if(Y.opts.opts.position){Y.opts.opts.position=I(Y.opts.opts.position)}}if(Y.todo.divId){Y.opts.container=document.getElementById(Y.todo.divId)}else{if(Y.opts.container){Y.opts.container=y(Y.opts.container).get(0)}}var aa,Z=new z.classes.StreetViewPanorama(Y.opts.container,Y.opts.opts);if(Z){N.setStreetView(Z)}aa=V.add(Y,"streetviewpanorama",Z);O(Y,Z,aa)};this.kmllayer=function(Z){var aa=[],Y="values" in Z.todo;if(!Y){Z.todo.values=[{options:Z.opts}]}if(!Z.todo.values.length){O(Z,false);return}y.each(Z.todo.values,function(ad,ae){var ag,af,ac,ab=b(Z,ae);if(!N){L()}ac=ab.options;if(ab.options.opts){ac=ab.options.opts;if(ab.options.url){ac.url=ab.options.url}}ac.map=N;if(d("3.10")){af=new z.classes.KmlLayer(ac)}else{af=new z.classes.KmlLayer(ac.url,ac)}aa.push(af);ag=V.add({todo:ab},"kmllayer",af);n(T,{todo:ab},af,ag)});O(Z,Y?aa:aa[0])};this.panel=function(ab){L();var ad,Y=0,ac=0,aa,Z=y(document.createElement("div"));Z.css({position:"absolute",zIndex:1000,visibility:"hidden"});if(ab.opts.content){aa=y(ab.opts.content);Z.append(aa);T.first().prepend(Z);if(ab.opts.left!==t){Y=ab.opts.left}else{if(ab.opts.right!==t){Y=T.width()-aa.width()-ab.opts.right}else{if(ab.opts.center){Y=(T.width()-aa.width())/2}}}if(ab.opts.top!==t){ac=ab.opts.top}else{if(ab.opts.bottom!==t){ac=T.height()-aa.height()-ab.opts.bottom}else{if(ab.opts.middle){ac=(T.height()-aa.height())/2}}}Z.css({top:ac,left:Y,visibility:"visible"})}ad=V.add(ab,"panel",Z);O(ab,Z,ad);Z=null};function W(aa){var af=new F(T,N,aa),Y={},ab={},ae=[],ad=/^[0-9]+$/,ac,Z;for(Z in aa){if(ad.test(Z)){ae.push(1*Z);ab[Z]=aa[Z];ab[Z].width=ab[Z].width||0;ab[Z].height=ab[Z].height||0}else{Y[Z]=aa[Z]}}ae.sort(function(ah,ag){return ah>ag});if(Y.calculator){ac=function(ag){var ah=[];y.each(ag,function(aj,ai){ah.push(af.value(ai))});return Y.calculator.apply(T,[ah])}}else{ac=function(ag){return ag.length}}af.error(function(){u.apply(S,arguments)});af.display(function(ag){var ai,aj,am,ak,al,ah=ac(ag.indexes);if(aa.force||ah>1){for(ai=0;ai<ae.length;ai++){if(ae[ai]<=ah){aj=ab[ae[ai]]}}}if(aj){al=aj.offset||[-aj.width/2,-aj.height/2];am=y.extend({},Y);am.options=y.extend({pane:"overlayLayer",content:aj.content?aj.content.replace("CLUSTER_COUNT",ah):"",offset:{x:("x" in al?al.x:al[0])||0,y:("y" in al?al.y:al[1])||0}},Y.options||{});ak=S.overlay({todo:am,opts:am.options,latLng:I(ag)},true);am.options.pane="floatShadow";am.options.content=y(document.createElement("div")).width(aj.width+"px").height(aj.height+"px").css({cursor:"pointer"});shadow=S.overlay({todo:am,opts:am.options,latLng:I(ag)},true);Y.data={latLng:I(ag),markers:[]};y.each(ag.indexes,function(ao,an){Y.data.markers.push(af.value(an));if(af.markerIsSet(an)){af.marker(an).setMap(null)}});n(T,{todo:Y},shadow,t,{main:ak,shadow:shadow});af.store(ag,ak,shadow)}else{y.each(ag.indexes,function(ao,an){af.marker(an).setMap(N)})}});return af}this.marker=function(aa){var Y="values" in aa.todo,ad=!N;if(!Y){aa.opts.position=aa.latLng||I(aa.opts.position);aa.todo.values=[{options:aa.opts}]}if(!aa.todo.values.length){O(aa,false);return}if(ad){L()}if(aa.todo.cluster&&!N.getBounds()){google.maps.event.addListenerOnce(N,"bounds_changed",function(){S.marker.apply(S,[aa])});return}if(aa.todo.cluster){var Z,ab;if(aa.todo.cluster instanceof a){Z=aa.todo.cluster;ab=V.getById(Z.id(),true)}else{ab=W(aa.todo.cluster);Z=new a(k(aa.todo.id,true),ab);V.add(aa,"clusterer",Z,ab)}ab.beginUpdate();y.each(aa.todo.values,function(af,ag){var ae=b(aa,ag);ae.options.position=ae.options.position?I(ae.options.position):I(ag);ae.options.map=N;if(ad){N.setCenter(ae.options.position);ad=false}ab.add(ae,ag)});ab.endUpdate();O(aa,Z)}else{var ac=[];y.each(aa.todo.values,function(af,ag){var ai,ah,ae=b(aa,ag);ae.options.position=ae.options.position?I(ae.options.position):I(ag);ae.options.map=N;if(ad){N.setCenter(ae.options.position);ad=false}ah=new z.classes.Marker(ae.options);ac.push(ah);ai=V.add({todo:ae},"marker",ah);n(T,{todo:ae},ah,ai)});O(aa,Y?ac:ac[0])}};this.getroute=function(Y){Y.opts.origin=I(Y.opts.origin,true);Y.opts.destination=I(Y.opts.destination,true);G().route(Y.opts,function(aa,Z){X(Y,Z==google.maps.DirectionsStatus.OK?aa:false,Z);P.ack()})};this.directionsrenderer=function(Y){Y.opts.map=N;var aa,Z=new google.maps.DirectionsRenderer(Y.opts);if(Y.todo.divId){Z.setPanel(document.getElementById(Y.todo.divId))}else{if(Y.todo.container){Z.setPanel(y(Y.todo.container).get(0))}}aa=V.add(Y,"directionsrenderer",Z);O(Y,Z,aa)};this.getgeoloc=function(Y){O(Y,Y.latLng)};this.styledmaptype=function(Y){L();var Z=new z.classes.StyledMapType(Y.todo.styles,Y.opts);N.mapTypes.set(Y.todo.id,Z);O(Y,Z)};this.imagemaptype=function(Y){L();var Z=new z.classes.ImageMapType(Y.opts);N.mapTypes.set(Y.todo.id,Z);O(Y,Z)};this.autofit=function(Y){var Z=new google.maps.LatLngBounds();y.each(V.all(),function(aa,ab){if(ab.getPosition){Z.extend(ab.getPosition())}else{if(ab.getBounds){Z.extend(ab.getBounds().getNorthEast());Z.extend(ab.getBounds().getSouthWest())}else{if(ab.getPaths){ab.getPaths().forEach(function(ac){ac.forEach(function(ad){Z.extend(ad)})})}else{if(ab.getPath){ab.getPath().forEach(function(ac){Z.extend(ac);""})}else{if(ab.getCenter){Z.extend(ab.getCenter())}else{if(ab instanceof a){ab=V.getById(ab.id(),true);if(ab){ab.autofit(Z)}}}}}}}});if(!Z.isEmpty()&&(!N.getBounds()||!N.getBounds().equals(Z))){if("maxZoom" in Y.todo){google.maps.event.addListenerOnce(N,"bounds_changed",function(){if(this.getZoom()>Y.todo.maxZoom){this.setZoom(Y.todo.maxZoom)}})}N.fitBounds(Z)}O(Y,true)};this.clear=function(Y){if(typeof Y.todo==="string"){if(V.clearById(Y.todo)||V.objClearById(Y.todo)){O(Y,true);return}Y.todo={name:Y.todo}}if(Y.todo.id){y.each(g(Y.todo.id),function(Z,aa){V.clearById(aa)||V.objClearById(aa)})}else{V.clear(g(Y.todo.name),Y.todo.last,Y.todo.first,Y.todo.tag);V.objClear(g(Y.todo.name),Y.todo.last,Y.todo.first,Y.todo.tag)}O(Y,true)};this.exec=function(Y){var Z=this;y.each(g(Y.todo.func),function(aa,ab){y.each(Z.get(Y.todo,true,Y.todo.hasOwnProperty("full")?Y.todo.full:true),function(ac,ad){ab.call(T,ad)})});O(Y,true)};this.get=function(aa,ad,ac){var Z,ab,Y=ad?aa:aa.todo;if(!ad){ac=Y.full}if(typeof Y==="string"){ab=V.getById(Y,false,ac)||V.objGetById(Y);if(ab===false){Z=Y;Y={}}}else{Z=Y.name}if(Z==="map"){ab=N}if(!ab){ab=[];if(Y.id){y.each(g(Y.id),function(ae,af){ab.push(V.getById(af,false,ac)||V.objGetById(af))});if(!y.isArray(Y.id)){ab=ab[0]}}else{y.each(Z?g(Z):[t],function(af,ag){var ae;if(Y.first){ae=V.get(ag,false,Y.tag,ac);if(ae){ab.push(ae)}}else{if(Y.all){y.each(V.all(ag,Y.tag,ac),function(ai,ah){ab.push(ah)})}else{ae=V.get(ag,true,Y.tag,ac);if(ae){ab.push(ae)}}}});if(!Y.all&&!y.isArray(Z)){ab=ab[0]}}}ab=y.isArray(ab)||!Y.all?ab:[ab];if(ad){return ab}else{O(aa,ab)}};this.getdistance=function(Y){var Z;Y.opts.origins=g(Y.opts.origins);for(Z=0;Z<Y.opts.origins.length;Z++){Y.opts.origins[Z]=I(Y.opts.origins[Z],true)}Y.opts.destinations=g(Y.opts.destinations);for(Z=0;Z<Y.opts.destinations.length;Z++){Y.opts.destinations[Z]=I(Y.opts.destinations[Z],true)}B().getDistanceMatrix(Y.opts,function(ab,aa){X(Y,aa===google.maps.DistanceMatrixStatus.OK?ab:false,aa);P.ack()})};this.trigger=function(Z){if(typeof Z.todo==="string"){google.maps.event.trigger(N,Z.todo)}else{var Y=[N,Z.todo.eventName];if(Z.todo.var_args){y.each(Z.todo.var_args,function(ab,aa){Y.push(aa)})}google.maps.event.trigger.apply(google.maps.event,Y)}X(Z);P.ack()}}function s(M){var L;if(!typeof M==="object"||!M.hasOwnProperty("get")){return false}for(L in M){if(L!=="get"){return false}}return !M.get.hasOwnProperty("callback")}y.fn.gmap3=function(){var M,O=[],N=true,L=[];J();for(M=0;M<arguments.length;M++){if(arguments[M]){O.push(arguments[M])}}if(!O.length){O.push("map")}y.each(this,function(){var P=y(this),Q=P.data("gmap3");N=false;if(!Q){Q=new K(P);P.data("gmap3",Q)}if(O.length===1&&(O[0]==="get"||s(O[0]))){if(O[0]==="get"){L.push(Q.get("map",true))}else{L.push(Q.get(O[0].get,true,O[0].get.full))}}else{Q._plan(O)}});if(L.length){if(L.length===1){return L[0]}else{return L}}return this}})(jQuery);

//===========================================================================

function ClusterIcon(a,b){a.getMarkerClusterer().extend(ClusterIcon,google.maps.OverlayView);this.cluster_=a;this.styles_=b;this.sums_=this.div_=this.center_=null;this.visible_=!1;this.setMap(a.getMap())}
ClusterIcon.prototype.onAdd=function(){var a=this;this.div_=document.createElement("div");this.visible_&&this.show();this.getPanes().overlayMouseTarget.appendChild(this.div_);google.maps.event.addDomListener(this.div_,"click",function(b){var c,d=a.cluster_.getMarkerClusterer();google.maps.event.trigger(d,"click",a.cluster_);google.maps.event.trigger(d,"clusterclick",a.cluster_);d.getZoomOnClick()&&(c=d.getMaxZoom(),d.getMap().fitBounds(a.cluster_.getBounds()),null!==c&&d.getMap().getZoom()>c&&d.getMap().setZoom(c+
1));b.cancelBubble=!0;b.stopPropagation&&b.stopPropagation()});google.maps.event.addDomListener(this.div_,"mouseover",function(){var b=a.cluster_.getMarkerClusterer();google.maps.event.trigger(b,"mouseover",a.cluster_)});google.maps.event.addDomListener(this.div_,"mouseout",function(){var b=a.cluster_.getMarkerClusterer();google.maps.event.trigger(b,"mouseout",a.cluster_)})};
ClusterIcon.prototype.onRemove=function(){this.div_&&this.div_.parentNode&&(this.hide(),google.maps.event.clearInstanceListeners(this.div_),this.div_.parentNode.removeChild(this.div_),this.div_=null)};ClusterIcon.prototype.draw=function(){if(this.visible_){var a=this.getPosFromLatLng_(this.center_);this.div_.style.top=a.y+"px";this.div_.style.left=a.x+"px"}};ClusterIcon.prototype.hide=function(){this.div_&&(this.div_.style.display="none");this.visible_=!1};
ClusterIcon.prototype.show=function(){if(this.div_){var a=this.getPosFromLatLng_(this.center_);this.div_.style.cssText=this.createCss(a);this.div_.innerHTML=this.cluster_.printable_?"<img src='"+this.url_+"'><div style='position: absolute; top: 0px; left: 0px; width: "+this.width_+"px;'>"+this.sums_.text+"</div>":this.sums_.text;this.div_.title=this.cluster_.getMarkerClusterer().getTitle();this.div_.style.display=""}this.visible_=!0};
ClusterIcon.prototype.useStyle=function(a){this.sums_=a;a=Math.max(0,a.index-1);a=Math.min(this.styles_.length-1,a);a=this.styles_[a];this.url_=a.url;this.height_=a.height;this.width_=a.width;this.anchor_=a.anchor;this.anchorIcon_=a.anchorIcon||[parseInt(this.height_/2,10),parseInt(this.width_/2,10)];this.textColor_=a.textColor||"black";this.textSize_=a.textSize||11;this.textDecoration_=a.textDecoration||"none";this.fontWeight_=a.fontWeight||"bold";this.fontStyle_=a.fontStyle||"normal";this.fontFamily_=
a.fontFamily||"Arial,sans-serif";this.backgroundPosition_=a.backgroundPosition||"0 0"};ClusterIcon.prototype.setCenter=function(a){this.center_=a};
ClusterIcon.prototype.createCss=function(a){var b=[];this.cluster_.printable_||(b.push("background-image:url("+this.url_+");"),b.push("background-size:"+this.width_+"px "+this.height_+"px;"),b.push("background-position:"+this.backgroundPosition_+";"));"object"===typeof this.anchor_?("number"===typeof this.anchor_[0]&&0<this.anchor_[0]&&this.anchor_[0]<this.height_?b.push("height:"+(this.height_-this.anchor_[0])+"px; padding-top:"+this.anchor_[0]+"px;"):b.push("height:"+this.height_+"px; line-height:"+
this.height_+"px;"),"number"===typeof this.anchor_[1]&&0<this.anchor_[1]&&this.anchor_[1]<this.width_?b.push("width:"+(this.width_-this.anchor_[1])+"px; padding-left:"+this.anchor_[1]+"px;"):b.push("width:"+this.width_+"px; text-align:center;")):b.push("height:"+this.height_+"px; line-height:"+this.height_+"px; width:"+this.width_+"px; text-align:center;");b.push("cursor:pointer; top:"+a.y+"px; left:"+a.x+"px; color:"+this.textColor_+"; position:absolute; font-size:"+this.textSize_+"px; font-family:"+
this.fontFamily_+"; font-weight:"+this.fontWeight_+"; font-style:"+this.fontStyle_+"; text-decoration:"+this.textDecoration_+";");return b.join("")};ClusterIcon.prototype.getPosFromLatLng_=function(a){a=this.getProjection().fromLatLngToDivPixel(a);a.x-=this.anchorIcon_[1];a.y-=this.anchorIcon_[0];return a};
function Cluster(a){this.markerClusterer_=a;this.map_=a.getMap();this.gridSize_=a.getGridSize();this.minClusterSize_=a.getMinimumClusterSize();this.averageCenter_=a.getAverageCenter();this.printable_=a.getPrintable();this.markers_=[];this.bounds_=this.center_=null;this.clusterIcon_=new ClusterIcon(this,a.getStyles())}Cluster.prototype.getSize=function(){return this.markers_.length};Cluster.prototype.getMarkers=function(){return this.markers_};Cluster.prototype.getCenter=function(){return this.center_};
Cluster.prototype.getMap=function(){return this.map_};Cluster.prototype.getMarkerClusterer=function(){return this.markerClusterer_};Cluster.prototype.getBounds=function(){var a,b=new google.maps.LatLngBounds(this.center_,this.center_),c=this.getMarkers();for(a=0;a<c.length;a++)b.extend(c[a].getPosition());return b};Cluster.prototype.remove=function(){this.clusterIcon_.setMap(null);this.markers_=[];delete this.markers_};
Cluster.prototype.addMarker=function(a){var b,c;if(this.isMarkerAlreadyAdded_(a))return!1;this.center_?this.averageCenter_&&(c=this.markers_.length+1,b=(this.center_.lat()*(c-1)+a.getPosition().lat())/c,c=(this.center_.lng()*(c-1)+a.getPosition().lng())/c,this.center_=new google.maps.LatLng(b,c),this.calculateBounds_()):(this.center_=a.getPosition(),this.calculateBounds_());a.isAdded=!0;this.markers_.push(a);b=this.markers_.length;c=this.markerClusterer_.getMaxZoom();if(null!==c&&this.map_.getZoom()>
c)a.getMap()!==this.map_&&a.setMap(this.map_);else if(b<this.minClusterSize_)a.getMap()!==this.map_&&a.setMap(this.map_);else if(b===this.minClusterSize_)for(a=0;a<b;a++)this.markers_[a].setMap(null);else a.setMap(null);this.updateIcon_();return!0};Cluster.prototype.isMarkerInClusterBounds=function(a){return this.bounds_.contains(a.getPosition())};Cluster.prototype.calculateBounds_=function(){var a=new google.maps.LatLngBounds(this.center_,this.center_);this.bounds_=this.markerClusterer_.getExtendedBounds(a)};
Cluster.prototype.updateIcon_=function(){var a=this.markers_.length,b=this.markerClusterer_.getMaxZoom();null!==b&&this.map_.getZoom()>b?this.clusterIcon_.hide():a<this.minClusterSize_?this.clusterIcon_.hide():(a=this.markerClusterer_.getStyles().length,a=this.markerClusterer_.getCalculator()(this.markers_,a),this.clusterIcon_.setCenter(this.center_),this.clusterIcon_.useStyle(a),this.clusterIcon_.show())};
Cluster.prototype.isMarkerAlreadyAdded_=function(a){var b;if(this.markers_.indexOf)return-1!==this.markers_.indexOf(a);for(b=0;b<this.markers_.length;b++)if(a===this.markers_[b])return!0;return!1};
function MarkerClusterer(a,b,c){this.extend(MarkerClusterer,google.maps.OverlayView);b=b||[];c=c||{};this.markers_=[];this.clusters_=[];this.listeners_=[];this.activeMap_=null;this.ready_=!1;this.gridSize_=c.gridSize||60;this.minClusterSize_=c.minimumClusterSize||2;this.maxZoom_=c.maxZoom||null;this.styles_=c.styles||[];this.title_=c.title||"";this.zoomOnClick_=!0;void 0!==c.zoomOnClick&&(this.zoomOnClick_=c.zoomOnClick);this.averageCenter_=!1;void 0!==c.averageCenter&&(this.averageCenter_=c.averageCenter);
this.ignoreHidden_=!1;void 0!==c.ignoreHidden&&(this.ignoreHidden_=c.ignoreHidden);this.printable_=!1;void 0!==c.printable&&(this.printable_=c.printable);this.imagePath_=c.imagePath||MarkerClusterer.IMAGE_PATH;this.imageExtension_=c.imageExtension||MarkerClusterer.IMAGE_EXTENSION;this.imageSizes_=c.imageSizes||MarkerClusterer.IMAGE_SIZES;this.calculator_=c.calculator||MarkerClusterer.CALCULATOR;this.batchSize_=c.batchSize||MarkerClusterer.BATCH_SIZE;this.batchSizeIE_=c.batchSizeIE||MarkerClusterer.BATCH_SIZE_IE;
-1!==navigator.userAgent.toLowerCase().indexOf("msie")&&(this.batchSize_=this.batchSizeIE_);this.setupStyles_();this.addMarkers(b,!0);this.setMap(a)}MarkerClusterer.prototype.onAdd=function(){var a=this;this.activeMap_=this.getMap();this.ready_=!0;this.repaint();this.listeners_=[google.maps.event.addListener(this.getMap(),"zoom_changed",function(){a.resetViewport_(!1)}),google.maps.event.addListener(this.getMap(),"idle",function(){a.redraw_()})]};
MarkerClusterer.prototype.onRemove=function(){var a;for(a=0;a<this.markers_.length;a++)this.markers_[a].setMap(this.activeMap_);for(a=0;a<this.clusters_.length;a++)this.clusters_[a].remove();this.clusters_=[];for(a=0;a<this.listeners_.length;a++)google.maps.event.removeListener(this.listeners_[a]);this.listeners_=[];this.activeMap_=null;this.ready_=!1};MarkerClusterer.prototype.draw=function(){};
MarkerClusterer.prototype.setupStyles_=function(){var a,b;if(!(0<this.styles_.length))for(a=0;a<this.imageSizes_.length;a++)b=this.imageSizes_[a],this.styles_.push({url:this.imagePath_+(a+1)+"."+this.imageExtension_,height:b,width:b})};MarkerClusterer.prototype.fitMapToMarkers=function(){var a,b=this.getMarkers(),c=new google.maps.LatLngBounds;for(a=0;a<b.length;a++)c.extend(b[a].getPosition());this.getMap().fitBounds(c)};MarkerClusterer.prototype.getGridSize=function(){return this.gridSize_};
MarkerClusterer.prototype.setGridSize=function(a){this.gridSize_=a};MarkerClusterer.prototype.getMinimumClusterSize=function(){return this.minClusterSize_};MarkerClusterer.prototype.setMinimumClusterSize=function(a){this.minClusterSize_=a};MarkerClusterer.prototype.getMaxZoom=function(){return this.maxZoom_};MarkerClusterer.prototype.setMaxZoom=function(a){this.maxZoom_=a};MarkerClusterer.prototype.getStyles=function(){return this.styles_};
MarkerClusterer.prototype.setStyles=function(a){this.styles_=a};MarkerClusterer.prototype.getTitle=function(){return this.title_};MarkerClusterer.prototype.setTitle=function(a){this.title_=a};MarkerClusterer.prototype.getZoomOnClick=function(){return this.zoomOnClick_};MarkerClusterer.prototype.setZoomOnClick=function(a){this.zoomOnClick_=a};MarkerClusterer.prototype.getAverageCenter=function(){return this.averageCenter_};
MarkerClusterer.prototype.setAverageCenter=function(a){this.averageCenter_=a};MarkerClusterer.prototype.getIgnoreHidden=function(){return this.ignoreHidden_};MarkerClusterer.prototype.setIgnoreHidden=function(a){this.ignoreHidden_=a};MarkerClusterer.prototype.getImageExtension=function(){return this.imageExtension_};MarkerClusterer.prototype.setImageExtension=function(a){this.imageExtension_=a};MarkerClusterer.prototype.getImagePath=function(){return this.imagePath_};
MarkerClusterer.prototype.setImagePath=function(a){this.imagePath_=a};MarkerClusterer.prototype.getImageSizes=function(){return this.imageSizes_};MarkerClusterer.prototype.setImageSizes=function(a){this.imageSizes_=a};MarkerClusterer.prototype.getCalculator=function(){return this.calculator_};MarkerClusterer.prototype.setCalculator=function(a){this.calculator_=a};MarkerClusterer.prototype.getPrintable=function(){return this.printable_};
MarkerClusterer.prototype.setPrintable=function(a){this.printable_=a};MarkerClusterer.prototype.getBatchSizeIE=function(){return this.batchSizeIE_};MarkerClusterer.prototype.setBatchSizeIE=function(a){this.batchSizeIE_=a};MarkerClusterer.prototype.getMarkers=function(){return this.markers_};MarkerClusterer.prototype.getTotalMarkers=function(){return this.markers_.length};MarkerClusterer.prototype.getClusters=function(){return this.clusters_};MarkerClusterer.prototype.getTotalClusters=function(){return this.clusters_.length};
MarkerClusterer.prototype.addMarker=function(a,b){this.pushMarkerTo_(a);b||this.redraw_()};MarkerClusterer.prototype.addMarkers=function(a,b){var c;for(c=0;c<a.length;c++)this.pushMarkerTo_(a[c]);b||this.redraw_()};MarkerClusterer.prototype.pushMarkerTo_=function(a){if(a.getDraggable()){var b=this;google.maps.event.addListener(a,"dragend",function(){b.ready_&&(this.isAdded=!1,b.repaint())})}a.isAdded=!1;this.markers_.push(a)};
MarkerClusterer.prototype.removeMarker=function(a,b){var c=this.removeMarker_(a);!b&&c&&this.repaint();return c};MarkerClusterer.prototype.removeMarkers=function(a,b){var c,d,e=!1;for(c=0;c<a.length;c++)d=this.removeMarker_(a[c]),e=e||d;!b&&e&&this.repaint();return e};
MarkerClusterer.prototype.removeMarker_=function(a){var b,c=-1;if(this.markers_.indexOf)c=this.markers_.indexOf(a);else for(b=0;b<this.markers_.length;b++)if(a===this.markers_[b]){c=b;break}if(-1===c)return!1;a.setMap(null);this.markers_.splice(c,1);return!0};MarkerClusterer.prototype.clearMarkers=function(){this.resetViewport_(!0);this.markers_=[]};
MarkerClusterer.prototype.repaint=function(){var a=this.clusters_.slice();this.clusters_=[];this.resetViewport_(!1);this.redraw_();setTimeout(function(){var b;for(b=0;b<a.length;b++)a[b].remove()},0)};
MarkerClusterer.prototype.getExtendedBounds=function(a){var b=this.getProjection(),c=new google.maps.LatLng(a.getNorthEast().lat(),a.getNorthEast().lng()),d=new google.maps.LatLng(a.getSouthWest().lat(),a.getSouthWest().lng()),c=b.fromLatLngToDivPixel(c);c.x+=this.gridSize_;c.y-=this.gridSize_;d=b.fromLatLngToDivPixel(d);d.x-=this.gridSize_;d.y+=this.gridSize_;c=b.fromDivPixelToLatLng(c);b=b.fromDivPixelToLatLng(d);a.extend(c);a.extend(b);return a};MarkerClusterer.prototype.redraw_=function(){this.createClusters_(0)};
MarkerClusterer.prototype.resetViewport_=function(a){var b,c;for(b=0;b<this.clusters_.length;b++)this.clusters_[b].remove();this.clusters_=[];for(b=0;b<this.markers_.length;b++)c=this.markers_[b],c.isAdded=!1,a&&c.setMap(null)};
MarkerClusterer.prototype.distanceBetweenPoints_=function(a,b){var c=(b.lat()-a.lat())*Math.PI/180,d=(b.lng()-a.lng())*Math.PI/180,c=Math.sin(c/2)*Math.sin(c/2)+Math.cos(a.lat()*Math.PI/180)*Math.cos(b.lat()*Math.PI/180)*Math.sin(d/2)*Math.sin(d/2);return 12742*Math.atan2(Math.sqrt(c),Math.sqrt(1-c))};MarkerClusterer.prototype.isMarkerInBounds_=function(a,b){return b.contains(a.getPosition())};
MarkerClusterer.prototype.addToClosestCluster_=function(a){var b,c,d,e=4E4,f=null;for(b=0;b<this.clusters_.length;b++)if(d=this.clusters_[b],c=d.getCenter())c=this.distanceBetweenPoints_(c,a.getPosition()),c<e&&(e=c,f=d);f&&f.isMarkerInClusterBounds(a)?f.addMarker(a):(d=new Cluster(this),d.addMarker(a),this.clusters_.push(d))};
MarkerClusterer.prototype.createClusters_=function(a){var b,c=this;if(this.ready_){0===a&&(google.maps.event.trigger(this,"clusteringbegin",this),"undefined"!==typeof this.timerRefStatic&&(clearTimeout(this.timerRefStatic),delete this.timerRefStatic));for(var d=new google.maps.LatLngBounds(this.getMap().getBounds().getSouthWest(),this.getMap().getBounds().getNorthEast()),d=this.getExtendedBounds(d),e=Math.min(a+this.batchSize_,this.markers_.length);a<e;a++)b=this.markers_[a],!b.isAdded&&this.isMarkerInBounds_(b,
d)&&(!this.ignoreHidden_||this.ignoreHidden_&&b.getVisible())&&this.addToClosestCluster_(b);e<this.markers_.length?this.timerRefStatic=setTimeout(function(){c.createClusters_(e)},0):(delete this.timerRefStatic,google.maps.event.trigger(this,"clusteringend",this))}};MarkerClusterer.prototype.extend=function(a,b){return function(a){for(var b in a.prototype)this.prototype[b]=a.prototype[b];return this}.apply(a,[b])};
MarkerClusterer.CALCULATOR=function(a,b){for(var c=0,d=a.length.toString(),e=d;0!==e;)e=parseInt(e/10,10),c++;c=Math.min(c,b);return{text:d,index:c}};MarkerClusterer.BATCH_SIZE=2E3;MarkerClusterer.BATCH_SIZE_IE=500;MarkerClusterer.IMAGE_PATH="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclustererplus/images/m";MarkerClusterer.IMAGE_EXTENSION="png";MarkerClusterer.IMAGE_SIZES=[53,56,66,78,90];

//===========================================================================

(function(a){if(typeof define==="function"&&define.amd&&define.amd.jQuery){define(["jquery"],a)}else{a(jQuery)}}(function(e){var o="left",n="right",d="up",v="down",c="in",w="out",l="none",r="auto",k="swipe",s="pinch",x="tap",i="doubletap",b="longtap",A="horizontal",t="vertical",h="all",q=10,f="start",j="move",g="end",p="cancel",a="ontouchstart" in window,y="TouchSwipe";var m={fingers:1,threshold:75,cancelThreshold:null,pinchThreshold:20,maxTimeThreshold:null,fingerReleaseThreshold:250,longTapThreshold:500,doubleTapThreshold:200,swipe:null,swipeLeft:null,swipeRight:null,swipeUp:null,swipeDown:null,swipeStatus:null,pinchIn:null,pinchOut:null,pinchStatus:null,click:null,tap:null,doubleTap:null,longTap:null,triggerOnTouchEnd:true,triggerOnTouchLeave:false,allowPageScroll:"auto",fallbackToMouseEvents:true,excludedElements:"label, button, input, select, textarea, a, .noSwipe"};e.fn.swipe=function(D){var C=e(this),B=C.data(y);if(B&&typeof D==="string"){if(B[D]){return B[D].apply(this,Array.prototype.slice.call(arguments,1))}else{e.error("Method "+D+" does not exist on jQuery.swipe")}}else{if(!B&&(typeof D==="object"||!D)){return u.apply(this,arguments)}}return C};e.fn.swipe.defaults=m;e.fn.swipe.phases={PHASE_START:f,PHASE_MOVE:j,PHASE_END:g,PHASE_CANCEL:p};e.fn.swipe.directions={LEFT:o,RIGHT:n,UP:d,DOWN:v,IN:c,OUT:w};e.fn.swipe.pageScroll={NONE:l,HORIZONTAL:A,VERTICAL:t,AUTO:r};e.fn.swipe.fingers={ONE:1,TWO:2,THREE:3,ALL:h};function u(B){if(B&&(B.allowPageScroll===undefined&&(B.swipe!==undefined||B.swipeStatus!==undefined))){B.allowPageScroll=l}if(B.click!==undefined&&B.tap===undefined){B.tap=B.click}if(!B){B={}}B=e.extend({},e.fn.swipe.defaults,B);return this.each(function(){var D=e(this);var C=D.data(y);if(!C){C=new z(this,B);D.data(y,C)}})}function z(a0,aq){var av=(a||!aq.fallbackToMouseEvents),G=av?"touchstart":"mousedown",au=av?"touchmove":"mousemove",R=av?"touchend":"mouseup",P=av?null:"mouseleave",az="touchcancel";var ac=0,aL=null,Y=0,aX=0,aV=0,D=1,am=0,aF=0,J=null;var aN=e(a0);var W="start";var T=0;var aM=null;var Q=0,aY=0,a1=0,aa=0,K=0;var aS=null;try{aN.bind(G,aJ);aN.bind(az,a5)}catch(ag){e.error("events not supported "+G+","+az+" on jQuery.swipe")}this.enable=function(){aN.bind(G,aJ);aN.bind(az,a5);return aN};this.disable=function(){aG();return aN};this.destroy=function(){aG();aN.data(y,null);return aN};this.option=function(a8,a7){if(aq[a8]!==undefined){if(a7===undefined){return aq[a8]}else{aq[a8]=a7}}else{e.error("Option "+a8+" does not exist on jQuery.swipe.options")}return null};function aJ(a9){if(ax()){return}if(e(a9.target).closest(aq.excludedElements,aN).length>0){return}var ba=a9.originalEvent?a9.originalEvent:a9;var a8,a7=a?ba.touches[0]:ba;W=f;if(a){T=ba.touches.length}else{a9.preventDefault()}ac=0;aL=null;aF=null;Y=0;aX=0;aV=0;D=1;am=0;aM=af();J=X();O();if(!a||(T===aq.fingers||aq.fingers===h)||aT()){ae(0,a7);Q=ao();if(T==2){ae(1,ba.touches[1]);aX=aV=ap(aM[0].start,aM[1].start)}if(aq.swipeStatus||aq.pinchStatus){a8=L(ba,W)}}else{a8=false}if(a8===false){W=p;L(ba,W);return a8}else{ak(true)}return null}function aZ(ba){var bd=ba.originalEvent?ba.originalEvent:ba;if(W===g||W===p||ai()){return}var a9,a8=a?bd.touches[0]:bd;var bb=aD(a8);aY=ao();if(a){T=bd.touches.length}W=j;if(T==2){if(aX==0){ae(1,bd.touches[1]);aX=aV=ap(aM[0].start,aM[1].start)}else{aD(bd.touches[1]);aV=ap(aM[0].end,aM[1].end);aF=an(aM[0].end,aM[1].end)}D=a3(aX,aV);am=Math.abs(aX-aV)}if((T===aq.fingers||aq.fingers===h)||!a||aT()){aL=aH(bb.start,bb.end);ah(ba,aL);ac=aO(bb.start,bb.end);Y=aI();aE(aL,ac);if(aq.swipeStatus||aq.pinchStatus){a9=L(bd,W)}if(!aq.triggerOnTouchEnd||aq.triggerOnTouchLeave){var a7=true;if(aq.triggerOnTouchLeave){var bc=aU(this);a7=B(bb.end,bc)}if(!aq.triggerOnTouchEnd&&a7){W=ay(j)}else{if(aq.triggerOnTouchLeave&&!a7){W=ay(g)}}if(W==p||W==g){L(bd,W)}}}else{W=p;L(bd,W)}if(a9===false){W=p;L(bd,W)}}function I(a7){var a8=a7.originalEvent;if(a){if(a8.touches.length>0){C();return true}}if(ai()){T=aa}a7.preventDefault();aY=ao();Y=aI();if(a6()){W=p;L(a8,W)}else{if(aq.triggerOnTouchEnd||(aq.triggerOnTouchEnd==false&&W===j)){W=g;L(a8,W)}else{if(!aq.triggerOnTouchEnd&&a2()){W=g;aB(a8,W,x)}else{if(W===j){W=p;L(a8,W)}}}}ak(false);return null}function a5(){T=0;aY=0;Q=0;aX=0;aV=0;D=1;O();ak(false)}function H(a7){var a8=a7.originalEvent;if(aq.triggerOnTouchLeave){W=ay(g);L(a8,W)}}function aG(){aN.unbind(G,aJ);aN.unbind(az,a5);aN.unbind(au,aZ);aN.unbind(R,I);if(P){aN.unbind(P,H)}ak(false)}function ay(bb){var ba=bb;var a9=aw();var a8=aj();var a7=a6();if(!a9||a7){ba=p}else{if(a8&&bb==j&&(!aq.triggerOnTouchEnd||aq.triggerOnTouchLeave)){ba=g}else{if(!a8&&bb==g&&aq.triggerOnTouchLeave){ba=p}}}return ba}function L(a9,a7){var a8=undefined;if(F()||S()){a8=aB(a9,a7,k)}else{if((M()||aT())&&a8!==false){a8=aB(a9,a7,s)}}if(aC()&&a8!==false){a8=aB(a9,a7,i)}else{if(al()&&a8!==false){a8=aB(a9,a7,b)}else{if(ad()&&a8!==false){a8=aB(a9,a7,x)}}}if(a7===p){a5(a9)}if(a7===g){if(a){if(a9.touches.length==0){a5(a9)}}else{a5(a9)}}return a8}function aB(ba,a7,a9){var a8=undefined;if(a9==k){aN.trigger("swipeStatus",[a7,aL||null,ac||0,Y||0,T]);if(aq.swipeStatus){a8=aq.swipeStatus.call(aN,ba,a7,aL||null,ac||0,Y||0,T);if(a8===false){return false}}if(a7==g&&aR()){aN.trigger("swipe",[aL,ac,Y,T]);if(aq.swipe){a8=aq.swipe.call(aN,ba,aL,ac,Y,T);if(a8===false){return false}}switch(aL){case o:aN.trigger("swipeLeft",[aL,ac,Y,T]);if(aq.swipeLeft){a8=aq.swipeLeft.call(aN,ba,aL,ac,Y,T)}break;case n:aN.trigger("swipeRight",[aL,ac,Y,T]);if(aq.swipeRight){a8=aq.swipeRight.call(aN,ba,aL,ac,Y,T)}break;case d:aN.trigger("swipeUp",[aL,ac,Y,T]);if(aq.swipeUp){a8=aq.swipeUp.call(aN,ba,aL,ac,Y,T)}break;case v:aN.trigger("swipeDown",[aL,ac,Y,T]);if(aq.swipeDown){a8=aq.swipeDown.call(aN,ba,aL,ac,Y,T)}break}}}if(a9==s){aN.trigger("pinchStatus",[a7,aF||null,am||0,Y||0,T,D]);if(aq.pinchStatus){a8=aq.pinchStatus.call(aN,ba,a7,aF||null,am||0,Y||0,T,D);if(a8===false){return false}}if(a7==g&&a4()){switch(aF){case c:aN.trigger("pinchIn",[aF||null,am||0,Y||0,T,D]);if(aq.pinchIn){a8=aq.pinchIn.call(aN,ba,aF||null,am||0,Y||0,T,D)}break;case w:aN.trigger("pinchOut",[aF||null,am||0,Y||0,T,D]);if(aq.pinchOut){a8=aq.pinchOut.call(aN,ba,aF||null,am||0,Y||0,T,D)}break}}}if(a9==x){if(a7===p||a7===g){clearTimeout(aS);if(V()&&!E()){K=ao();aS=setTimeout(e.proxy(function(){K=null;aN.trigger("tap",[ba.target]);if(aq.tap){a8=aq.tap.call(aN,ba,ba.target)}},this),aq.doubleTapThreshold)}else{K=null;aN.trigger("tap",[ba.target]);if(aq.tap){a8=aq.tap.call(aN,ba,ba.target)}}}}else{if(a9==i){if(a7===p||a7===g){clearTimeout(aS);K=null;aN.trigger("doubletap",[ba.target]);if(aq.doubleTap){a8=aq.doubleTap.call(aN,ba,ba.target)}}}else{if(a9==b){if(a7===p||a7===g){clearTimeout(aS);K=null;aN.trigger("longtap",[ba.target]);if(aq.longTap){a8=aq.longTap.call(aN,ba,ba.target)}}}}}return a8}function aj(){var a7=true;if(aq.threshold!==null){a7=ac>=aq.threshold}return a7}function a6(){var a7=false;if(aq.cancelThreshold!==null&&aL!==null){a7=(aP(aL)-ac)>=aq.cancelThreshold}return a7}function ab(){if(aq.pinchThreshold!==null){return am>=aq.pinchThreshold}return true}function aw(){var a7;if(aq.maxTimeThreshold){if(Y>=aq.maxTimeThreshold){a7=false}else{a7=true}}else{a7=true}return a7}function ah(a7,a8){if(aq.allowPageScroll===l||aT()){a7.preventDefault()}else{var a9=aq.allowPageScroll===r;switch(a8){case o:if((aq.swipeLeft&&a9)||(!a9&&aq.allowPageScroll!=A)){a7.preventDefault()}break;case n:if((aq.swipeRight&&a9)||(!a9&&aq.allowPageScroll!=A)){a7.preventDefault()}break;case d:if((aq.swipeUp&&a9)||(!a9&&aq.allowPageScroll!=t)){a7.preventDefault()}break;case v:if((aq.swipeDown&&a9)||(!a9&&aq.allowPageScroll!=t)){a7.preventDefault()}break}}}function a4(){var a8=aK();var a7=U();var a9=ab();return a8&&a7&&a9}function aT(){return !!(aq.pinchStatus||aq.pinchIn||aq.pinchOut)}function M(){return !!(a4()&&aT())}function aR(){var ba=aw();var bc=aj();var a9=aK();var a7=U();var a8=a6();var bb=!a8&&a7&&a9&&bc&&ba;return bb}function S(){return !!(aq.swipe||aq.swipeStatus||aq.swipeLeft||aq.swipeRight||aq.swipeUp||aq.swipeDown)}function F(){return !!(aR()&&S())}function aK(){return((T===aq.fingers||aq.fingers===h)||!a)}function U(){return aM[0].end.x!==0}function a2(){return !!(aq.tap)}function V(){return !!(aq.doubleTap)}function aQ(){return !!(aq.longTap)}function N(){if(K==null){return false}var a7=ao();return(V()&&((a7-K)<=aq.doubleTapThreshold))}function E(){return N()}function at(){return((T===1||!a)&&(isNaN(ac)||ac===0))}function aW(){return((Y>aq.longTapThreshold)&&(ac<q))}function ad(){return !!(at()&&a2())}function aC(){return !!(N()&&V())}function al(){return !!(aW()&&aQ())}function C(){a1=ao();aa=event.touches.length+1}function O(){a1=0;aa=0}function ai(){var a7=false;if(a1){var a8=ao()-a1;if(a8<=aq.fingerReleaseThreshold){a7=true}}return a7}function ax(){return !!(aN.data(y+"_intouch")===true)}function ak(a7){if(a7===true){aN.bind(au,aZ);aN.bind(R,I);if(P){aN.bind(P,H)}}else{aN.unbind(au,aZ,false);aN.unbind(R,I,false);if(P){aN.unbind(P,H,false)}}aN.data(y+"_intouch",a7===true)}function ae(a8,a7){var a9=a7.identifier!==undefined?a7.identifier:0;aM[a8].identifier=a9;aM[a8].start.x=aM[a8].end.x=a7.pageX||a7.clientX;aM[a8].start.y=aM[a8].end.y=a7.pageY||a7.clientY;return aM[a8]}function aD(a7){var a9=a7.identifier!==undefined?a7.identifier:0;var a8=Z(a9);a8.end.x=a7.pageX||a7.clientX;a8.end.y=a7.pageY||a7.clientY;return a8}function Z(a8){for(var a7=0;a7<aM.length;a7++){if(aM[a7].identifier==a8){return aM[a7]}}}function af(){var a7=[];for(var a8=0;a8<=5;a8++){a7.push({start:{x:0,y:0},end:{x:0,y:0},identifier:0})}return a7}function aE(a7,a8){a8=Math.max(a8,aP(a7));J[a7].distance=a8}function aP(a7){if(J[a7]){return J[a7].distance}return undefined}function X(){var a7={};a7[o]=ar(o);a7[n]=ar(n);a7[d]=ar(d);a7[v]=ar(v);return a7}function ar(a7){return{direction:a7,distance:0}}function aI(){return aY-Q}function ap(ba,a9){var a8=Math.abs(ba.x-a9.x);var a7=Math.abs(ba.y-a9.y);return Math.round(Math.sqrt(a8*a8+a7*a7))}function a3(a7,a8){var a9=(a8/a7)*1;return a9.toFixed(2)}function an(){if(D<1){return w}else{return c}}function aO(a8,a7){return Math.round(Math.sqrt(Math.pow(a7.x-a8.x,2)+Math.pow(a7.y-a8.y,2)))}function aA(ba,a8){var a7=ba.x-a8.x;var bc=a8.y-ba.y;var a9=Math.atan2(bc,a7);var bb=Math.round(a9*180/Math.PI);if(bb<0){bb=360-Math.abs(bb)}return bb}function aH(a8,a7){var a9=aA(a8,a7);if((a9<=45)&&(a9>=0)){return o}else{if((a9<=360)&&(a9>=315)){return o}else{if((a9>=135)&&(a9<=225)){return n}else{if((a9>45)&&(a9<135)){return v}else{return d}}}}}function ao(){var a7=new Date();return a7.getTime()}function aU(a7){a7=e(a7);var a9=a7.offset();var a8={left:a9.left,right:a9.left+a7.outerWidth(),top:a9.top,bottom:a9.top+a7.outerHeight()};return a8}function B(a7,a8){return(a7.x>a8.left&&a7.x<a8.right&&a7.y>a8.top&&a7.y<a8.bottom)}}}));

//===========================================================================

/*!
 * jCarousel - Riding carousels with jQuery
 *   http://sorgalla.com/jcarousel/
 *
 * Copyright (c) 2006 Jan Sorgalla (http://sorgalla.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Built on top of the jQuery library
 *   http://jquery.com
 *
 * Inspired by the "Carousel Component" by Bill Scott
 *   http://billwscott.com/carousel/
 */

(function(a){var b={vertical:!1,rtl:!1,start:1,offset:1,size:null,scroll:3,visible:null,animation:"normal",easing:"swing",auto:0,wrap:null,initCallback:null,setupCallback:null,reloadCallback:null,itemLoadCallback:null,itemFirstInCallback:null,itemFirstOutCallback:null,itemLastInCallback:null,itemLastOutCallback:null,itemVisibleInCallback:null,itemVisibleOutCallback:null,animationStepCallback:null,buttonNextHTML:"<div></div>",buttonPrevHTML:"<div></div>",buttonNextEvent:"click",buttonPrevEvent:"click",buttonNextCallback:null,buttonPrevCallback:null,itemFallbackDimension:null},c=!1;a(window).bind("load.jcarousel",function(){c=!0}),a.jcarousel=function(e,f){this.options=a.extend({},b,f||{}),this.locked=!1,this.autoStopped=!1,this.container=null,this.clip=null,this.list=null,this.buttonNext=null,this.buttonPrev=null,this.buttonNextState=null,this.buttonPrevState=null,f&&void 0!==f.rtl||(this.options.rtl="rtl"==(a(e).attr("dir")||a("html").attr("dir")||"").toLowerCase()),this.wh=this.options.vertical?"height":"width",this.lt=this.options.vertical?"top":this.options.rtl?"right":"left";for(var g="",h=e.className.split(" "),i=0;h.length>i;i++)if(-1!=h[i].indexOf("jcarousel-skin")){a(e).removeClass(h[i]),g=h[i];break}"UL"==e.nodeName.toUpperCase()||"OL"==e.nodeName.toUpperCase()?(this.list=a(e),this.clip=this.list.parents(".jcarousel-clip"),this.container=this.list.parents(".jcarousel-container")):(this.container=a(e),this.list=this.container.find("ul,ol").eq(0),this.clip=this.container.find(".jcarousel-clip")),0===this.clip.size()&&(this.clip=this.list.wrap("<div></div>").parent()),0===this.container.size()&&(this.container=this.clip.wrap("<div></div>").parent()),""!==g&&-1==this.container.parent()[0].className.indexOf("jcarousel-skin")&&this.container.wrap('<div class=" '+g+'"></div>'),this.buttonPrev=a(".jcarousel-prev",this.container),0===this.buttonPrev.size()&&null!==this.options.buttonPrevHTML&&(this.buttonPrev=a(this.options.buttonPrevHTML).appendTo(this.container)),this.buttonPrev.addClass(this.className("jcarousel-prev")),this.buttonNext=a(".jcarousel-next",this.container),0===this.buttonNext.size()&&null!==this.options.buttonNextHTML&&(this.buttonNext=a(this.options.buttonNextHTML).appendTo(this.container)),this.buttonNext.addClass(this.className("jcarousel-next")),this.clip.addClass(this.className("jcarousel-clip")).css({position:"relative"}),this.list.addClass(this.className("jcarousel-list")).css({overflow:"hidden",position:"relative",top:0,margin:0,padding:0}).css(this.options.rtl?"right":"left",0),this.container.addClass(this.className("jcarousel-container")).css({position:"relative"}),!this.options.vertical&&this.options.rtl&&this.container.addClass("jcarousel-direction-rtl").attr("dir","rtl");var j=null!==this.options.visible?Math.ceil(this.clipping()/this.options.visible):null,k=this.list.children("li"),l=this;if(k.size()>0){var m=0,n=this.options.offset;k.each(function(){l.format(this,n++),m+=l.dimension(this,j)}),this.list.css(this.wh,m+100+"px"),f&&void 0!==f.size||(this.options.size=k.size())}this.container.css("display","block"),this.buttonNext.css("display","block"),this.buttonPrev.css("display","block"),this.funcNext=function(){return l.next(),!1},this.funcPrev=function(){return l.prev(),!1},this.funcResize=function(){l.resizeTimer&&clearTimeout(l.resizeTimer),l.resizeTimer=setTimeout(function(){l.reload()},100)},null!==this.options.initCallback&&this.options.initCallback(this,"init"),!c&&d.isSafari()?(this.buttons(!1,!1),a(window).bind("load.jcarousel",function(){l.setup()})):this.setup()};var d=a.jcarousel;d.fn=d.prototype={jcarousel:"0.2.9"},d.fn.extend=d.extend=a.extend,d.fn.extend({setup:function(){if(this.first=null,this.last=null,this.prevFirst=null,this.prevLast=null,this.animating=!1,this.timer=null,this.resizeTimer=null,this.tail=null,this.inTail=!1,!this.locked){this.list.css(this.lt,this.pos(this.options.offset)+"px");var b=this.pos(this.options.start,!0);this.prevFirst=this.prevLast=null,this.animate(b,!1),a(window).unbind("resize.jcarousel",this.funcResize).bind("resize.jcarousel",this.funcResize),null!==this.options.setupCallback&&this.options.setupCallback(this)}},reset:function(){this.list.empty(),this.list.css(this.lt,"0px"),this.list.css(this.wh,"10px"),null!==this.options.initCallback&&this.options.initCallback(this,"reset"),this.setup()},reload:function(){if(null!==this.tail&&this.inTail&&this.list.css(this.lt,d.intval(this.list.css(this.lt))+this.tail),this.tail=null,this.inTail=!1,null!==this.options.reloadCallback&&this.options.reloadCallback(this),null!==this.options.visible){var a=this,b=Math.ceil(this.clipping()/this.options.visible),c=0,e=0;this.list.children("li").each(function(d){c+=a.dimension(this,b),a.first>d+1&&(e=c)}),this.list.css(this.wh,c+"px"),this.list.css(this.lt,-e+"px")}this.scroll(this.first,!1)},lock:function(){this.locked=!0,this.buttons()},unlock:function(){this.locked=!1,this.buttons()},size:function(a){return void 0!==a&&(this.options.size=a,this.locked||this.buttons()),this.options.size},has:function(a,b){void 0!==b&&b||(b=a),null!==this.options.size&&b>this.options.size&&(b=this.options.size);for(var c=a;b>=c;c++){var d=this.get(c);if(!d.length||d.hasClass("jcarousel-item-placeholder"))return!1}return!0},get:function(b){return a(">.jcarousel-item-"+b,this.list)},add:function(b,c){var e=this.get(b),f=0,g=a(c);if(0===e.length){var h,i=d.intval(b);for(e=this.create(b);;)if(h=this.get(--i),0>=i||h.length){0>=i?this.list.prepend(e):h.after(e);break}}else f=this.dimension(e);"LI"==g.get(0).nodeName.toUpperCase()?(e.replaceWith(g),e=g):e.empty().append(c),this.format(e.removeClass(this.className("jcarousel-item-placeholder")),b);var j=null!==this.options.visible?Math.ceil(this.clipping()/this.options.visible):null,k=this.dimension(e,j)-f;return b>0&&this.first>b&&this.list.css(this.lt,d.intval(this.list.css(this.lt))-k+"px"),this.list.css(this.wh,d.intval(this.list.css(this.wh))+k+"px"),e},remove:function(a){var b=this.get(a);if(b.length&&!(a>=this.first&&this.last>=a)){var c=this.dimension(b);this.first>a&&this.list.css(this.lt,d.intval(this.list.css(this.lt))+c+"px"),b.remove(),this.list.css(this.wh,d.intval(this.list.css(this.wh))-c+"px")}},next:function(){null===this.tail||this.inTail?this.scroll("both"!=this.options.wrap&&"last"!=this.options.wrap||null===this.options.size||this.last!=this.options.size?this.first+this.options.scroll:1):this.scrollTail(!1)},prev:function(){null!==this.tail&&this.inTail?this.scrollTail(!0):this.scroll("both"!=this.options.wrap&&"first"!=this.options.wrap||null===this.options.size||1!=this.first?this.first-this.options.scroll:this.options.size)},scrollTail:function(a){if(!this.locked&&!this.animating&&this.tail){this.pauseAuto();var b=d.intval(this.list.css(this.lt));b=a?b+this.tail:b-this.tail,this.inTail=!a,this.prevFirst=this.first,this.prevLast=this.last,this.animate(b)}},scroll:function(a,b){this.locked||this.animating||(this.pauseAuto(),this.animate(this.pos(a),b))},pos:function(a,b){var c=d.intval(this.list.css(this.lt));if(this.locked||this.animating)return c;"circular"!=this.options.wrap&&(a=1>a?1:this.options.size&&a>this.options.size?this.options.size:a);for(var m,e=this.first>a,f="circular"!=this.options.wrap&&1>=this.first?1:this.first,g=e?this.get(f):this.get(this.last),h=e?f:f-1,i=null,j=0,k=!1,l=0;e?--h>=a:a>++h;)i=this.get(h),k=!i.length,0===i.length&&(i=this.create(h).addClass(this.className("jcarousel-item-placeholder")),g[e?"before":"after"](i),null!==this.first&&"circular"==this.options.wrap&&null!==this.options.size&&(0>=h||h>this.options.size)&&(m=this.get(this.index(h)),m.length&&(i=this.add(h,m.clone(!0))))),g=i,l=this.dimension(i),k&&(j+=l),null!==this.first&&("circular"==this.options.wrap||h>=1&&(null===this.options.size||this.options.size>=h))&&(c=e?c+l:c-l);var n=this.clipping(),o=[],p=0,q=0;for(g=this.get(a-1),h=a;++p;){if(i=this.get(h),k=!i.length,0===i.length&&(i=this.create(h).addClass(this.className("jcarousel-item-placeholder")),0===g.length?this.list.prepend(i):g[e?"before":"after"](i),null!==this.first&&"circular"==this.options.wrap&&null!==this.options.size&&(0>=h||h>this.options.size)&&(m=this.get(this.index(h)),m.length&&(i=this.add(h,m.clone(!0))))),g=i,l=this.dimension(i),0===l)throw Error("jCarousel: No width/height set for items. This will cause an infinite loop. Aborting...");if("circular"!=this.options.wrap&&null!==this.options.size&&h>this.options.size?o.push(i):k&&(j+=l),q+=l,q>=n)break;h++}for(var r=0;o.length>r;r++)o[r].remove();j>0&&(this.list.css(this.wh,this.dimension(this.list)+j+"px"),e&&(c-=j,this.list.css(this.lt,d.intval(this.list.css(this.lt))-j+"px")));var s=a+p-1;if("circular"!=this.options.wrap&&this.options.size&&s>this.options.size&&(s=this.options.size),h>s)for(p=0,h=s,q=0;++p&&(i=this.get(h--),i.length)&&(q+=this.dimension(i),!(q>=n)););var t=s-p+1;if("circular"!=this.options.wrap&&1>t&&(t=1),this.inTail&&e&&(c+=this.tail,this.inTail=!1),this.tail=null,"circular"!=this.options.wrap&&s==this.options.size&&s-p+1>=1){var u=d.intval(this.get(s).css(this.options.vertical?"marginBottom":"marginRight"));q-u>n&&(this.tail=q-n-u)}for(b&&a===this.options.size&&this.tail&&(c-=this.tail,this.inTail=!0);a-->t;)c+=this.dimension(this.get(a));return this.prevFirst=this.first,this.prevLast=this.last,this.first=t,this.last=s,c},animate:function(b,c){if(!this.locked&&!this.animating){this.animating=!0;var d=this,e=function(){if(d.animating=!1,0===b&&d.list.css(d.lt,0),!d.autoStopped&&("circular"==d.options.wrap||"both"==d.options.wrap||"last"==d.options.wrap||null===d.options.size||d.last<d.options.size||d.last==d.options.size&&null!==d.tail&&!d.inTail)&&d.startAuto(),d.buttons(),d.notify("onAfterAnimation"),"circular"==d.options.wrap&&null!==d.options.size)for(var a=d.prevFirst;d.prevLast>=a;a++)null===a||a>=d.first&&d.last>=a||!(1>a||a>d.options.size)||d.remove(a)};if(this.notify("onBeforeAnimation"),this.options.animation&&c!==!1){var f=this.options.vertical?{top:b}:this.options.rtl?{right:b}:{left:b},g={duration:this.options.animation,easing:this.options.easing,complete:e};a.isFunction(this.options.animationStepCallback)&&(g.step=this.options.animationStepCallback),this.list.animate(f,g)}else this.list.css(this.lt,b+"px"),e()}},startAuto:function(a){if(void 0!==a&&(this.options.auto=a),0===this.options.auto)return this.stopAuto();if(null===this.timer){this.autoStopped=!1;var b=this;this.timer=window.setTimeout(function(){b.next()},1e3*this.options.auto)}},stopAuto:function(){this.pauseAuto(),this.autoStopped=!0},pauseAuto:function(){null!==this.timer&&(window.clearTimeout(this.timer),this.timer=null)},buttons:function(a,b){null==a&&(a=!this.locked&&0!==this.options.size&&(this.options.wrap&&"first"!=this.options.wrap||null===this.options.size||this.last<this.options.size),this.locked||this.options.wrap&&"first"!=this.options.wrap||null===this.options.size||!(this.last>=this.options.size)||(a=null!==this.tail&&!this.inTail)),null==b&&(b=!this.locked&&0!==this.options.size&&(this.options.wrap&&"last"!=this.options.wrap||this.first>1),this.locked||this.options.wrap&&"last"!=this.options.wrap||null===this.options.size||1!=this.first||(b=null!==this.tail&&this.inTail));var c=this;this.buttonNext.size()>0?(this.buttonNext.unbind(this.options.buttonNextEvent+".jcarousel",this.funcNext),a&&this.buttonNext.bind(this.options.buttonNextEvent+".jcarousel",this.funcNext),this.buttonNext[a?"removeClass":"addClass"](this.className("jcarousel-next-disabled")).attr("disabled",a?!1:!0),null!==this.options.buttonNextCallback&&this.buttonNext.data("jcarouselstate")!=a&&this.buttonNext.each(function(){c.options.buttonNextCallback(c,this,a)}).data("jcarouselstate",a)):null!==this.options.buttonNextCallback&&this.buttonNextState!=a&&this.options.buttonNextCallback(c,null,a),this.buttonPrev.size()>0?(this.buttonPrev.unbind(this.options.buttonPrevEvent+".jcarousel",this.funcPrev),b&&this.buttonPrev.bind(this.options.buttonPrevEvent+".jcarousel",this.funcPrev),this.buttonPrev[b?"removeClass":"addClass"](this.className("jcarousel-prev-disabled")).attr("disabled",b?!1:!0),null!==this.options.buttonPrevCallback&&this.buttonPrev.data("jcarouselstate")!=b&&this.buttonPrev.each(function(){c.options.buttonPrevCallback(c,this,b)}).data("jcarouselstate",b)):null!==this.options.buttonPrevCallback&&this.buttonPrevState!=b&&this.options.buttonPrevCallback(c,null,b),this.buttonNextState=a,this.buttonPrevState=b},notify:function(a){var b=null===this.prevFirst?"init":this.prevFirst<this.first?"next":"prev";this.callback("itemLoadCallback",a,b),this.prevFirst!==this.first&&(this.callback("itemFirstInCallback",a,b,this.first),this.callback("itemFirstOutCallback",a,b,this.prevFirst)),this.prevLast!==this.last&&(this.callback("itemLastInCallback",a,b,this.last),this.callback("itemLastOutCallback",a,b,this.prevLast)),this.callback("itemVisibleInCallback",a,b,this.first,this.last,this.prevFirst,this.prevLast),this.callback("itemVisibleOutCallback",a,b,this.prevFirst,this.prevLast,this.first,this.last)},callback:function(b,c,d,e,f,g,h){if(null!=this.options[b]&&("object"==typeof this.options[b]||"onAfterAnimation"==c)){var i="object"==typeof this.options[b]?this.options[b][c]:this.options[b];if(a.isFunction(i)){var j=this;if(void 0===e)i(j,d,c);else if(void 0===f)this.get(e).each(function(){i(j,this,e,d,c)});else for(var k=function(a){j.get(a).each(function(){i(j,this,a,d,c)})},l=e;f>=l;l++)null===l||l>=g&&h>=l||k(l)}}},create:function(a){return this.format("<li></li>",a)},format:function(b,c){b=a(b);for(var d=b.get(0).className.split(" "),e=0;d.length>e;e++)-1!=d[e].indexOf("jcarousel-")&&b.removeClass(d[e]);return b.addClass(this.className("jcarousel-item")).addClass(this.className("jcarousel-item-"+c)).css({"float":this.options.rtl?"right":"left","list-style":"none"}).attr("jcarouselindex",c),b},className:function(a){return a+" "+a+(this.options.vertical?"-vertical":"-horizontal")},dimension:function(b,c){var e=a(b);if(null==c)return this.options.vertical?e.innerHeight()+d.intval(e.css("margin-top"))+d.intval(e.css("margin-bottom"))+d.intval(e.css("border-top-width"))+d.intval(e.css("border-bottom-width"))||d.intval(this.options.itemFallbackDimension):e.innerWidth()+d.intval(e.css("margin-left"))+d.intval(e.css("margin-right"))+d.intval(e.css("border-left-width"))+d.intval(e.css("border-right-width"))||d.intval(this.options.itemFallbackDimension);var f=this.options.vertical?c-d.intval(e.css("marginTop"))-d.intval(e.css("marginBottom")):c-d.intval(e.css("marginLeft"))-d.intval(e.css("marginRight"));return a(e).css(this.wh,f+"px"),this.dimension(e)},clipping:function(){return this.options.vertical?this.clip[0].offsetHeight-d.intval(this.clip.css("borderTopWidth"))-d.intval(this.clip.css("borderBottomWidth")):this.clip[0].offsetWidth-d.intval(this.clip.css("borderLeftWidth"))-d.intval(this.clip.css("borderRightWidth"))},index:function(a,b){return null==b&&(b=this.options.size),Math.round(((a-1)/b-Math.floor((a-1)/b))*b)+1}}),d.extend({defaults:function(c){return a.extend(b,c||{})},intval:function(a){return a=parseInt(a,10),isNaN(a)?0:a},windowLoaded:function(){c=!0},isSafari:function(){var a=navigator.userAgent.toLowerCase(),b=/(chrome)[ \/]([\w.]+)/.exec(a)||/(webkit)[ \/]([\w.]+)/.exec(a)||[],c=b[1]||"";return"webkit"===c}}),a.fn.jcarousel=function(b){if("string"==typeof b){var c=a(this).data("jcarousel"),e=Array.prototype.slice.call(arguments,1);return c[b].apply(c,e)}return this.each(function(){var c=a(this).data("jcarousel");c?(b&&a.extend(c.options,b),c.reload()):a(this).data("jcarousel",new d(this,b))})}})(jQuery); 

//===========================================================================


(function(c){var b={init:function(e){var f={set_width:false,set_height:false,horizontalScroll:false,scrollInertia:950,mouseWheel:true,mouseWheelPixels:"auto",autoDraggerLength:true,autoHideScrollbar:false,snapAmount:null,snapOffset:0,scrollButtons:{enable:false,scrollType:"continuous",scrollSpeed:"auto",scrollAmount:40},advanced:{updateOnBrowserResize:true,updateOnContentResize:false,autoExpandHorizontalScroll:false,autoScrollOnFocus:true,normalizeMouseWheelDelta:false},contentTouchScroll:true,callbacks:{onScrollStart:function(){},onScroll:function(){},onTotalScroll:function(){},onTotalScrollBack:function(){},onTotalScrollOffset:0,onTotalScrollBackOffset:0,whileScrolling:function(){}},theme:"light"},e=c.extend(true,f,e);return this.each(function(){var m=c(this);if(e.set_width){m.css("width",e.set_width)}if(e.set_height){m.css("height",e.set_height)}if(!c(document).data("mCustomScrollbar-index")){c(document).data("mCustomScrollbar-index","1")}else{var t=parseInt(c(document).data("mCustomScrollbar-index"));c(document).data("mCustomScrollbar-index",t+1)}m.wrapInner("<div class='mCustomScrollBox mCS-"+e.theme+"' id='mCSB_"+c(document).data("mCustomScrollbar-index")+"' style='position:relative; height:100%; overflow:hidden; max-width:100%;' />").addClass("mCustomScrollbar _mCS_"+c(document).data("mCustomScrollbar-index"));var g=m.children(".mCustomScrollBox");if(e.horizontalScroll){g.addClass("mCSB_horizontal").wrapInner("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />");var k=g.children(".mCSB_h_wrapper");k.wrapInner("<div class='mCSB_container' style='position:absolute; left:0;' />").children(".mCSB_container").css({width:k.children().outerWidth(),position:"relative"}).unwrap()}else{g.wrapInner("<div class='mCSB_container' style='position:relative; top:0;' />")}var o=g.children(".mCSB_container");if(c.support.touch){o.addClass("mCS_touch")}o.after("<div class='mCSB_scrollTools' style='position:absolute;'><div class='mCSB_draggerContainer'><div class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' style='position:relative;'></div></div><div class='mCSB_draggerRail'></div></div></div>");var l=g.children(".mCSB_scrollTools"),h=l.children(".mCSB_draggerContainer"),q=h.children(".mCSB_dragger");if(e.horizontalScroll){q.data("minDraggerWidth",q.width())}else{q.data("minDraggerHeight",q.height())}if(e.scrollButtons.enable){if(e.horizontalScroll){l.prepend("<a class='mCSB_buttonLeft' oncontextmenu='return false;'></a>").append("<a class='mCSB_buttonRight' oncontextmenu='return false;'></a>")}else{l.prepend("<a class='mCSB_buttonUp' oncontextmenu='return false;'></a>").append("<a class='mCSB_buttonDown' oncontextmenu='return false;'></a>")}}g.bind("scroll",function(){if(!m.is(".mCS_disabled")){g.scrollTop(0).scrollLeft(0)}});m.data({mCS_Init:true,mCustomScrollbarIndex:c(document).data("mCustomScrollbar-index"),horizontalScroll:e.horizontalScroll,scrollInertia:e.scrollInertia,scrollEasing:"mcsEaseOut",mouseWheel:e.mouseWheel,mouseWheelPixels:e.mouseWheelPixels,autoDraggerLength:e.autoDraggerLength,autoHideScrollbar:e.autoHideScrollbar,snapAmount:e.snapAmount,snapOffset:e.snapOffset,scrollButtons_enable:e.scrollButtons.enable,scrollButtons_scrollType:e.scrollButtons.scrollType,scrollButtons_scrollSpeed:e.scrollButtons.scrollSpeed,scrollButtons_scrollAmount:e.scrollButtons.scrollAmount,autoExpandHorizontalScroll:e.advanced.autoExpandHorizontalScroll,autoScrollOnFocus:e.advanced.autoScrollOnFocus,normalizeMouseWheelDelta:e.advanced.normalizeMouseWheelDelta,contentTouchScroll:e.contentTouchScroll,onScrollStart_Callback:e.callbacks.onScrollStart,onScroll_Callback:e.callbacks.onScroll,onTotalScroll_Callback:e.callbacks.onTotalScroll,onTotalScrollBack_Callback:e.callbacks.onTotalScrollBack,onTotalScroll_Offset:e.callbacks.onTotalScrollOffset,onTotalScrollBack_Offset:e.callbacks.onTotalScrollBackOffset,whileScrolling_Callback:e.callbacks.whileScrolling,bindEvent_scrollbar_drag:false,bindEvent_content_touch:false,bindEvent_scrollbar_click:false,bindEvent_mousewheel:false,bindEvent_buttonsContinuous_y:false,bindEvent_buttonsContinuous_x:false,bindEvent_buttonsPixels_y:false,bindEvent_buttonsPixels_x:false,bindEvent_focusin:false,bindEvent_autoHideScrollbar:false,mCSB_buttonScrollRight:false,mCSB_buttonScrollLeft:false,mCSB_buttonScrollDown:false,mCSB_buttonScrollUp:false});if(e.horizontalScroll){if(m.css("max-width")!=="none"){if(!e.advanced.updateOnContentResize){e.advanced.updateOnContentResize=true}}}else{if(m.css("max-height")!=="none"){var s=false,r=parseInt(m.css("max-height"));if(m.css("max-height").indexOf("%")>=0){s=r,r=m.parent().height()*s/100}m.css("overflow","hidden");g.css("max-height",r)}}m.mCustomScrollbar("update");if(e.advanced.updateOnBrowserResize){var i,j=c(window).width(),u=c(window).height();c(window).bind("resize."+m.data("mCustomScrollbarIndex"),function(){if(i){clearTimeout(i)}i=setTimeout(function(){if(!m.is(".mCS_disabled")&&!m.is(".mCS_destroyed")){var w=c(window).width(),v=c(window).height();if(j!==w||u!==v){if(m.css("max-height")!=="none"&&s){g.css("max-height",m.parent().height()*s/100)}m.mCustomScrollbar("update");j=w;u=v}}},150)})}if(e.advanced.updateOnContentResize){var p;if(e.horizontalScroll){var n=o.outerWidth()}else{var n=o.outerHeight()}p=setInterval(function(){if(e.horizontalScroll){if(e.advanced.autoExpandHorizontalScroll){o.css({position:"absolute",width:"auto"}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({width:o.outerWidth(),position:"relative"}).unwrap()}var v=o.outerWidth()}else{var v=o.outerHeight()}if(v!=n){m.mCustomScrollbar("update");n=v}},300)}})},update:function(){var n=c(this),k=n.children(".mCustomScrollBox"),q=k.children(".mCSB_container");q.removeClass("mCS_no_scrollbar");n.removeClass("mCS_disabled mCS_destroyed");k.scrollTop(0).scrollLeft(0);var y=k.children(".mCSB_scrollTools"),o=y.children(".mCSB_draggerContainer"),m=o.children(".mCSB_dragger");if(n.data("horizontalScroll")){var A=y.children(".mCSB_buttonLeft"),t=y.children(".mCSB_buttonRight"),f=k.width();if(n.data("autoExpandHorizontalScroll")){q.css({position:"absolute",width:"auto"}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({width:q.outerWidth(),position:"relative"}).unwrap()}var z=q.outerWidth()}else{var w=y.children(".mCSB_buttonUp"),g=y.children(".mCSB_buttonDown"),r=k.height(),i=q.outerHeight()}if(i>r&&!n.data("horizontalScroll")){y.css("display","block");var s=o.height();if(n.data("autoDraggerLength")){var u=Math.round(r/i*s),l=m.data("minDraggerHeight");if(u<=l){m.css({height:l})}else{if(u>=s-10){var p=s-10;m.css({height:p})}else{m.css({height:u})}}m.children(".mCSB_dragger_bar").css({"line-height":m.height()+"px"})}var B=m.height(),x=(i-r)/(s-B);n.data("scrollAmount",x).mCustomScrollbar("scrolling",k,q,o,m,w,g,A,t);var D=Math.abs(q.position().top);n.mCustomScrollbar("scrollTo",D,{scrollInertia:0,trigger:"internal"})}else{if(z>f&&n.data("horizontalScroll")){y.css("display","block");var h=o.width();if(n.data("autoDraggerLength")){var j=Math.round(f/z*h),C=m.data("minDraggerWidth");if(j<=C){m.css({width:C})}else{if(j>=h-10){var e=h-10;m.css({width:e})}else{m.css({width:j})}}}var v=m.width(),x=(z-f)/(h-v);n.data("scrollAmount",x).mCustomScrollbar("scrolling",k,q,o,m,w,g,A,t);var D=Math.abs(q.position().left);n.mCustomScrollbar("scrollTo",D,{scrollInertia:0,trigger:"internal"})}else{k.unbind("mousewheel focusin");if(n.data("horizontalScroll")){m.add(q).css("left",0)}else{m.add(q).css("top",0)}y.css("display","none");q.addClass("mCS_no_scrollbar");n.data({bindEvent_mousewheel:false,bindEvent_focusin:false})}}},scrolling:function(h,p,m,j,w,e,A,v){var k=c(this);if(!k.data("bindEvent_scrollbar_drag")){var n,o;if(c.support.msPointer){j.bind("MSPointerDown",function(H){H.preventDefault();k.data({on_drag:true});j.addClass("mCSB_dragger_onDrag");var G=c(this),J=G.offset(),F=H.originalEvent.pageX-J.left,I=H.originalEvent.pageY-J.top;if(F<G.width()&&F>0&&I<G.height()&&I>0){n=I;o=F}});c(document).bind("MSPointerMove."+k.data("mCustomScrollbarIndex"),function(H){H.preventDefault();if(k.data("on_drag")){var G=j,J=G.offset(),F=H.originalEvent.pageX-J.left,I=H.originalEvent.pageY-J.top;D(n,o,I,F)}}).bind("MSPointerUp."+k.data("mCustomScrollbarIndex"),function(x){k.data({on_drag:false});j.removeClass("mCSB_dragger_onDrag")})}else{j.bind("mousedown touchstart",function(H){H.preventDefault();H.stopImmediatePropagation();var G=c(this),K=G.offset(),F,J;if(H.type==="touchstart"){var I=H.originalEvent.touches[0]||H.originalEvent.changedTouches[0];F=I.pageX-K.left;J=I.pageY-K.top}else{k.data({on_drag:true});j.addClass("mCSB_dragger_onDrag");F=H.pageX-K.left;J=H.pageY-K.top}if(F<G.width()&&F>0&&J<G.height()&&J>0){n=J;o=F}}).bind("touchmove",function(H){H.preventDefault();H.stopImmediatePropagation();var K=H.originalEvent.touches[0]||H.originalEvent.changedTouches[0],G=c(this),J=G.offset(),F=K.pageX-J.left,I=K.pageY-J.top;D(n,o,I,F)});c(document).bind("mousemove."+k.data("mCustomScrollbarIndex"),function(H){if(k.data("on_drag")){var G=j,J=G.offset(),F=H.pageX-J.left,I=H.pageY-J.top;D(n,o,I,F)}}).bind("mouseup."+k.data("mCustomScrollbarIndex"),function(x){k.data({on_drag:false});j.removeClass("mCSB_dragger_onDrag")})}k.data({bindEvent_scrollbar_drag:true})}function D(G,H,I,F){if(k.data("horizontalScroll")){k.mCustomScrollbar("scrollTo",(j.position().left-(H))+F,{moveDragger:true,trigger:"internal"})}else{k.mCustomScrollbar("scrollTo",(j.position().top-(G))+I,{moveDragger:true,trigger:"internal"})}}if(c.support.touch&&k.data("contentTouchScroll")){if(!k.data("bindEvent_content_touch")){var l,B,r,s,u,C,E;p.bind("touchstart",function(x){x.stopImmediatePropagation();l=x.originalEvent.touches[0]||x.originalEvent.changedTouches[0];B=c(this);r=B.offset();u=l.pageX-r.left;s=l.pageY-r.top;C=s;E=u});p.bind("touchmove",function(x){x.preventDefault();x.stopImmediatePropagation();l=x.originalEvent.touches[0]||x.originalEvent.changedTouches[0];B=c(this).parent();r=B.offset();u=l.pageX-r.left;s=l.pageY-r.top;if(k.data("horizontalScroll")){k.mCustomScrollbar("scrollTo",E-u,{trigger:"internal"})}else{k.mCustomScrollbar("scrollTo",C-s,{trigger:"internal"})}})}}if(!k.data("bindEvent_scrollbar_click")){m.bind("click",function(F){var x=(F.pageY-m.offset().top)*k.data("scrollAmount"),y=c(F.target);if(k.data("horizontalScroll")){x=(F.pageX-m.offset().left)*k.data("scrollAmount")}if(y.hasClass("mCSB_draggerContainer")||y.hasClass("mCSB_draggerRail")){k.mCustomScrollbar("scrollTo",x,{trigger:"internal",scrollEasing:"draggerRailEase"})}});k.data({bindEvent_scrollbar_click:true})}if(k.data("mouseWheel")){if(!k.data("bindEvent_mousewheel")){h.bind("mousewheel",function(H,J){var G,F=k.data("mouseWheelPixels"),x=Math.abs(p.position().top),I=j.position().top,y=m.height()-j.height();if(k.data("normalizeMouseWheelDelta")){if(J<0){J=-1}else{J=1}}if(F==="auto"){F=100+Math.round(k.data("scrollAmount")/2)}if(k.data("horizontalScroll")){I=j.position().left;y=m.width()-j.width();x=Math.abs(p.position().left)}if((J>0&&I!==0)||(J<0&&I!==y)){H.preventDefault();H.stopImmediatePropagation()}G=x-(J*F);k.mCustomScrollbar("scrollTo",G,{trigger:"internal"})});k.data({bindEvent_mousewheel:true})}}if(k.data("scrollButtons_enable")){if(k.data("scrollButtons_scrollType")==="pixels"){if(k.data("horizontalScroll")){v.add(A).unbind("mousedown touchstart MSPointerDown mouseup MSPointerUp mouseout MSPointerOut touchend",i,g);k.data({bindEvent_buttonsContinuous_x:false});if(!k.data("bindEvent_buttonsPixels_x")){v.bind("click",function(x){x.preventDefault();q(Math.abs(p.position().left)+k.data("scrollButtons_scrollAmount"))});A.bind("click",function(x){x.preventDefault();q(Math.abs(p.position().left)-k.data("scrollButtons_scrollAmount"))});k.data({bindEvent_buttonsPixels_x:true})}}else{e.add(w).unbind("mousedown touchstart MSPointerDown mouseup MSPointerUp mouseout MSPointerOut touchend",i,g);k.data({bindEvent_buttonsContinuous_y:false});if(!k.data("bindEvent_buttonsPixels_y")){e.bind("click",function(x){x.preventDefault();q(Math.abs(p.position().top)+k.data("scrollButtons_scrollAmount"))});w.bind("click",function(x){x.preventDefault();q(Math.abs(p.position().top)-k.data("scrollButtons_scrollAmount"))});k.data({bindEvent_buttonsPixels_y:true})}}function q(x){if(!j.data("preventAction")){j.data("preventAction",true);k.mCustomScrollbar("scrollTo",x,{trigger:"internal"})}}}else{if(k.data("horizontalScroll")){v.add(A).unbind("click");k.data({bindEvent_buttonsPixels_x:false});if(!k.data("bindEvent_buttonsContinuous_x")){v.bind("mousedown touchstart MSPointerDown",function(y){y.preventDefault();var x=z();k.data({mCSB_buttonScrollRight:setInterval(function(){k.mCustomScrollbar("scrollTo",Math.abs(p.position().left)+x,{trigger:"internal",scrollEasing:"easeOutCirc"})},17)})});var i=function(x){x.preventDefault();clearInterval(k.data("mCSB_buttonScrollRight"))};v.bind("mouseup touchend MSPointerUp mouseout MSPointerOut",i);A.bind("mousedown touchstart MSPointerDown",function(y){y.preventDefault();var x=z();k.data({mCSB_buttonScrollLeft:setInterval(function(){k.mCustomScrollbar("scrollTo",Math.abs(p.position().left)-x,{trigger:"internal",scrollEasing:"easeOutCirc"})},17)})});var g=function(x){x.preventDefault();clearInterval(k.data("mCSB_buttonScrollLeft"))};A.bind("mouseup touchend MSPointerUp mouseout MSPointerOut",g);k.data({bindEvent_buttonsContinuous_x:true})}}else{e.add(w).unbind("click");k.data({bindEvent_buttonsPixels_y:false});if(!k.data("bindEvent_buttonsContinuous_y")){e.bind("mousedown touchstart MSPointerDown",function(y){y.preventDefault();var x=z();k.data({mCSB_buttonScrollDown:setInterval(function(){k.mCustomScrollbar("scrollTo",Math.abs(p.position().top)+x,{trigger:"internal",scrollEasing:"easeOutCirc"})},17)})});var t=function(x){x.preventDefault();clearInterval(k.data("mCSB_buttonScrollDown"))};e.bind("mouseup touchend MSPointerUp mouseout MSPointerOut",t);w.bind("mousedown touchstart MSPointerDown",function(y){y.preventDefault();var x=z();k.data({mCSB_buttonScrollUp:setInterval(function(){k.mCustomScrollbar("scrollTo",Math.abs(p.position().top)-x,{trigger:"internal",scrollEasing:"easeOutCirc"})},17)})});var f=function(x){x.preventDefault();clearInterval(k.data("mCSB_buttonScrollUp"))};w.bind("mouseup touchend MSPointerUp mouseout MSPointerOut",f);k.data({bindEvent_buttonsContinuous_y:true})}}function z(){var x=k.data("scrollButtons_scrollSpeed");if(k.data("scrollButtons_scrollSpeed")==="auto"){x=Math.round((k.data("scrollInertia")+100)/40)}return x}}}if(k.data("autoScrollOnFocus")){if(!k.data("bindEvent_focusin")){h.bind("focusin",function(){h.scrollTop(0).scrollLeft(0);var x=c(document.activeElement);if(x.is("input,textarea,select,button,a[tabindex],area,object")){var G=p.position().top,y=x.position().top,F=h.height()-x.outerHeight();if(k.data("horizontalScroll")){G=p.position().left;y=x.position().left;F=h.width()-x.outerWidth()}if(G+y<0||G+y>F){k.mCustomScrollbar("scrollTo",y,{trigger:"internal"})}}});k.data({bindEvent_focusin:true})}}if(k.data("autoHideScrollbar")){if(!k.data("bindEvent_autoHideScrollbar")){h.bind("mouseenter",function(x){h.addClass("mCS-mouse-over");d.showScrollbar.call(h.children(".mCSB_scrollTools"))}).bind("mouseleave touchend",function(x){h.removeClass("mCS-mouse-over");if(x.type==="mouseleave"){d.hideScrollbar.call(h.children(".mCSB_scrollTools"))}});k.data({bindEvent_autoHideScrollbar:true})}}},scrollTo:function(e,f){var i=c(this),o={moveDragger:false,trigger:"external",callbacks:true,scrollInertia:i.data("scrollInertia"),scrollEasing:i.data("scrollEasing")},f=c.extend(o,f),p,g=i.children(".mCustomScrollBox"),k=g.children(".mCSB_container"),r=g.children(".mCSB_scrollTools"),j=r.children(".mCSB_draggerContainer"),h=j.children(".mCSB_dragger"),t=draggerSpeed=f.scrollInertia,q,s,m,l;if(!k.hasClass("mCS_no_scrollbar")){i.data({mCS_trigger:f.trigger});if(i.data("mCS_Init")){f.callbacks=false}if(e||e===0){if(typeof(e)==="number"){if(f.moveDragger){p=e;if(i.data("horizontalScroll")){e=h.position().left*i.data("scrollAmount")}else{e=h.position().top*i.data("scrollAmount")}draggerSpeed=0}else{p=e/i.data("scrollAmount")}}else{if(typeof(e)==="string"){var v;if(e==="top"){v=0}else{if(e==="bottom"&&!i.data("horizontalScroll")){v=k.outerHeight()-g.height()}else{if(e==="left"){v=0}else{if(e==="right"&&i.data("horizontalScroll")){v=k.outerWidth()-g.width()}else{if(e==="first"){v=i.find(".mCSB_container").find(":first")}else{if(e==="last"){v=i.find(".mCSB_container").find(":last")}else{v=i.find(e)}}}}}}if(v.length===1){if(i.data("horizontalScroll")){e=v.position().left}else{e=v.position().top}p=e/i.data("scrollAmount")}else{p=e=v}}}if(i.data("horizontalScroll")){if(i.data("onTotalScrollBack_Offset")){s=-i.data("onTotalScrollBack_Offset")}if(i.data("onTotalScroll_Offset")){l=g.width()-k.outerWidth()+i.data("onTotalScroll_Offset")}if(p<0){p=e=0;clearInterval(i.data("mCSB_buttonScrollLeft"));if(!s){q=true}}else{if(p>=j.width()-h.width()){p=j.width()-h.width();e=g.width()-k.outerWidth();clearInterval(i.data("mCSB_buttonScrollRight"));if(!l){m=true}}else{e=-e}}var n=i.data("snapAmount");if(n){e=Math.round(e/n)*n-i.data("snapOffset")}d.mTweenAxis.call(this,h[0],"left",Math.round(p),draggerSpeed,f.scrollEasing);d.mTweenAxis.call(this,k[0],"left",Math.round(e),t,f.scrollEasing,{onStart:function(){if(f.callbacks&&!i.data("mCS_tweenRunning")){u("onScrollStart")}if(i.data("autoHideScrollbar")){d.showScrollbar.call(r)}},onUpdate:function(){if(f.callbacks){u("whileScrolling")}},onComplete:function(){if(f.callbacks){u("onScroll");if(q||(s&&k.position().left>=s)){u("onTotalScrollBack")}if(m||(l&&k.position().left<=l)){u("onTotalScroll")}}h.data("preventAction",false);i.data("mCS_tweenRunning",false);if(i.data("autoHideScrollbar")){if(!g.hasClass("mCS-mouse-over")){d.hideScrollbar.call(r)}}}})}else{if(i.data("onTotalScrollBack_Offset")){s=-i.data("onTotalScrollBack_Offset")}if(i.data("onTotalScroll_Offset")){l=g.height()-k.outerHeight()+i.data("onTotalScroll_Offset")}if(p<0){p=e=0;clearInterval(i.data("mCSB_buttonScrollUp"));if(!s){q=true}}else{if(p>=j.height()-h.height()){p=j.height()-h.height();e=g.height()-k.outerHeight();clearInterval(i.data("mCSB_buttonScrollDown"));if(!l){m=true}}else{e=-e}}var n=i.data("snapAmount");if(n){e=Math.round(e/n)*n-i.data("snapOffset")}d.mTweenAxis.call(this,h[0],"top",Math.round(p),draggerSpeed,f.scrollEasing);d.mTweenAxis.call(this,k[0],"top",Math.round(e),t,f.scrollEasing,{onStart:function(){if(f.callbacks&&!i.data("mCS_tweenRunning")){u("onScrollStart")}if(i.data("autoHideScrollbar")){d.showScrollbar.call(r)}},onUpdate:function(){if(f.callbacks){u("whileScrolling")}},onComplete:function(){if(f.callbacks){u("onScroll");if(q||(s&&k.position().top>=s)){u("onTotalScrollBack")}if(m||(l&&k.position().top<=l)){u("onTotalScroll")}}h.data("preventAction",false);i.data("mCS_tweenRunning",false);if(i.data("autoHideScrollbar")){if(!g.hasClass("mCS-mouse-over")){d.hideScrollbar.call(r)}}}})}if(i.data("mCS_Init")){i.data({mCS_Init:false})}}}function u(w){this.mcs={top:k.position().top,left:k.position().left,draggerTop:h.position().top,draggerLeft:h.position().left,topPct:Math.round((100*Math.abs(k.position().top))/Math.abs(k.outerHeight()-g.height())),leftPct:Math.round((100*Math.abs(k.position().left))/Math.abs(k.outerWidth()-g.width()))};switch(w){case"onScrollStart":i.data("mCS_tweenRunning",true).data("onScrollStart_Callback").call(i,this.mcs);break;case"whileScrolling":i.data("whileScrolling_Callback").call(i,this.mcs);break;case"onScroll":i.data("onScroll_Callback").call(i,this.mcs);break;case"onTotalScrollBack":i.data("onTotalScrollBack_Callback").call(i,this.mcs);break;case"onTotalScroll":i.data("onTotalScroll_Callback").call(i,this.mcs);break}}},stop:function(){var g=c(this),e=g.children().children(".mCSB_container"),f=g.children().children().children().children(".mCSB_dragger");d.mTweenAxisStop.call(this,e[0]);d.mTweenAxisStop.call(this,f[0])},disable:function(e){var j=c(this),f=j.children(".mCustomScrollBox"),h=f.children(".mCSB_container"),g=f.children(".mCSB_scrollTools"),i=g.children().children(".mCSB_dragger");f.unbind("mousewheel focusin mouseenter mouseleave touchend");h.unbind("touchstart touchmove");if(e){if(j.data("horizontalScroll")){i.add(h).css("left",0)}else{i.add(h).css("top",0)}}g.css("display","none");h.addClass("mCS_no_scrollbar");j.data({bindEvent_mousewheel:false,bindEvent_focusin:false,bindEvent_content_touch:false,bindEvent_autoHideScrollbar:false}).addClass("mCS_disabled")},destroy:function(){var e=c(this);e.removeClass("mCustomScrollbar _mCS_"+e.data("mCustomScrollbarIndex")).addClass("mCS_destroyed").children().children(".mCSB_container").unwrap().children().unwrap().siblings(".mCSB_scrollTools").remove();c(document).unbind("mousemove."+e.data("mCustomScrollbarIndex")+" mouseup."+e.data("mCustomScrollbarIndex")+" MSPointerMove."+e.data("mCustomScrollbarIndex")+" MSPointerUp."+e.data("mCustomScrollbarIndex"));c(window).unbind("resize."+e.data("mCustomScrollbarIndex"))}},d={showScrollbar:function(){this.stop().animate({opacity:1},"fast")},hideScrollbar:function(){this.stop().animate({opacity:0},"fast")},mTweenAxis:function(g,i,h,f,o,y){var y=y||{},v=y.onStart||function(){},p=y.onUpdate||function(){},w=y.onComplete||function(){};var n=t(),l,j=0,r=g.offsetTop,s=g.style;if(i==="left"){r=g.offsetLeft}var m=h-r;q();e();function t(){if(window.performance&&window.performance.now){return window.performance.now()}else{if(window.performance&&window.performance.webkitNow){return window.performance.webkitNow()}else{if(Date.now){return Date.now()}else{return new Date().getTime()}}}}function x(){if(!j){v.call()}j=t()-n;u();if(j>=g._time){g._time=(j>g._time)?j+l-(j-g._time):j+l-1;if(g._time<j+1){g._time=j+1}}if(g._time<f){g._id=_request(x)}else{w.call()}}function u(){if(f>0){g.currVal=k(g._time,r,m,f,o);s[i]=Math.round(g.currVal)+"px"}else{s[i]=h+"px"}p.call()}function e(){l=1000/60;g._time=j+l;_request=(!window.requestAnimationFrame)?function(z){u();return setTimeout(z,0.01)}:window.requestAnimationFrame;g._id=_request(x)}function q(){if(g._id==null){return}if(!window.requestAnimationFrame){clearTimeout(g._id)}else{window.cancelAnimationFrame(g._id)}g._id=null}function k(B,A,F,E,C){switch(C){case"linear":return F*B/E+A;break;case"easeOutQuad":B/=E;return -F*B*(B-2)+A;break;case"easeInOutQuad":B/=E/2;if(B<1){return F/2*B*B+A}B--;return -F/2*(B*(B-2)-1)+A;break;case"easeOutCubic":B/=E;B--;return F*(B*B*B+1)+A;break;case"easeOutQuart":B/=E;B--;return -F*(B*B*B*B-1)+A;break;case"easeOutQuint":B/=E;B--;return F*(B*B*B*B*B+1)+A;break;case"easeOutCirc":B/=E;B--;return F*Math.sqrt(1-B*B)+A;break;case"easeOutSine":return F*Math.sin(B/E*(Math.PI/2))+A;break;case"easeOutExpo":return F*(-Math.pow(2,-10*B/E)+1)+A;break;case"mcsEaseOut":var D=(B/=E)*B,z=D*B;return A+F*(0.499999999999997*z*D+-2.5*D*D+5.5*z+-6.5*D+4*B);break;case"draggerRailEase":B/=E/2;if(B<1){return F/2*B*B*B+A}B-=2;return F/2*(B*B*B+2)+A;break}}},mTweenAxisStop:function(e){if(e._id==null){return}if(!window.requestAnimationFrame){clearTimeout(e._id)}else{window.cancelAnimationFrame(e._id)}e._id=null},rafPolyfill:function(){var f=["ms","moz","webkit","o"],e=f.length;while(--e>-1&&!window.requestAnimationFrame){window.requestAnimationFrame=window[f[e]+"RequestAnimationFrame"];window.cancelAnimationFrame=window[f[e]+"CancelAnimationFrame"]||window[f[e]+"CancelRequestAnimationFrame"]}}};d.rafPolyfill.call();c.support.touch=!!("ontouchstart" in window);c.support.msPointer=window.navigator.msPointerEnabled;var a=("https:"==document.location.protocol)?"https:":"http:";c.event.special.mousewheel||document.write('<script src="'+a+'//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.0.6/jquery.mousewheel.min.js"><\/script>');c.fn.mCustomScrollbar=function(e){if(b[e]){return b[e].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof e==="object"||!e){return b.init.apply(this,arguments)}else{c.error("Method "+e+" does not exist")}}}})(jQuery);

//===========================================================================


/*!
 * iCheck v0.9.1 jQuery plugin, http://git.io/uhUPMA
 */
(function(f){function C(a,c,d){var b=a[0],e=/er/.test(d)?k:/bl/.test(d)?u:j;active=d==E?{checked:b[j],disabled:b[u],indeterminate:"true"==a.attr(k)||"false"==a.attr(v)}:b[e];if(/^(ch|di|in)/.test(d)&&!active)p(a,e);else if(/^(un|en|de)/.test(d)&&active)w(a,e);else if(d==E)for(var e in active)active[e]?p(a,e,!0):w(a,e,!0);else if(!c||"toggle"==d){if(!c)a[r]("ifClicked");active?b[l]!==x&&w(a,e):p(a,e)}}function p(a,c,d){var b=a[0],e=a.parent(),g=c==j,H=c==k,m=H?v:g?I:"enabled",r=h(b,m+y(b[l])),L=h(b,
c+y(b[l]));if(!0!==b[c]){if(!d&&c==j&&b[l]==x&&b.name){var p=a.closest("form"),s='input[name="'+b.name+'"]',s=p.length?p.find(s):f(s);s.each(function(){this!==b&&f.data(this,n)&&w(f(this),c)})}H?(b[c]=!0,b[j]&&w(a,j,"force")):(d||(b[c]=!0),g&&b[k]&&w(a,k,!1));J(a,g,c,d)}b[u]&&h(b,z,!0)&&e.find("."+F).css(z,"default");e[t](L||h(b,c));e[A](r||h(b,m)||"")}function w(a,c,d){var b=a[0],e=a.parent(),g=c==j,f=c==k,m=f?v:g?I:"enabled",n=h(b,m+y(b[l])),p=h(b,c+y(b[l]));if(!1!==b[c]){if(f||!d||"force"==d)b[c]=
!1;J(a,g,m,d)}!b[u]&&h(b,z,!0)&&e.find("."+F).css(z,"pointer");e[A](p||h(b,c)||"");e[t](n||h(b,m))}function K(a,c){if(f.data(a,n)){var d=f(a);d.parent().html(d.attr("style",f.data(a,n).s||"")[r](c||""));d.off(".i").unwrap();f(D+'[for="'+a.id+'"]').add(d.closest(D)).off(".i")}}function h(a,c,d){if(f.data(a,n))return f.data(a,n).o[c+(d?"":"Class")]}function y(a){return a.charAt(0).toUpperCase()+a.slice(1)}function J(a,c,d,b){if(!b){if(c)a[r]("ifToggled");a[r]("ifChanged")[r]("if"+y(d))}}var n="iCheck",
F=n+"-helper",x="radio",j="checked",I="un"+j,u="disabled",v="determinate",k="in"+v,E="update",l="type",t="addClass",A="removeClass",r="trigger",D="label",z="cursor",G=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini/i.test(navigator.userAgent);f.fn[n]=function(a,c){var d=":checkbox, :"+x,b=f(),e=function(a){a.each(function(){var a=f(this);b=a.is(d)?b.add(a):b.add(a.find(d))})};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(a))return a=a.toLowerCase(),
e(this),b.each(function(){"destroy"==a?K(this,"ifDestroyed"):C(f(this),!0,a);f.isFunction(c)&&c()});if("object"==typeof a||!a){var g=f.extend({checkedClass:j,disabledClass:u,indeterminateClass:k,labelHover:!0},a),h=g.handle,m=g.hoverClass||"hover",y=g.focusClass||"focus",v=g.activeClass||"active",z=!!g.labelHover,s=g.labelHoverClass||"hover",B=(""+g.increaseArea).replace("%","")|0;if("checkbox"==h||h==x)d=":"+h;-50>B&&(B=-50);e(this);return b.each(function(){K(this);var a=f(this),b=this,c=b.id,d=
-B+"%",e=100+2*B+"%",e={position:"absolute",top:d,left:d,display:"block",width:e,height:e,margin:0,padding:0,background:"#fff",border:0,opacity:0},d=G?{position:"absolute",visibility:"hidden"}:B?e:{position:"absolute",opacity:0},h="checkbox"==b[l]?g.checkboxClass||"icheckbox":g.radioClass||"i"+x,k=f(D+'[for="'+c+'"]').add(a.closest(D)),q=a.wrap('<div class="'+h+'"/>')[r]("ifCreated").parent().append(g.insert),e=f('<ins class="'+F+'"/>').css(e).appendTo(q);a.data(n,{o:g,s:a.attr("style")}).css(d);
g.inheritClass&&q[t](b.className);g.inheritID&&c&&q.attr("id",n+"-"+c);"static"==q.css("position")&&q.css("position","relative");C(a,!0,E);if(k.length)k.on("click.i mouseenter.i mouseleave.i touchbegin.i touchend.i",function(c){var d=c[l],e=f(this);if(!b[u])if("click"==d?C(a,!1,!0):z&&(/ve|nd/.test(d)?(q[A](m),e[A](s)):(q[t](m),e[t](s))),G)c.stopPropagation();else return!1});a.on("click.i focus.i blur.i keyup.i keydown.i keypress.i",function(c){var d=c[l];c=c.keyCode;if("click"==d)return!1;if("keydown"==
d&&32==c)return b[l]==x&&b[j]||(b[j]?w(a,j):p(a,j)),!1;if("keyup"==d&&b[l]==x)!b[j]&&p(a,j);else if(/us|ur/.test(d))q["blur"==d?A:t](y)});e.on("click mousedown mouseup mouseover mouseout touchbegin.i touchend.i",function(d){var c=d[l],e=/wn|up/.test(c)?v:m;if(!b[u]){if("click"==c)C(a,!1,!0);else{if(/wn|er|in/.test(c))q[t](e);else q[A](e+" "+v);if(k.length&&z&&e==m)k[/ut|nd/.test(c)?A:t](s)}if(G)d.stopPropagation();else return!1}})})}return this}})(jQuery);

//===========================================================================



(function(c){"function"===typeof module?module.exports=c(this.jQuery||require("jquery")):"function"===typeof define&&define.amd?define(["jquery"],function(f){return c(f)}):this.NProgress=c(this.jQuery)})(function(c){function f(b,a,d){return b<a?a:b>d?d:b}function h(b,a,c){b="translate3d"===d.positionUsing?{transform:"translate3d("+100*(-1+b)+"%,0,0)"}:"translate"===d.positionUsing?{transform:"translate("+100*(-1+b)+"%,0)"}:{"margin-left":100*(-1+b)+"%"};b.transition="all "+a+"ms "+c;return b}var a=
{version:"0.1.2"},d=a.settings={minimum:0.08,easing:"ease",positionUsing:"",speed:200,trickle:!0,trickleRate:0.02,trickleSpeed:800,showSpinner:!0,parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};a.configure=function(b){c.extend(d,b);return this};a.status=null;a.set=function(b){var e=a.isStarted();b=f(b,d.minimum,1);a.status=1===b?null:b;var c=a.render(!e),k=c.find('[role="bar"]'),g=d.speed,
l=d.easing;c[0].offsetWidth;c.queue(function(e){""===d.positionUsing&&(d.positionUsing=a.getPositioningCSS());k.css(h(b,g,l));1===b?(c.css({transition:"none",opacity:1}),c[0].offsetWidth,setTimeout(function(){c.css({transition:"all "+g+"ms linear",opacity:0});setTimeout(function(){a.remove();e()},g)},g)):setTimeout(e,g)});return this};a.isStarted=function(){return"number"===typeof a.status};a.start=function(){a.status||a.set(0);var b=function(){setTimeout(function(){a.status&&(a.trickle(),b())},d.trickleSpeed)};
d.trickle&&b();return this};a.done=function(b){return b||a.status?a.inc(0.3+0.5*Math.random()).set(1):this};a.inc=function(b){var c=a.status;return c?("number"!==typeof b&&(b=(1-c)*f(Math.random()*c,0.1,0.95)),c=f(c+b,0,0.994),a.set(c)):a.start()};a.trickle=function(){return a.inc(Math.random()*d.trickleRate)};a.render=function(b){if(a.isRendered())return c("#nprogress");c("html").addClass("nprogress-busy");var e=c("<div id='nprogress'>").html(d.template);b=b?"-100":100*(-1+(a.status||0));e.find('[role="bar"]').css({transition:"all 0 linear",
transform:"translate3d("+b+"%,0,0)"});d.showSpinner||e.find('[role="spinner"]').remove();c(d.parent).addClass("nprogress-parent").append(e);return e};a.remove=function(){c(d.parent).removeClass("nprogress-parent");c("html").removeClass("nprogress-busy");c("#nprogress").remove()};a.isRendered=function(){return 0<c("#nprogress").length};a.getPositioningCSS=function(){var b=document.body.style,a="WebkitTransform"in b?"Webkit":"MozTransform"in b?"Moz":"msTransform"in b?"ms":"OTransform"in b?"O":"";return a+
"Perspective"in b?"translate3d":a+"Transform"in b?"translate":"margin"};return a});

//===========================================================================



// Ion.RangeSlider
// version 1.8.5 Build: 159
// © 2013 Denis Ineshin | IonDen.com
//
// Project page:    http://ionden.com/a/plugins/ion.rangeSlider/
// GitHub page:     https://github.com/IonDen/ion.rangeSlider
//
// Released under MIT licence:
// http://ionden.com/a/plugins/licence-en.html
// =====================================================================================================================

(function ($, document, window, navigator) {
    "use strict";

    var pluginCount = 0;
    var isOldie = (function () {
        var n = navigator.userAgent,
            r = /msie\s\d+/i,
            v;
        if (n.search(r) > 0) {
            v = r.exec(n).toString();
            v = v.split(" ")[1];
            if (v < 9) {
                return true;
            }
        }
        return false;
    }());
    var isTouch = (function () {
        try {
            document.createEvent("TouchEvent");
            return true;
        } catch (e) {
            return false;
        }
    }());

    var methods = {
        init: function (options) {

            // irs = ion range slider css prefix
            var baseHTML =
                '<span class="irs">' +
                '<span class="irs-line"><span class="irs-line-left"></span><span class="irs-line-mid"></span><span class="irs-line-right"></span></span>' +
                '<span class="irs-min">0</span><span class="irs-max">1</span>' +
                '<span class="irs-from">0</span><span class="irs-to">0</span><span class="irs-single">0</span>' +
                '</span>' +
                '<span class="irs-grid"></span>';

            var singleHTML =
                '<span class="irs-slider single"></span>';

            var doubleHTML =
                '<span class="irs-diapason"></span>' +
                '<span class="irs-slider from"></span>' +
                '<span class="irs-slider to"></span>';

            var disableHTML =
                '<span class="irs-disable-mask"></span>';



            return this.each(function () {
                var settings = $.extend({
                    min: null,
                    max: null,
                    from: null,
                    to: null,
                    type: "single",
                    step: 1,
                    prefix: "",
                    postfix: "",
                    hasGrid: false,
                    hideMinMax: false,
                    hideFromTo: false,
                    prettify: true,
                    disable: false,
                    onChange: null,
                    onLoad: null,
                    onFinish: null
                }, options);



                var slider = $(this),
                    self = this,
                    value_array = null;

                if (slider.data("isActive")) {
                    return;
                }
                slider.data("isActive", true);

                pluginCount += 1;
                this.pluginCount = pluginCount;



                // check default values
                if (slider.prop("value")) {
                    value_array = slider.prop("value").split(";");
                }

                if (settings.type === "single") {

                    if (value_array && value_array.length > 1) {

                        if (typeof settings.min !== "number") {
                            settings.min = parseFloat(value_array[0]);
                        } else {
                            if (typeof settings.from !== "number") {
                                settings.from = parseFloat(value_array[0]);
                            }
                        }

                        if (typeof settings.max !== "number") {
                            settings.max = parseFloat(value_array[1]);
                        }

                    } else if (value_array && value_array.length === 1) {

                        if (typeof settings.from !== "number") {
                            settings.from = parseFloat(value_array[0]);
                        }

                    }

                } else if (settings.type === "double") {

                    if (value_array && value_array.length > 1) {

                        if (typeof settings.min !== "number") {
                            settings.min = parseFloat(value_array[0]);
                        } else {
                            if (typeof settings.from !== "number") {
                                settings.from = parseFloat(value_array[0]);
                            }
                        }

                        if (typeof settings.max !== "number") {
                            settings.max = parseFloat(value_array[1]);
                        } else {
                            if (typeof settings.to !== "number") {
                                settings.to = parseFloat(value_array[1]);
                            }
                        }

                    } else if (value_array && value_array.length === 1) {

                        if (typeof settings.min !== "number") {
                            settings.min = parseFloat(value_array[0]);
                        } else {
                            if (typeof settings.from !== "number") {
                                settings.from = parseFloat(value_array[0]);
                            }
                        }

                    }

                }


                // Set Min and Max if no
                if (typeof settings.min !== "number") {
                    settings.min = 10;
                }
                if (typeof settings.max !== "number") {
                    settings.max = 100;
                }


                // Set From and To if no
                if (typeof settings.from !== "number") {
                    settings.from = settings.min;
                }
                if (typeof settings.to !== "number") {
                    settings.to = settings.max;
                }


                // extend from data-*
                if (typeof slider.data("min") === "number") {
                    settings.min = parseFloat(slider.data("min"));
                }
                if (typeof slider.data("max") === "number") {
                    settings.max = parseFloat(slider.data("max"));
                }
                if (typeof slider.data("from") === "number") {
                    settings.from = parseFloat(slider.data("from"));
                }
                if (typeof slider.data("to") === "number") {
                    settings.to = parseFloat(slider.data("to"));
                }
                if (slider.data("step")) {
                    settings.step = parseFloat(slider.data("step"));
                }
                if (slider.data("type")) {
                    settings.type = slider.data("type");
                }
                if (slider.data("prefix")) {
                    settings.prefix = slider.data("prefix");
                }
                if (slider.data("postfix")) {
                    settings.postfix = slider.data("postfix");
                }
                if (slider.data("hasgrid")) {
                    settings.hasGrid = slider.data("hasgrid");
                }
                if (slider.data("hideminmax")) {
                    settings.hideMinMax = slider.data("hideminmax");
                }
                if (slider.data("hidefromto")) {
                    settings.hideFromTo = slider.data("hidefromto");
                }
                if (slider.data("prettify")) {
                    settings.prettify = slider.data("prettify");
                }


                // fix diapason
                if (settings.from < settings.min) {
                    settings.from = settings.min;
                }
                if (settings.to > settings.max) {
                    settings.to = settings.max;
                }
                if (settings.type === "double") {
                    if (settings.from > settings.to) {
                        settings.from = settings.to;
                    }
                    if (settings.to < settings.from) {
                        settings.to = settings.from;
                    }
                }


                var prettify = function (num) {
                    var n = num.toString();
                    if (settings.prettify) {
                        n = n.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g, "$1 ");
                    }
                    return n;
                };


                var containerHTML = '<span class="irs" id="irs-' + this.pluginCount + '"></span>';
                slider[0].style.display = "none";
                slider.before(containerHTML);

                var $container = slider.prev(),
                    $body = $(document.body),
                    $window = $(window),
                    $rangeSlider,
                    $fieldMin,
                    $fieldMax,
                    $fieldFrom,
                    $fieldTo,
                    $fieldSingle,
                    $singleSlider,
                    $fromSlider,
                    $toSlider,
                    $activeSlider,
                    $diapason,
                    $grid;

                var allowDrag = false,
                    sliderIsActive = false,
                    firstStart = true,
                    numbers = {};

                var mouseX = 0,
                    fieldMinWidth = 0,
                    fieldMaxWidth = 0,
                    normalWidth = 0,
                    fullWidth = 0,
                    sliderWidth = 0,
                    width = 0,
                    left = 0,
                    right = 0,
                    minusX = 0,
                    stepFloat = 0;


                if (parseInt(settings.step, 10) !== parseFloat(settings.step)) {
                    stepFloat = settings.step.toString().split(".")[1];
                    stepFloat = Math.pow(10, stepFloat.length);
                }



                // public methods
                this.updateData = function (options) {
                    firstStart = true;
                    settings = $.extend(settings, options);
                    removeHTML();
                };
                this.removeSlider = function () {
                    $container.find("*").off();
                    $window.off("mouseup.irs" + self.pluginCount);
                    $body.off("mouseup.irs" + self.pluginCount);
                    $body.off("mousemove.irs" + self.pluginCount);
                    $container.html("").remove();
                    slider.data("isActive", false);
                    slider.show();
                };





                // private methods
                var removeHTML = function () {
                    $container.find("*").off();
                    $window.off("mouseup.irs" + self.pluginCount);
                    $body.off("mouseup.irs" + self.pluginCount);
                    $body.off("mousemove.irs" + self.pluginCount);
                    $container.html("");

                    placeHTML();
                };
                var placeHTML = function () {
                    $container.html(baseHTML);
                    $rangeSlider = $container.find(".irs");

                    $fieldMin = $rangeSlider.find(".irs-min");
                    $fieldMax = $rangeSlider.find(".irs-max");
                    $fieldFrom = $rangeSlider.find(".irs-from");
                    $fieldTo = $rangeSlider.find(".irs-to");
                    $fieldSingle = $rangeSlider.find(".irs-single");
                    $grid = $container.find(".irs-grid");

                    if (settings.hideMinMax) {
                        $fieldMin[0].style.display = "none";
                        $fieldMax[0].style.display = "none";

                        fieldMinWidth = 0;
                        fieldMaxWidth = 0;
                    }
                    if (settings.hideFromTo) {
                        $fieldFrom[0].style.display = "none";
                        $fieldTo[0].style.display = "none";
                        $fieldSingle[0].style.display = "none";
                    }
                    if (!settings.hideMinMax) {
                        $fieldMin.html(settings.prefix + prettify(settings.min) + settings.postfix);
                        $fieldMax.html(settings.prefix + prettify(settings.max) + settings.postfix);

                        fieldMinWidth = $fieldMin.outerWidth();
                        fieldMaxWidth = $fieldMax.outerWidth();
                    }

                    if (settings.type === "single") {
                        $rangeSlider.append(singleHTML);

                        $singleSlider = $rangeSlider.find(".single");

                        $singleSlider.on("mousedown", function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            calcDimensions(e, $(this), null);

                            allowDrag = true;
                            sliderIsActive = true;

                            if (isOldie) {
                                $("*").prop("unselectable", true);
                            }
                        });
                        if (isTouch) {
                            $singleSlider.on("touchstart", function (e) {
                                e.preventDefault();
                                e.stopPropagation();

                                calcDimensions(e.originalEvent.touches[0], $(this), null);

                                allowDrag = true;
                                sliderIsActive = true;
                            });
                        }

                    } else if (settings.type === "double") {
                        $rangeSlider.append(doubleHTML);

                        $fromSlider = $rangeSlider.find(".from");
                        $toSlider = $rangeSlider.find(".to");
                        $diapason = $rangeSlider.find(".irs-diapason");

                        setDiapason();

                        $fromSlider.on("mousedown", function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            $(this).addClass("last");
                            $toSlider.removeClass("last");
                            calcDimensions(e, $(this), "from");
                            allowDrag = true;
                            sliderIsActive = true;

                            if (isOldie) {
                                $("*").prop("unselectable", true);
                            }
                        });
                        $toSlider.on("mousedown", function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            $(this).addClass("last");
                            $fromSlider.removeClass("last");
                            calcDimensions(e, $(this), "to");
                            allowDrag = true;
                            sliderIsActive = true;

                            if (isOldie) {
                                $("*").prop("unselectable", true);
                            }
                        });

                        if (isTouch) {
                            $fromSlider.on("touchstart", function (e) {
                                e.preventDefault();
                                e.stopPropagation();

                                $(this).addClass("last");
                                $toSlider.removeClass("last");
                                calcDimensions(e.originalEvent.touches[0], $(this), "from");
                                allowDrag = true;
                                sliderIsActive = true;
                            });
                            $toSlider.on("touchstart", function (e) {
                                e.preventDefault();
                                e.stopPropagation();

                                $(this).addClass("last");
                                $fromSlider.removeClass("last");
                                calcDimensions(e.originalEvent.touches[0], $(this), "to");
                                allowDrag = true;
                                sliderIsActive = true;
                            });
                        }

                        if (settings.to === settings.max) {
                            $fromSlider.addClass("last");
                        }
                    }

                    var mouseup = function () {
                        if (allowDrag) {
                            sliderIsActive = false;
                            allowDrag = false;
                            $activeSlider.removeAttr("id");
                            $activeSlider = null;
                            if (settings.type === "double") {
                                setDiapason();
                            }
                            getNumbers();

                            if (isOldie) {
                                $("*").prop("unselectable", false);
                            }
                        }
                    };
                    $body.on("mouseup.irs" + self.pluginCount, function () {
                        mouseup();
                    });
                    $window.on("mouseup.irs" + self.pluginCount, function () {
                        mouseup();
                    });


                    $body.on("mousemove.irs" + self.pluginCount, function (e) {
                        if (allowDrag) {
                            mouseX = e.pageX;
                            dragSlider();
                        }
                    });

                    $container.on("mouseup", function (e) {
                        if (allowDrag || settings.disable) {
                            return;
                        }

                        moveByClick(e.pageX);
                    });

                    if (isTouch) {
                        $window.on("touchend", function () {
                            if (allowDrag) {
                                sliderIsActive = false;
                                allowDrag = false;
                                $activeSlider.removeAttr("id");
                                $activeSlider = null;
                                if (settings.type === "double") {
                                    setDiapason();
                                }
                                getNumbers();
                            }
                        });
                        $window.on("touchmove", function (e) {
                            if (allowDrag) {
                                mouseX = e.originalEvent.touches[0].pageX;
                                dragSlider();
                            }
                        });
                    }

                    getSize();
                    setNumbers();
                    if (settings.hasGrid) {
                        setGrid();
                    }
                    if (settings.disable) {
                        setMask();
                    }
                };

                var getSize = function () {
                    normalWidth = $rangeSlider.width();
                    if ($singleSlider) {
                        sliderWidth = $singleSlider.width();
                    } else {
                        sliderWidth = $fromSlider.width();
                    }
                    fullWidth = normalWidth - sliderWidth;
                };

                var calcDimensions = function (e, currentSlider, whichSlider) {
                    getSize();

                    firstStart = false;
                    $activeSlider = currentSlider;
                    $activeSlider.attr("id", "irs-active-slider");

                    var _x1 = $activeSlider.offset().left,
                        _x2 = e.pageX - _x1;
                    minusX = _x1 + _x2 - $activeSlider.position().left;

                    if (settings.type === "single") {

                        width = $rangeSlider.width() - sliderWidth;

                    } else if (settings.type === "double") {

                        if (whichSlider === "from") {
                            left = 0;
                            right = parseInt($toSlider.css("left"), 10);
                        } else {
                            left = parseInt($fromSlider.css("left"), 10);
                            right = $rangeSlider.width() - sliderWidth;
                        }

                    }
                };

                var setDiapason = function () {
                    var _w = $fromSlider.width(),
                        _x = $.data($fromSlider[0], "x") || parseInt($fromSlider[0].style.left, 10) || $fromSlider.position().left,
                        _width = $.data($toSlider[0], "x") || parseInt($toSlider[0].style.left, 10) || $toSlider.position().left,
                        x = _x + (_w / 2),
                        w = _width - _x;
                    $diapason[0].style.left = x + "px";
                    $diapason[0].style.width = w + "px";
                };

                var dragSlider = function (manual_x) {
                    var x_pure = mouseX - minusX,
                        x;

                    if (manual_x) {
                        x_pure = manual_x;
                    } else {
                        x_pure = mouseX - minusX;
                    }

                    if (settings.type === "single") {

                        if (x_pure < 0) {
                            x_pure = 0;
                        }
                        if (x_pure > width) {
                            x_pure = width;
                        }

                    } else if (settings.type === "double") {

                        if (x_pure < left) {
                            x_pure = left;
                        }
                        if (x_pure > right) {
                            x_pure = right;
                        }
                        setDiapason();

                    }

                    $.data($activeSlider[0], "x", x_pure);
                    getNumbers();

                    x = Math.round(x_pure);
                    $activeSlider[0].style.left = x + "px";
                };

                var getNumbers = function () {
                    var nums = {
                        input: slider,
                        slider: $container,
                        fromNumber: 0,
                        toNumber: 0,
                        fromPers: 0,
                        toPers: 0,
                        fromX: 0,
                        toX: 0
                    };
                    var diapason = settings.max - settings.min, _from, _to;

                    if (settings.type === "single") {

                        nums.fromX = $.data($singleSlider[0], "x") || parseInt($singleSlider[0].style.left, 10) || $singleSlider.position().left;
                        nums.fromPers = nums.fromX / fullWidth * 100;
                        _from = (diapason / 100 * nums.fromPers) + settings.min;
                        nums.fromNumber = Math.round(_from / settings.step) * settings.step;
                        if (nums.fromNumber < settings.min) {
                            nums.fromNumber = settings.min;
                        }
                        if (nums.fromNumber > settings.max) {
                            nums.fromNumber = settings.max;
                        }

                        if (stepFloat) {
                            nums.fromNumber = parseInt(nums.fromNumber * stepFloat, 10) / stepFloat;
                        }

                    } else if (settings.type === "double") {


                        nums.fromX = $.data($fromSlider[0], "x") || parseInt($fromSlider[0].style.left, 10) || $fromSlider.position().left;
                        nums.fromPers = nums.fromX / fullWidth * 100;
                        _from = (diapason / 100 * nums.fromPers) + settings.min;
                        nums.fromNumber = Math.round(_from / settings.step) * settings.step;
                        if (nums.fromNumber < settings.min) {
                            nums.fromNumber = settings.min;
                        }

                        nums.toX = $.data($toSlider[0], "x") || parseInt($toSlider[0].style.left, 10) || $toSlider.position().left;
                        nums.toPers = nums.toX / fullWidth * 100;
                        _to = (diapason / 100 * nums.toPers) + settings.min;
                        nums.toNumber = Math.round(_to / settings.step) * settings.step;
                        if (nums.toNumber > settings.max) {
                            nums.toNumber = settings.max;
                        }

                        if (stepFloat) {
                            nums.fromNumber = parseInt(nums.fromNumber * stepFloat, 10) / stepFloat;
                            nums.toNumber = parseInt(nums.toNumber * stepFloat, 10) / stepFloat;
                        }

                    }

                    numbers = nums;
                    setFields();
                };

                var setNumbers = function () {
                    var nums = {
                        input: slider,
                        slider: $container,
                        fromNumber: settings.from,
                        toNumber: settings.to,
                        fromPers: 0,
                        toPers: 0,
                        fromX: 0,
                        fromX_pure: 0,
                        toX: 0,
                        toX_pure: 0
                    };
                    var diapason = settings.max - settings.min;

                    if (settings.type === "single") {

                        nums.fromPers = (nums.fromNumber - settings.min) / diapason * 100;
                        nums.fromX_pure = fullWidth / 100 * nums.fromPers;
                        nums.fromX = Math.round(nums.fromX_pure);
                        $singleSlider[0].style.left = nums.fromX + "px";
                        $.data($singleSlider[0], "x", nums.fromX_pure);

                    } else if (settings.type === "double") {

                        nums.fromPers = (nums.fromNumber - settings.min) / diapason * 100;
                        nums.fromX_pure = fullWidth / 100 * nums.fromPers;
                        nums.fromX = Math.round(nums.fromX_pure);
                        $fromSlider[0].style.left = nums.fromX + "px";
                        $.data($fromSlider[0], "x", nums.fromX_pure);

                        nums.toPers = (nums.toNumber - settings.min) / diapason * 100;
                        nums.toX_pure = fullWidth / 100 * nums.toPers;
                        nums.toX = Math.round(nums.toX_pure);
                        $toSlider[0].style.left = nums.toX + "px";
                        $.data($toSlider[0], "x", nums.toX_pure);

                        setDiapason();

                    }

                    numbers = nums;
                    setFields();
                };

                var moveByClick = function (page_x) {
                    var x = page_x - $container.offset().left,
                        d = numbers.toX - numbers.fromX,
                        zero_point = numbers.fromX + (d / 2);

                    left = 0;
                    width = $rangeSlider.width() - sliderWidth;
                    right = $rangeSlider.width() - sliderWidth;

                    if (settings.type === "single") {
                        $activeSlider = $singleSlider;
                        $activeSlider.attr("id", "irs-active-slider");
                        dragSlider(x);
                    } else if (settings.type === "double") {
                        if (x <= zero_point) {
                            $activeSlider = $fromSlider;
                        } else {
                            $activeSlider = $toSlider;
                        }
                        $activeSlider.attr("id", "irs-active-slider");
                        dragSlider(x);
                        setDiapason();
                    }

                    $activeSlider.removeAttr("id");
                    $activeSlider = null;
                };

                var setFields = function () {
                    var _from, _fromW, _fromX,
                        _to, _toW, _toX,
                        _single, _singleW, _singleX,
                        _slW = (sliderWidth / 2);

                    if (settings.type === "single") {

                        if (!settings.hideText) {
                            $fieldFrom[0].style.display = "none";
                            $fieldTo[0].style.display = "none";

                            _single = settings.prefix +
                                prettify(numbers.fromNumber) +
                                settings.postfix;
                            $fieldSingle.html(_single);

                            _singleW = $fieldSingle.outerWidth();
                            _singleX = numbers.fromX - (_singleW / 2) + _slW;
                            if (_singleX < 0) {
                                _singleX = 0;
                            }
                            if (_singleX > normalWidth - _singleW) {
                                _singleX = normalWidth - _singleW;
                            }
                            $fieldSingle[0].style.left = _singleX + "px";

                            if (!settings.hideMinMax && !settings.hideFromTo) {
                                if (_singleX < fieldMinWidth) {
                                    $fieldMin[0].style.display = "none";
                                } else {
                                    $fieldMin[0].style.display = "block";
                                }

                                if (_singleX + _singleW > normalWidth - fieldMaxWidth) {
                                    $fieldMax[0].style.display = "none";
                                } else {
                                    $fieldMax[0].style.display = "block";
                                }
                            }
                        }

                        slider.attr("value", parseFloat(numbers.fromNumber));

                    } else if (settings.type === "double") {

                        if (!settings.hideText) {
                            _from = settings.prefix +
                                prettify(numbers.fromNumber) +
                                settings.postfix;
                            _to = settings.prefix +
                                prettify(numbers.toNumber) +
                                settings.postfix;

                            if (numbers.fromNumber !== numbers.toNumber) {
                                _single = settings.prefix +
                                    prettify(numbers.fromNumber) +
                                    " — " + settings.prefix +
                                    prettify(numbers.toNumber) +
                                    settings.postfix;
                            } else {
                                _single = settings.prefix +
                                    prettify(numbers.fromNumber) +
                                    settings.postfix;
                            }

                            $fieldFrom.html(_from);
                            $fieldTo.html(_to);
                            $fieldSingle.html(_single);

                            _fromW = $fieldFrom.outerWidth();
                            _fromX = numbers.fromX - (_fromW / 2) + _slW;
                            if (_fromX < 0) {
                                _fromX = 0;
                            }
                            if (_fromX > normalWidth - _fromW) {
                                _fromX = normalWidth - _fromW;
                            }
                            $fieldFrom[0].style.left = _fromX + "px";

                            _toW = $fieldTo.outerWidth();
                            _toX = numbers.toX - (_toW / 2) + _slW;
                            if (_toX < 0) {
                                _toX = 0;
                            }
                            if (_toX > normalWidth - _toW) {
                                _toX = normalWidth - _toW;
                            }
                            $fieldTo[0].style.left = _toX + "px";

                            _singleW = $fieldSingle.outerWidth();
                            _singleX = numbers.fromX + ((numbers.toX - numbers.fromX) / 2) - (_singleW / 2) + _slW;
                            if (_singleX < 0) {
                                _singleX = 0;
                            }
                            if (_singleX > normalWidth - _singleW) {
                                _singleX = normalWidth - _singleW;
                            }
                            $fieldSingle[0].style.left = _singleX + "px";

                            if (_fromX + _fromW < _toX) {
                                $fieldSingle[0].style.display = "none";
                                $fieldFrom[0].style.display = "block";
                                $fieldTo[0].style.display = "block";
                            } else {
                                $fieldSingle[0].style.display = "block";
                                $fieldFrom[0].style.display = "none";
                                $fieldTo[0].style.display = "none";
                            }

                            if (!settings.hideMinMax && !settings.hideFromTo) {
                                if (_singleX < fieldMinWidth || _fromX < fieldMinWidth) {
                                    $fieldMin[0].style.display = "none";
                                } else {
                                    $fieldMin[0].style.display = "block";
                                }

                                if (_singleX + _singleW > normalWidth - fieldMaxWidth || _toX + _toW > normalWidth - fieldMaxWidth) {
                                    $fieldMax[0].style.display = "none";
                                } else {
                                    $fieldMax[0].style.display = "block";
                                }
                            }
                        }

                        slider.attr("value", parseFloat(numbers.fromNumber) + ";" + parseFloat(numbers.toNumber));

                    }

                    // trigger onChange function
                    if (typeof settings.onChange === "function") {
                        settings.onChange.call(this, numbers);
                    }

                    // trigger onFinish function
                    if (typeof settings.onFinish === "function" && !sliderIsActive && !firstStart) {
                        settings.onFinish.call(this, numbers);
                    }

                    // trigger onLoad function
                    if (typeof settings.onLoad === "function" && !sliderIsActive && firstStart) {
                        settings.onLoad.call(this, numbers);
                    }
                };

                var setGrid = function () {
                    $container.addClass("irs-with-grid");

                    var i,
                        text = '',
                        step = 0,
                        tStep = 0,
                        gridHTML = '',
                        smNum = 20,
                        bigNum = 4;

                    for (i = 0; i <= smNum; i += 1) {
                        step = Math.floor(normalWidth / smNum * i);

                        if (step >= normalWidth) {
                            step = normalWidth - 1;
                        }
                        gridHTML += '<span class="irs-grid-pol small" style="left: ' + step + 'px;"></span>';
                    }
                    for (i = 0; i <= bigNum; i += 1) {
                        step = Math.floor(normalWidth / bigNum * i);

                        if (step >= normalWidth) {
                            step = normalWidth - 1;
                        }
                        gridHTML += '<span class="irs-grid-pol" style="left: ' + step + 'px;"></span>';

                        if (stepFloat) {
                            text = (settings.min + ((settings.max - settings.min) / bigNum * i));
                            text = (text / settings.step) * settings.step;
                            text = parseInt(text * stepFloat, 10) / stepFloat;
                        } else {
                            text = Math.round(settings.min + ((settings.max - settings.min) / bigNum * i));
                            text = Math.round(text / settings.step) * settings.step;
                            text = prettify(text);
                        }

                        if (i === 0) {
                            tStep = step;
                            gridHTML += '<span class="irs-grid-text" style="left: ' + tStep + 'px; text-align: left;">' + text + '</span>';
                        } else if (i === bigNum) {
                            tStep = step - 100;
                            gridHTML += '<span class="irs-grid-text" style="left: ' + tStep + 'px; text-align: right;">' + text + '</span>';
                        } else {
                            tStep = step - 50;
                            gridHTML += '<span class="irs-grid-text" style="left: ' + tStep + 'px;">' + text + '</span>';
                        }
                    }

                    $grid.html(gridHTML);
                };

                var setMask = function () {
                    $container.addClass("irs-disabled");
                    $container.append(disableHTML);
                };

                placeHTML();
            });
        },
        update: function (options) {
            return this.each(function () {
                this.updateData(options);
            });
        },
        remove: function () {
            return this.each(function () {
                this.removeSlider();
            });
        }
    };

    $.fn.ionRangeSlider = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist for jQuery.ionRangeSlider');
        }
    };

}(jQuery, document, window, navigator));

//===========================================================================



/* @Version 2.6.0 */

//=======================//
//==== Map functions ====//
//=======================//
	
	var carousel_map_zoom = progress_map_vars.carousel_map_zoom;
	
	/**
	 * Load map options
	 *
	 * @light_map, Declare the light map in order to use the apropriate options for this type of map.
	 * @latLng, The center point of the map.
	 * @zoom, The default zoom of the map.
	 *
	 */
	
	function cspm_load_map_options(light_map, latLng, zoom){
		
		var latlng = (latLng != null) ? latLng.split(',') : progress_map_vars.center.split(',');
		
		var zoom_value = (zoom != null) ? parseInt(zoom) : parseInt(progress_map_vars.zoom)
		
		var default_options = {
			center:[latlng[0], latlng[1]],
			zoom: zoom_value,			
			scrollwheel: eval(progress_map_vars.scrollwheel),
			panControl: eval(progress_map_vars.panControl),	
			panControlOptions: {
				position: google.maps.ControlPosition.RIGHT_TOP  
			},					
			mapTypeControl: eval(progress_map_vars.mapTypeControl),
			mapTypeControlOptions: {
				position: google.maps.ControlPosition.TOP_RIGHT,
				mapTypeIds: [google.maps.MapTypeId.ROADMAP,
							 google.maps.MapTypeId.SATELLITE,
							 google.maps.MapTypeId.TERRAIN,
							 google.maps.MapTypeId.HYBRID]				
			},
			streetViewControl: eval(progress_map_vars.streetViewControl),	
			streetViewControlOptions: {
				position: google.maps.ControlPosition.RIGHT_TOP  
			},	
		};
		
		if(progress_map_vars.zoomControl == 'true' && progress_map_vars.zoomControlType == 'default'){
			
			var zoom_options = {
				zoomControl: true,
				zoomControlOptions:{
					style: google.maps.ZoomControlStyle.SMALL 
				},
			};
		
		}else{
			var zoom_options = {
				zoomControl: false,
			};
		}
		
		var map_options = jQuery.extend({}, default_options, zoom_options);
		
		return map_options;
		
	}					
	
	// Set the initial map style
	// @since 2.4
	function cspm_initial_map_style(map_style, custom_style_status){
			
		if(map_style == 'custom_style' && custom_style_status == false)
			var map_type_id = {mapTypeId: google.maps.MapTypeId.ROADMAP};
		
		else if(map_style == 'custom_style')
			var map_type_id = {mapTypeId: "custom_style"};
			
		else if(map_style == 'ROADMAP')
			var map_type_id = {mapTypeId: google.maps.MapTypeId.ROADMAP};
			
		else if(map_style == 'SATELLITE')
			var map_type_id = {mapTypeId: google.maps.MapTypeId.SATELLITE};
			
		else if(map_style == 'TERRAIN')				
			var map_type_id = {mapTypeId: google.maps.MapTypeId.TERRAIN};
			
		else if(map_style == 'HYBRID')				
			var map_type_id = {mapTypeId: google.maps.MapTypeId.HYBRID};
		
		return map_type_id;
		
	}
	
	var post_ids_and_categories = {};
	var post_lat_lng_coords = {};
	var post_ids_and_child_status = {}

	// Create pins
	// @Since 2.5	
	function cspm_new_pin_object(i, post_id, lat, lng, post_categories, map_id, marker_img, marker_size, is_child){
		
		post_lat_lng_coords[map_id][post_id] = lat+'_'+lng;
	
		// Create an object of that post_id and its categories/status for the faceted search
		post_ids_and_categories[map_id]['post_id_'+post_id+''] = {};
		post_ids_and_child_status[map_id][lat+'_'+lng] = is_child;
		
		// Get the current post categories	
		var post_category_ids = (post_categories != '') ? post_categories.split(',') : '';
		
		// Collect an object of all posts in the map and their categories
		// Useful for the faceted search & the search form
		post_ids_and_categories[map_id]['post_id_'+post_id+''][0] = post_category_ids;
		
		// By default the marker image is the default Google map red marker
		var marker_icon = '';
		
		// If the selected marker is the customized type
		if(progress_map_vars.defaultMarker == 'customize'){
			
			// Get the custom marker image
			// If the marker categories option is set to TRUE, the marker image will be the uploaded marker category image
			// If the marker categories option is set to FALSE, the marker image will be the default custom image provided by the plugin
			var marker_cat_img = marker_img;
			
			// Add retina support
			if(progress_map_vars.retinaSupport == "true"){
			
				var marker_img_width = marker_size.split('x')[0]/2;
				var marker_img_height = marker_size.split('x')[1]/2;
								
				marker_icon = new google.maps.MarkerImage(marker_cat_img, null, null, null, new google.maps.Size(marker_img_width,marker_img_height));					
			
			}else marker_icon = new google.maps.MarkerImage(marker_cat_img);
			
		}		
		
		return pin_object = {latLng: [lat, lng], tag: 'post_id__'+post_id+'', id: post_id+'_'+is_child, options:{ optimized: false, icon: marker_icon, id: post_id, post_id: post_id, is_child: is_child}};										
	
	}
	

	/**
	 * Create pins
	 * @Deprecated since 2.5
	 * Use cspm_new_pin_object() instead
	 */
	function cspm_new_pin($this, i, post_id, lat, lng, post_url, marker_img, items_title, items_details, light_map, static_map, post_categories, map_id, marker_size){

		var plugin_map = $this;
		
		var post_category_ids = '';

		if(progress_map_vars.retinaSupport == "true"){
			
			var marker_img_width = marker_size.split('x')[0]/2;
			var marker_img_height = marker_size.split('x')[1]/2;
			
		}
		
		post_lat_lng_coords[map_id][post_id] = lat+'_'+lng;
	
		// Create an object of post_ids and their categories for the faceted search
		post_ids_and_categories[map_id]['post_id_'+post_id+''] = {};
			
		var post_category_ids = (post_categories != '') ? post_categories.split(',') : '';
		
		post_ids_and_categories[map_id]['post_id_'+post_id+''][0] = post_category_ids;

		if(progress_map_vars.marker_cats_settings == 'true' && progress_map_vars.count_marker_categories > 0){

			var marker_cat_img = progress_map_vars.marker_categories['marker_category_'+post_category_ids[0]+''];
			
			if(marker_cat_img != '' && marker_cat_img != null){
				
				// Add retina support
				if(progress_map_vars.retinaSupport == "true")			
					var marker_icon = new google.maps.MarkerImage(marker_cat_img, null, null, null, new google.maps.Size(marker_img_width,marker_img_height));					
				else var marker_icon = new google.maps.MarkerImage(marker_cat_img);
				
			}else{
				
				// Add retina support
				if(progress_map_vars.retinaSupport == "true")
					var marker_icon = (progress_map_vars.defaultMarker == 'customize') ? new google.maps.MarkerImage(progress_map_vars.marker_icon, null, null, null, new google.maps.Size(marker_img_width,marker_img_height)) : '';
				else var marker_icon = (progress_map_vars.defaultMarker == 'customize') ? new google.maps.MarkerImage(progress_map_vars.marker_icon) : '';
				
			}

		}else{
				
			// Add retina support
			if(progress_map_vars.retinaSupport == "true")				
				var marker_icon = (progress_map_vars.defaultMarker == 'customize') ? new google.maps.MarkerImage(progress_map_vars.marker_icon, null, null, null, new google.maps.Size(marker_img_width,marker_img_height)) : '';
			else var marker_icon = (progress_map_vars.defaultMarker == 'customize') ? new google.maps.MarkerImage(progress_map_vars.marker_icon) : '';
				
		}
		
		plugin_map.gmap3({ 
		 marker:{
			latLng: [lat, lng],
			tag: 'post_id__'+post_id+'',
			options:{
				optimized: false,
				icon: marker_icon,
				id: post_id,
				item_title: items_title,
				item_img: marker_img,
				item_url: post_url,
			},			
			callback: function(marker){												

				if (progress_map_vars.retinaSupport == "true") {	marker.setOptions({	 optimized: false	});}

				// Create carousel items
				if(!light_map && progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
				
					var output = '';
					
					if(progress_map_vars.items_view == "listview"){ 
					
						item_width = parseInt(progress_map_vars.horizontal_item_width);										
						item_height = parseInt(progress_map_vars.horizontal_item_height);
						item_css = progress_map_vars.horizontal_item_css;
						items_background  = progress_map_vars.items_background;
						
						// Horizontal view
					
						output += '<li id="'+map_id+'_list_items_'+post_id+'" class="'+post_id+' carousel_item_'+i+'_'+map_id+'" name="'+lat+'_'+lng+'" value="'+i+'" style="width:'+item_width+'px; height:'+item_height+'px; background-color:'+items_background+'; margin:4px 3px; '+item_css+'">';
							output += '<div class="cspm_spinner"></div>';							
						output += '</li>';
					
					}else if(progress_map_vars.items_view == "gridview"){ 
					
						item_width = parseInt(progress_map_vars.vertical_item_width);
						item_height = parseInt(progress_map_vars.vertical_item_height);
						item_css = progress_map_vars.vertical_item_css;
						items_background  = progress_map_vars.items_background;
						
						// Vertical view
						
						output += '<li id="'+map_id+'_list_items_'+post_id+'" class="'+post_id+' carousel_item_'+i+'_'+map_id+'" name="'+lat+'_'+lng+'" value="'+i+'" style="width:'+item_width+'px; height:'+item_height+'px; background-color:'+items_background+'; margin:4px 3px; '+item_css+'">';
							output += '<div class="cspm_spinner"></div>';
						output += '</li>';
					
					}
					
					// Add item content to the carousel
					jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').append(output);
					
				}						
				
			},
			// marker events
			events:{
				mouseover: function(marker){	
					
					// Call active overlay style			
					jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
					jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');	
					
					// Call carousel item active style
					if(!light_map && progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
						
						cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), i);
						cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id+'', map_id);
					
					}
				
				},
				mouseout: function(marker){	
				
					// Remove overlay item style
					jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
					jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');	

				},
				// Click event is used only for content infowindow style
				click: function(marker){
					
					// first, hide all infowindows
					jQuery('div.infoWindowOverlay').hide();
						
					// Then show the current infowindow
					jQuery('div#infowindow_'+i+'_'+map_id+'').show();																
					
					// Center the map on that marker
					var latLng = new google.maps.LatLng(lat, lng);							
					var map = plugin_map.gmap3("get");														
					map.panTo(latLng);
					map.setCenter(latLng);	
					
					// Call custom scroll bar for infowindow
					jQuery("div.infoWindowOverlayTopRight p").mCustomScrollbar("destroy");
					jQuery("div.infoWindowOverlayTopRight p").mCustomScrollbar({
						autoHideScrollbar:true,
						theme:"dark-thin"
					});										
																			
				}
			}
		  },
		  overlay: cspm_create_marker_overlay(plugin_map, post_id, i, lat, lng, post_url, marker_img, items_title, items_details, light_map, static_map, map_id),		  

		});
						
	}
	
	/**
	 * Create overlay
	 * @Deprecated since 2.5
	 */
	function cspm_create_marker_overlay(plugin_map, post_id, i, lat, lng, post_url, marker_img, items_title, items_details, light_map, static_map, map_id){
				
		var overlay = { latLng: [lat, lng] };
		
		if( progress_map_vars.show_infowindow == 'true' ){
		  
			var overlay = {
			
				latLng: [lat, lng],
			
				options: cspm_overlay_content_options(post_id, i, lat, lng, post_url, marker_img, items_title, items_details, static_map, map_id),
				
				callback: function(overlay){
					
				},
				
				// Overlay event
				events:{
					mouseover: function(overlay){	
												
						// Call active overlay style																				
						jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
						jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');

						// Call carousel item active style	
						if(!light_map && progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
							
							cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), i);
							cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id+'', map_id);
							
						}
												
					},
					mouseout: function(overlay){
								
						// Remove overlay active event									
						jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
						jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');		
						
					},
					// Click event used only for content infowindow style
					click: function(overlay){
						
						// Hide current infowindow
						jQuery('div.infoWindowOverlayClose').click(function(){
							jQuery('div.infoWindowOverlay').hide();
						});

					}
				}
			
			}
		  
		}
		
		return overlay;
		
	}
	
	/**
	 * Create overlay options
	 * @Deprecated since 2.5
	 */
	function cspm_overlay_content_options(post_id, i, lat, lng, post_url, marker_img, items_title, items_details, static_map, map_id){

		// Content style overlay
		if( !static_map && progress_map_vars.infowindow_type == 'content_style' ){
			
			var overlay_options = {
				
				// Content infowindow (content style)
				content: '<div id="infowindow_'+i+'_'+map_id+'" name="'+i+'" value="" class="infoWindowOverlay overlay_'+i+'">'+
							'<div class="infoWindowOverlayTop">'+
								'<div class="infoWindowOverlayTopLeft">'+
									'<div class="InfoWindowOverlayImgHolder">'+
										'<div class="infoWindowOverlayImg" style="background:#fff url('+marker_img+') no-repeat;"></div>'+
									'</div>'+
									'<div class="infoWindowOverlayClose"></div>'+
								'</div>'+
								'<div class="infoWindowOverlayTopRight">'+
									'<p><a href="'+post_url+'">'+items_title+'</a><br />'+
									items_details+'</p>'+
								'</div>'+
							'</div>'+
							'<div>'+
								'<div class="infoWindowOverlayArrow"></div>'+
							'</div>'+
						'</div>',
						
				offset:{
					x: parseInt(progress_map_vars.content_overlay_horizontal_pos),
					y: parseInt(progress_map_vars.content_overlay_vertical_pos)
				}
				
			};
				
		// Bubble style overlay
			
		}else if( !static_map && progress_map_vars.infowindow_type == 'bubble_style' ){
			
			var blank = (progress_map_vars.bubble_external_link == 'true') ? 'target="_blank"' : '';
			var link_text = (progress_map_vars.bubble_link_text != '') ? '<div class="pin_overlay_content"><a title="'+items_title+'" href="'+post_url+'" '+blank+'>'+progress_map_vars.bubble_link_text+'</a></div>' : '';
			
			var overlay_options = {
					
				// Rounded infowindow (bubble style)
				content: '<div id="bubble_'+post_id+'_'+map_id+'" class="marker_holder overlay_'+i+'" name="'+i+'">'+
							'<div class="pin_overlay img-'+i+'">'+
								'<div class="pin_overlay_img" style="background-image: url('+marker_img+');">'+
									link_text+									
								'</div>'+
							'</div>'+							
						 '</div>',		
													
				offset:{
					x: parseInt(progress_map_vars.bubble_horizontal_pos),
					y: parseInt(progress_map_vars.bubble_vertical_pos)
				}
			
			};
			
		}else if( static_map ){
			
			var overlay_options = {
					
				// Rounded infowindow (bubble style)
				content: '<div id="bubble_'+post_id+'" class="marker_holder img_map_holder overlay_'+i+'" name="'+i+'">'+
							'<div class="pin_overlay img-'+i+'">'+
								'<div class="pin_overlay_img" style="background-image: url('+marker_img+');">'+
									'<div class="pin_overlay_content">'+
										'<a href="'+post_url+'"><u>More</u></a>'+
									'</div>'+
								'</div>'+
							'</div>'+
						 '</div>',
													
				offset:{
					x:4,
					y:-80
				}
			
			};
			
		}
		
		return overlay_options;
	
	}

	// Clustering markers
	function cspm_clustering(plugin_map, map_id, light_map){

		var markerCluster;
		
		var mapObject = plugin_map.gmap3('get');
	
		small_cluster_size = progress_map_vars.small_cluster_size;
		medium_cluster_size = progress_map_vars.medium_cluster_size
		big_cluster_size = progress_map_vars.big_cluster_size;

		plugin_map.gmap3({
			get: {
				name: 'marker',
				all: true,
				callback: function(objs){
					markerCluster = new MarkerClusterer(mapObject, objs, {
						gridSize: parseInt(progress_map_vars.grid_size),
						styles: [{
									url: progress_map_vars.small_cluster_icon,
									height: small_cluster_size.split('x')[0],
									width: small_cluster_size.split('x')[1],
									textColor: progress_map_vars.cluster_text_color,
									textSize: 11,
									fontWeight: 'normal',
									fontFamily: 'sans-serif'
								}, {
									url: progress_map_vars.medium_cluster_icon,
									height: medium_cluster_size.split('x')[0],
									width: medium_cluster_size.split('x')[1],
									textColor: progress_map_vars.cluster_text_color,
									textSize: 13,	
									fontWeight: 'normal',								
									fontFamily: 'sans-serif'
								}, {
									url: progress_map_vars.big_cluster_icon,
									height: big_cluster_size.split('x')[0],
									width: big_cluster_size.split('x')[1],
									textColor: progress_map_vars.cluster_text_color,
									textSize: 15,		
									fontWeight: 'normal',							
									fontFamily: 'sans-serif'
								}],
						zoomOnClick: true,	
						ignoreHidden: true,	
					});					
						
					/**
					 * On load, Hide and show overlays depending on markers positions
					 * @Deprecated since 2.5		 		
					 ***********************/
					 setTimeout(function() {
						cspm_remove_overlays(markerCluster.getClusters(), map_id);
						cspm_load_overlays(plugin_map, map_id);	
					 }, 1000);				
					 /***********************
					 */
					
					/**
					 * On zoom changed, Hide and show overlays depending on markers positions	
					 * @Deprecated since 2.5		 		
					 ***********************/
					 google.maps.event.addListener(mapObject, 'zoom_changed', function() {				
						setTimeout(function() {
							cspm_remove_overlays(markerCluster.getClusters(), map_id);
							cspm_load_overlays(plugin_map, map_id);							
						}, 1000);
					 });
					 /***********************
					 */
					
					/**
					 * On zoom changed, Hide and show overlays depending on markers positions
					 * @Deprecated since 2.5		 		
					 ***********************/
					 google.maps.event.addListener(mapObject, 'center_changed', function() {				
						setTimeout(function() {
							if(progress_map_vars.infowindow_type != 'content_style'){
								cspm_remove_overlays(markerCluster.getClusters(), map_id);
								cspm_load_overlays(plugin_map, map_id);	
							}
							jQuery('div[class^=cluster_posts_widget]').removeClass('flipInX');
							jQuery('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
						}, 1000);
					 });
					 /***********************
					 */
					
					var cluster_xhr;
					 
					// On cluster click, Hide and show overlays depending on markers positions	
					google.maps.event.addListener(markerCluster, 'clusterclick', function(cluster) {
						
						// Get cluster position and convert it to XY
						var scale = Math.pow(2, mapObject.getZoom());
						var nw = new google.maps.LatLng(mapObject.getBounds().getNorthEast().lat(), mapObject.getBounds().getSouthWest().lng());
						var worldCoordinateNW = mapObject.getProjection().fromLatLngToPoint(nw);
						var worldCoordinate = mapObject.getProjection().fromLatLngToPoint(cluster.center_);
						var pixelOffset = new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
						var mapposition = plugin_map.position();

						var count_li = 0;
						
						var current_zoom = mapObject.getZoom();
						
						if(current_zoom >= 19) {
							
							var cluster_markers = cluster.getMarkers();									
							
							// @since 2.5 ====							
							var clustred_post_ids = [];
							// ===============
							
							for (var i = 0; i < cluster_markers.length; i++ ){
								
								if(cluster_markers[i].visible == true){
									
									count_li++;
									
									// @since 2.5 ====
									clustred_post_ids.push(cluster_markers[i].id);										
									// ===============
									
								}
								
							}
							
							jQuery('div.cluster_posts_widget_'+map_id+'').html('<div class="blue_cloud"></div>');
								
							if(count_li > 0){
								
								// @since 2.5 ====
								jQuery('div.cluster_posts_widget_'+map_id+'').removeClass('flipOutX');
								jQuery('div.cluster_posts_widget_'+map_id+'').addClass('cspm_animated flipInX').css('display', 'block');
								jQuery('div.cluster_posts_widget_'+map_id+'').css({left: (pixelOffset.x + mapposition.left + 40 + 'px'), top: (pixelOffset.y + mapposition.top - 32 + 'px')});	
			
								if(cluster_xhr && cluster_xhr.readystate != 4){
									cluster_xhr.abort();
								}
								
								cluster_xhr = jQuery.post(
									progress_map_vars.ajax_url,
									{
										action: 'cspm_load_clustred_markers_list',
										post_ids: clustred_post_ids,
										light_map: light_map
									},
									function(data){	
										
										jQuery('div.cluster_posts_widget_'+map_id+'').html(data);
										
										// Call custom scroll bar for infowindow
										jQuery("div.cluster_posts_widget_"+map_id+"").mCustomScrollbar("destroy");
										jQuery("div.cluster_posts_widget_"+map_id+"").mCustomScrollbar({
											autoHideScrollbar:true,
											theme:"dark-thin"
										});												
										
									}
								);
								
								jQuery("div.cluster_posts_widget_"+map_id+" ul li").livequery('click', function(){
									
									var id = jQuery(this).attr('id');
									var i = jQuery('li#'+map_id+'_list_items_'+id+'').attr('value');
									cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), i);
									cspm_carousel_item_hover_style('li.carousel_item_'+i+'_'+map_id+'', map_id);
									
								});
								
							}else jQuery('div.cluster_posts_widget_'+map_id+'').css({'display':'none'});
		
							mapObject.setZoom(mapObject.getZoom() - 1);
							mapObject.setZoom(mapObject.getZoom() + 1);
		
						}
						
						/**
						 * @Deprecated since 2.5		 		
						 ***********************/
						 cspm_load_overlays(plugin_map, map_id);
						 /***********************
						 */
								
					});
					
				}
			}
			
		});
		
		return markerCluster;
	
	}

	function cspm_simple_clustering(plugin_map, map_id){
		
		var mapObject = plugin_map.gmap3('get');
		var markerCluster = new MarkerClusterer(mapObject);
		
    	mapObject.setZoom(mapObject.getZoom() - 1);
		mapObject.setZoom(mapObject.getZoom() + 1);
		
		/**
		 * @Deprecated since 2.5		 		
		 ***********************/
		 setTimeout(function() {
			 cspm_remove_overlays(markerCluster.getClusters(), map_id);
			 cspm_load_overlays(plugin_map, map_id);							
		 }, 600);
		 /***********************
		 */	
							
	}
	
	// Get items data function via ajax
	function cspm_ajax_item_details(post_id, map_id){

		jQuery.post(
			progress_map_vars.ajax_url,
			{
				action: 'cspm_load_carousel_item',
				post_id: post_id,
				items_view: progress_map_vars.items_view,
			},
			function(data){	
				jQuery("li#"+map_id+"_list_items_"+post_id+"").addClass('cspm_animated fadeIn').html(data);															
			}
		);
	
	}
	
	/**
	 * Load overlays for markers outside clusters
	 * @Deprecated since 2.5
	 */	
	function cspm_load_overlays(plugin_map, map_id){
	
		plugin_map.gmap3({
			get: {
				name: 'marker',
				all:  true,
				callback: function(objs) {
					jQuery.each(objs, function(i, obj) {									
						if(obj.getMap()) {
							if(obj.visible == true){
								var marker_id = obj.id;
								jQuery('div#bubble_'+marker_id+'_'+map_id+'').css({'display':'block'}); 
							}
						};
					});
				}
			}
		});
	
	}										
	
	/**
	 * hide overlays for markers inside clusters
	 * @Deprecated since 2.5
	 */	
	function cspm_remove_overlays(clusters, map_id){

		jQuery('div.infoWindowOverlay').hide();					
		jQuery.each(clusters, function(i, cluster) {
			var markers = cluster.getMarkers();
			if(markers.length > 1) {
				jQuery.each(markers, function(i, marker) {					
					var marker_id = marker.id;
					jQuery('div#bubble_'+marker_id+'_'+map_id+'').css({'display':'none'}); 
				});
			}
		});	
		
	}
	
	// Animate the selected marker
	function cspm_animate_marker(plugin_map, map_id, post_id){
		
		plugin_map.gmap3({
			get: {
				name: 'marker',
				tag: 'post_id__'+post_id+'',
				callback: function(marker){
					if(marker.visible == true){						
						
						var is_child = marker.is_child;	
						var marker_infobox = 'div.cspm_infobox_container.infobox_'+post_id+'[data-is-child='+is_child+']';

						if(progress_map_vars.markerAnimation == 'pulsating_circle'){
								
							var mapObject = plugin_map.gmap3('get');
	
							// Get marker position and convert it to XY
							var scale = Math.pow(2, mapObject.getZoom());
							var nw = new google.maps.LatLng(mapObject.getBounds().getNorthEast().lat(), mapObject.getBounds().getSouthWest().lng());
							var worldCoordinateNW = mapObject.getProjection().fromLatLngToPoint(nw);
							var worldCoordinate = mapObject.getProjection().fromLatLngToPoint(marker.position);
							var pixelOffset = new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
							var mapposition = plugin_map.position();
		
							jQuery('div#pulsating_holder.'+map_id+'_pulsating').css({'display':'block', 'left':(pixelOffset.x + mapposition.left - 15 + 'px'), 'top':(pixelOffset.y + mapposition.top - 18 + 'px')});
							setTimeout(function(){
								jQuery('div#pulsating_holder.'+map_id+'_pulsating').css('display', 'none');
								jQuery(marker_infobox).addClass('cspm_current_bubble');
							},1500);
							
						}else if(progress_map_vars.markerAnimation == 'bouncing_marker'){
						 								
							marker.setAnimation(google.maps.Animation.BOUNCE);
							setTimeout(function(){
								marker.setAnimation(null);
								jQuery(marker_infobox).addClass('cspm_current_bubble');
							},1500);
							
						}else if(progress_map_vars.markerAnimation == 'flushing_infobox'){						
							
							jQuery('div.cspm_infobox_container').removeClass('cspm_animated flash');
							setTimeout(function(){								
								jQuery(marker_infobox).addClass('cspm_animated flash');
								jQuery(marker_infobox).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){jQuery(marker_infobox).removeClass('flash');});
							}, 600);
							
						}

					}
				}
			}
		});
	
	}

	// Zoom-in function
	function cspm_zoom_in(selector, mapObj){
		
		selector.click(function(){
			
			var map = jQuery(mapObj).gmap3("get");
			
    		map.setZoom(map.getZoom() + 1);
			
			jQuery('div[class^=cluster_posts_widget]').removeClass('flipInX');
			jQuery('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
	
		});
		
	}

	// Zoom-out function
	function cspm_zoom_out(selector, mapObj){
		
		selector.click(function(){
					
			var map = jQuery(mapObj).gmap3("get");
    		
			map.setZoom(map.getZoom() - 1);
			
			jQuery('div[class^=cluster_posts_widget]').removeClass('flipInX');
			jQuery('div[class^=cluster_posts_widget]').addClass('cspm_animated flipOutX');
			
		});
		
	}
	
//============================//
//==== Carousel functions ====//
//============================//

	// Initialize carousel
	function cspm_init_carousel(carousel_size, carousel_id){

		if(progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
			
			var vertical_value = false;	
			var dimension = (progress_map_vars.items_view == 'listview') ? progress_map_vars.horizontal_item_width : progress_map_vars.vertical_item_width;
			
			if(progress_map_vars.main_layout == "mr-cl" || progress_map_vars.main_layout == "ml-cr"  || progress_map_vars.main_layout == "map-tglc-right"  || progress_map_vars.main_layout == "map-tglc-left"){
				var vertical_value = true;
				var dimension = (progress_map_vars.items_view == 'listview') ? progress_map_vars.horizontal_item_height : progress_map_vars.vertical_item_height;
			}
			
			var size = {}; 
			var auto_scroll_option = {}; 
			
			if(progress_map_vars.number_of_items != '')
				var size = { size: parseInt(progress_map_vars.number_of_items) };
			else if(carousel_size != null)
				var size = { size: parseInt(carousel_size) };
				
			var default_options = {
				
				scroll: eval(progress_map_vars.carousel_scroll),
				wrap: progress_map_vars.carousel_wrap,
				auto: eval(progress_map_vars.carousel_auto),		
				initCallback: cspm_carousel_init_callback,
				itemFallbackDimension: parseInt(dimension),
				itemLoadCallback: cspm_carousel_itemLoadCallback,
				rtl: eval(progress_map_vars.carousel_mode),
				animation: progress_map_vars.carousel_animation,
				easing: progress_map_vars.carousel_easing,
				vertical: vertical_value,	
			
			};
			
			if(eval(progress_map_vars.carousel_auto) > 0)
				var auto_scroll_option = { itemFirstInCallback: { onAfterAnimation:  cspm_carousel_item_request } }
			else var auto_scroll_option = { itemFirstInCallback: cspm_carousel_itemFirstInCallback, }
		
			var carousel_options = jQuery.extend({}, default_options, size, auto_scroll_option);
			
			// Init jcarousel
			jQuery('ul#codespacing_progress_map_carousel_'+carousel_id+'').jcarousel(carousel_options);	

		}else return false;		
		
	}
	
	function cspm_carousel_itemFirstInCallback(carousel, item, idx, state) {
		
		var map_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		if(state == "prev" || state == "next"){
			
			var item_value = item.value;

			cspm_carousel_item_hover_style('li.carousel_item_'+item_value+'_'+map_id+'', map_id);
				
		}
		
		return false;
		
	}

	// Load Items in the screenview
	function cspm_carousel_itemLoadCallback(carousel){
				
		var map_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		for(var i = parseInt(carousel.first); i <= parseInt(carousel.last); i++){
			
			var post_id = jQuery('.jcarousel-item-'+ i +'').attr('class').split(' ')[0];
			
			// Check if the requested items already exist
			if ( jQuery('.jcarousel-item-'+ i +'').has('div.cspm_spinner').length ){
				
				// Get items details
				cspm_ajax_item_details(post_id, map_id);	
				
			}
			
		}
		
	}

	// Carousel callback function
	function cspm_carousel_init_callback(carousel){
		
		var carousel_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];

		// Move the carousel with scroll wheel
		if(progress_map_vars.scrollwheel_carousel == 'true'){

			jQuery('ul#codespacing_progress_map_carousel_'+carousel_id+'').mousewheel(function(event, delta) {
					
				if (delta > 0){
					carousel.prev();
					setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
					return false;
				}else if (delta < 0){
					carousel.next();
					setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
					return false;
				}
					
			});
			
		}
		
		// Touch swipe option
		if(progress_map_vars.touchswipe_carousel == 'true'){

			jQuery('ul#codespacing_progress_map_carousel_'+carousel_id+'').swipe({ 
				
				//Generic swipe handler for all directions
				swipe:function(event, direction, distance, duration, fingerCount) {

					if(progress_map_vars.main_layout == 'mu-cd' || progress_map_vars.main_layout == 'md-cu' || progress_map_vars.main_layout == 'm-con' || progress_map_vars.main_layout == 'fullscreen-map-top-carousel' || progress_map_vars.main_layout == 'fit-in-map-top-carousel'){
						
						if(direction == 'left'){
							carousel.next();
							setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
							return false;
						}else if(direction == 'right'){
							carousel.prev();
							setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
							return false;
						}
						
					}else if(progress_map_vars.main_layout == 'ml-cr' || progress_map_vars.main_layout == 'mr-cl'){
						
						if(direction == 'up'){
							carousel.next();
							setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
							return false;
						}else if(direction == 'down'){
							carousel.prev();
							setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
							return false;
						}
						
					}															
					
				},
				threshold:0				
			});
			
		}
		
		// Pause autoscrolling if the user moves with the cursor over the carousel
		carousel.clip.hover(function() {
			carousel.stopAuto();
		}, function() {
			carousel.startAuto();
		});
		
		// Next button 
		carousel.buttonNext.bind('click', function() {
			setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
		});
		
		// Previous button
		carousel.buttonPrev.bind('click', function() {		
			setTimeout(function(){ cspm_carousel_item_request(carousel); }, 600);
		});
		
	}					
	
	function cspm_carousel_item_request(carousel){

		var map_id = carousel.container.context.id.split('codespacing_progress_map_carousel_')[1];
		
		var plugin_map = jQuery('div#codespacing_progress_map_div_'+map_id+'');
		
		var firstItem = parseInt(carousel.first);
		
		var overlay_id = jQuery('.jcarousel-item-'+ firstItem +'').attr('class').split(' ')[0];

		if(overlay_id){
			
			var item_latlng = jQuery('li#'+map_id+'_list_items_'+overlay_id+'').attr('name');
			
			if(item_latlng){
					
				var split_item_latlng = item_latlng.split('_');
				var this_lat = split_item_latlng[0].replace(/\"/g, '');
				var this_lng = split_item_latlng[1].replace(/\"/g, '');
					
				cspm_carousel_item_hover_style('li#'+map_id+'_list_items_'+overlay_id+'', map_id);
					
				var map = jQuery('div#codespacing_progress_map_div_'+map_id+'').gmap3("get");							
				
				cspm_center_map_at_point(plugin_map, this_lat, this_lng)
					
				// Overlay active style 
				// @Depricated since 2.5 ====
				jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
				jQuery('div#bubble_'+overlay_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');
				// ==========================
				
				setTimeout(function(){cspm_animate_marker(plugin_map, map_id, overlay_id);},200);
			
			}
			
		}
				
	}

	// Call carousel items								
	function cspm_call_carousel_item(carousel, id){
		
		carousel.scroll(jQuery.jcarousel.intval(id));
		return false;
		
	}
	
	// Custom style for the first and selected carousel item
	function cspm_carousel_item_hover_style(item_selector, map_id){								

		jQuery('li[id^='+map_id+'_list_items_]').removeClass('cspm_carousel_first_item').css({'background-color':progress_map_vars.items_background});
		jQuery(item_selector).addClass('cspm_carousel_first_item').css({'background-color':progress_map_vars.items_hover_background});	
		
	}
	
	function cspm_object_size(obj){
			
		var size = 0, key;
		for (key in obj) {
			if (obj.hasOwnProperty(key)) size++;
		}
		return size;
					
	}
	
	function cspm_rewrite_carousel(show_carousel, carousel_id, posts_to_retreive, map_id){

		if(show_carousel == "yes" && progress_map_vars.show_carousel == "true" && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
	
			var carousel = carousel_id.data('jcarousel');
			
			carousel.reset();
			
			var carousel_length = cspm_object_size(posts_to_retreive)
	
			if(progress_map_vars.items_view == "listview"){ 
			
				item_width = parseInt(progress_map_vars.horizontal_item_width);										
				item_height = parseInt(progress_map_vars.horizontal_item_height);
				item_css = progress_map_vars.horizontal_item_css;
				items_background  = progress_map_vars.items_background;
			
			}else if(progress_map_vars.items_view == "gridview"){ 
			
				item_width = parseInt(progress_map_vars.vertical_item_width);
				item_height = parseInt(progress_map_vars.vertical_item_height);
				item_css = progress_map_vars.vertical_item_css;
				items_background  = progress_map_vars.items_background;
				
			}
	
			var count_loop = 0;
						
			for(var c = 0; c < carousel_length; c++){
				
				var post_id = posts_to_retreive[c];
				var is_child = post_ids_and_child_status[map_id][post_lat_lng_coords[map_id][post_id]];
				
				var carousel_item = '';							
			
				carousel_item = '<li id="'+map_id+'_list_items_'+post_id+'" class="'+post_id+' carousel_item_'+(c+1)+'_'+map_id+'" data-is-child="'+is_child+'" name="'+post_lat_lng_coords[map_id][post_id]+'" value="'+(c+1)+'" style="width:'+item_width+'px; height:'+item_height+'px; background-color:'+items_background+'; margin:4px 3px; '+item_css+'">';
					carousel_item += '<div class="cspm_spinner"></div>';
				carousel_item += '</li>';
			
				carousel.add(c+1, carousel_item);
				
				count_loop++;
				
			}					
								
			cspm_init_carousel(carousel_length, map_id);
			
			return count_loop++;
							
		}

	}
	
	function cspm_fullscreen_map(){
		
		var screenWidth = window.innerWidth;
		var screenHeight = window.innerHeight;

		jQuery('div.codespacing_progress_map_area').css({height : screenHeight, width : screenWidth});
	
	}
		
	function cspm_carousel_width(){
		
		var carouselWidth = jQuery('div.codespacing_progress_map_area').width();
		
		carouselWidth = parseInt(carouselWidth - 40);
		
		var carouselHalf = parseInt((-0) - ( carouselWidth/ 2));

		jQuery('div.codespacing_progress_map_carousel_on_top').css({width : carouselWidth, 'margin-left' : carouselHalf+'px'});
	
	}
		
	function cspm_toggle_carousel_width(){
		
		var carouselWidth = jQuery('div.codespacing_progress_map_area').width();

		jQuery('div.cspm_toggle_carousel_horizontal').css({width : carouselWidth});
	
	}

	function cspm_fitIn_map(){
		
		var parentHeight = jQuery('div.codespacing_progress_map_area').parent().height();
		
		if(parentHeight == 0) parentHeight = progress_map_vars.layout_fixed_height;

		jQuery('div.codespacing_progress_map_area').css({height : parentHeight});
	
	}
	
	function cspm_set_markers_visibility(plugin_map, value, j, post_ids_and_categories, posts_to_retreive, retreive_posts){
		
		if(retreive_posts == true){
			
			// @value: Refers to the category ID
			if(value != null){
				// Show markers comparing with the category ID (faceted search case)
				plugin_map.gmap3({
					get: {
						name: "marker",
						all: true,
						callback: function(objs){
							jQuery.each(objs, function(i, obj){
								
								if(jQuery.inArray(value, post_ids_and_categories['post_id_'+obj.post_id][0]) > -1){
									
									if(typeof obj.setVisible === 'function')
										obj.setVisible(true);
										
									if(jQuery.inArray(obj.post_id, posts_to_retreive) === -1){
										posts_to_retreive[j] = obj.post_id;	
										j++;
									}	
										
								}
								
							});
						}
					}
				});
				
			}else{
				
				// Show markers comparing with the search area radius (Search form case)
				plugin_map.gmap3({
					get: {
						name: "marker",
						all: true,
						callback: function(objs){
							jQuery.each(objs, function(i, obj){
								if(typeof obj.setVisible === 'function' && (jQuery.inArray(obj.post_id, posts_to_retreive) > -1))
									obj.setVisible(true);	
							});
						}
					}
				});
			
			}
		
		// Show all markers	
		}else{
			
			plugin_map.gmap3({
				get: {
					name: "marker",
					all: true,
					callback: function(objs){
						jQuery.each(objs, function(i, obj){
							if(typeof obj.setVisible === 'function') obj.setVisible(true);
							posts_to_retreive[j] = obj.post_id;	
							j++;
						});
					}
				}
			});

		}
		
		return posts_to_retreive;
		
	}

	// Get Two Address's And Return Distance In Between
	// @distance_unit = imperial / metric 
	function cspm_get_distance(origin_lat, origin_lng, destination_lat, destination_lng, distance_unit){
		
		var earth_radius = (distance_unit == "metric") ? 6380 : (6380*0.621371192);
		
		return distance = Math.acos(Math.sin(cspm_deg2rad(destination_lat))*Math.sin(cspm_deg2rad(origin_lat))+Math.cos(cspm_deg2rad(destination_lat))*Math.cos(cspm_deg2rad(origin_lat))*Math.cos(cspm_deg2rad(destination_lng)-cspm_deg2rad(origin_lng)))*earth_radius;
		
	}

	function cspm_center_map_at_point(plugin_map, latitude, longitude){
				
		var mapObject = plugin_map.gmap3("get");
		
		var latLng = new google.maps.LatLng(latitude, longitude);
			
		mapObject.panTo(latLng);
		mapObject.setCenter(latLng);
		mapObject.setZoom(parseInt(carousel_map_zoom));
		
	}
	
	function cspm_is_bounds_contains_marker(plugin_map, latitude, longitude){
		
		var mapObject = plugin_map.gmap3('get');
		var myLatlng = new google.maps.LatLng(latitude, longitude);
		return mapObject.getBounds().contains(myLatlng);		
							
	}
		
	var cspm_requests = {};
	var cspm_bubbles = {};
	var cspm_child_markers = {};
	
	function cspm_draw_multiple_infoboxes(plugin_map, map_id, infobox_html_content, infobox_type){
	
		plugin_map.gmap3({
			get: {
				name: 'marker',
				all:  true,
				callback: function(objs) {				
										
					for(var i = 0; i < objs.length; i++){	
																				
						var post_id = objs[i].post_id;
						var latLng = objs[i].position;
						var icon_height = (typeof objs[i].icon === 'undefined' || typeof objs[i].icon.size === 'undefined' || typeof objs[i].icon.size.height === 'undefined') ? 38 : objs[i].icon.size.height;
						var is_child = objs[i].is_child;
						
						// Convert the LatLng object to array
						var marker_position = jQuery.map(latLng, function(value, index) {
							return [value];
						});
						var lat = marker_position[0];
						var lng = marker_position[1];	

						// if the marker is within the viewport of the map
						if(cspm_is_bounds_contains_marker(plugin_map, lat, lng) && objs[i].getMap() != null && objs[i].visible == true){
							
							var this_infobox_div = jQuery('div.infobox_'+post_id+'.cspm_infobox_'+map_id+'[data-is-child='+is_child+']');

							// If the infobox was already created ...
							if(jQuery.contains(document.body, this_infobox_div[0])){
								
								// ... Set its position to the top of the marker
								cspm_infobox_set_position(plugin_map, this_infobox_div, latLng, icon_height);
							
							// If the infobox not created ...
							}else{
								
								// 1. Create the marker infobox
								var this_infobox_div = infobox_html_content;
								this_infobox_div = this_infobox_div.split('<div class="cspm_infobox_container cspm_infobox_multiple cspm_infobox_'+map_id+' '+infobox_type+'');
								this_infobox_div = jQuery('<div data-is-child="'+is_child+'" class="cspm_infobox_container cspm_infobox_multiple cspm_infobox_'+map_id+' '+infobox_type+' infobox_'+post_id+''+this_infobox_div[1]);
								
								// 2. Append the infobox to the map
								jQuery(plugin_map.selector).parent().append(this_infobox_div);
								
								// 3. Set the position of the infobox on to of the marker
								cspm_infobox_set_position(plugin_map, this_infobox_div, latLng, icon_height);
								
								// 4. Save the ajax requests in an array
								cspm_bubbles[map_id].push(post_id);
								cspm_child_markers[map_id].push(is_child);
								cspm_requests[map_id].push(jQuery.post(
									progress_map_vars.ajax_url,
									{
										action: 'cspm_infobox_content',
										post_id: post_id,
										infobox_type: infobox_type,
										map_id: map_id,
										status: 'cspm_infobox_multiple'
									}
								));
								
							}															
						
						// Hide the infobox when the marker is outside the viewport of the map	
						}else jQuery('div.infobox_'+post_id+'.cspm_infobox_'+map_id+'[data-is-child='+is_child+']').fadeOut();	

						// Detect the end of the loop
						if(i == (objs.length-1)){
							// If the was any new infoboxes created
							if(cspm_bubbles[map_id].length > 0){
								// Load their content just after ajax requests were finished
								var cspm_defer = jQuery.when.apply(jQuery, cspm_requests[map_id]);
								cspm_defer.done(function(){
									if(cspm_requests[map_id].length == 1){
										if(arguments[1] == 'success')
											jQuery('div.infobox_'+cspm_bubbles[map_id][0]+'.cspm_infobox_'+map_id+'[data-is-child='+cspm_child_markers[map_id][0]+']').html(arguments[0]);		
									}else if(cspm_requests[map_id].length > 1){
										jQuery.each(arguments, function(index, responseData){
											if(responseData.length > 0 && responseData[1] == 'success')
												jQuery('div.infobox_'+cspm_bubbles[map_id][index]+'.cspm_infobox_'+map_id+'[data-is-child='+cspm_child_markers[map_id][index]+']').html(responseData[0]);		
										});
									}
								});
							}	
						}
						
					}
																												
				}
			}
		});
		
	}

	function cspm_draw_single_infobox(plugin_map, map_id, infobox_div, infobox_type, marker_obj, infobox_xhr){

		var post_id = marker_obj.post_id;
		var icon_height = (typeof marker_obj.icon === 'undefined' || typeof marker_obj.icon.size === 'undefined' || typeof marker_obj.icon.size.height === 'undefined') ? 38 : marker_obj.icon.size.height;
		
		// 1. Get the post_id from the infobox
		var infobox_post_id = infobox_div.attr('data-post-id');
		
		// 2. Compare the infobox post_id with the clicked marker post_id ...
		// ... to make sure not loading the content again
		if(infobox_post_id != post_id){
			
			var infobox_html = '<div class="blue_cloud"></div><div class="cspm_arrow_down '+infobox_type+'"></div>';
			infobox_div.html(infobox_html);															
			
			if(infobox_xhr && infobox_xhr.readystate != 4){
				infobox_xhr.abort();
			}
			
			infobox_xhr = jQuery.post(
				progress_map_vars.ajax_url,
				{
					action: 'cspm_infobox_content',
					post_id: post_id,
					infobox_type: infobox_type,
					map_id: map_id,
					status: 'cspm_infobox_single'
				},
				function(data){
					infobox_div.html(data);															
				}
			);
			
		}
		
		// 3. Update the infobox post_id attribute
		infobox_div.attr('data-post-id', post_id);
		
		// 4. Set the position on the infobox on top of the marker
		cspm_infobox_set_position(plugin_map, infobox_div, marker_obj.position, icon_height);
		
		return infobox_xhr;
	
	}
	
	function cspm_set_single_infobox_position(plugin_map, infobox_div){
		
		if(infobox_div.is(':visible')){
			
			var post_id = infobox_div.attr('data-post-id');
			
			plugin_map.gmap3({
			  get: {
				name: 'marker',
				tag: 'post_id__'+post_id+'',
				callback: function(obj){
					var icon_height = (typeof obj.icon === 'undefined' || typeof obj.icon.size === 'undefined' || typeof obj.icon.size.height === 'undefined') ? 38 : obj.icon.size.height;
					cspm_infobox_set_position(plugin_map, infobox_div, obj.position, icon_height);
					// Hide the infobox when the marker was clustred or no more visible
					setTimeout(function(){ 
						if(obj.getMap() == null || obj.visible == false){
							infobox_div.addClass('cspm_animated fadeOutUp');					
							infobox_div.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
								infobox_div.hide().removeClass('cspm_animated fadeOutUp');
							});		
						}
					}, 400);
				}
			  }
			});									
		}	
			
	}
	
	function cspm_infobox_set_position(plugin_map, infobox_div, marker_position, marker_icon_height){

		var mapObject = plugin_map.gmap3('get');
						
		// Get marker position and convert it to XY
		var scale = Math.pow(2, mapObject.getZoom());
		var nw = new google.maps.LatLng(mapObject.getBounds().getNorthEast().lat(), mapObject.getBounds().getSouthWest().lng());
		var worldCoordinateNW = mapObject.getProjection().fromLatLngToPoint(nw);
		var worldCoordinate = mapObject.getProjection().fromLatLngToPoint(marker_position);
		var pixelOffset = new google.maps.Point(Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale), Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale));
		var mapposition = plugin_map.position();
		
		var infobox_half_width = infobox_div.width() / 2;
		var margin_top = marker_icon_height + infobox_div.height();		
		
		infobox_div.css({'left':(pixelOffset.x + mapposition.left + 'px'),
  						 'top':(pixelOffset.y + mapposition.top + 'px'), 
						 'margin-left':('-' + infobox_half_width + 'px'),
						 'margin-top':('-'+margin_top+'px')
					   }).fadeIn('slow');
					   
	}
	
	// Count the number of visible markers in the map
	// @since 2.5
	function cspm_nbr_of_visible_markers(plugin_map){
		
		var count_posts = 0;
		
		plugin_map.gmap3({
			get: {
				name: 'marker',
				all:  true,
				callback: function(objs) {				
					for(var i = 0; i < objs.length; i++){	
						if(objs[i].visible == true){
							count_posts++;
						}
					}
				}
			}
		});		
		
		return count_posts;
		
	}
	
	// Hide all visible markers in the map
	// @since 2.5
	function cspm_hide_all_markers(plugin_map){
		
		var r = jQuery.Deferred();
		
		plugin_map.gmap3({
			get: {
				name: "marker",				
				all: true,	
				callback: function(objs){
					jQuery.each(objs, function(i, obj){
						if(typeof obj.setVisible === 'function')
							obj.setVisible(false);
					});
					r.resolve();
				}
			}
		});
				
		return r;
		
	}
	
	// Remove duplicate emlements from an array
	// @since 2.5
	function cspm_remove_array_duplicates(array){
		var new_array = [];
		var i = 0;
		jQuery.each(array, function(index, element){
			if(jQuery.inArray(element, new_array) === -1){
				new_array[i] = element;	
				i++;
			}
		});
		return new_array;
	}
		
//=========================//
//==== Other functions ====//
//=========================//
	
	function cspm_strpos(haystack, needle, offset) {
		
	  // From: http://phpjs.org/functions
	  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  // +   improved by: Onno Marsman
	  // +   bugfixed by: Daniel Esteban
	  // +   improved by: Brett Zamir (http://brett-zamir.me)
	  // *     example 1: strpos('Kevin van Zonneveld', 'e', 5);
	  // *     returns 1: 14
	  var i = (haystack + '').indexOf(needle, (offset || 0));
	  return i === -1 ? false : i;
	  
	}

	function cspm_deg2rad(angle) {
		
	  // From: http://phpjs.org/functions
	  // +   original by: Enrique Gonzalez
	  // +     improved by: Thomas Grainger (http://graingert.co.uk)
	  // *     example 1: deg2rad(45);
	  // *     returns 1: 0.7853981633974483
	  return angle * .017453292519943295; // (angle / 180) * Math.PI;
	
	}	
	
	function alerte(obj) {
		
		if (typeof obj == 'object') {
			var foo = '';
			for (var i in obj) {
				if (obj.hasOwnProperty(i)) {
					foo += '[' + i + '] => ' + obj[i] + '\n';
				}
			}
			alert(foo);
		}else {
			alert(obj);
		}
		
	}
	
	jQuery(document).ready(function($) {				

		if(progress_map_vars.faceted_search_option == 'true'){
	
			// Customize Checkboxes and Radios button
		
			if(progress_map_vars.faceted_search_input_skin == 'line'){
				
				var skin_color = '-'+progress_map_vars.faceted_search_input_color;
				
				$('form.faceted_search_form input').each(function(){
					
					var self = $(this),
					  label = self.next(),
					  label_text = label.text();
				
					label.remove();
					self.iCheck({
						checkboxClass: 'icheckbox_line'+skin_color+'',
						radioClass: 'iradio_line'+skin_color+'',
						insert: '<div class="icheck_line-icon"></div>' + label_text,
						inheritClass: true
					});		
				
				});
				
			}else{
				
				if(progress_map_vars.faceted_search_input_skin == 'polaris' || progress_map_vars.faceted_search_input_skin == 'futurico') var skin_color = '';
				else var skin_color = '-'+progress_map_vars.faceted_search_input_color;
				
				$('form.faceted_search_form input').iCheck({
					checkboxClass: 'icheckbox_'+progress_map_vars.faceted_search_input_skin+skin_color+'',
					radioClass: 'iradio_'+progress_map_vars.faceted_search_input_skin+skin_color+'',
					increaseArea: '20%',
					inheritClass: true
				});
			
			}
		
		
			// Faceted search =====		
		
			$('div.faceted_search_btn').livequery('click', function(){

				var map_id = $(this).attr('id');
				var status = $(this).attr('data-status');
				
				if($('div.faceted_search_container_'+map_id+'').is(':visible')){
					$('div.faceted_search_container_'+map_id+'').removeClass('slideInLeft').addClass('cspm_animated slideOutLeft');
					setTimeout(function(){$('div.faceted_search_container_'+map_id+'').css({'display':'none'});},200);
				}else{					
					$('div.faceted_search_container_'+map_id+'').removeClass('slideOutLeft').addClass('cspm_animated fadeInRight').css({'display':'block'});
				}
				
				// Call custom scroll bar for faceted search list
				$("div[class^=faceted_search_container] form.faceted_search_form ul").mCustomScrollbar("destroy");
				$("div[class^=faceted_search_container] form.faceted_search_form ul").mCustomScrollbar({
					autoHideScrollbar:false,
					theme:"dark-thin"
				});
				
			});

			$('div[class^=reset_map_list]').livequery('click', function(){
				
				var map_id = $(this).attr('id');
				
				$('form#faceted_search_form_'+map_id+' input').iCheck('uncheck');
				
				$(this).hide();
			
			});
		
			var posts_to_retreive = {};
			
			$('form.faceted_search_form input').livequery('ifChanged', function(){
				
				var map_id = $(this).attr('class').split(' ')[1];
				var carousel = $(this).attr('class').split(' ')[2];
	
				var plugin_map = $('div#codespacing_progress_map_div_'+map_id+'');
				
				// Hide all markers
				cspm_hide_all_markers(plugin_map).done(function(){
					
					// Hide all bubbles
					// @Depricated since 2.5 ====
					for (var post in post_ids_and_categories[map_id]) {
						if (post_ids_and_categories[map_id].hasOwnProperty(post)) {
							var post_id = post.split('_')[2]; 		
							$('div#bubble_'+post_id+'_'+map_id+'').css({'display':'none'}); 
						}
					}					
					// ==========================
					
					if(progress_map_vars.faceted_search_multi_taxonomy_option == "false")
						$('div.reset_map_list_'+map_id+'').show();
					
					posts_to_retreive[map_id] = [];
					var retreived_posts = [];
					var i = 0;
					var j = 0;
					var num_checked = 0;
					var count_posts = 0;					
							
					$('div.faceted_search_container_'+map_id+' form.faceted_search_form input').each(function(){
		
						if($(this).prop('checked') == true){ 
							
							num_checked++;
							
							var input_checked = $(this).attr("name").split('___')[0];
							
							var value = $(this).val();
	
							// Loop throught post_ids and check its relation with the current category
							// Then show markers within the selected category
							retreived_posts = cspm_remove_array_duplicates(retreived_posts.concat(cspm_set_markers_visibility(plugin_map, value, j, post_ids_and_categories[map_id], posts_to_retreive[map_id], true)));
							cspm_simple_clustering(plugin_map, map_id);
							count_posts = cspm_rewrite_carousel(carousel, $('ul#codespacing_progress_map_carousel_'+map_id+''), retreived_posts, map_id);
							
							i++;
		
						}								
						
					});
					
					// Show all markers when there is no checked category
					if(num_checked == 0){
						
						var j = 0;
		
						cspm_set_markers_visibility(plugin_map, null, j, post_ids_and_categories[map_id], posts_to_retreive[map_id], false);
						cspm_simple_clustering(plugin_map, map_id);
						count_posts = cspm_rewrite_carousel(carousel, $('ul#codespacing_progress_map_carousel_'+map_id+''), posts_to_retreive[map_id], map_id);
							
					}	
					
					if(progress_map_vars.show_posts_count == "yes")
						$('span.the_count_'+map_id+'').empty().html(count_posts);
					
				});
					
			});
		
			// @Facetd search ====
			
		}
		
			
		// The event handler of the carousel items
		
		if(progress_map_vars.show_carousel == 'true' && progress_map_vars.main_layout != 'fullscreen-map' && progress_map_vars.main_layout != 'fit-in-map'){
			
			jQuery('ul[id^=codespacing_progress_map_carousel_] li').livequery('click', function(){
				
				var map_id = $(this).attr('id').split('_list_items_')[0];				
				var item_value = jQuery(this).attr('value');				
				var post_id = jQuery(this).attr('class').split(' ')[0];	// @Deprecated since 2.5				
						
				// Move the clicked carousel item to the first position
				cspm_call_carousel_item(jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel'), item_value);
				
				setTimeout(function(){
					var carousel = jQuery('ul#codespacing_progress_map_carousel_'+map_id+'').data('jcarousel');
					cspm_carousel_item_request(carousel);
				}, 600);
				
				/**
				 * Add overlay active style (used only for bubble infowindow style) 
				 * @Deprecated since 2.5		 		
				 ***********************/
				if(progress_map_vars.infowindow_type != 'content_style'){		
					jQuery('div.marker_holder div.pin_overlay_content').removeClass('pin_overlay_content-active');
					jQuery('div#bubble_'+post_id+'_'+map_id+' div.pin_overlay_content').addClass('pin_overlay_content-active');	
				}
				/***********************
				*/
				
			}).css('cursor','pointer');

		}
		
		// @Event handler
		
		
		// Search form request

		if(progress_map_vars.search_form_option == 'true'){
	
			// Customize the slider text box
			$("input.cspm_sf_slider_range").ionRangeSlider({
				type: 'single',		
			});
			
			// Reset the search form & the map
			$('div[class^=cspm_reset_search_form]').livequery('click', function(){
				
				var map_id = $(this).attr('data-map-id');
				var carousel = $(this).attr('data-show-carousel');
				var plugin_map = jQuery('div#codespacing_progress_map_div_'+map_id+'');
				
				posts_to_retreive[map_id] = [];
				
				cspm_set_markers_visibility(plugin_map, null, 0, post_ids_and_categories[map_id], posts_to_retreive[map_id], false);
				cspm_simple_clustering(plugin_map, map_id);
				cspm_rewrite_carousel(carousel, $('ul#codespacing_progress_map_carousel_'+map_id+''), posts_to_retreive[map_id], map_id);
				
				if(progress_map_vars.show_posts_count == "yes")
					$('span.the_count_'+map_id+'').empty().html(posts_to_retreive[map_id].length);
									
				plugin_map.gmap3({
					clear: {
						name:"circle",
						all: true
					},
				});
				
				$('form#search_form_'+map_id+' input#cspm_address').attr('value', '');
				
				$(this).removeClass('fadeIn').hide();
						
			});
			
			// Load the search form to the screen
			$('div.search_form_btn').livequery('click', function(){
				
				var map_id = $(this).attr('id');
				var status = $(this).attr('data-status');
				
				if($('div.search_form_container_'+map_id+'').is(':visible')){
					$('div.search_form_container_'+map_id+'').removeClass('fadeInUp').addClass('cspm_animated slideOutLeft');
					setTimeout(function(){
						$('div.search_form_container_'+map_id+'').css({'display':'none'});							
					},200);
				}else{										
					$('div.search_form_container_'+map_id+'').removeClass('slideOutLeft').addClass('cspm_animated fadeInUp').css({'display':'block'});
					setTimeout(function(){
						$('form#search_form_'+map_id+' input[name=cspm_address]').focus();
					},400);
				}
				
			});
			
			// Submit the search form data
			jQuery('div[class^=cspm_submit_search_form_]').livequery('click', function(){
				
				var map_id = jQuery(this).attr('data-map-id');
				var carousel = jQuery(this).attr('data-show-carousel');
				var address = jQuery('form#search_form_'+map_id+' input[name=cspm_address]').val();
				var distance = jQuery('form#search_form_'+map_id+' input[name=cspm_distance]').val();
				var distance_unit = jQuery('form#search_form_'+map_id+' input[name=cspm_distance_unit]').val();
								
				var plugin_map = jQuery('div#codespacing_progress_map_div_'+map_id+'');
				
				jQuery('div.cspm_submit_search_form_'+map_id+'').hide();
				jQuery('div.cspm_loader_search_form_'+map_id+'').show();
				
				var posts_in_search = {};				
				posts_in_search[map_id] = [];

				var geocoder = new google.maps.Geocoder();
				
				// Convert our address to Lat & Long
				geocoder.geocode({ 'address': address }, function (results, status) {
					
					// If the address is found
					if (status == google.maps.GeocoderStatus.OK) {
						
						var latitude = results[0].geometry.location.lat();
						var longitude = results[0].geometry.location.lng();
										
						plugin_map.gmap3({
							get: {
								name: 'marker',
								all:  true,
								callback: function(objs) {
									
									var j = 0;
									
									// Get all markers inside the radius of our address
									jQuery.each(objs, function(i, obj) {									
										
										var marker_id = obj.id;
										
										// Convert the LatLng object to array
										var post_latlng = jQuery.map(obj.position, function(value, index) {
											return [value];
										});
										
										// Calculate the distance and save the post_id							
										if(cspm_get_distance(latitude, longitude, post_latlng[0], post_latlng[1], distance_unit) < parseInt(distance)){
											posts_in_search[map_id][j] = marker_id;													
											j++;
										}
										
									});
									
									// If one or more posts are found within the radius area
									if(cspm_object_size(posts_in_search[map_id]) > 0){
										
										// Hide all markers	
										cspm_hide_all_markers(plugin_map).done(function(){
										
											// Hide all bubbles
											// @Depricated since 2.5 ====
											for (var post in post_ids_and_categories[map_id]) {
												if (post_ids_and_categories[map_id].hasOwnProperty(post)) {
													var post_id = post.split('_')[2]; 		
													$('div#bubble_'+post_id+'_'+map_id+'').css({'display':'none'}); 
												}
											}
											// ==========================
					
											// Center the map in our address position
											cspm_center_map_at_point(plugin_map, latitude, longitude);
	
											// Loop throught post_ids and check the post relation with the current category
											// Then show markers within the selected category
											cspm_set_markers_visibility(plugin_map, null, 0, post_ids_and_categories[map_id], posts_in_search[map_id], true);
											cspm_simple_clustering(plugin_map, map_id);
											cspm_rewrite_carousel(carousel, $('ul#codespacing_progress_map_carousel_'+map_id+''), posts_in_search[map_id], map_id);
	
											plugin_map.gmap3({
												clear: {
													name:"circle",
													all: true
												},
												circle:{
													options:{
														center: [latitude, longitude],
														radius : (parseInt(distance)*1000),
														fillColor : progress_map_vars.fillColor,
														fillOpacity: progress_map_vars.fillOpacity,
														strokeColor : progress_map_vars.strokeColor,
														strokeOpacity: progress_map_vars.strokeOpacity,
														strokeWeight: parseInt(progress_map_vars.strokeWeight),
														editable: false,
													},
													callback: function(circle){
														plugin_map.gmap3('get').fitBounds(circle.getBounds());
													}
												}											
											});
											
											// Show the reset button
											$('div.cspm_reset_search_form_'+map_id+'').show();
					
											// Reload post count value
											if(progress_map_vars.show_posts_count == "yes")
												$('span.the_count_'+map_id+'').empty().html(posts_in_search[map_id].length);
											
											jQuery('div.cspm_submit_search_form_'+map_id+'').show();
											jQuery('div.cspm_loader_search_form_'+map_id+'').hide();
											
										});
										
									}else{
														
										jQuery('div.cspm_submit_search_form_'+map_id+'').show();
										jQuery('div.cspm_loader_search_form_'+map_id+'').hide();
										
										jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_notice').removeClass('fadeOut').addClass('cspm_animated fadeInLeft').css({'display':'block'});	
										setTimeout(function(){
											jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_notice').removeClass('fadeInLeft').addClass('cspm_animated fadeOut');
											setTimeout(function(){
												jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_notice').css({'display':'none'});
											},700);
										},5000);									
			
									}

								}
							}
						});
					
					// The address is not found		
					}else{
										
						jQuery('div.cspm_submit_search_form_'+map_id+'').show();
						jQuery('div.cspm_loader_search_form_'+map_id+'').hide();

						jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_error').removeClass('fadeOut').addClass('cspm_animated fadeInLeft').css({'display':'block'});	
						setTimeout(function(){
							jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_error').removeClass('fadeInLeft').addClass('cspm_animated fadeOut');
							setTimeout(function(){
								jQuery('div.search_form_container_'+map_id+' div.cspm_search_form_error').css({'display':'none'});
							},700);
						},5000);									
			
					}
					
				});
				
			});
			
		}		  
		
		// @Search form request
		
		
		// Toogle the carousel
				
		$("div.toggle-carousel-bottom, div.toggle-carousel-top").livequery('click', function(){
			
			var map_id = $(this).attr('data-map-id');
			
			$("div#codespacing_progress_map_carousel_container").slideToggle("slow", function(){
			
				cspm_init_carousel(null, map_id);
				
			});
			
		});
		
		
		// Fit in layout
		
		if(progress_map_vars.main_layout == 'fit-in-map' || progress_map_vars.main_layout == 'fit-in-map-top-carousel'){
			
			cspm_fitIn_map();
			$(window).resize(cspm_fitIn_map);
		
		}
		
		
		// Fullscreen layout
		
		if(progress_map_vars.main_layout == 'fullscreen-map' || progress_map_vars.main_layout == 'fullscreen-map-top-carousel'){
		
			cspm_fullscreen_map();
			$(window).resize(cspm_fullscreen_map);
			
		}
		

		// Map with carousel on top
		
		if(progress_map_vars.main_layout == 'm-con' || progress_map_vars.main_layout == 'fullscreen-map-top-carousel' || progress_map_vars.main_layout == 'fit-in-map-top-carousel'){
		
			cspm_carousel_width();
			$(window).resize(cspm_carousel_width);
			
		}	

		
		// Show & Hide the search dsitance radius in the search form
		
		$('span.cspm_distance').livequery('click', function(){
			
			var map_id = $(this).attr('data-map-id');
							
			if($('form#search_form_'+map_id+' div.cspm_search_distances ul').is(':visible')){
				$('form#search_form_'+map_id+' div.cspm_search_distances ul').removeClass('fadeInDown').addClass('cspm_animated fadeOutUp');
				setTimeout(function(){$('form#search_form_'+map_id+' div.cspm_search_distances ul').css({'display':'none'});},200);
			}else{					
				$('form#search_form_'+map_id+' div.cspm_search_distances ul').removeClass('fadeOutUp').addClass('cspm_animated fadeInDown').css({'display':'block'});
			}
						
		});
		
		$('div.cspm_search_distances ul li').livequery('click', function(){
			
			var map_id = $(this).parent().prev().attr('data-map-id');
			
			$('form#search_form_'+map_id+' div.cspm_search_distances span.cspm_distance').text($(this).text());
			
			$('form#search_form_'+map_id+' div.cspm_search_distances ul').removeClass('fadeInDown').addClass('cspm_animated fadeOutUp');
			
			setTimeout(function(){$('form#search_form_'+map_id+' div.cspm_search_distances ul').css({'display':'none'});},200);
			
		});
		
		// @Search distance

	});