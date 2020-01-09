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