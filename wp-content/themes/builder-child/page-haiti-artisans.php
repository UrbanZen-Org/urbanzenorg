<?php
/**
 * Full Content Template
 *
   Template Name:  Haiti Artisan
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
								            
								    </p>
                                    <ul class="bxslider">
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_DK.jpg" /></li>
									  <li><img src="/wp-content/uploads/2016/09/UZF_HA_Row_2_Mission_Slide_1.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_01_ApparentProject.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_02_CaribbeanCraft.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_04_Add_HaitiDesignCoOp.jpg" /></li>
									  <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_03_Tobacco.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_04_LeoganeStone.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_05_Maritou.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_06_PascaleTheard.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_07_PaulaColes.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_08_PhilippeDodard.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_09_Horn.jpg" /></li>
                                      <li><img src="/wp-content/uploads/2016/09/UZF_HA_Slider_10_Cookie.jpg" /></li>
                                    </ul>
									<div class="cell-video-container">

										<iframe src="https://player.vimeo.com/video/29276643?color=FFFFFF&title=0&byline=0&portrait=0" width="100%" height="auto" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
									</div><br>
									<h2 class="heading yellow text-center">D.O.T</h2><br/>
									 <ul class="bxslider">
                                      <li><img src="/wp-content/uploads/2017/05/UZF_HA_DOT_Slider_1.jpg" /></li>
									  <li><img src="/wp-content/uploads/2017/05/UZF_HA_DOT_Slider_2.jpg" /></li>
                                     
                                    </ul>
                                    <p class="text-center">The Design, Organization, Training Center (D.O.T) in Port-au-Prince, was created by Donna Karan, Urban Zen, Parsons School of Design, and Haitian artisan and businesswoman Paula Coles to help bridge Haiti's traditional artisan techniques with the modernity and design innovation needed to succeed in today's global marketplace.</p><br>
                                    <h2 class="heading yellow text-center">Our Impact</h2><br/>
								    <img class="alignnone wp-image-21814 size-full" src="http://urbanzen.org/wp-content/uploads/2017/05/UZF_HA_DiscoverHaiti_no-text.jpg" alt="" width="1560" height="600" />
								    <p class="text-center">The outcome of Urban Zen's commitment to Haiti has raised massive awareness, created jobs, provided vocational eductation, and inspired others in the creative community to join the platform and bring even more opportunity to the developing world.</p>
								    <script>
                                        $('.bxslider').bxSlider();
                                    </script>
									
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
