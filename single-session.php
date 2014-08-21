<?php get_header(); 
while(have_posts()){
the_post();
echo '<schema itemscope itemtype="http://schema.org/CreativeWork"><meta name="author" itemprop="Alisha Khan Photography">';
$title = '<h1 itemprop="name">'.wp_title('', false).'</h1>';
echo do_shortcode('[row][panel][backdrop]<schema itemprop="image">'.get_the_post_thumbnail(get_the_ID()).'</schema>[/backdrop][textbox]'.$title.'[/textbox][/panel][/row]');

?>

<?php the_content(); 

echo '</schema>';
$prev_post = get_previous_post();
if(!empty($prev_post)){
$prev_data='[panel][backdrop]'.get_the_post_thumbnail($prev_post->ID).'[/backdrop][textbox]<a href="'.get_the_permalink( $prev_post->ID ).'" class=button>Previous: '.$prev_post->post_title.'</a>[/textbox][/panel]';	
}

$next_post = get_next_post();
if(!empty($next_post)){
	$next_data='[panel][backdrop]'.get_the_post_thumbnail($next_post->ID).'[/backdrop][textbox]<a href="'.get_the_permalink( $next_post->ID ).'" class=button>Next: '.$next_post->post_title.'</a>[/textbox][/panel]';
}
echo do_shortcode('[row]'.$prev_data.$next_data.'[/row]');
?>

<?php } get_footer(); ?>