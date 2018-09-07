<?php add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' ); 
    function theme_enqueue_styles() 
    { wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
}
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

function my_ext2type($ext2types) {
    array_push($ext2types, array('image' => array('svg', 'svgz')));
    return $ext2types;
}
add_filter('ext2type', 'my_ext2type');
  
function my_mime_types($mimes){
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'my_mime_types');
  
function my_mime_to_ext($mime_to_ext) {
    $mime_to_ext['image/svg+xml'] = 'svg';
    return $mime_to_ext;
}
add_filter('getimagesize_mimes_to_exts', 'my_mime_to_ext');



/*snsweight*/

class SNS extends WP_Widget
{
/*コンストラクタ*/
    function __construct()
    {
        parent::__construct(
            'sns_widget',
            'SNSボタン',
            array('description' => 'SNSボタンを追加')
        );
    }
/*ウィジェット追加画面でのカスタマイズ欄の追加*/
    function form($instance)
    {
        ?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('タイトル:'); ?></label>
  <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
  name="<?php echo $this->get_field_name('title'); ?>"
  value="<?php echo esc_attr($instance['title']); ?>">
</p>
<?php

}
/*カスタマイズ欄の入力内容が変更された場合の処理*/
function update($new_instance, $old_instance)
{
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    return $instance;
}
/*ウィジェットのに出力される要素の設定*/
function widget($args, $instance)
{
    extract($args);
    echo $before_widget;
    if (!empty($instance['title'])) {
        $title = apply_filters('widget_title', $instance['title']);
    }
    if ($title) {
        echo $before_title . $title . $after_title;
    } else {
        echo '';
    }
    ?>
<div class="sns-widget">
  <?php get_template_part('sns'); ?>
</div>
<?php echo $after_widget;
}
}
register_widget('SNS');
/*snsweight　end*/


