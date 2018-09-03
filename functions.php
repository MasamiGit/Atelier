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


