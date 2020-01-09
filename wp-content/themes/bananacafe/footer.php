<footer id="dibu">
  <div class="about">
    <div class="right">
      <?php wp_nav_menu( array( 'theme_location'=>'bottom-menu','container' => '') ); ?>
      <p class="banquan">
        <?php bloginfo( 'name' ); ?>
        ，
        <?php bloginfo( 'description' ); ?>
      </p>
    </div>
    <div class="left">
      <ul class="list">
        <li><a href="http://weibo.com/cafebanana" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/xinlan.png" alt="<?php bloginfo( 'name' ); ?>"></a></li>
        <li><a href="http://user.qzone.qq.com/1875522872"><img src="<?php bloginfo('template_directory'); ?>/images/qq.png" alt="<?php bloginfo( 'name' ); ?>"></a></li>
      </ul>
    </div>
  </div>
  <!--about-->
  <div class="bottom">
    <?php bloginfo( 'name' ); ?>
    <a href="http://www.bananacafe.cn/?page_id=137"><font color="#ff5f1a">Bananacafe 2.0</font></a> <a href="http://www.miitbeian.gov.cn/">粤ICP备13063893号-2</a>
    <span class="tongji"> 
      <script src="http://s6.cnzz.com/stat.php?id=1253468941&web_id=1253468941" language="JavaScript"></script> 
    </span>
  </div>
  <!--bottom--> 
</footer>
<!--dibu-->
<div class="scroll" id="scroll" style="display:none;"> 回到顶部 </div>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.10.1.min.js"></script> 
<script type="text/javascript">
	$(function(){
		showScroll();
		function showScroll(){
			$(window).scroll( function() { 
				var scrollValue=$(window).scrollTop();
				scrollValue > 100 ? $('div[class=scroll]').fadeIn():$('div[class=scroll]').fadeOut();
			} );	
			$('#scroll').click(function(){
				$("html,body").animate({scrollTop:0},200);	
			});	
		}
	})
	</script>
<?php wp_footer(); ?>
</body></html>