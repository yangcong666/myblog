<?php get_header(); ?>
<div id="main">
  <div id="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="content">
      <header class="title"> <span class="avata"><a href="<?php the_author_meta('user_url'); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '45', '' ); ?></span>
        <div class="mecc">
          <h1> <a href="<?php the_permalink() ?>">
            <?php the_title(); ?>
            </a> </h1>
          <address>
          <?php the_category(',') ?>
          -
          <?php the_author(); ?>
          -
          <time>
            <?php the_time('Y.m.d'); ?>
          </time>
          - View:
          <?php post_views(' ', ' 次'); ?>
          </address>
        </div>
         <?php wpfp_link() ?>
      </header>
      <?php $postimg = get_post_meta($post->ID, "postimg_value", true); $postimg = trim(strip_tags($postimg)); ?>
      <div class="content-text">
        <?php the_content(); ?>
      </div>
      
      <!--content_text-->
      <footer class="article-tag">
        <?php the_tags('  ', ' , ' , ''); ?>
      </footer>
      <!--article-tag--> 
    </article>
    <!--content-->
    <nav class="nav-single"> <span class="nav-previous">
      <?php next_post_link( '%link', '' . _x( '&larr;', 'Next post link' ) . ' %title' ); ?>
      </span> <span class="nav-next">
      <?php previous_post_link( '%link', '%title ' . _x( '&rarr;', 'Previous post link' ) . '' ); ?>
      </span> </nav>
      <div class="comment" id="comments">
		<?php comments_template(); ?>
		</div>
    <!-- .nav-single -->  
    <?php endwhile;?>
    <?php endif; ?>
  </div>
  <!--Container End-->
  <?php get_sidebar(); ?>
</div>
<!--main-->
<?php get_footer(); ?>
