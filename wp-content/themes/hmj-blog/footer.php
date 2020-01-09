	</div>
</div>
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			Copyright © 2015 | yconion 自酌一杯 | 沪ICP备13033667号 
		<!-- 请勿删除、修改作者版权信息，如删除或修改，网站则会无法访问！-->
		<!-- 版权开始-->
		<span style="float: right;">HMJ-Blog Theme by <a href="http://www.heminjie.com/">何敏杰</a> Powered by <a href="http://www.iztwp.com" target="_blank">WordPress</a></span>
		<!-- 版权结束-->
		</div>
	</footer>
<?php if ( is_singular() ){ ?>
<!-- Baidu Button BEGIN -->
<script>
window._bd_share_config = {
    "common": {
        "bdSnsKey": {},
        "bdText": "",
        "bdMini": "2",
        "bdMiniList": false,
        "bdPic": "",
        "bdStyle": "0",
        "bdSize": "16"
    },
    "share": {}
};
with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~ ( - new Date() / 36e5)];
</script>
<!-- Baidu Button END -->
<?php } ?>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/zan.js" charset="UTF-8"></script>
<?php } ?>



<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/backtop.js" charset="UTF-8"></script>


<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
/* 鼠标特效 */
$(function() {
    var a_idx = 0,
        b_idx = 0;
    c_idx = 0;
    jQuery(document).ready(function($) {
        $("body").click(function(e) {
            var a = new Array("欢迎您", "么么哒", "你真好", "棒棒哒", "真可爱", "你最美", "喜欢你", "真聪明", "爱你哦", "好厉害", "你真帅", "祝福你"),
                b = new Array("#09ebfc", "#ff6651", "#ffb351", "#51ff65", "#5197ff", "#a551ff", "#ff51f7", "#ff518e", "#ff5163", "#efff51"),
                c = new Array("12", "14", "16", "18", "20", "22", "24", "26", "28", "30");
            var $i = $("<span/>").text(a[a_idx]);
            a_idx = (a_idx + 1) % a.length;
            b_idx = (b_idx + 1) % b.length;
            c_idx = (c_idx + 1) % c.length;
            var x = e.pageX,
                y = e.pageY;
            $i.css({
                "z-index": 999,
                "top": y - 20,
                "left": x,
                "position": "absolute",
                "font-weight": "bold",
                "font-size": c[c_idx] + "px",
                "color": b[b_idx]
            });
            $("body").append($i);
            $i.animate({
                "top": y - 180,
                "opacity": 0
            }, 1500, function() {
                $i.remove();
            });
        });
    });
    var _hmt = _hmt || [];
})
</script>

<?php wp_footer(); ?>


</body>
</html>
