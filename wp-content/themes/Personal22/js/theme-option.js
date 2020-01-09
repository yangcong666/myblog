var g_CustomFileFrame;

jQuery(document).ready(function(){
    // image setting action
    jQuery('div.uploads_image .uploads_button').on("click", PDTUploadSingleThemeImage);
    jQuery('div.uploads_image .uploads_del').on("click", PDTDeLinkThemeImage);
    jQuery('div.uploads_image input[type="text"]').on("change", function(){
        jQuery(this).parents('.uploads_image').find('.uploads_image_show').find('img').attr("src", jQuery(this).val());
        jQuery(this).parents('.uploads_image').find('.uploads_image_show').removeClass('none');
    });
	

    //隔行换色
    //$('.form_table tr:even').addClass('alt');

    //经过TR变色
    // $('.form_table tr').hover(function(){
    //     if(!$(this).hasClass('over')){
    //         $(this).addClass('over');   
    //     }
    // },function(){
    //     if($(this).hasClass('over')){
    //         $(this).removeClass('over');
    //     }
    // })
    // 
    
    //右侧最小高度
    //alert($('#TabMenu').height());
    $('#TabContent').css('min-height',$('#TabMenu').height()+20+'px');



    //wnumber
    $('.wnumber').on("keydown keyup keypress change",function(){
        //alert($(this).val());
        if($(this).val()<0){
            $(this).val(0);
        }
    })

    //isFixed()
    isFixed();

    //settings submit
    $('.settings_submit').on('click', function () {
        $(this).html('<i class="icon-spinner icon-spin"></i> 保存中...');
        $(this).css('opacity',0.6);
    })

    //tooltip
    $('[data-toggle="tooltip"]').tooltip()


});


function PDTUploadSingleThemeImage() {

    if (typeof(g_CustomFileFrame)!=="undefined") {
        g_CustomFileFrame.close();
    }

    //Create WP media frame.
    g_CustomFileFrame = wp.media.frames.customHeader = wp.media({
        //Title of media manager frame
        title: "文件上传",
        library: {
            type: ''
        },
        button: {
            //Button text
            text: "确定选择"
        },
        //Do not allow multiple files, if you want multiple, set true
        multiple: false
    });

    var self = this;
    //callback for selected image
    g_CustomFileFrame.on('select', function(event) {
        var oAttachment = g_CustomFileFrame.state().get('selection').first().toJSON();

        jQuery(self).parents('.uploads_image').find('input[type="text"]').val(oAttachment.url);
        jQuery(self).parents('.uploads_image').find('.uploads_image_show').removeClass('none');
        jQuery(self).parents('.uploads_image').find('img').show();
        jQuery(self).parents('.uploads_image').find('img').attr("src", oAttachment.url);
    });

    //Open modal
    g_CustomFileFrame.open();
}

function PDTDeLinkThemeImage() {
    jQuery(this).parents('.uploads_image').find('input[type="text"]').val("");
    jQuery(this).parents('.uploads_image').find('.uploads_image_show').addClass('none');
    jQuery(this).parents('.uploads_image').find('img').attr("src", "");
    jQuery(this).parents('.uploads_image').find('img').hide();
}


// isFixed
function isFixed() {
    var topBtn = jQuery("#Wrap");
    jQuery(window).scroll(function() {
        var gotoTop = jQuery(this).scrollTop();
        if(gotoTop > 300) {
            //jQuery(topBtn).fadeIn("500");
            $('.settings_submit').addClass('isFixed');
        } else {
            //jQuery(topBtn).fadeOut("500");
            $('.settings_submit').removeClass('isFixed');
        }
    });
}