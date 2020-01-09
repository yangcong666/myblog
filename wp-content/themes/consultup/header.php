<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package consultup
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"></a>
<div class="wrapper">
<header class="ti-headwidget trans" > 
  <!--==================== TOP BAR ====================-->
  <div class="container">
    <?php 
	  $consultup_head_info_icon_one = get_theme_mod('consultup_head_info_icon_one');
      $consultup_head_info_icon_one_text = get_theme_mod('consultup_head_info_icon_one_text');
      $consultup_head_info_icon_two = get_theme_mod('consultup_head_info_icon_two');
      $consultup_head_info_icon_two_text = get_theme_mod('consultup_head_info_icon_two_text');
	  $header_social_icon_enable = get_theme_mod('header_social_icon_enable','on');
      $consultup_header_fb_link = get_theme_mod('consultup_header_fb_link');
      $consultup_header_fb_target = get_theme_mod('consultup_header_fb_target',1);
      $consultup_header_twt_link = get_theme_mod('consultup_header_twt_link');
      $consultup_header_twt_target = get_theme_mod('consultup_header_twt_target',1);
      $consultup_header_lnkd_link = get_theme_mod('consultup_header_lnkd_link');
      $consultup_twitter_lnkd_target = get_theme_mod('consultup_twitter_lnkd_target',1);
      $consultup_header_insta_link = get_theme_mod('consultup_header_insta_link');
      $consultup_insta_lnkd_target = get_theme_mod('consultup_insta_lnkd_target',1);
	  if(($consultup_head_info_icon_one) || ($consultup_head_info_icon_two_text) || ($consultup_head_info_icon_one_text) || ($consultup_head_info_icon_two) || ($consultup_header_twt_link) || ($consultup_header_lnkd_link) || ($consultup_header_insta_link) || ($consultup_header_fb_link) !=''){ 
      ?>
    <div class="ti-head-detail hidden-xs hidden-sm">
      <div class="row">
	  
        <div class="col-md-6 col-xs-12 col-sm-6">
         <ul class="info-left">
          <li><i class="fa <?php echo esc_attr( $consultup_head_info_icon_one ); ?> "></i> <?php echo esc_html( $consultup_head_info_icon_one_text );?></li>
          <li><i class="fa <?php echo esc_attr( $consultup_head_info_icon_two ); ?> "></i> <?php echo esc_html( $consultup_head_info_icon_two_text ); ?></li>
          </ul>
        </div>
	 
      <div class="col-md-6 col-xs-12">
      <?php 
      if($header_social_icon_enable !='off')
      {
      ?>
      <ul class="ti-social info-right">
      <?php if($consultup_header_fb_link !=''){?>
      <li><span class="icon-soci"><a <?php if($consultup_header_fb_target) { ?> target="_blank" <?php } ?>href="<?php echo esc_url($consultup_header_fb_link); ?>"><i class="fa fa-facebook"></i></a></span> </li>
      <?php } if($consultup_header_twt_link !=''){ ?>
      <li><span class="icon-soci"><a <?php if($consultup_header_twt_target) { ?>target="_blank" <?php } ?>href="<?php echo esc_url($consultup_header_twt_link);?>"><i class="fa fa-twitter"></i></a></span></li>
      <?php } if($consultup_header_lnkd_link !=''){ ?>
      <li><span class="icon-soci"><a <?php if($consultup_twitter_lnkd_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($consultup_header_lnkd_link); ?>"><i class="fa fa-linkedin"></i></a></span></li>
      <?php } 
      if($consultup_header_insta_link !=''){ ?>
      <li><span class="icon-soci"><a <?php if($consultup_insta_lnkd_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($consultup_header_insta_link); ?>"><i class="fa fa-instagram"></i></a></span></li>
      <?php } ?>
      </ul>
      <?php } ?>
    </div>
      </div>
    </div>
	  <?php } ?>
  </div>
  <div class="clearfix"></div>
  <div class="container">
    <div class="ti-nav-widget-area">
    <div class="row">
          <div class="col-md-3 col-sm-4 text-center-xs">
            <div class="navbar-header">
              <?php the_custom_logo(); ?>

              <?php  if ( display_header_text() ) : ?>
            <div class="site-branding-text">
				<h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<p class="site-description"><?php bloginfo('description'); ?></p>
			</div>
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-wp"> <span class="sr-only"><?php esc_html_e('Toggle Navigation','consultup');?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <?php endif; ?>
          </div>
          </div>
          <div class="col-md-9 col-sm-8">
            <div class="header-widget">
              <div class="col-md-3 col-md-offset-3 col-sm-3 col-xs-6 hidden-sm hidden-xs">
                <div class="ti-header-box">
                  <div class="ti-header-box-icon">
                    <?php $consultup_header_widget_one_icon = get_theme_mod('consultup_header_widget_one_icon');
                    if( !empty($consultup_header_widget_one_icon) ):
                      echo '<i class="fa '.esc_attr($consultup_header_widget_one_icon).'">'.'</i>';
                    endif; ?>
                   </div>
                  <div class="ti-header-box-info">
                    <?php $consultup_header_widget_one_title = get_theme_mod('consultup_header_widget_one_title'); 
                    if( !empty($consultup_header_widget_one_title) ):
                      echo '<h4>'.esc_html($consultup_header_widget_one_title).'</h4>';
                    endif; ?>
                    <?php $consultup_header_widget_one_description = get_theme_mod('consultup_header_widget_one_description');
                    if( !empty($consultup_header_widget_one_description) ):
                      echo '<p>'.esc_html($consultup_header_widget_one_description).'</p>';
                    endif; ?> 
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6 hidden-sm hidden-xs">
                <div class="ti-header-box">
                  <div class="ti-header-box-icon">
                    <?php $consultup_header_widget_two_icon = get_theme_mod('consultup_header_widget_two_icon');
                    if( !empty($consultup_header_widget_two_icon) ):
                      echo '<i class="fa '.esc_attr($consultup_header_widget_two_icon).'">'.'</i>';
                    endif; ?>
                   </div>
                  <div class="ti-header-box-info">
                    <?php $consultup_header_widget_two_title = get_theme_mod('consultup_header_widget_two_title'); 
                    if( !empty($consultup_header_widget_two_title) ):
                      echo '<h4>'.esc_html($consultup_header_widget_two_title).'</h4>';
                    endif; ?>
                    <?php $consultup_header_widget_two_description = get_theme_mod('consultup_header_widget_two_description');
                    if( !empty($consultup_header_widget_two_description) ):
                      echo '<p>'.esc_html($consultup_header_widget_two_description).'</p>';
                    endif; ?> 
                  </div>
                </div>
              </div>
         <div class="col-md-3 col-sm-6 col-xs-12 hidden-sm hidden-xs">
                <div class="ti-header-box text-right"> 
                  <?php $consultup_header_widget_four_label = get_theme_mod('consultup_header_widget_four_label'); 
                  $consultup_header_widget_four_link = get_theme_mod('consultup_header_widget_four_link');
                  $consultup_header_widget_four_target = get_theme_mod('consultup_header_widget_four_target'); 
          if( !empty($consultup_header_widget_four_label) ):?>
          <a href="<?php echo esc_url($consultup_header_widget_four_link); ?>" <?php if( $consultup_header_widget_four_target ==true) { echo "target='_blank'"; } ?> class="btn btn-theme"><?php echo esc_html($consultup_header_widget_four_label); ?></a> 
          <?php endif; ?>
                </div>
         </div>
            </div>
          </div>
        </div>
      </div></div>

     <div class="container"> 
    <div class="ti-menu-full">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top navbar-wp">
         <!-- navbar-toggle -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-wp"> <span class="sr-only"><?php esc_html_e('Toggle Navigation','consultup'); ?></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <!-- /navbar-toggle --> 
          
          <div class="collapse navbar-collapse" id="navbar-wp">
          <?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'container'  => 'nav-collapse collapse navbar-inverse-collapse',
								'menu_class' => 'nav navbar-nav',
								'fallback_cb' => 'consultup_fallback_page_menu',
								'walker' => new Consultup_Nav_Walker()
							) ); 
						?>
          </div>
      </nav> <!-- /Navigation -->
    </div>
  </div>
</header>