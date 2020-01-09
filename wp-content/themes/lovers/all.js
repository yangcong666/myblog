function goTop(acceleration, time) {
	acceleration = acceleration || 0.1;
	time = time || 16; 
	
	var x1 = 0;
	var y1 = 0;
	var x2 = 0;
	var y2 = 0;
	var x3 = 0;
	var y3 = 0;
	
	if (document.documentElement) {
		x1 = document.documentElement.scrollLeft || 0;
		y1 = document.documentElement.scrollTop || 0;
	}
	
	if (document.body) {
		x2 = document.body.scrollLeft || 0;
		y2 = document.body.scrollTop || 0;
	}
	
	var x3 = window.scrollX || 0;
	var y3 = window.scrollY || 0;
	var x = Math.max(x1, Math.max(x2, x3));
	var y = Math.max(y1, Math.max(y2, y3));
	var speed = 1 + acceleration;
	
	window.scrollTo(Math.floor(x / speed), Math.floor(y / speed));
	
	if(x > 0 || y > 0) {
		var invokeFunction = "goTop(" + acceleration + ", " + time + ")";
		window.setTimeout(invokeFunction, time);
	}
}
function externallinks() {
if (!document.getElementsByTagName) return;
var anchors = document.getElementsByTagName("a");
for (var i=0; i<anchors.length; i++) {
var anchor = anchors[i];
if (anchor.getAttribute("href") &&
anchor.getAttribute("rel") == "external nofollow")
anchor.target = "_blank";
}
}
window.onload = externallinks;

var clear="clear.gif" //path to clear.gif

pngfix=function(){var els=document.getElementsByTagName('*');var ip=/\.png/i;var i=els.length;while(i-- >0){var el=els[i];var es=el.style;if(el.src&&el.src.match(ip)&&!es.filter){es.height=el.height;es.width=el.width;es.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+el.src+"',sizingMethod='crop')";el.src=clear;}else{var elb=el.currentStyle.backgroundImage;if(elb.match(ip)){var path=elb.split('"');var rep=(el.currentStyle.backgroundRepeat=='no-repeat')?'crop':'scale';es.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+path[1]+"',sizingMethod='"+rep+"')";es.height=el.clientHeight+'px';es.backgroundImage='none';var elkids=el.getElementsByTagName('*');if (elkids){var j=elkids.length;if(el.currentStyle.position!="absolute")es.position='static';while (j-- >0)if(!elkids[j].style.position)elkids[j].style.position="relative";}}}}}
window.attachEvent('onload',pngfix);
jQuery(document).ready(function($){
 
$("a").mouseover(function(e){
	this.myTitle = this.title;
	this.myHref = this.href;
	this.myHref = (this.myHref.length > 30 ? this.myHref.toString().substring(0,30)+"..." : this.myHref);
	this.title = "";
	var tooltip = "<div id='tooltip'><p>"+this.myTitle+"<em>"+this.myHref+"</em>"+"</p></div>";
	$('body').append(tooltip);
	$('#tooltip').css({"opacity":"0.8","top":(e.pageY+20)+"px","left":(e.pageX+10)+"px"}).show('fast');
}).mouseout(function(){this.title = this.myTitle;$('#tooltip').remove();
}).mousemove(function(e){$('#tooltip').css({"top":(e.pageY+20)+"px","left":(e.pageX+10)+"px"});
});
 
});