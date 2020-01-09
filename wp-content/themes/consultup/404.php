<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package consultup
 */
get_header(); ?>
<div class="consultup-breadcrumb-section">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="consultup-page-breadcrumb">
              <li><a href="<?php echo esc_url(home_url());?>"><i class="fa fa-home"></i></a></li>
              <li class="active"><a href="<?php echo esc_url(home_url());?>"><?php esc_html_e('404','consultup'); ?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center consultup-section">
        <div class="consultup-error-404">
          <h1><?php esc_html_e('4','consultup'); ?><i class="fa fa-exclamation-circle"></i><?php esc_html_e('4','consultup'); ?></h1>
          <h4><?php esc_html_e('Oops! Page not found','consultup'); ?></h4>
          <p><?php esc_html_e("We are sorry, but the page you are looking for does not exist.","consultup"); ?></p>
          <a href="<?php echo esc_url(home_url());?>" onClick="history.back();" class="btn btn-theme"><?php esc_html_e('Go Back','consultup'); ?></a> </div>
      </div>
    </div>
  </div>
<?php
get_footer();