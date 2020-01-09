<?php if (is_page())  { 
$style_item = 'page'; 
} elseif (is_single()) { 
if ($post->post_author == '1') { 
$style_item = 'boy'; 
} 
elseif ($post->post_author == '2') { 
$style_item = 'girl'; 
} 
} else { 
$style_item = 'normal'; 
} ?>	 
<div class="footer footer_<?php echo $style_item ;?>"> 

        <p>&copy; <?php echo date('Y'); ?> <a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>  基于<a href="http://wordpress.org" target="_blank">WordPress</a>.</p> 
     
</div> 