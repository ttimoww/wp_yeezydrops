<?php get_header(); ?>

<div class="wrapper page-news">
    <div class="wrapper__container">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <div class="posts">
            <?php $query = new WP_Query( array( 'category_name' => 'news' ) ); ?>
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

            <h2><?php the_title(); ?></h2>
            <p><?php the_date(); ?></p>

            <?php endwhile; 
            wp_reset_postdata();
            else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>