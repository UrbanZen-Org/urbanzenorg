<?php
/**
 * Full Content Template
 *
   Template Name:  UZIT 9/28/16
 *
 */
?>
<?php get_header(); ?>

		<div class="container">

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="full-width" class="clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					        <?php if (function_exists("builder_breadcrumb_lists")) { ?>
							<?php //builder_breadcrumb_lists(); ?>
							<?php } ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

								<?php /*	<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'bonestheme' ) ), bones_get_the_author_posts_link());
									?></p>
                  */?>

								</header> <!-- end article header -->

								<section class="entry-content clearfix" itemprop="articleBody">
								    
								    <?php the_content(); ?>
								    
								    <p style="text-align: center;">
								            <img class="alignleft wp-image-23378 size-full" src="/wp-content/uploads/2016/09/UZIT_Homepage_Row_1_DK-1.jpg" alt="DOT" width="100%" height="auto" />
								    </p>
                                    <ul class="bxslider">
									  <li><img src="/wp-content/uploads/2016/09/UZIT_Homepage_Row_2_Mission_1-1.jpg" /></li>
									  <li><img src="/wp-content/uploads/2016/09/UZIT_Homepage_Row_2_Mission_2.jpg" /></li>
									  <li><img src="/wp-content/uploads/2016/09/UZIT_Homepage_Row_2_Mission_3-1.jpg" /></li>
                                    
                                    </ul>
									<div class="cell-video-container">

										<iframe src="https://player.vimeo.com/video/180962509?color=FFFFFF&title=0&byline=0&portrait=0" width="100%" height="auto" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
									</div><br>
									<img class="alignnone wp-image-21879 size-full" src="/wp-content/uploads/2016/09/UZIT_Homepage_Row_4_Healing-Modalities.jpg" alt="" width="100%" height="auto" />
									<img class="alignnone wp-image-21814 size-full" src="/wp-content/uploads/2016/09/UZIT_Homepage_Row_5_PANIC.jpg" alt="" width="100%" height="auto" />	
									<img class="alignnone wp-image-21814 size-full" src="/wp-content/uploads/2016/09/UZIT_Homepage_Row_6_Clinical_Rotation-1.jpg" alt="" width="100%" height="auto" />	    
								    <script>
                                        $('.bxslider').bxSlider();
                                    </script>
										
										<div class="text-center">
											<br>
							<a href="http://uzit.urbanzen.org" target="_blank" class="outline-yellow-button">Learn More</a>
						</div>
									
							    </section> <!-- end article section -->
                                
                                
                                
                                
                                
                                
                                
								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ' ', '' ); ?>

								</footer> <!-- end article footer -->

								<?php comments_template(); ?>

							</article> <!-- end article -->

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									
									</article>

							<?php endif; ?>

						</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

			</div> <!-- end .container -->


<?php get_footer(); ?>
