mw.loader.implement("jquery.autoEllipsis",function(){(function($){var cache={},matchTextCache={};$.fn.autoEllipsis=function(options){options=$.extend({position:'center',tooltip:false,restoreText:false,hasSpan:false,matchText:null},options);return this.each(function(){var $trimmableText,text,trimmableText,w,pw,l,r,i,side,m,$container=$(this);if(options.restoreText){if(!$container.data('autoEllipsis.originalText')){$container.data('autoEllipsis.originalText',$container.text());}else{$container.text($container.data('autoEllipsis.originalText'));}}if(options.hasSpan){$trimmableText=$container.children(options.selector);}else{$trimmableText=$('<span>').css('whiteSpace','nowrap').text($container.text());$container.empty().append($trimmableText);}text=$container.text();trimmableText=$trimmableText.text();w=$container.width();pw=0;if(options.matchText){if(!(text in matchTextCache)){matchTextCache[text]={};}if(!(options.matchText in matchTextCache[text])){matchTextCache[text][options.matchText]
={};}if(!(w in matchTextCache[text][options.matchText])){matchTextCache[text][options.matchText][w]={};}if(options.position in matchTextCache[text][options.matchText][w]){$container.html(matchTextCache[text][options.matchText][w][options.position]);if(options.tooltip){$container.attr('title',text);}return;}}else{if(!(text in cache)){cache[text]={};}if(!(w in cache[text])){cache[text][w]={};}if(options.position in cache[text][w]){$container.html(cache[text][w][options.position]);if(options.tooltip){$container.attr('title',text);}return;}}if($trimmableText.width()+pw>w){switch(options.position){case'right':l=0;r=trimmableText.length;do{m=Math.ceil((l+r)/2);$trimmableText.text(trimmableText.substr(0,m)+'...');if($trimmableText.width()+pw>w){r=m-1;}else{l=m;}}while(l<r);$trimmableText.text(trimmableText.substr(0,l)+'...');break;case'center':i=[Math.round(trimmableText.length/2),Math.round(trimmableText.length/2)];side=1;while($trimmableText.outerWidth()+pw>w&&i[0]>0){$trimmableText.text(
trimmableText.substr(0,i[0])+'...'+trimmableText.substr(i[1]));if(side===0){i[0]--;side=1;}else{i[1]++;side=0;}}break;case'left':r=0;while($trimmableText.outerWidth()+pw>w&&r<trimmableText.length){$trimmableText.text('...'+trimmableText.substr(r));r++;}break;}}if(options.tooltip){$container.attr('title',text);}if(options.matchText){$container.highlightText(options.matchText);matchTextCache[text][options.matchText][w][options.position]=$container.html();}else{cache[text][w][options.position]=$container.html();}});};}(jQuery));;},{},{});mw.loader.implement("jquery.checkboxShiftClick",function(){(function($){$.fn.checkboxShiftClick=function(text){var prevCheckbox=null,$box=this;$box.click(function(e){if(prevCheckbox!==null&&e.shiftKey){$box.slice(Math.min($box.index(prevCheckbox),$box.index(e.target)),Math.max($box.index(prevCheckbox),$box.index(e.target))+1).prop('checked',!!e.target.checked);}prevCheckbox=e.target;});return $box;};}(jQuery));;},{},{});mw.loader.implement(
"jquery.highlightText",function(){(function($){$.highlightText={splitAndHighlight:function(node,pat){var i,patArray=pat.split(' ');for(i=0;i<patArray.length;i++){if(patArray[i].length===0){continue;}$.highlightText.innerHighlight(node,patArray[i]);}return node;},innerHighlight:function(node,pat){var i,match,pos,spannode,middlebit,middleclone;if(node.nodeType===3){match=node.data.match(new RegExp("(^|\\s)"+$.escapeRE(pat),"i"));if(match){pos=match.index+match[1].length;spannode=document.createElement('span');spannode.className='highlight';middlebit=node.splitText(pos);middlebit.splitText(pat.length);middleclone=middlebit.cloneNode(true);spannode.appendChild(middleclone);middlebit.parentNode.replaceChild(spannode,middlebit);}}else if(node.nodeType===1&&node.childNodes&&!/(script|style)/i.test(node.tagName)&&!(node.tagName.toLowerCase()==='span'&&node.className.match(/\bhighlight/))){for(i=0;i<node.childNodes.length;++i){$.highlightText.innerHighlight(node.childNodes[i],pat);}}}};$.fn.
highlightText=function(matchString){return this.each(function(){var $el=$(this);$el.data('highlightText',{originalText:$el.text()});$.highlightText.splitAndHighlight(this,matchString);});};}(jQuery));;},{},{});mw.loader.implement("jquery.makeCollapsible",function(){(function($,mw){$.fn.makeCollapsible=function(){return this.each(function(){var $toggle,lpx='jquery.makeCollapsible> ',$that=$(this).addClass('mw-collapsible'),that=this,collapsetext=$(this).attr('data-collapsetext'),expandtext=$(this).attr('data-expandtext'),toggleElement=function($collapsible,action,$defaultToggle,instantHide){var $collapsibleContent,$containers;if(!$collapsible.jquery){return;}if(action!=='expand'&&action!=='collapse'){return;}if($defaultToggle===undefined){$defaultToggle=null;}if($defaultToggle!==null&&!($defaultToggle instanceof $)){return;}if(action==='collapse'){if($collapsible.is('table')){$containers=$collapsible.find('>tbody>tr');if($defaultToggle){$containers.not($defaultToggle.closest('tr')).stop
(true,true).fadeOut();}else{if(instantHide){$containers.hide();}else{$containers.stop(true,true).fadeOut();}}}else if($collapsible.is('ul')||$collapsible.is('ol')){$containers=$collapsible.find('> li');if($defaultToggle){$containers.not($defaultToggle.parent()).stop(true,true).slideUp();}else{if(instantHide){$containers.hide();}else{$containers.stop(true,true).slideUp();}}}else{$collapsibleContent=$collapsible.find('> .mw-collapsible-content');if($collapsibleContent.length){if(instantHide){$collapsibleContent.hide();}else{$collapsibleContent.slideUp();}}else{if($collapsible.is('tr')||$collapsible.is('td')||$collapsible.is('th')){$collapsible.fadeOut();}else{$collapsible.slideUp();}}}}else{if($collapsible.is('table')){$containers=$collapsible.find('>tbody>tr');if($defaultToggle){$containers.not($defaultToggle.parent().parent()).stop(true,true).fadeIn();}else{$containers.stop(true,true).fadeIn();}}else if($collapsible.is('ul')||$collapsible.is('ol')){$containers=$collapsible.find('> li')
;if($defaultToggle){$containers.not($defaultToggle.parent()).stop(true,true).slideDown();}else{$containers.stop(true,true).slideDown();}}else{$collapsibleContent=$collapsible.find('> .mw-collapsible-content');if($collapsibleContent.length){$collapsibleContent.slideDown();}else{if($collapsible.is('tr')||$collapsible.is('td')||$collapsible.is('th')){$collapsible.fadeIn();}else{$collapsible.slideDown();}}}}},toggleLinkDefault=function(that,e){var $that=$(that),$collapsible=$that.closest('.mw-collapsible.mw-made-collapsible').toggleClass('mw-collapsed');e.preventDefault();e.stopPropagation();if(!$that.hasClass('mw-collapsible-toggle-collapsed')){$that.removeClass('mw-collapsible-toggle-expanded').addClass('mw-collapsible-toggle-collapsed');if($that.find('> a').length){$that.find('> a').text(expandtext);}else{$that.text(expandtext);}toggleElement($collapsible,'collapse',$that);}else{$that.removeClass('mw-collapsible-toggle-collapsed').addClass('mw-collapsible-toggle-expanded');if($that.find
('> a').length){$that.find('> a').text(collapsetext);}else{$that.text(collapsetext);}toggleElement($collapsible,'expand',$that);}return;},toggleLinkPremade=function($that,e){var $collapsible=$that.eq(0).closest('.mw-collapsible.mw-made-collapsible').toggleClass('mw-collapsed');if($(e.target).is('a')){return true;}e.preventDefault();e.stopPropagation();if(!$that.hasClass('mw-collapsible-toggle-collapsed')){$that.removeClass('mw-collapsible-toggle-expanded').addClass('mw-collapsible-toggle-collapsed');toggleElement($collapsible,'collapse',$that);}else{$that.removeClass('mw-collapsible-toggle-collapsed').addClass('mw-collapsible-toggle-expanded');toggleElement($collapsible,'expand',$that);}return;},toggleLinkCustom=function($that,e,$collapsible){if(e){e.preventDefault();e.stopPropagation();}var action=$collapsible.hasClass('mw-collapsed')?'expand':'collapse';$collapsible.toggleClass('mw-collapsed');toggleElement($collapsible,action,$that);};if(!collapsetext){collapsetext=mw.msg(
'collapsible-collapse');}if(!expandtext){expandtext=mw.msg('collapsible-expand');}var $toggleLink=$('<a href="#"></a>').text(collapsetext).wrap('<span class="mw-collapsible-toggle"></span>').parent().prepend('&nbsp;[').append(']&nbsp;').on('click.mw-collapse',function(e){toggleLinkDefault(this,e);});if($that.hasClass('mw-made-collapsible')){return;}else{$that.addClass('mw-made-collapsible');}if(($that.attr('id')||'').indexOf('mw-customcollapsible-')===0){var thatId=$that.attr('id'),$customTogglers=$('.'+thatId.replace('mw-customcollapsible','mw-customtoggle'));mw.log(lpx+'Found custom collapsible: #'+thatId);if($customTogglers.length){$customTogglers.on('click.mw-collapse',function(e){toggleLinkCustom($(this),e,$that);});}else{mw.log(lpx+'#'+thatId+': Missing toggler!');}if($that.hasClass('mw-collapsed')){$that.removeClass('mw-collapsed');toggleLinkCustom($customTogglers,null,$that);}}else{if($that.is('table')){var $firstRowCells=$that.find('tr:first th, tr:first td');$toggle=
$firstRowCells.find('> .mw-collapsible-toggle');if(!$toggle.length){$firstRowCells.eq(-1).prepend($toggleLink);}else{$toggleLink=$toggle.off('click.mw-collapse').on('click.mw-collapse',function(e){toggleLinkPremade($toggle,e);});}}else if($that.is('ul')||$that.is('ol')){var $firstItem=$that.find('li:first');$toggle=$firstItem.find('> .mw-collapsible-toggle');if(!$toggle.length){var firstval=$firstItem.attr('value');if(firstval===undefined||!firstval||firstval==='-1'||firstval===-1){$firstItem.attr('value','1');}$that.prepend($toggleLink.wrap('<li class="mw-collapsible-toggle-li"></li>').parent());}else{$toggleLink=$toggle.off('click.mw-collapse').on('click.mw-collapse',function(e){toggleLinkPremade($toggle,e);});}}else{$toggle=$that.find('> .mw-collapsible-toggle');if(!$that.find('> .mw-collapsible-content').length){$that.wrapInner('<div class="mw-collapsible-content"></div>');}if(!$toggle.length){$that.prepend($toggleLink);}else{$toggleLink=$toggle.off('click.mw-collapse').on(
'click.mw-collapse',function(e){toggleLinkPremade($toggle,e);});}}}if($that.hasClass('mw-collapsed')&&($that.attr('id')||'').indexOf('mw-customcollapsible-')!==0){$that.removeClass('mw-collapsed');toggleElement($that,'collapse',$toggleLink.eq(0),true);$toggleLink.eq(0).click();}});};}(jQuery,mediaWiki));;},{"css":[".mw-collapsible-toggle{float:right} li .mw-collapsible-toggle{float:none} .mw-collapsible-toggle-li{list-style:none}\n/* cache key: negusweb_wiki:resourceloader:filter:minify-css:7:4250852ed2349a0d4d0fc6509a3e7d4c */"]},{"collapsible-expand":"Espandi","collapsible-collapse":"Comprimi"});mw.loader.implement("jquery.mw-jump",function(){jQuery(function($){$('.mw-jump').delegate('a','focus blur',function(e){if(e.type==="blur"||e.type==="focusout"){$(this).closest('.mw-jump').css({height:'0'});}else{$(this).closest('.mw-jump').css({height:'auto'});}});});;},{},{});mw.loader.implement("jquery.placeholder",function(){(function($){$.fn.placeholder=function(){return this.each(
function(){var placeholder,$input;if(this.placeholder&&'placeholder'in document.createElement(this.tagName)){return;}placeholder=this.getAttribute('placeholder');$input=$(this);if(this.value===''||this.value===placeholder){$input.addClass('placeholder').val(placeholder);}$input.blur(function(){if(this.value===''){this.value=placeholder;$input.addClass('placeholder');}}).on('focus drop keydown paste',function(e){if($input.hasClass('placeholder')){if(e.type==='drop'&&e.originalEvent.dataTransfer){try{this.value=e.originalEvent.dataTransfer.getData('text/plain');}catch(exception){this.value=e.originalEvent.dataTransfer.getData('text');}e.preventDefault();}else{this.value='';}$input.removeClass('placeholder');}});if(this.form){$(this.form).submit(function(){if($input.hasClass('placeholder')){$input.val('').removeClass('placeholder');}});}});};}(jQuery));;},{},{});mw.loader.implement("jquery.suggestions",function(){(function($){$.suggestions={cancel:function(context){if(context.data.timerID
!==null){clearTimeout(context.data.timerID);}if($.isFunction(context.config.cancel)){context.config.cancel.call(context.data.$textbox);}},restore:function(context){context.data.$textbox.val(context.data.prevText);},update:function(context,delayed){function maybeFetch(){if(context.data.$textbox.val().length===0){context.data.$container.hide();context.data.prevText='';}else if(context.data.$textbox.val()!==context.data.prevText){if(typeof context.config.fetch==='function'){context.data.prevText=context.data.$textbox.val();context.config.fetch.call(context.data.$textbox,context.data.$textbox.val());}}}if(context.data.timerID!==null){clearTimeout(context.data.timerID);}if(delayed){context.data.timerID=setTimeout(maybeFetch,context.config.delay);}else{maybeFetch();}$.suggestions.special(context);},special:function(context){if(typeof context.config.special.render==='function'){setTimeout(function(){var $special=context.data.$container.find('.suggestions-special');context.config.special.
render.call($special,context.data.$textbox.val());},1);}},configure:function(context,property,value){var newCSS;switch(property){case'fetch':case'cancel':case'special':case'result':case'$region':case'expandFrom':context.config[property]=value;break;case'suggestions':context.config[property]=value;if(context.data!==undefined){if(context.data.$textbox.val().length===0){context.data.$container.hide();}else{context.data.$container.show();newCSS={top:context.config.$region.offset().top+context.config.$region.outerHeight(),bottom:'auto',width:context.config.$region.outerWidth(),height:'auto'};context.config.expandFrom=(function(expandFrom){var regionWidth,docWidth,regionCenter,docCenter,docDir=$(document.documentElement).css('direction'),$region=context.config.$region;if(context.config.positionFromLeft){expandFrom='left';}else if($.inArray(expandFrom,['left','right','start','end','auto'])===-1){expandFrom='auto';}if(expandFrom==='auto'){if($region.data('searchsuggest-expand-dir')){expandFrom
=$region.data('searchsuggest-expand-dir');}else{regionWidth=$region.outerWidth();docWidth=$(document).width();if((regionWidth/docWidth)>0.85){expandFrom='start';}else{regionCenter=$region.offset().left+regionWidth/2;docCenter=docWidth/2;if(Math.abs(regionCenter-docCenter)/docCenter<0.10){expandFrom='start';}else{expandFrom=regionCenter>docCenter?'right':'left';}}}}if(expandFrom==='start'){expandFrom=docDir==='rtl'?'right':'left';}else if(expandFrom==='end'){expandFrom=docDir==='rtl'?'left':'right';}return expandFrom;}(context.config.expandFrom));if(context.config.expandFrom==='left'){newCSS.left=context.config.$region.offset().left;newCSS.right='auto';}else{newCSS.left='auto';newCSS.right=$('body').width()-(context.config.$region.offset().left+context.config.$region.outerWidth());}context.data.$container.css(newCSS);var $results=context.data.$container.children('.suggestions-results');$results.empty();var expWidth=-1;var $autoEllipseMe=$([]);var matchedText=null;for(var i=0;i<context.
config.suggestions.length;i++){var text=context.config.suggestions[i];var $result=$('<div>').addClass('suggestions-result').attr('rel',i).data('text',context.config.suggestions[i]).mousemove(function(e){context.data.selectedWithMouse=true;$.suggestions.highlight(context,$(this).closest('.suggestions-results div'),false);}).appendTo($results);if(typeof context.config.result.render==='function'){context.config.result.render.call($result,context.config.suggestions[i]);}else{if(context.config.highlightInput){matchedText=context.data.prevText;}$result.append($('<span>').css('whiteSpace','nowrap').text(text));var $span=$result.children('span');if($span.outerWidth()>$result.width()&&$span.outerWidth()>expWidth){expWidth=$span.outerWidth()+(context.data.$container.width()-$span.parent().width());}$autoEllipseMe=$autoEllipseMe.add($result);}}if(expWidth>context.data.$container.width()){var maxWidth=context.config.maxExpandFactor*context.data.$textbox.width();context.data.$container.width(Math.
min(expWidth,maxWidth));}$autoEllipseMe.autoEllipsis({hasSpan:true,tooltip:true,matchText:matchedText});}}break;case'maxRows':context.config[property]=Math.max(1,Math.min(100,value));break;case'delay':context.config[property]=Math.max(0,Math.min(1200,value));break;case'maxExpandFactor':context.config[property]=Math.max(1,value);break;case'submitOnClick':case'positionFromLeft':case'highlightInput':context.config[property]=value?true:false;break;}},highlight:function(context,result,updateTextbox){var selected=context.data.$container.find('.suggestions-result-current');if(!result.get||selected.get(0)!==result.get(0)){if(result==='prev'){if(selected.is('.suggestions-special')){result=context.data.$container.find('.suggestions-result:last');}else{result=selected.prev();if(selected.length===0){if(context.data.$container.find('.suggestions-special').html()!==''){result=context.data.$container.find('.suggestions-special');}else{result=context.data.$container.find(
'.suggestions-results div:last');}}}}else if(result==='next'){if(selected.length===0){result=context.data.$container.find('.suggestions-results div:first');if(result.length===0&&context.data.$container.find('.suggestions-special').html()!==''){result=context.data.$container.find('.suggestions-special');}}else{result=selected.next();if(selected.is('.suggestions-special')){result=$([]);}else if(result.length===0&&context.data.$container.find('.suggestions-special').html()!==''){result=context.data.$container.find('.suggestions-special');}}}selected.removeClass('suggestions-result-current');result.addClass('suggestions-result-current');}if(updateTextbox){if(result.length===0||result.is('.suggestions-special')){$.suggestions.restore(context);}else{context.data.$textbox.val(result.data('text'));context.data.$textbox.change();}context.data.$textbox.trigger('change');}},keypress:function(e,context,key){var wasVisible=context.data.$container.is(':visible'),preventDefault=false;switch(key){case
40:if(wasVisible){$.suggestions.highlight(context,'next',true);context.data.selectedWithMouse=false;}else{$.suggestions.update(context,false);}preventDefault=true;break;case 38:if(wasVisible){$.suggestions.highlight(context,'prev',true);context.data.selectedWithMouse=false;}preventDefault=wasVisible;break;case 27:context.data.$container.hide();$.suggestions.restore(context);$.suggestions.cancel(context);context.data.$textbox.trigger('change');preventDefault=wasVisible;break;case 13:context.data.$container.hide();preventDefault=wasVisible;var selected=context.data.$container.find('.suggestions-result-current');if(selected.length===0||context.data.selectedWithMouse){$.suggestions.cancel(context);context.config.$region.closest('form').submit();}else if(selected.is('.suggestions-special')){if(typeof context.config.special.select==='function'){context.config.special.select.call(selected,context.data.$textbox);}}else{if(typeof context.config.result.select==='function'){$.suggestions.
highlight(context,selected,true);context.config.result.select.call(selected,context.data.$textbox);}else{$.suggestions.highlight(context,selected,true);}}break;default:$.suggestions.update(context,true);break;}if(preventDefault){e.preventDefault();e.stopImmediatePropagation();}}};$.fn.suggestions=function(){var returnValue,args=arguments;$(this).each(function(){var context,key;context=$(this).data('suggestions-context');if(context===undefined||context===null){context={config:{'fetch':function(){},'cancel':function(){},'special':{},'result':{},'$region':$(this),'suggestions':[],'maxRows':7,'delay':120,'submitOnClick':false,'maxExpandFactor':3,'expandFrom':'auto','highlightInput':false}};}if(args.length>0){if(typeof args[0]==='object'){for(key in args[0]){$.suggestions.configure(context,key,args[0][key]);}}else if(typeof args[0]==='string'){if(args.length>1){$.suggestions.configure(context,args[0],args[1]);}else if(returnValue===null||returnValue===undefined){returnValue=(args[0]in
context.config?undefined:context.config[args[0]]);}}}if(context.data===undefined){context.data={timerID:null,prevText:null,visibleResults:0,mouseDownOn:$([]),$textbox:$(this),selectedWithMouse:false};context.data.$container=$('<div>').css('display','none').addClass('suggestions').append($('<div>').addClass('suggestions-results').mousedown(function(e){context.data.mouseDownOn=$(e.target).closest('.suggestions-results div');}).mouseup(function(e){var $result=$(e.target).closest('.suggestions-results div');var $other=context.data.mouseDownOn;context.data.mouseDownOn=$([]);if($result.get(0)!==$other.get(0)){return;}$.suggestions.highlight(context,$result,true);context.data.$container.hide();if(typeof context.config.result.select==='function'){context.config.result.select.call($result,context.data.$textbox);}context.data.$textbox.focus();})).append($('<div>').addClass('suggestions-special').mousedown(function(e){context.data.mouseDownOn=$(e.target).closest('.suggestions-special');}).mouseup
(function(e){var $special=$(e.target).closest('.suggestions-special');var $other=context.data.mouseDownOn;context.data.mouseDownOn=$([]);if($special.get(0)!==$other.get(0)){return;}context.data.$container.hide();if(typeof context.config.special.select==='function'){context.config.special.select.call($special,context.data.$textbox);}context.data.$textbox.focus();}).mousemove(function(e){context.data.selectedWithMouse=true;$.suggestions.highlight(context,$(e.target).closest('.suggestions-special'),false);})).appendTo($('body'));$(this).attr('autocomplete','off').keydown(function(e){context.data.keypressed=e.which;context.data.keypressedCount=0;switch(context.data.keypressed){case 40:e.preventDefault();e.stopImmediatePropagation();break;case 38:case 27:case 13:if(context.data.$container.is(':visible')){e.preventDefault();e.stopImmediatePropagation();}}}).keypress(function(e){context.data.keypressedCount++;$.suggestions.keypress(e,context,context.data.keypressed);}).keyup(function(e){if(
context.data.keypressedCount===0){$.suggestions.keypress(e,context,context.data.keypressed);}}).blur(function(){if(context.data.mouseDownOn.length>0){return;}context.data.$container.hide();$.suggestions.cancel(context);});}$(this).data('suggestions-context',context);});return returnValue!==undefined?returnValue:$(this);};}(jQuery));;},{"css":[
".suggestions{overflow:hidden;position:absolute;top:0;left:0;width:0;border:none;z-index:1099;padding:0;margin:-1px -1px 0 0} html \x3e body .suggestions{margin:-1px 0 0 0}.suggestions-special{position:relative;background-color:white;cursor:pointer;border:solid 1px #aaaaaa;padding:0;margin:0;margin-top:-2px;display:none;padding:0.25em 0.25em;line-height:1.25em}.suggestions-results{background-color:white;cursor:pointer;border:solid 1px #aaaaaa;padding:0;margin:0}.suggestions-result{color:black;margin:0;line-height:1.5em;padding:0.01em 0.25em;text-align:left}.suggestions-result-current{background-color:#4C59A6;color:white}.suggestions-special .special-label{color:gray;text-align:left}.suggestions-special .special-query{color:black;font-style:italic;text-align:left}.suggestions-special .special-hover{background-color:silver}.suggestions-result-current .special-label,.suggestions-result-current .special-query{color:white}.autoellipsis-matched,.highlight{font-weight:bold}\n/* cache key: negusweb_wiki:resourceloader:filter:minify-css:7:9780324491b653a3780e2d029bdc140c */"
]},{});mw.loader.implement("mediawiki.api",function(){(function(mw,$){var defaultOptions={parameters:{action:'query',format:'json'},ajax:{url:mw.util.wikiScript('api'),timeout:30*1000,dataType:'json'}};mw.Api=function(options){if(options===undefined){options={};}if(options.ajax&&options.ajax.url!==undefined){options.ajax.url=String(options.ajax.url);}options.parameters=$.extend({},defaultOptions.parameters,options.parameters);options.ajax=$.extend({},defaultOptions.ajax,options.ajax);this.defaults=options;};mw.Api.prototype={normalizeAjaxOptions:function(arg){var opts=arg||{};if(typeof arg==='function'){opts={ok:arg};}return opts;},get:function(parameters,ajaxOptions){ajaxOptions=this.normalizeAjaxOptions(ajaxOptions);ajaxOptions.type='GET';return this.ajax(parameters,ajaxOptions);},post:function(parameters,ajaxOptions){ajaxOptions=this.normalizeAjaxOptions(ajaxOptions);ajaxOptions.type='POST';return this.ajax(parameters,ajaxOptions);},ajax:function(parameters,ajaxOptions){var token,
apiDeferred=$.Deferred();parameters=$.extend({},this.defaults.parameters,parameters);ajaxOptions=$.extend({},this.defaults.ajax,ajaxOptions);if(parameters.token){token=parameters.token;delete parameters.token;}ajaxOptions.data=$.param(parameters).replace(/\./g,'%2E');if(token){ajaxOptions.data+='&token='+encodeURIComponent(token);}if(ajaxOptions.ok){apiDeferred.done(ajaxOptions.ok);delete ajaxOptions.ok;}if(ajaxOptions.err){apiDeferred.fail(ajaxOptions.err);delete ajaxOptions.err;}$.ajax(ajaxOptions).fail(function(xhr,textStatus,exception){apiDeferred.reject('http',{xhr:xhr,textStatus:textStatus,exception:exception});}).done(function(result){if(result===undefined||result===null||result===''){apiDeferred.reject('ok-but-empty','OK response but empty result (check HTTP headers?)');}else if(result.error){var code=result.error.code===undefined?'unknown':result.error.code;apiDeferred.reject(code,result);}else{apiDeferred.resolve(result);}});return apiDeferred.promise().fail(function(code,
details){mw.log('mw.Api error: ',code,details);});}};mw.Api.errors=['ok-but-empty','timeout','duplicate','duplicate-archive','noimageinfo','uploaddisabled','nomodule','mustbeposted','badaccess-groups','stashfailed','missingresult','missingparam','invalid-file-key','copyuploaddisabled','mustbeloggedin','empty-file','file-too-large','filetype-missing','filetype-banned','filetype-banned-type','filename-tooshort','illegal-filename','verification-error','hookaborted','unknown-error','internal-error','overwrite','badtoken','fetchfileerror','fileexists-shared-forbidden','invalidtitle','notloggedin'];mw.Api.warnings=['duplicate','exists'];}(mediaWiki,jQuery));;},{},{});mw.loader.implement("mediawiki.searchSuggest",function(){(function(mw,$){$(document).ready(function($){var map,searchboxesSelectors,$searchRegion=$('#simpleSearch, #searchInput').first(),$searchInput=$('#searchInput');map={browsers:{ltr:{opera:[['>=',9.6]],docomo:false,blackberry:false,ipod:false,iphone:false},rtl:{opera:[['>=',
9.6]],docomo:false,blackberry:false,ipod:false,iphone:false}}};if(!$.client.test(map)){return;}searchboxesSelectors=['#searchInput','#searchInput2','#powerSearchText','#searchText','.mw-searchInput'];$(searchboxesSelectors.join(', ')).suggestions({fetch:function(query){var $el,jqXhr;if(query.length!==0){$el=$(this);jqXhr=$.ajax({url:mw.util.wikiScript('api'),data:{format:'json',action:'opensearch',search:query,namespace:0,suggest:''},dataType:'json',success:function(data){if($.isArray(data)&&data.length){$el.suggestions('suggestions',data[1]);}}});$el.data('request',jqXhr);}},cancel:function(){var jqXhr=$(this).data('request');if(jqXhr&&$.isFunction(jqXhr.abort)){jqXhr.abort();$(this).removeData('request');}},result:{select:function($input){$input.closest('form').submit();}},delay:120,highlightInput:true}).bind('paste cut drop',function(){$(this).trigger('keypress');});if($searchRegion.length===0){return;}$searchInput.attr('placeholder',mw.msg('searchsuggest-search')).placeholder();
$searchInput.suggestions({result:{select:function($input){$input.closest('form').submit();}},special:{render:function(query){var $el=this;if($el.children().length===0){$el.append($('<div>').addClass('special-label').text(mw.msg('searchsuggest-containing')),$('<div>').addClass('special-query').text(query).autoEllipsis()).show();}else{$el.find('.special-query').text(query).autoEllipsis();}},select:function($input){$input.closest('form').append($('<input type="hidden" name="fulltext" value="1"/>'));$input.closest('form').submit();}},$region:$searchRegion});$searchInput.data('suggestions-context').data.$container.css('fontSize',$searchInput.css('fontSize'));});}(mediaWiki,jQuery));;},{},{"searchsuggest-search":"Ricerca","searchsuggest-containing":"contenente..."});mw.loader.implement("mediawiki.user",function(){(function(mw,$){function User(options,tokens){var user,callbacks;user=this;callbacks={};function getUserInfo(info,callback){var api;if(callbacks[info]){callbacks[info].add(callback)
;return;}callbacks.rights=$.Callbacks('once memory');callbacks.groups=$.Callbacks('once memory');callbacks[info].add(callback);api=new mw.Api();api.get({action:'query',meta:'userinfo',uiprop:'rights|groups'}).always(function(data){var rights,groups;if(data.query&&data.query.userinfo){rights=data.query.userinfo.rights;groups=data.query.userinfo.groups;}callbacks.rights.fire(rights||[]);callbacks.groups.fire(groups||[]);});}this.options=options||new mw.Map();this.tokens=tokens||new mw.Map();function generateId(){var i,r,id='',seed='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';for(i=0;i<32;i++){r=Math.floor(Math.random()*seed.length);id+=seed.substring(r,r+1);}return id;}this.getName=function(){return mw.config.get('wgUserName');};this.name=function(){return this.getName();};this.isAnon=function(){return user.getName()===null;};this.anonymous=function(){return user.isAnon();};this.sessionId=function(){var sessionId=$.cookie('mediaWiki.user.sessionId');if(typeof sessionId
==='undefined'||sessionId===null){sessionId=generateId();$.cookie('mediaWiki.user.sessionId',sessionId,{'expires':null,'path':'/'});}return sessionId;};this.id=function(){var id,name=user.getName();if(name){return name;}id=$.cookie('mediaWiki.user.id');if(typeof id==='undefined'||id===null){id=generateId();}$.cookie('mediaWiki.user.id',id,{expires:365,path:'/'});return id;};this.bucket=function(key,options){var cookie,parts,version,bucket,range,k,rand,total;options=$.extend({buckets:{},version:0,tracked:false,expires:30},options||{});cookie=$.cookie('mediaWiki.user.bucket:'+key);if(typeof cookie==='string'&&cookie.length>2&&cookie.indexOf(':')>0){parts=cookie.split(':');if(parts.length>1&&Number(parts[0])===options.version){version=Number(parts[0]);bucket=String(parts[1]);}}if(bucket===undefined){if(!$.isPlainObject(options.buckets)){throw'Invalid buckets error. Object expected for options.buckets.';}version=Number(options.version);range=0;for(k in options.buckets){range+=options.
buckets[k];}rand=Math.random()*range;total=0;for(k in options.buckets){bucket=k;total+=options.buckets[k];if(total>=rand){break;}}if(options.tracked){mw.loader.using('jquery.clickTracking',function(){$.trackAction('mediaWiki.user.bucket:'+key+'@'+version+':'+bucket);});}$.cookie('mediaWiki.user.bucket:'+key,version+':'+bucket,{'path':'/','expires':Number(options.expires)});}return bucket;};this.getGroups=function(callback){getUserInfo('groups',callback);};this.getRights=function(callback){getUserInfo('rights',callback);};}mw.user=new User(mw.user.options,mw.user.tokens);}(mediaWiki,jQuery));;},{},{});mw.loader.implement("mediawiki.page.ready",function(){jQuery(document).ready(function($){if(!('placeholder'in document.createElement('input'))){$('input[placeholder]').placeholder();}$('.mw-collapsible').makeCollapsible();if($('table.sortable').length){mw.loader.using('jquery.tablesorter',function(){$('table.sortable').tablesorter();});}$('input[type=checkbox]:not(.noshiftselect)').
checkboxShiftClick();mw.util.updateTooltipAccessKeys();});;},{},{});
/* cache key: negusweb_wiki:resourceloader:filter:minify-js:7:37af1dc1a2881df1ed16f1f0d5d13b28 */