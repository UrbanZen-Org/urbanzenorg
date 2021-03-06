<?php get_header(); ?>

<div class="container">

			<div id="content">
				<?php if(in_category('dot') || in_category('dot-photo-journals')){ ?>
					<div class="dot-header">
				<h1 class="page-title text-center bold" itemprop="headline"><a href="http://urbanzen.org/d-o-t/"><img src="http://urbanzen.org/wp-content/uploads/2015/07/dot-logo.png" alt="D.O.T" width="175" /></a></h1>
				<hr/>
				<div class="sub menu"> 
					<?php wp_nav_menu('dot'); ?>
				</div>
			</div>
				<?php } ?>
				<div id="inner-content" class="wrap clearfix">

					<div id="full-width" class="clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<?php if (function_exists("builder_breadcrumb_lists")) { ?>
							<?php /*builder_breadcrumb_lists(); */?>
							<?php } ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
								<?php /*	<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&amp;</span> filed under %4$s.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', ') );
									?></p> */?>

								</header> <!-- end article header -->

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section> <!-- end article section -->

								<footer class="article-footer">
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ' ', '</p>' ); ?>

								</footer> <!-- end article footer -->

								<?php comments_template(); ?>

							</article> <!-- end article -->

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>
						<div class="row post-nav">
						
							<div class="col-md-6">
								<div class="pull-left">
								<?php previous_post('&#9664; %', '', 'yes'); ?> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="pull-right">
								<?php next_post('% &#9654;', '', 'yes'); ?>
								</div>
								</div>
						</div>		
					</div> <!-- end #main -->

					<?php// get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

		</div> <!-- end .container -->

<?php get_footer(); ?>
