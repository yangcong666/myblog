$(document).ready(function(e) {


    var contHeight=$(window).height();
    var docuHeight=$(document).height();


	$('#Menu').find('li').first().addClass('first');
	$('#Menu').find('li').last().addClass('last');
	//alert($('.menu_link').find('li').last().html());

	$('[data-toggle="tooltip"]').tooltip();


//文章内容图片居中
	if($(".theCon").find('img.aligncenter').attr('src')!=''){
		//alert($("#Singles").find('img.aligncenter').attr('src'));
		$(".theCon").find('img.aligncenter').parent().addClass('aligncenter');
	}

	//导航
    $('.menu_btn').on('click', function(event) {
        if($('body').hasClass('open')){
        	$('.mobile_menu').removeClass('open');
        	$('.mobile_menu').height('auto');
        	$('body').removeClass('open');
        	$('.container_body').height('auto');
        }else{
        	$('.mobile_menu').addClass('open');
        	$('.mobile_menu').height(contHeight);
        	$('body').addClass('open');
        	$('.container_body').height(contHeight-30);
        }
    });



	if($('.backlink').length){
		$('.backlink').attr('href',$('.the_category').find('a').first().attr('href'));
	}

//验证搜索	
	$("#searchform").submit(function(){
		if($("#s").val()==""){
			//alert("请输入搜索内容");
			$("#s").focus();
			return false;
		}
	})
	
	$(".the_hover img").hover(function(){$(this).stop().fadeTo(250, 0.6);},function(){$(this).stop().fadeTo(250, 1);});
	
	if($('.hca_loop').length){
		$('.hca_loop').hover(function(){
			$(this).find('.hca_loop_title').stop().animate({bottom:"0"},300);
		},function(){
			$(this).find('.hca_loop_title').stop().animate({bottom:"-220px"},300);
		})
	}

    //gotoTop
	gotoTop();



	

	
});




// Goto top function
function gotoTop() {
	var topBtn = jQuery("#to_top");
	var headtop = jQuery("#headtop");
	jQuery(window).scroll(function() {
		var gotoTop = jQuery(this).scrollTop();
		if(gotoTop > 500) {
			jQuery(topBtn).fadeIn("500");			
		} else {
			jQuery(topBtn).fadeOut("500");
		}
		if(gotoTop > 100) {
			if(headtop.length){jQuery(headtop).removeClass('big');}			
		} else {
			if(headtop.length){jQuery(headtop).addClass('big');}
		}
	});
	topBtn.on("click", function() {
		jQuery("body, html").animate({
			scrollTop: 0
		}, 300);
		return false;
	});
}


















