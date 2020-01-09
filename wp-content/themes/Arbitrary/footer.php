<div id="footer">
	<div class="container">
		<p>©2013<?php bloginfo('name'); ?> <?php bloginfo('description'); ?>。</p>
	</div>
</div><!-- #footer -->
<?php if( IsMobile ){?>
<script type="text/javascript">
	var _id = function(_){
		return document.getElementById(_)
	};
					
	_id("mobile-menu").onclick = function(){
		if( _id("header").className == "selected" ){
			_id("header").className = ""
		}else{
			_id("header").className = "selected"
		}
	};
	
	for(var i=0; i< document.images.length; i++){
		document.images[i].removeAttribute("width");
		document.images[i].removeAttribute("height");
	}
</script>
<?php }?>
<script type="text/javascript">
/*富强民主文明和谐*/
    var a_idx = 0;
    jQuery(document).ready(function($) {
        $("body").click(function(e) {
            var a = new Array("富强", "民主", "文明", "和谐", "自由", "平等", "公正" ,"法治", "爱国", "敬业", "诚信", "友善", "手麻了", "歇会儿");
            var $i = $("<span/>").text(a[a_idx]);
            a_idx = (a_idx + 1) % a.length;
            var x = e.pageX,
            y = e.pageY;
            $i.css({
                "z-index": 9999,
                "top": y - 20,
                "left": x,
                "position": "absolute",
                "font-weight": "bold",
                "color": "#ff6651"
            });
            $("body").append($i);
            $i.animate({
                "top": y - 180,
                "opacity": 0
            },
            1500,
            function() {
                $i.remove();
            });
        });
    });
</script>
<?php wp_footer(); ?>
</body>
</html>
