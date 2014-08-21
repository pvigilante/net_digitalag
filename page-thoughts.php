<?php get_header(); 
$title = '<h1>'.wp_title('', false).'</h1>';
echo do_shortcode('[row][panel][textbox]'.$title.'[/textbox][/panel][/row]');

echo do_shortcode('');
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$query = new WP_Query();
$query->query('posts_per_page=10&paged='.$paged);
while($query->have_posts()){
$query->the_post();?>

<?php 
echo do_shortcode('[row][panel][backdrop]'.get_the_post_thumbnail(get_the_ID()).'[/backdrop][textbox]<h2>'.get_the_title().'</h2><p>'.get_the_excerpt().'</p><a href="'.get_the_permalink().'" class="button">Read More</a>[/textbox][/panel][/row]');
 ?>


<?php } 
 next_posts_link('Older Entries', $the_query->max_num_pages ); 
 previous_posts_link( 'Newer Entries' );
 wp_reset_postdata(); 
get_footer(); ?>