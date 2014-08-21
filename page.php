<?php get_header(); 
while(have_posts()){
the_post();?>
<schema itemscope itemtype="http://schema.org/Product">
<?php 

the_content(); ?>

</schema>
<?php }

wp_reset_query();
$query = new WP_Query();
$query->query('posts_per_page=1&post_type=session&orderby=rand');
while($query->have_posts()){
$query->the_post();

echo do_shortcode('[row][panel][backdrop]'.get_the_post_thumbnail(get_the_ID()).'[/backdrop][textbox]<h2>'.get_the_title().'</h2><p>'.get_the_excerpt().'</p><a href="'.get_the_permalink().'" class="button">See Session</a>[/textbox][/panel][/row]');
 
} 
 get_footer(); ?>