    jQuery.noConflict();
    jQuery(document).ready(function($){

/********** jquery toogle function **********/
	$('#toggle-view li').click(function () {
		var text = $(this).children('p');

		if (text.is(':hidden')) {
			text.slideDown('200');
			jQuery(this).find('.toggle-indicator').text('-');
		} else {
			text.slideUp('200');
			$(this).find('.toggle-indicator').text('+');
		}
	});


$('#butContact').mouseover(function(){
		$(this).hide();
		$(this).css('background-position','50% -29px');
		$(this).fadeIn('normal');
	});

$('#butContact').mouseout(function(){
		$(this).hide();
		$(this).css('background-position','50% 0');
		$(this).fadeIn('normal');
	});

// PRETTY PHOTO INIT
$("a[rel^='prettyPhoto']").prettyPhoto();
	});