/*Superfish*/
(function($){var methods=function(){var c={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",menuArrowClass:"sf-arrows"},ios=function(){var ios=/iPhone|iPad|iPod/i.test(navigator.userAgent);if(ios)$(window).load(function(){$("body").children().on("click",$.noop)});return ios}(),wp7=function(){var style=document.documentElement.style;return"behavior"in style&&("fill"in style&&/iemobile/i.test(navigator.userAgent))}(),toggleMenuClasses=function($menu,o){var classes=c.menuClass;
if(o.cssArrows)classes+=" "+c.menuArrowClass;$menu.toggleClass(classes)},setPathToCurrent=function($menu,o){return $menu.find("li."+o.pathClass).slice(0,o.pathLevels).addClass(o.hoverClass+" "+c.bcClass).filter(function(){return $(this).children(o.popUpSelector).hide().show().length}).removeClass(o.pathClass)},toggleAnchorClass=function($li){$li.children("a").toggleClass(c.anchorClass)},toggleTouchAction=function($menu){var touchAction=$menu.css("ms-touch-action");touchAction=touchAction==="pan-y"?
"auto":"pan-y";$menu.css("ms-touch-action",touchAction)},applyHandlers=function($menu,o){var targets="li:has("+o.popUpSelector+")";if($.fn.hoverIntent&&!o.disableHI)$menu.hoverIntent(over,out,targets);else $menu.on("mouseenter.superfish",targets,over).on("mouseleave.superfish",targets,out);var touchevent="MSPointerDown.superfish";if(!ios)touchevent+=" touchend.superfish";if(wp7)touchevent+=" mousedown.superfish";$menu.on("focusin.superfish","li",over).on("focusout.superfish","li",out).on(touchevent,
"a",o,touchHandler)},touchHandler=function(e){var $this=$(this),$ul=$this.siblings(e.data.popUpSelector);if($ul.length>0&&$ul.is(":hidden")){$this.one("click.superfish",false);if(e.type==="MSPointerDown")$this.trigger("focus");else $.proxy(over,$this.parent("li"))()}},over=function(){var $this=$(this),o=getOptions($this);clearTimeout(o.sfTimer);$this.siblings().superfish("hide").end().superfish("show")},out=function(){var $this=$(this),o=getOptions($this);if(ios)$.proxy(close,$this,o)();else{clearTimeout(o.sfTimer);
o.sfTimer=setTimeout($.proxy(close,$this,o),o.delay)}},close=function(o){o.retainPath=$.inArray(this[0],o.$path)>-1;this.superfish("hide");if(!this.parents("."+o.hoverClass).length){o.onIdle.call(getMenu(this));if(o.$path.length)$.proxy(over,o.$path)()}},getMenu=function($el){return $el.closest("."+c.menuClass)},getOptions=function($el){return getMenu($el).data("sf-options")};return{hide:function(instant){if(this.length){var $this=this,o=getOptions($this);if(!o)return this;var not=o.retainPath===
true?o.$path:"",$ul=$this.find("li."+o.hoverClass).add(this).not(not).removeClass(o.hoverClass).children(o.popUpSelector),speed=o.speedOut;if(instant){$ul.show();speed=0}o.retainPath=false;o.onBeforeHide.call($ul);$ul.stop(true,true).animate(o.animationOut,speed,function(){var $this=$(this);o.onHide.call($this)})}return this},show:function(){var o=getOptions(this);if(!o)return this;var $this=this.addClass(o.hoverClass),$ul=$this.children(o.popUpSelector);o.onBeforeShow.call($ul);$ul.stop(true,true).animate(o.animation,
o.speed,function(){o.onShow.call($ul)});return this},destroy:function(){return this.each(function(){var $this=$(this),o=$this.data("sf-options"),$hasPopUp;if(!o)return false;$hasPopUp=$this.find(o.popUpSelector).parent("li");clearTimeout(o.sfTimer);toggleMenuClasses($this,o);toggleAnchorClass($hasPopUp);toggleTouchAction($this);$this.off(".superfish").off(".hoverIntent");$hasPopUp.children(o.popUpSelector).attr("style",function(i,style){return style.replace(/display[^;]+;?/g,"")});o.$path.removeClass(o.hoverClass+
" "+c.bcClass).addClass(o.pathClass);$this.find("."+o.hoverClass).removeClass(o.hoverClass);o.onDestroy.call($this);$this.removeData("sf-options")})},init:function(op){return this.each(function(){var $this=$(this);if($this.data("sf-options"))return false;var o=$.extend({},$.fn.superfish.defaults,op),$hasPopUp=$this.find(o.popUpSelector).parent("li");o.$path=setPathToCurrent($this,o);$this.data("sf-options",o);toggleMenuClasses($this,o);toggleAnchorClass($hasPopUp);toggleTouchAction($this);applyHandlers($this,
o);$hasPopUp.not("."+c.bcClass).superfish("hide",true);o.onInit.call(this)})}}}();$.fn.superfish=function(method,args){if(methods[method])return methods[method].apply(this,Array.prototype.slice.call(arguments,1));else if(typeof method==="object"||!method)return methods.init.apply(this,arguments);else return $.error("Method "+method+" does not exist on jQuery.fn.superfish")};$.fn.superfish.defaults={popUpSelector:"ul,.sf-mega",hoverClass:"sfHover",pathClass:"overrideThisToUse",pathLevels:1,delay:800,
animation:{opacity:"show"},animationOut:{opacity:"hide"},speed:"normal",speedOut:"fast",cssArrows:true,disableHI:false,onInit:$.noop,onBeforeShow:$.noop,onShow:$.noop,onBeforeHide:$.noop,onHide:$.noop,onIdle:$.noop,onDestroy:$.noop};$.fn.extend({hideSuperfishUl:methods.hide,showSuperfishUl:methods.show})})(jQuery);

/* Sidr */
(function(e){var t=false,n=false;var r={isUrl:function(e){var t=new RegExp("^(https?:\\/\\/)?"+"((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|"+"((\\d{1,3}\\.){3}\\d{1,3}))"+"(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*"+"(\\?[;&a-z\\d%_.~+=-]*)?"+"(\\#[-a-z\\d_]*)?$","i");if(!t.test(e)){return false}else{return true}},loadContent:function(e,t){e.html(t)},addPrefix:function(e){var t=e.attr("id"),n=e.attr("class");if(typeof t==="string"&&""!==t){e.attr("id",t.replace(/([A-Za-z0-9_.\-]+)/g,"sidr-id-$1"))}if(typeof n==="string"&&""!==n&&"sidr-inner"!==n){e.attr("class",n.replace(/([A-Za-z0-9_.\-]+)/g,"sidr-class-$1"))}e.removeAttr("style")},execute:function(r,s,o){if(typeof s==="function"){o=s;s="sidr"}else if(!s){s="sidr"}var u=e("#"+s),a=e(u.data("body")),f=e("html"),l=u.outerWidth(true),c=u.data("speed"),h=u.data("side"),p=u.data("displace"),d=u.data("onOpen"),v=u.data("onClose"),m,g,y,b=s==="sidr"?"sidr-open":"sidr-open "+s+"-open";if("open"===r||"toggle"===r&&!u.is(":visible")){if(u.is(":visible")||t){return}if(n!==false){i.close(n,function(){i.open(s)});return}t=true;if(h==="left"){m={left:l+"px"};g={left:"0px"}}else{m={right:l+"px"};g={right:"0px"}}if(a.is("body")){y=f.scrollTop();f.css("overflow-x","hidden").scrollTop(y)}if(p){a.addClass("sidr-animating").css({width:a.width(),position:"absolute"}).animate(m,c,function(){e(this).addClass(b)})}else{setTimeout(function(){e(this).addClass(b)},c)}u.css("display","block").animate(g,c,function(){t=false;n=s;if(typeof o==="function"){o(s)}a.removeClass("sidr-animating")});d()}else{if(!u.is(":visible")||t){return}t=true;if(h==="left"){m={left:0};g={left:"-"+l+"px"}}else{m={right:0};g={right:"-"+l+"px"}}if(a.is("body")){y=f.scrollTop();f.removeAttr("style").scrollTop(y)}a.addClass("sidr-animating").animate(m,c).removeClass(b);u.animate(g,c,function(){u.removeAttr("style").hide();a.removeAttr("style");e("html").removeAttr("style");t=false;n=false;if(typeof o==="function"){o(s)}a.removeClass("sidr-animating")});v()}}};var i={open:function(e,t){r.execute("open",e,t)},close:function(e,t){r.execute("close",e,t)},toggle:function(e,t){r.execute("toggle",e,t)},toogle:function(e,t){r.execute("toggle",e,t)}};e.sidr=function(t){if(i[t]){return i[t].apply(this,Array.prototype.slice.call(arguments,1))}else if(typeof t==="function"||typeof t==="string"||!t){return i.toggle.apply(this,arguments)}else{e.error("Method "+t+" does not exist on jQuery.sidr")}};e.fn.sidr=function(t){var n=e.extend({name:"sidr",speed:200,side:"left",source:null,renaming:true,body:"body",displace:true,onOpen:function(){},onClose:function(){}},t);var s=n.name,o=e("#"+s);if(o.length===0){o=e("<div />").attr("id",s).appendTo(e("body"))}o.addClass("sidr").addClass(n.side).data({speed:n.speed,side:n.side,body:n.body,displace:n.displace,onOpen:n.onOpen,onClose:n.onClose});if(typeof n.source==="function"){var u=n.source(s);r.loadContent(o,u)}else if(typeof n.source==="string"&&r.isUrl(n.source)){e.get(n.source,function(e){r.loadContent(o,e)})}else if(typeof n.source==="string"){var a="",f=n.source.split(",");e.each(f,function(t,n){a+='<div class="sidr-inner">'+e(n).html()+"</div>"});if(n.renaming){var l=e("<div />").html(a);l.find("*").each(function(t,n){var i=e(n);r.addPrefix(i)});a=l.html()}r.loadContent(o,a)}else if(n.source!==null){e.error("Invalid Sidr Source")}return this.each(function(){var t=e(this),n=t.data("sidr");if(!n){t.data("sidr",s);if("ontouchstart"in document.documentElement){t.bind("touchstart",function(e){var t=e.originalEvent.touches[0];this.touched=e.timeStamp});t.bind("touchend",function(e){var t=Math.abs(e.timeStamp-this.touched);if(t<200){e.preventDefault();i.toggle(s)}})}else{t.click(function(e){e.preventDefault();i.toggle(s)})}}})}})(jQuery);

/* global */
(function($) {
	"use strict";
	$(document).ready(function(){
		/* Main menu superfish*/
		$('ul.nav-menu').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast'
		});
		
		/* Mobile Menu*/
		$('#navigation-toggle').sidr({
			name: 'sidr-main',
			source: '#sidr-close, #site-nav',
			side: 'left',
			displace: false
		});
		$(".sidr-class-toggle-sidr-close").click( function() {
			$.sidr('close', 'sidr-main');
			return false;
		});
	}); 
})(jQuery);

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(5(a){4(1t 1l!=="1h"&&1l.2z){1l([],a)}X{4(1t 1y!=="1h"&&1y.1G){1y.1G=a()}X{13.1O=a()}}})(5(){3 c=5(){11 13.23||(Z.18&&Z.18.1X)||Z.1k.1X};3 G={};3 V=24;3 k=[];3 E="25";3 B="26";3 z="28";3 o="2i";3 l="2j";3 w="2l";3 n="2m";3 p=[E,B,z,o,l,w,n];3 F={7:0,6:0};3 y=5(){11 13.22||Z.18.1L};3 a=5(){11 2o.2q(Z.1k.1I,Z.18.1I,Z.1k.1w,Z.18.1w,Z.18.1L)};G.15=1d;G.1b=1d;G.1a=1d;G.1A=y();3 v;3 s;3 b;5 t(){G.15=c();G.1b=G.15+G.1A;G.1a=a();4(G.1a!==v){b=k.Y;1i(b--){k[b].1j()}v=G.1a}}5 r(){G.1A=y();t();q()}3 d;5 u(){2r(d);d=2y(r,2B)}3 h;5 q(){h=k.Y;1i(h--){k[h].19()}h=k.Y;1i(h--){k[h].1D()}}5 m(P,I){3 S=2;2.9=P;4(!I){2.16=F}X{4(I===+I){2.16={7:I,6:I}}X{2.16={7:I.7||F.7,6:I.6||F.6}}}2.8={};1c(3 N=0,M=p.Y;N<M;N++){S.8[p[N]]=[]}2.1e=1o;3 L;3 Q;3 R;3 O;3 H;3 e;5 K(i){4(i.Y===0){11}H=i.Y;1i(H--){e=i[H];e.1q.1p(S,s);4(e.1E){i.1m(H,1)}}}2.1D=5 J(){4(2.W&&!L){K(2.8[B])}4(2.14&&!Q){K(2.8[z])}4(2.12!==R&&2.17!==O){K(2.8[E]);4(!Q&&!2.14){K(2.8[z]);K(2.8[l])}4(!L&&!2.W){K(2.8[B]);K(2.8[o])}}4(!2.14&&Q){K(2.8[l])}4(!2.W&&L){K(2.8[o])}4(2.W!==L){K(2.8[E])}1K(1g){10 L!==2.W:10 Q!==2.14:10 R!==2.12:10 O!==2.17:K(2.8[n])}L=2.W;Q=2.14;R=2.12;O=2.17};2.1j=5(){4(2.1e){11}3 U=2.7;3 T=2.6;4(2.9.2k){3 j=2.9.1z.1x;4(j==="1Q"){2.9.1z.1x=""}3 i=2.9.27();2.7=i.7+G.15;2.6=i.6+G.15;4(j==="1Q"){2.9.1z.1x=j}}X{4(2.9===+2.9){4(2.9>0){2.7=2.6=2.9}X{2.7=2.6=G.1a-2.9}}X{2.7=2.9.7;2.6=2.9.6}}2.7-=2.16.7;2.6+=2.16.6;2.1u=2.6-2.7;4((U!==1h||T!==1h)&&(2.7!==U||2.6!==T)){K(2.8[w])}};2.1j();2.19();L=2.W;Q=2.14;R=2.12;O=2.17}m.1S={1s:5(e,j,i){1K(1g){10 e===E&&!2.W&&2.12:10 e===B&&2.W:10 e===z&&2.14:10 e===o&&2.12&&!2.W:10 e===l&&2.12:j.1p(2,s);4(i){11}}4(2.8[e]){2.8[e].1U({1q:j,1E:i||1o})}X{1n 1f 1B("1Y 1Z 2n a 1v 21 20 1W 1V "+e+". 1T 1C 1R: "+p.1P(", "))}},29:5(H,I){4(2.8[H]){1c(3 e=0,j;j=2.8[H][e];e++){4(j.1q===I){2.8[H].1m(e,1);2a}}}X{1n 1f 1B("1Y 1Z 2b a 1v 21 20 1W 1V "+H+". 1T 1C 1R: "+p.1P(", "))}},2c:5(e,i){2.1s(e,i,1g)},2d:5(){2.1u=2.9.1w+2.16.7+2.16.6;2.6=2.7+2.1u},19:5(){2.12=2.7<G.15;2.17=2.6>G.1b;2.W=(2.7<=G.1b&&2.6>=G.15);2.14=(2.7>=G.15&&2.6<=G.1b)||(2.12&&2.17)},2e:5(){3 I=k.2f(2),e=2;k.1m(I,1);1c(3 J=0,H=p.Y;J<H;J++){e.8[p[J]].Y=0}},2g:5(){2.1e=1g},2h:5(){2.1e=1o}};3 g=5(e){11 5(j,i){2.1s.1p(2,e,j,i)}};1c(3 C=0,A=p.Y;C<A;C++){3 f=p[C];m.1S[f]=g(f)}1N{t()}1M(D){1N{13.$(t)}1M(D){1n 1f 1B("2p 1J 1H 2s 1O 2t 2u <2v>, 1J 1H 2w 2x.")}}5 x(e){s=e;t();q()}4(13.1r){13.1r("1v",x);13.1r("2A",u)}X{13.1F("2C",x);13.1F("2D",u)}G.2E=G.2F=5(i,j){4(1t i==="2G"){i=Z.2H(i)}X{4(i&&i.Y>0){i=i[0]}}3 e=1f m(i,j);k.1U(e);e.19();11 e};G.19=5(){s=1d;t();q()};G.2I=5(){G.1a=0;G.19()};11 G});',62,169,'||this|var|if|function|bottom|top|callbacks|watchItem|||||||||||||||||||||||||||||||||||||||||||||||||isInViewport|else|length|document|case|return|isAboveViewport|window|isFullyInViewport|viewportTop|offsets|isBelowViewport|documentElement|update|documentHeight|viewportBottom|for|null|locked|new|true|undefined|while|recalculateLocation|body|define|splice|throw|false|call|callback|addEventListener|on|typeof|height|scroll|offsetHeight|display|module|style|viewportHeight|Error|options|triggerCallbacks|isOne|attachEvent|exports|must|scrollHeight|you|switch|clientHeight|catch|try|scrollMonitor|join|none|are|prototype|Your|push|type|of|scrollTop|Tried|to|listener|monitor|innerHeight|pageYOffset|87|visibilityChange|enterViewport|getBoundingClientRect|fullyEnterViewport|off|break|remove|one|recalculateSize|destroy|indexOf|lock|unlock|exitViewport|partiallyExitViewport|nodeName|locationChange|stateChange|add|Math|If|max|clearTimeout|put|in|the|head|use|jQuery|setTimeout|amd|resize|100|onscroll|onresize|beget|create|string|querySelector|recalculateLocations'.split('|'),0,{}))


$(document).ready(function() {
	/* 菜单*/
	var $account = $('#top-header');
	var $header = $('#menu-box, #search-main, #mobile-nav');
	var $minisb = $('#content');
	var $footer = $('#footer');

	var accountWatcher = scrollMonitor.create($account);
	var headerWatcher = scrollMonitor.create($header);

	var footerWatcherTop = $minisb.height() + $header.height();
	var footerWatcher = scrollMonitor.create($footer, {
		top: footerWatcherTop
	});

	accountWatcher.lock();
	headerWatcher.lock();

	accountWatcher.visibilityChange(function() {
		$header.toggleClass('shadow', !accountWatcher.isInViewport);
	});
	headerWatcher.visibilityChange(function() {
		$minisb.toggleClass('shadow', !headerWatcher.isInViewport);
	});

	footerWatcher.fullyEnterViewport(function() {
		if (footerWatcher.isAboveViewport) {
			$minisb.removeClass('shadow').addClass('hug-footer')
		}
	});
	footerWatcher.partiallyExitViewport(function() {
		if (!footerWatcher.isAboveViewport) {
			$minisb.addClass('fixed').removeClass('hug-footer')
		}
	});
});


$(document).ready(function() {
    var index_h = $("#scroll").height() + 50 - $("#log-box").height() - 10;
    $("#log-box").css("bottom", index_h + "px");
    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 10,
        mobile: false,
        live: true,
        callback: function(box) {}
    });
    if (! (/msie [6|7|8|9]/i.test(navigator.userAgent))) {
        wow.init();
    }
});

/*wow*/
$(document).ready(function(a) {

	if (typeof scrollMonitor != 'undefined') {
		a(".wow").each(function(i, el) {
			var ael = a(el),
			watcher = scrollMonitor.create(el, -100);
			ael.addClass('wow');
			watcher.enterViewport(function(ev) {
				ael.removeClass('fadeInUp');
			});
		});
	}
})

/*创建二维码窗口*/
$(document).ready(function() {
    if (!+ [1, ]) {
        present = "table";
    } else {
        present = "canvas";
    }
    $('#output').qrcode({
        render: present,
        text: window.location.href,
        width: "150",
        height: "150"
    });
});

$(document).ready(function() {
	
	/*选项卡小工具事件*/
	$('.tabber-contain').each(function() {
		$(this).find(".tabber-content").hide(); 
		$(this).find("ul.tabs li:first").addClass("active").show(); 
		$(this).find(".tabber-content:first").show();
	});

	/*On Click Event*/
	$("ul.tabs li").click(function(e) {
		$(this).parents('.tabber-contain').find("ul.tabs li").removeClass("active"); 
		$(this).addClass("active"); 
		$(this).parents('.tabber-contain').find(".tabber-content").hide(); 

		var activeTab = $(this).find("a").attr("href"); 
		$(this).parents('.tabber-contain').find(activeTab).fadeIn(); 

		e.preventDefault();
	});

	$("ul.tabs li a").click(function(e) {
		e.preventDefault();
	})


/* 搜索 */
$(".nav-search").click(function() {
	$("#search-main").fadeToggle(300);
});

$('#search-close').click(function() {
    $('#search-main').hide()
});	
	
/* 滚屏*/
$('.scroll-h').click(function() {
	$('html,body').animate({
		scrollTop: '0px'
	},
	800);
});
$('.scroll-c').click(function() {
	$('html,body').animate({
		scrollTop: $('.scroll-comments').offset().top
	},
	800);
});
$('.scroll-b').click(function() {
	$('html,body').animate({
		scrollTop: $('.site-info').offset().top
	},
	800);
});


/*二维码弹出层*/
$(".qr").mouseover(function() {
	$(this).children(".qr-img").show();
});
$(".qr").mouseout(function() {
	$(this).children(".qr-img").hide();
});


/* 字号放大*/
$("#fontsize").click(function() {
	var _this = $(this);
	var _t = $(".single-content");
	var _c = _this.attr("class");
	if (_c == "size_s") {
		_this.removeClass("size_s").addClass("size_l");
		_this.text("A+");
		_t.removeClass("fontsmall").addClass("fontlarge");
	} else {
		_this.removeClass("size_l").addClass("size_s");
		_this.text("A-");
		_t.removeClass("fontlarge").addClass("fontsmall");
	};
});

});

/* 图片延迟加载*/
$(".site-main img, .widget img, .load img, .single-content img,.avatar").lazyload({
	effect: "fadeIn",
	threshold: 100,
	failure_limit: 70
});


/*页面打印*/
var global_Html = "";
function printme() {
	global_Html = document.body.innerHTML;
	document.body.innerHTML = document.getElementById('primary').innerHTML;
	window.print();
	window.setTimeout(function() {
		document.body.innerHTML = global_Html;
	}, 500);
};

/* 隐藏侧边*/
function siderhidden() {
	var R = document.getElementById("sidebar");
	var L = document.getElementById("primary");
	if (R.className == "sidebar") {
		R.className = "sidebar-hide";
		L.className = "";
	} else {
		R.className = "sidebar";
		L.className = "primary";
	}
}




$(document).ready(function() {
  	/* 侧边栏跟随*/
     $('#sidebar').theiaStickySidebar({
        additionalMarginTop: 30
     }); 
  	/* 侧边栏跟随*/
     $('#primary').theiaStickySidebar({
        additionalMarginTop: 75
     }); 
    
});

/*ajax评论*/
jQuery(document).ready(function(jQuery) {
	var __cancel = jQuery('#cancel-comment-reply-link'),
		__cancel_text = __cancel.text(),
		__list = 'comment-list';
	jQuery(document).on("submit", "#commentform", function() {
		jQuery.ajax({
			url: ajaxcomment.ajax_url,
			data: jQuery(this).serialize() + "&action=ajax_comment",
			type: jQuery(this).attr('method'),
			beforeSend: addComment.createButterbar("提交中...."),
			error: function(request) {
				var t = addComment;
				t.createButterbar(request.responseText);
			},
			success: function(data) {
				jQuery('textarea').each(function() {
					this.value = ''
				});
				var t = addComment,
					cancel = t.I('cancel-comment-reply-link'),
					temp = t.I('wp-temp-form-div'),
					respond = t.I(t.respondId),
					post = t.I('comment_post_ID').value,
					parent = t.I('comment_parent').value;
				if (parent != '0') {
					jQuery('#respond').before('<ol class="children">' + data + '</ol>');
				} else if (!jQuery('.' + __list ).length) {
					if (ajaxcomment.formpostion == 'bottom') {
						jQuery('#respond').before('<ol class="' + __list + '">' + data + '</ol>');
					} else {
						jQuery('#respond').after('<ol class="' + __list + '">' + data + '</ol>');
					}

				} else {
					if (ajaxcomment.order == 'asc') {
						jQuery('.' + __list ).append(data); 
					} else {
						jQuery('.' + __list ).prepend(data); 
					}
				}
				t.createButterbar("提交成功");
				cancel.style.display = 'none';
				cancel.onclick = null;
				t.I('comment_parent').value = '0';
				if (temp && respond) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp)
				}
			}
		});
		return false;
	});
	addComment = {
		moveForm: function(commId, parentId, respondId) {
			var t = this,
				div, comm = t.I(commId),
				respond = t.I(respondId),
				cancel = t.I('cancel-comment-reply-link'),
				parent = t.I('comment_parent'),
				post = t.I('comment_post_ID');
			__cancel.text(__cancel_text);
			t.respondId = respondId;
			if (!t.I('wp-temp-form-div')) {
				div = document.createElement('div');
				div.id = 'wp-temp-form-div';
				div.style.display = 'none';
				respond.parentNode.insertBefore(div, respond)
			}!comm ? (temp = t.I('wp-temp-form-div'), t.I('comment_parent').value = '0', temp.parentNode.insertBefore(respond, temp), temp.parentNode.removeChild(temp)) : comm.parentNode.insertBefore(respond, comm.nextSibling);
			jQuery("body").animate({
				scrollTop: jQuery('#respond').offset().top - 180
			}, 400);
			parent.value = parentId;
			cancel.style.display = '';
			cancel.onclick = function() {
				var t = addComment,
					temp = t.I('wp-temp-form-div'),
					respond = t.I(t.respondId);
				t.I('comment_parent').value = '0';
				if (temp && respond) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp);
				}
				this.style.display = 'none';
				this.onclick = null;
				return false;
			};
			try {
				t.I('comment').focus();
			} catch (e) {}
			return false;
		},
		I: function(e) {
			return document.getElementById(e);
		},
		clearButterbar: function(e) {
			if (jQuery(".butterBar").length > 0) {
				jQuery(".butterBar").remove();
			}
		},
		createButterbar: function(message) {
			var t = this;
			t.clearButterbar();
      jQuery("#respond").after('<div class="butterBar butterBar--center"><p class="butterBar-message">' + message + '</p></div>');

			setTimeout("jQuery('.butterBar').remove()", 3000);
		}
	};
});

jQuery(document).ready(function() {
	
	  
    jQuery('.flexslider').flexslider({
        animation: "fade",
        slideshowSpeed: 7000,
        animationSpeed: 600,
        controlNav: true,
        slideshow: true,
        randomize: false,
        pauseOnHover: true,
        prevText: "",
        nextText: "",
        after: function(slider) {
            jQuery('.flexslider .slider-caption').animate({
                bottom: 12,
            },
            400)
        },
        before: function(slider) {
            jQuery('.flexslider .slider-caption').animate({
                bottom: 12,
            },
            400)
        },
        start: function(slider) {
        	  var slidercount=jQuery(".slides li").length;
            var slide_control_width = 100 / slidercount;
            jQuery('.flexslider .flex-control-nav li').css('width', slide_control_width + '%');
            jQuery('.flexslider .slider-caption').animate({
                bottom: 12,
            },
            400)
        }
    });
});

