<?php
/**
 * Full Content Template
 *
   Template Name:  Rhianna Partnership
 *
 */
?>
<?php get_header(); ?>
<div class="centerBanner">
	<div class="mobile_hidden">
		<img src="http://urbanzen.org/wp-content/uploads/2017/05/d_UZF_rihanna-partnership_bannerb.jpg" style="width:100%"/>
	</div>
	<div class="desktop_hidden">
		<img src="http://urbanzen.org/wp-content/uploads/2017/05/m_UZF_rihanna-partnership_bannerb.jpg" style="width:100%"/>
	</div>
	<div class="centerContent">
		<h1>RIHANNA PARTNERS WITH DONNA KARAN, PARSONS SCHOOL OF DESIGN, AND D.O.T HAITI TO BENEFIT HAITIAN ARTISANS</h1>
		<br>
		<a id="link" class="learn-more">LEARN MORE<span></span></a>
	</div>
</div>
<a name="jump-to"></a>
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
					</header> <!-- end article header -->
					<section class="entry-content clearfix" itemprop="articleBody">
						<?php the_content(); ?>
					</section>
				</article>
			</div>
		</div>
	</div>
</div>

                  
					
						<div class="container">
						<h2 class="text-center heading">Our Partners</h2>
						<div class="row our-partners">
						<div class="col-md-3 col-md-offset-3 text-right">
							<img width="50%" src="http://urbanzen.org/wp-content/uploads/2017/05/parsons-logo-inverted-.png" alt="Parson's New School" />
						</div>
						<div class="col-md-3 text-left">
							<img width="50%" src="http://urbanzen.org/wp-content/uploads/2017/05/clara-lionel-foundation_inverted.png" alt="Clara Lionel Foundation" />
						</div></div>
						</div>
						<br><br>
						<div class="container">
							<h2 class="text-center heading">Our Initiatives</h2>
							<div class="ctas">
								<div class="col-md-4">
								    <div style="position:relative;">
									    <a class="rollover" href="/our-initiatives/haiti-artisan-project/">
									        <div style="position:absolute;text-align:center;width:100%;margin-top:-35px;top:50%;">
									            <span style="color: #FFF;display:block;">PRESERVING CULTURES</span>
									            <span style="color: #fdb913;display:block;font-size: 25px;line-height: 1em;font-weight: 300;">HAITI ARTISAN<br />PROJECT</span>
									        </div>
									        <img class="alignleft size-full wp-image-21315" src="/wp-content/uploads/2016/09/UZF_HP_Thb_Small_1_Haiti_Artisan.jpg" alt="Haiti Artisan Project" width="100%" height="auto" />
									    </a>
									</div>
								</div>
								<div class="col-md-4">
								    <div style="position:relative;">
								        <a class="rollover" href="/our-initiatives/uzit">
								            <div style="position:absolute;text-align:center;width:100%;margin-top:-35px;top:50%;">
									            <span style="color: #FFF;display:block;">WELL-BEING</span>
									            <span style="color: #fdb913;display:block;font-size: 25px;line-height: 1em;font-weight: 300;">UZIT PROGRAM</span>
									        </div>
								            <img class="alignleft size-full wp-image-21314" src="/wp-content/uploads/2016/09/UZF_HP_Thb_Small_3_UZIT.jpg" alt="Connect And Create Urban Zen Center" width="100%" height="auto" />
								        </a>
								    </div>
								</div>
								<div class="col-md-4">
								    <div style="position:relative;">
								        <a class="rollover" href="/our-initiatives/empowering-children/">
								            <div style="position:absolute;text-align:center;width:100%;margin-top:-35px;top:50%;">
									            <span style="color: #FFF;display:block;">EMPOWERING CHILDREN</span>
									            <span style="color: #fdb913;display:block;font-size: 25px;line-height: 1em;font-weight: 300;">EDUCATION</span>
									        </div>
								            <img class="alignleft size-full wp-image-21314" src="/wp-content/uploads/2016/09/UZF_HP_Thb_Small_4_Education.jpg" alt="Connect And Create Urban Zen Center" width="100%" height="auto" />
								        </a>
								    </div>
								</div>
							</div>
						</div>	
						<br/><br/>
						
						
					    

					    <script>
						function scrollToAnchor(aid){
						    var aTag = $("a[name='"+ aid +"']");
						    $('html,body').animate({scrollTop: aTag.offset().top -100},'slow');
						}

						$("#link").click(function() {
						   scrollToAnchor('jump-to');
						});
						
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
