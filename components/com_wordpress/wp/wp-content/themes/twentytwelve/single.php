<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content <?php if( !get_site_option( 'wpj_use_wp_sidebar', 1 ) ) { echo 'full'; } ?> ">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><a href="/blog">BACK TO BLOG</a></span>
					<span class="nav-next"><?php previous_post_link( '%link', 'NEXT ARTICLE <span class="meta-nav">' . _x(  ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>