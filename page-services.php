<?php get_header(); 
while(have_posts()){
the_post();?>
<schema itemscope itemtype="http://schema.org/Product">
<?php 

the_content(); ?>

</schema>
<?php } get_footer(); ?>