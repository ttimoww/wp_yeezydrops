<?php get_header(); ?>

<?php 
    if (in_category('upcoming')) {
        get_template_part('./post-templates/post-upcoming', $name = null);
    } elseif (in_category('news')){
        get_template_part('./post-templates/post-news', $name = null);
    } elseif (in_category('past-drops')) {
        get_template_part('./post-templates/post-past-drops', $name = null);
    }else{
        get_template_part('./post-templates/post', $name = null);
    }
?>

<?php get_footer(); ?>