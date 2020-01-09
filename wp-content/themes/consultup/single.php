<!-- =========================
     Page Breadcrumb   
============================== -->
<?php get_header();
$background_image = get_theme_support( 'custom-header', 'default-image' );

if ( has_header_image() ) {
  $background_image = get_header_image();
}
?>

<div class="consultup-breadcrumb-section" style='background: url("<?php echo esc_url( $background_image ); ?>" ) repeat scroll center 0 #143745;'>
<div class="overlay">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12">
			    <div class="consultup-breadcrumb-title">
            <h1><?php the_title(); ?></h1>
			       <div class="consultup-blog-category">
              <span class="consultup-blog-date"><i class="fa fa-clock-o"></i> <?php echo esc_html(get_the_date('M')); ?> <?php echo esc_html(get_the_date('j,')); ?> <?php echo esc_html(get_the_date('Y')); ?></span>
              <i class="fa fa-folder-open-o"></i>
              <?php $cat_list = get_the_category_list();
                if(!empty($cat_list)) { ?>
                  <?php the_category(', '); ?>
                <?php } ?>
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<!-- =========================
     Page Content Section      
============================== -->
<main id="content">
  <div class="container">
    <div class="row"> 
      <div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'9' ); ?> col-sm-8">
		      <?php if(have_posts())
		        {
		      while(have_posts()) { the_post(); ?>
          <div class="col-md-12">
            <div class="consultup-blog-post-box"> 
              <?php 
              if(has_post_thumbnail()){
              echo '<a class="consultup-blog-thumb" href="'.esc_url(get_the_permalink()).'">';
              the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
              echo '</a>';
               } ?>
              <article class="small">
                <h1 class="title">
               <?php the_title(); ?></a>
               </h1>
                <?php the_content(); ?>
              </article>
            </div>
          </div>
		      <?php } ?>
		      <div class="col-md-12 text-center">
            <?php the_posts_navigation(); ?>
          </div>  
          <div class="col-md-12">
            <div class="media consultup-info-author-block"> <a class="consultup-author-pic" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a>
			<div class="media-body">
                <h4 class="media-heading"><span><i class="fa fa-user"></i><?php esc_html_e('By','consultup'); ?></span><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php the_author(); ?></a></h4>
                <p><?php the_author_meta( 'description' ); ?></p>
              </div>
            </div>
          </div>
		      <?php } ?>
         <?php comments_template('',true); ?>
      </div>
      <div class="col-md-3 col-sm-4">
      <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>