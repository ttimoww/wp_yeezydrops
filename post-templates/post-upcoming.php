<div class="wrapper post-upcoming">
    <div class="wrapper__container">
        <div class="post-upcoming__header">
            <h1><?php the_title(); ?></h1> 
            <h2>
                <?php 
                    $custom = get_post_custom();
                    if (isset($custom['date'])){
                        echo $custom['date'][0];
                    } 
                ?>
            </h2>
            <div class="post-upcoming__image" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div>
            
        </div> 
        <div class="post-upcoming__content">
            <?php 
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        the_content();
                    }
                }
            ?>
        </div>
    </div>
</div>