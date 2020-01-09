   <div id="footer-widget-box" class="site-footer"> 
    <div class="footer-widget"> 
     <?php 

     if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-footer')) : endif; 


     ?>	
     <div class="clear"></div> 
    </div>
   </div> 
   <footer id="colophon" class="site-footer wow fadeInUp" data-wow-delay="0.3s" role="contentinfo"> 
    <div class="site-info">
      <?php 
       	$websitelog = of_get_option( 'summer_copyright');
       	
       	echo ($websitelog) ? $websitelog : 'Copyright © 2015-2018 WordPress Leaf. All rights reserved' ;


       	
       ?> 
     <span class="add-info"> 开发者 <a  href="//www.wordpressleaf.com" rel="nofollow" target="_blank"><span id="run_time" style="color: #0196e3;">WordPressLeaf</span></a>  </span> 
    </div>
    <!-- .site-info --> 
   </footer>
   <!-- .site-footer -->
   <ul id="scroll"> 
    <li class="log log-no"><a class="log-button" title="文章目录"><i class="fa fa-bars"></i></a></li> 
    <li><a class="scroll-h" title="返回顶部"><i class="fa fa-angle-up"></i></a></li> 
    <li><a class="scroll-b" title="转到底部"><i class="fa fa-angle-down"></i></a></li> 
    <li class="gb2-site"><a id="gb2big5" href="javascript:StranBody()" title="繁體"><span>繁</span></a></li> 
    <li class="qr-site"><a href="javascript:void(0)" class="qr" title="本页二维码"><i class="fa fa-qrcode"></i><span class="qr-img"><span id="output"><img class="alignnone" src="/favicon.ico" alt="icon" />
        </span><span class="arrow arrow-z">◆</span><span class="arrow arrow-y">◆</span></span></a></li> 
   </ul>
  </div>
  <div id="overlay"></div>
<?php
	wp_footer();
?>
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
</body>
</html>
