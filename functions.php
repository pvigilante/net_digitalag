<?php
add_theme_support('post-thumbnails');
add_theme_support('menus');

function session_post_init(){
	$args = array(
		'public' => true,
		'label' => 'Sessions',
		'rewrite' => array('slug' => 'session'),
		'hierarchical' => true,
		'capability_type' => 'post',
		'supports'	=> array('title','editor','thumbnail', 'excerpt','publicize')
	);
	register_post_type('session', $args);
	flush_rewrite_rules();
}
add_action('init', 'session_post_init');

add_action('init', 'my_custom_init'); 
function my_custom_init() {
    add_post_type_support( 'session', 'publicize' );
}

function dag_row($attr, $content = null){
	$a = shortcode_atts(array(
		'valign' => 'center',
		'align' => 'center',
		'color' => '',
		'height' => '',
		'id' => ''
		
	), $attr);
	return '<section id="'.$a['id'].'" role="row" data-valign="'.$a['valign'].'" data-align="'.$a['align'].'" data-color="'.$a['color'].'" data-height="'.$a['height'].'">'.do_shortcode($content).'</section>';
}
add_shortcode('row', 'dag_row');

function dag_panel($attr, $content = null){
	$a = shortcode_atts(array(), $attr);
	return '<aside role="panel">'.do_shortcode($content).'</aside>';
}
add_shortcode('panel', 'dag_panel');

function dag_textbox($attr, $content = null){
	$a = shortcode_atts(array(), $attr);
	return '<div role="textbox">'.do_shortcode($content).'</div>';
}
add_shortcode('textbox', 'dag_textbox');

function dag_slider($attr, $content = null){
	$a = shortcode_atts(array(), $attr);
	return '<div role="slider">'.do_shortcode($content).'</div>';
}
add_shortcode('slider', 'dag_slider');

function dag_backdrop($attr, $content = null){
	$a = shortcode_atts(array(), $attr);
	return '<figure role="backdrop">'.do_shortcode($content).'</figure>';
}
add_shortcode('backdrop', 'dag_backdrop');
?>