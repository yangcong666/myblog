<?php

function kratos_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Blog Page', 'kratos' ),
        'id' => 'sidebar_blog',
        'description' => __( '博客页面侧边栏', 'kratos' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix animate-box">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    ) );   
}
add_action( 'widgets_init', 'kratos_widgets_init' );

function remove_default_widget() {
 //    unregister_widget('WP_Widget_Recent_Posts');//移除近期文章
 //    unregister_widget('WP_Widget_Recent_Comments');//移除近期评论
       unregister_widget('WP_Widget_Meta');//移除站点功能
       unregister_widget('WP_Widget_Tag_Cloud');//移除标签云
 //    unregister_widget('WP_Widget_Text');//移除文本框
 //    unregister_widget('WP_Widget_Archives');//移除文章归档
 //    unregister_widget('WP_Widget_RSS');//移除RSS
       unregister_widget('WP_Nav_Menu_Widget');//移除菜单
 //    unregister_widget('WP_Widget_Pages');//移除页面
       unregister_widget('WP_Widget_Calendar');//移除日历
 //    unregister_widget('WP_Widget_Categories');//移除分类目录
       unregister_widget('WP_Widget_Search');//移除搜索
}
add_action( 'widgets_init', 'remove_default_widget' );

class kratos_widget_ad extends WP_Widget {

    function kratos_widget_ad() {
        $widget_ops = array(
            'classname' => 'widget_kratos_ad',
            'name'        => '广告位',
            'description' => 'Kratos主题特色组件 - 广告位'
        );
        parent::WP_Widget( false, false, $widget_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $aurl = $instance['aurl'] ? $instance['aurl'] : '';
        $title = $instance['title'] ? $instance['title'] : '';
        $imgurl = $instance['imgurl'] ? $instance['imgurl'] : '';
        echo $before_widget;
        ?>
            <?php if(!empty($title)) {?>
            <h4 class="widget-title"><?php echo $title; ?></h4>
            <?php }?>
            <?php if(!empty($imgurl)) {?>
            <a href="<?php echo $aurl; ?>" target="_blank">
                <img class="carousel-inner img-responsive img-rounded" src="<?php echo $imgurl; ?>" />
            </a>
            <?php }?>
        <?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    function form( $instance ) {
        @$title = esc_attr( $instance['title'] );
        @$aurl = esc_attr( $instance['aurl'] );
        @$imgurl = esc_attr( $instance['imgurl'] );
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                    标题：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'aurl' ); ?>">
                    链接：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'aurl' ); ?>" name="<?php echo $this->get_field_name( 'aurl' ); ?>" type="text" value="<?php echo $aurl; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'imgurl' ); ?>">
                    图片：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'imgurl' ); ?>" name="<?php echo $this->get_field_name( 'imgurl' ); ?>" type="text" value="<?php echo $imgurl; ?>" />
                </label>
            </p>
        <?php
    }
}

class kratos_widget_about extends WP_Widget {

    function kratos_widget_about() {
        $widget_ops = array(
            'classname' => 'amadeus_about',
            'name'        => '个人简介',
            'description' => 'Kratos主题特色组件 - 个人简介'
        );
        parent::WP_Widget( false, false, $widget_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $profile = $instance['profile'] ? $instance['profile'] : '';
        $title = $instance['title'] ? $instance['title'] : '';
        $imgurl = $instance['imgurl'] ? $instance['imgurl'] : '';
        echo $before_widget;
        ?>
                <?php if(!empty($imgurl)) {?>
                <div class="photo-wrapper">
                    <img class="about-photo" src="<?php echo $imgurl; ?>" />
                </div>
                <?php }?>
                <?php if(!empty($title)) {?>
                <h4 class="widget-title"><?php echo $title; ?></h4>
                <?php }?>
                <?php if(!empty($profile)) {?>
                <div class="textwidget">
                    <p><?php echo $profile; ?></p>
                </div>
                <?php }?>
        <?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    function form( $instance ) {
        @$title = esc_attr( $instance['title'] );
        @$imgurl = esc_attr( $instance['imgurl'] );
        @$profile = esc_attr( $instance['profile'] );
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                    标题：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'imgurl' ); ?>">
                    头像：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'imgurl' ); ?>" name="<?php echo $this->get_field_name( 'imgurl' ); ?>" type="text" value="<?php echo $imgurl; ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'profile' ); ?>">
                    简介：
                    <textarea class="widefat" rows="4" id="<?php echo $this->get_field_id( 'profile' ); ?>" name="<?php echo $this->get_field_name( 'profile' ); ?>" ><?php echo $profile; ?></textarea>
                </label>
            </p> 
        <?php
    }
}

class kratos_widget_tags extends WP_Widget {
    function __construct(){
        $widget_ops = array(
            'name'        => '标签云',
            'description' => 'Kratos主题特色组件 - 标签云'
        );
        parent::__construct(false, false, $widget_ops);
    }

    function widget($args, $instance){
        extract($args);
        $result = '';
        $title = $instance['title'] ? esc_attr($instance['title']) : '';
        $title = apply_filters('widget_title',$title);
        $number = (!empty($instance['number'])) ? intval($instance['number']) : 50;
        $orderby = (!empty($instance['orderby'])) ? esc_attr($instance['orderby']) : 'count';
        $order = (!empty($instance['order'])) ? esc_attr($instance['order']) : 'DESC';
        $tags = wp_tag_cloud( array(
                    'unit' => 'px',
                    'smallest' => 14,
                    'largest' => 14,
                    'number' => $number,
                    'format' => 'flat',
                    'orderby' => $orderby,
                    'order' => $order,
                    'echo' => FALSE
                )
            );
        $result .= $before_widget;
        if($title) $result .= '<h4 class="widget-title">'.$title .'</h4>';
        $result .= '<div class="tag_clouds">';
        $result .= $tags;
        $result .= '</div>';
        $result .= $after_widget;
        echo $result;
    }

    function update($new_instance, $old_instance){
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = esc_attr($new_instance['title']);
        $instance['number'] = intval($new_instance['number']);
        $instance['orderby'] = esc_attr($new_instance['orderby']);
        $instance['order'] = esc_attr($new_instance['order']);
        return $instance;
    }

    function form($instance){
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=>'Tags','number'=>'20','orderby'=>'count','order'=>'RAND'));
        $title =  esc_attr($instance['title']);
        $number = intval($instance['number']);
        $orderby =  esc_attr($instance['orderby']);
        $order =  esc_attr($instance['order']);
        ?>
        <p>
            <label for='<?php echo $this->get_field_id("title");?>'>标题：<input type='text' class='widefat' name='<?php echo $this->get_field_name("title");?>' id='<?php echo $this->get_field_id("title");?>' value="<?php echo $title;?>"/></label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("number");?>'>数量：<input type='text' name='<?php echo $this->get_field_name("number");?>' id='<?php echo $this->get_field_id("number");?>' value="<?php echo $number;?>"/></label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("orderby");?>'>类型：
                <select name="<?php echo $this->get_field_name("orderby");?>" id='<?php echo $this->get_field_id("orderby");?>'>
                    <option value="count" <?php echo ($orderby == 'count') ? 'selected' : ''; ?>>数量</option>
                    <option value="name" <?php echo ($orderby == 'name') ? 'selected' : ''; ?>>名字</option>
                </select>
            </label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("order");?>'>排序：
                <select name="<?php echo $this->get_field_name("order");?>" id='<?php echo $this->get_field_id("order");?>'>
                    <option value="DESC" <?php echo ($order == 'DESC') ? 'selected' : ''; ?>>降序</option>
                    <option value="ASC" <?php echo ($order == 'ASC') ? 'selected' : ''; ?>>升序</option>
                    <option value="RAND" <?php echo ($order == 'RAND') ? 'selected' : ''; ?>>随机</option>
                </select>
            </label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}

class kratos_widget_search extends WP_Widget {

    function kratos_widget_search() {
        $widget_ops = array(
            'classname' => 'widget_kratos_search',
            'name'        => '站点搜索',
            'description' => 'Kratos主题特色组件 - 站点搜索'
        );
        parent::WP_Widget( false, false, $widget_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = $instance['title'] ? $instance['title'] : '';
        echo $before_widget;
        ?>
        <?php if(!empty($title)) {?>
        <h4 class="widget-title"><?php echo $title; ?></h4>
        <?php }?>
         <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
            <div class="form-group">
                 <input type="text" name='s' id='s' placeholder="Search…" class="form-control" placeholder="" x-webkit-speech>
            </div>
        </form>

        <?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    function form( $instance ) {
        @$title = esc_attr( $instance['title'] );
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                    标题：
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
                </label>
            </p>
        <?php
    }
}

function kratos_register_widgets(){
    register_widget('kratos_widget_ad'); 
    register_widget('kratos_widget_about'); 
    register_widget('kratos_widget_tags'); 
    register_widget('kratos_widget_search'); 
}
add_action('widgets_init','kratos_register_widgets');
?>