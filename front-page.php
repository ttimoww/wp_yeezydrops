<?php get_header(); ?>
<div class="wrapper frontpage">
    <div class="wrapper__container">
        <!-- <div class="jumbo"></div> -->
        <div class="latest-posts">
            
            <!-- START FIRST TO COME -->
            <?php $query = new WP_Query( array( 'category_name' => 'upcoming', 'posts_per_page' => 1 ) ); ?>
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

            <div class="latest-posts__post"">
                <h2>First to come</h2>
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
            <!-- END FIRST TO COME -->

            <!-- START LATEST DROP -->
            <?php $query = new WP_Query( array( 'category_name' => 'past-drops', 'posts_per_page' => 1 ) ); ?>
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

            <div class="latest-posts__post"">
                <h2>Last Drop</h2>
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
            <!-- END LATEST DROP -->
        </div>
        <!-- <?php wp_nav_menu(array('theme_location' => 'homepage')); ?> -->
    </div>
</div>
<?php get_footer(); ?>