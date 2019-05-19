<?php get_header(); ?>

<?php 
    if (in_category('upcoming')) {
        get_template_part('./template-parts/posts/upcoming', $name = null);
    } elseif (in_category('news')){
        get_template_part('./template-parts/posts/news', $name = null);
    } elseif (in_category('past-drops')) {
        get_template_part('./template-parts/posts/past-drops', $name = null);
    }
?>

<?php get_footer(); ?>