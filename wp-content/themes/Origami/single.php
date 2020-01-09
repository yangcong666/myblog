<?php
$sidebar_pos = get_option('origami_layout_sidebar', 'right');
$post_list_class =
  $sidebar_pos == 'none' ? 'col-10 col-md-12' : 'col-8 col-md-12';
$sidebar_class = $sidebar_pos == 'none' ? 'd-none' : 'col-4 col-md-12';
$main_class = $sidebar_pos == 'left' ? 'flex-rev' : '';
the_post();
$post_author_id = get_post_field('post_author', $post->ID);
$post_item = [
  'post_id' => $post->ID,
  'post_title' => get_the_title($post->ID),
  'post_date' => get_the_date(get_option('date_format'), $post->ID),
  'post_comments' => get_comments_number($post->ID),
  'post_link' => get_the_permalink($post->ID),
  'post_image' => wp_get_attachment_url(get_post_thumbnail_id($post->ID)),
  'post_image_alt' => get_post_meta(
    get_post_thumbnail_id($post->ID),
    '_wp_attachment_image_alt',
    true
  ),
  'post_author' => get_the_author_meta('display_name', $post_author_id),
  'post_category' => wp_get_post_categories($post->ID),
  'post_tag' => wp_get_post_tags($post->ID),
  'post_excerpt' => get_the_excerpt($post->ID)
];
if ($post_item['post_image'] == false && origami_get_other_thumbnail($post)) {
  $post_item['post_image'] = origami_get_other_thumbnail($post);
}
?>
<?php get_header(); ?>
<div id="main-content">
    <main class="ori-container columns <?php echo $main_class; ?> grid-md single-post">
        <section class="s-post-container column <?php echo $post_list_class; ?>">
            <?php if ($post_item['post_image']): ?>
              <div class="s-post-thumb" style="background-image:url(<?php echo $post_item['post_image']; ?>)"></div>
            <?php endif; ?>
            <?php origami_breadcrumbs();?>
            <div class="s-post-info post-info">
                <h2 class="card-title"><?php echo $post_item['post_title']; ?></h2>
                <div class="card-subtitle text-gray">
                    <time><?php echo $post_item['post_date']; ?></time> • <span><?php echo $post_item['post_author']; ?></span> •
                    <span><?php echo $post_item['post_comments'] . __('条评论', 'origami'); ?></span> • 
                    <ul>
                    <?php foreach ($post_item['post_category'] as $cat): ?>
                        <li><a href="<?php echo get_category_link($cat); ?>"><?php echo get_cat_name($cat); ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <article <?php post_class("s-post-content"); ?> id="post-<?php the_ID(); ?>">
                <?php the_content(); ?>
            </article>
            <div class="s-post-tags">
              <?php get_template_part('template-part/post-tags'); ?>
            </div>
            <div class="s-post-comments">
              <?php comments_template(); ?>
            </div>
            <div class="s-post-nav">
              <?php get_template_part('template-part/post-nav'); ?>
            </div>
        </section>
        <aside class="column ori-sidebar <?php echo $sidebar_class; ?>">
            <?php get_sidebar(); ?>
        </aside>
    </main>
</div>
<?php
// get_template_part('template-part/tools-button');
get_footer(); ?>
