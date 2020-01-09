<div class="sidebar"> 
    	<ul> 
		<div class="bloginfo"> 		
<?php 
if (is_page())  { 
bloginfo ('description');}
elseif (is_single()) { 
the_author_description();
}
else { 
bloginfo ('description');
} ?>	
			 	 </div> 
		           
            <div class="clear"></div> 
            <li> 
            <h2>页 面</h2> 
                <ul> 
                     <?php  wp_list_pages('depth=1&title_li=0&sort_column=menu_order&sort_order=ASC');?>
                      
</ul> 
 </li> 
         <div align=center><!-- 这里可以放置广告 --></div>
  <li> 
            <h2>分 类</h2> 
                <ul> 
                	<?php wp_list_categories('show_count=1&title_li=0'); ?> 
                </ul> 
            </li> 
            <li> 
            <h2>文章索引</h2> 
                <ul> 
                    <?php wp_get_archives('type=monthly'); ?>
	
                </ul> 
            </li>    
            <li> 
			<h2>管 理</h2> 
                <ul> 
                     <li><?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
					<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
					<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
					<?php wp_meta(); ?></li> 
                        <li id="feed"> 
            <li> 
                <!-- Search Begin --> 
                    
<form name="form" id="searchform" action="<?php bloginfo( 'url' ); ?>/" method="post"> 
<input name="s" type="text" class="searchInput" id="text" onBlur="mousedown()" onClick="mouseover()" /> 
<input class="searchBtn" type="submit" id="searchsubmit" value="搜 索"  /> 
</form> 
 
<script   language="javascript"> 
 function mouseover()
 {
	var str=document.form.text.value;
	 if (str=="Search")
		{
		 	document.form.text.value='';
		}
 }
function mousedown()
 {
	var str=document.form.text.value;
	 if (str=="" || str=="Search")
		{
		 	document.form.text.value='Search';
		}
 }
</script> 
                <!-- Search End --> 
            </li> 
            </li> 
        </ul> 
</div> 