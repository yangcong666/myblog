<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<?php mfthemes_meta();?>
<?php wp_head(); ?>
<?php $options = get_option('mfthemes_options');?>
</head>
<body <?php body_class(); ?>>
<div id="header">
	<div class="container clearfix">
		<h2 class="logo"><a href="<?php bloginfo('url');?>" title="<?php bloginfo('name'); ?>" rel="home"><img src="http://114.116.235.65/wp-content/uploads/2019/12/log-e1575464129626.png"<?php echo TPLDIR;?>/images/logo.png" height="40" alt="<?php bloginfo('name'); ?>" /></a></h2>
		<?php if( IsMobile ) : ?>
			<div id="mobile-menu"></div>
			<?php wp_nav_menu(array( 'theme_location'=>'mobileMenu','container_class' => 'header-menu')); ?>		
		<?php else : ?>
			<div class="global-nav">
				<ul class="gnul">
					<li class="gnli <?php if(is_home()) echo "current";?>">
						<a class="gna" href="<?php bloginfo('url');?>" title="首页">首页</a>
					</li>
					<?php if($options["global_nav"]):?>
						<li class="gnli dropdown">
							<a class="gna dropdown-link" href="javascript:;" title="导航"><span class="icon-list"></span>导航</a>
							<div class="dropdown-arrow1"></div>
							<div class="dropdown-arrow2"></div>
							<div class="submenu">
								<div class="tab-content">
									<table>
										<tbody>
											<tr class="trline">
												<td class="tdleft">分类</td>
												<td class="tdright">
													<div class="tab-categories">
														<ul>
															<?php wp_list_categories('&title_li='); ?>
														</ul>
													</div>											
												</td>
											</tr>
											<tr class="trline">
												<td class="tdleft">页面</td>
												<td class="tdright">
													<?php wp_nav_menu(array( 'theme_location'=>'customMenu','container_class' => 'tab-categories')); ?>										
												</td>
											</tr>										
											<tr>
												<td class="tdleft">标签</td>
												<td class="tdright">
													<div class="tab-tags">
														<?php wp_tag_cloud( array('unit' => 'px', 'smallest' => 12, 'largest' => 12, 'number' => $options["tagnumber"], 'format' => 'flat', 'orderby' => 'count', 'order' => 'DESC' )); ?>
													</div>										
												</td>
											</tr>										
										</tbody>
									</table>
								</div>
							</div>					
						</li>
					<?php endif;?>
				</ul>
			</div>	
			<div class="global-nav global-custom-nav">
				<?php wp_nav_menu(array( 'theme_location'=>'desktopMenu','container_class' => 'desktop-menu')); ?>			
			</div>		
			<form method="get" class="search-form" action="<?php bloginfo('url');?>">
				<input type="text" name="s" class="search-input" size="15"/>
				<button type="submit" alt="search" class="search-submit"><span class="icon-search"></span></button>
			</form>
		<?php endif;?>
	</div>
</div><!-- #header -->