var swfurl=youkujs.swfurl||"http://player.youku.com/player.php/sid/v.swf",domready=function(){function k(){if(!d.isReady){try{document.documentElement.doScroll("left")}catch(e){setTimeout(k,1);return}d.ready()}}var i,f,l={"[object Boolean]":"boolean","[object Number]":"number","[object String]":"string","[object Function]":"function","[object Array]":"array","[object Date]":"date","[object RegExp]":"regexp","[object Object]":"object"},d={isReady:!1,readyWait:1,holdReady:function(e){e?d.readyWait++:
d.ready(!0)},ready:function(e){if(!0===e&&!--d.readyWait||!0!==e&&!d.isReady){if(!document.body)return setTimeout(d.ready,1);d.isReady=!0;!0!==e&&0<--d.readyWait||i.resolveWith(document,[d])}},bindReady:function(){if(!i){i=d._Deferred();if("complete"===document.readyState)return setTimeout(d.ready,1);if(document.addEventListener)document.addEventListener("DOMContentLoaded",f,!1),window.addEventListener("load",d.ready,!1);else if(document.attachEvent){document.attachEvent("onreadystatechange",f);window.attachEvent("onload",
d.ready);var e=!1;try{e=null==window.frameElement}catch(g){}document.documentElement.doScroll&&e&&k()}}},_Deferred:function(){var e=[],g,f,i,j={done:function(){if(!i){var f=arguments,h,k,a,b,c;g&&(c=g,g=0);h=0;for(k=f.length;h<k;h++)a=f[h],b=d.type(a),"array"===b?j.done.apply(j,a):"function"===b&&e.push(a);c&&j.resolveWith(c[0],c[1])}return this},resolveWith:function(d,h){if(!i&&!g&&!f){h=h||[];f=1;try{for(;e[0];)e.shift().apply(d,h)}finally{g=[d,h],f=0}}return this},resolve:function(){j.resolveWith(this,
arguments);return this},isResolved:function(){return!(!f&&!g)},cancel:function(){i=1;e=[];return this}};return j},type:function(e){return null==e?String(e):l[Object.prototype.toString.call(e)]||"object"}};document.addEventListener?f=function(){document.removeEventListener("DOMContentLoaded",f,!1);d.ready()}:document.attachEvent&&(f=function(){"complete"===document.readyState&&(document.detachEvent("onreadystatechange",f),d.ready())});return function(e){d.bindReady();d.type(e);i.done(e)}}();
domready(function(){var k=document.addEventListener?function(a,b,c){b.addEventListener(a,c,!1)}:document.attachEvent?function(a,b,c){b.attachEvent("on"+a,c)}:function(a,b,c){b["on"+a]=c},i=/[\n\t]/g,f=/\s+/,l=function(a){var b=[];try{b=Array.prototype.slice.call(a,0)}catch(c){for(var b=[],e=0,d;d=a[e++];)b.push(d)}return b},d=function(a,b){if(b&&"string"===typeof b||void 0===b){var c=(b||"").split(f);if(1===a.nodeType&&a.className)if(b){for(var d=(" "+a.className+" ").replace(i," "),e=0,h=c.length;e<
h;e++)d=d.replace(" "+c[e]+" "," ");a.className=p(d)}else a.className=""}},e=function(a,b,c){b=b||document;if(b.getElementsByClassName)return l(b.getElementsByClassName(a));for(var a=a.replace(/\-/g,"\\-"),d=[],b=b||document,c=l(b.getElementsByTagName(c||"*")),b=c.length,a=RegExp("(^|\\s)"+a+"(\\s|$)");b--;)a.test(c[b].className)&&d.push(c[b]);return d},g=function(a,b){if("undefined"!==a.length)for(var c=0,d=a.length;c<d&&!1!==b.call(a[c],c,a[c]);c++);else for(name in a)b.call(a[name],name,a[name])},
p=function(a){return a.replace(/^(\s|\u00A0)+/,"").replace(/(\s|\u00A0)+$/,"")};if(document.getElementById("ykv_youku-video")){var r=!!navigator.userAgent.match(/(iphone|ipod|ipad|android)/i),j=e("ykv_video"),n=function(a){g(j,function(){var b=this.getAttribute("youkuid");a==b&&this.click()})},h=980,q=514;n();g(j,function(){var a=this;k("click",a,function(){var b;b=0<=(" "+a.className+" ").replace(i," ").indexOf(" selected ")?!0:!1;if(!b){b=
a.getAttribute("youkuid");var c=e("selected",document.getElementById("ykv_youku-video"),"a"),g=a.parentNode.parentNode;c.length&&d(c[0],"selected");c="selected".split(f);if(1===a.nodeType)if(a.className){for(var j=" "+a.className+" ",l=a.className,o=0,n=c.length;o<n;o++)0>j.indexOf(" "+c[o]+" ")&&(l+=" "+c[o]);a.className=p(l)}else a.className="selected";(c=e("ykv_video-preview")[0])&&c.parentNode&&c.parentNode.removeChild(c);var m=document.createElement("div"),c=r?"<iframe height="+q+" width="+h+
' src="http://player.youku.com/embed/'+b+'" frameborder=0 allowfullscreen></iframe>':'<object class="video-object" type="application/x-shockwave-flash" data="'+swfurl+'" width="'+h+'" height="'+q+'"><param name="wmode" value="transparent" /><param name="wmode" value="opaque" /><param name="allowFullScreen" value="true"><param name="allowscriptaccess" value="always"><param name="isAutoPlay" value="true"><param name="flashvars" value="VideoIDS='+b+'&amp;isShowRelatedVideo=false&amp;showAd=0&amp;show_pre=0&amp;show_next=0&amp;isAutoPlay=true&amp;isDebug=false&amp;UserID=0&amp;winType=interior&amp;playMovie=true&amp;MMControl=false&amp;MMout=false"><param name="movie" value="'+
swfurl+'"></object>';m.className="ykv_video-preview";m.innerHTML='<div class="ykv_video-player container">'+c+'</div><div class="ykv_video-close"></div>';g&&g.parentNode&&g.parentNode.insertBefore(m,g.nextSibling);document.body.scrollTop=a.offsetTop+105;document.documentElement.scrollTop=a.offsetTop+105;k("click",e("ykv_video-close")[0],function(){m&&m.parentNode&&m.parentNode.removeChild(m);d(a,"selected")});window.location.hash="#"+b;document.title=a.title;window.console&&console.log("Going to play %s page %s",
document.title,"http://v.youku.com/v_show/id_"+b+".html")}})});k("hashchange",window,function(){n(window.location.hash.replace(/#/,""))});n(window.location.hash.replace(/#/,""))}});