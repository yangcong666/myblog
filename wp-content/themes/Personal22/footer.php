

    </div>
    <!-- /row -->
</div>
<!-- /container -->


<div id="to_top"></div>


<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/js/public/echo.js"></script>
<script>
echo.init({
  offset: 100,
  throttle: 250,
  unload: false,
  callback: function (element, op) {
    console.log(element, 'has been', op + 'ed')
  }
});
</script>
<script>
$('body').show();
$('.version').text(NProgress.version);
NProgress.start();
setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

$("#b-0").click(function() { NProgress.start(); });
$("#b-40").click(function() { NProgress.set(0.4); });
$("#b-inc").click(function() { NProgress.inc(); });
$("#b-100").click(function() { NProgress.done(); });
</script>

<?php wp_footer(); ?>
<?php echo stripslashes(get_option('foot_code')); ?>
<?php if(is_home()){ //首页附加代码 ?>
<?php echo stripslashes(get_option('foot_home_code')); ?>
<?php } ?>
</body></html>