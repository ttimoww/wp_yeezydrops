<?php get_header(); ?>

<div class="wrapper page-upcoming">
    <div class="wrapper__container">
    <h1 class="page-title"><?php the_title(); ?></h1>
        <div class="posts">
            <?php $query = new WP_Query( array( 'category_name' => 'upcoming' ) ); ?>
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

            <div class="post"">
                <a href="<?php the_permalink(); ?>">
                    <div class="post__image" alt="<?php the_title(); ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div>
                </a>
                <p class="date"><?php
                    $custom = get_post_custom();
                    if (isset($custom['date'])){
                        echo $custom['date'][0];
                    }
                ?></p>
            </div>

            <?php endwhile; 
            wp_reset_postdata();
            else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>