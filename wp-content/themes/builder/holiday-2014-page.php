<?php
/**
 * Full Content Template
 *
   Template Name:  Holiday 2014 (STATIC PAGE)
 *
 */
?>
<?php get_header(); ?>
<style>
.icon-row{
    margin-bottom:20px;
}
.a-icons{
    display:inline-block;
    width:100%;
}
.a-icons img{
    margin-bottom: 0;
}
.a-icons .overlay{
    width:100%;
    height:100%;
    position: absolute;
    display:block;
    z-index:99;
}
.a-icons .overlay span#box-label{
    position: absolute;
    display: block;
    text-align: center;
    width:100%;
    top:50%;
    margin-top:-10px;
    color:#fff;
}
.a-icons .overlay span#box-label.two-lines{
    margin-top: -20px;
}
.a-icons:hover .overlay{
    background-color: rgba(228, 44, 44, 0.3);
}
@media all and (max-width: 1200px) { /* screen size until 1200px */
    body {
        font-size: 1.5em; /* 1.5x default size */
    }
    #box-label, #h-span{font-size:1.5em;}
}
@media all and (max-width: 1000px) { /* screen size until 1000px */
    body {
        font-size: 1.2em; /* 1.2x default size */
    }
    #box-label, #h-span{font-size:1.2em;}
}
@media all and (max-width: 500px) { /* screen size until 500px */
    body {
        font-size: 0.5em; /* 0.8x default size */
    }
    #box-label, #h-span{font-size:0.8em;}
}
</style>
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

									<!--<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>-->

								</header> <!-- end article header -->

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
									
									<div id="Holiday2014">
									    
									    <div class="hero-container" style="width:100%;height:400px;background: url(http://www.urbanzen.com/wp-content/uploads/2014/12/hero_banner.jpg) no-repeat 0 0;background-size:cover;position:relative;margin-bottom:20px;">
									        <div class="hero-text" style="position:absolute;right: 15%;top:50%;text-align:center;margin-top:-50px;">
									            <span>
    									            THIS SEASON, GIVE A GIFT<br />
    									            THAT GIVES BACK
    									        </span>
    									        <h2 style="margin:10px 0; color: #C28742;">HOLIDAY GIFT GUIDE</h2>
    									    </div>
									    </div>
									    
									    <div class="row clearfix" style="background-color:#151515;margin:0 0 20px 0;">
									        <div class="col-md-6 col-xs-12">
									            <div style="padding:10px; margin-right: 4em; padding-top: 3em; padding-bottom: 2em;">
                                                    
                                                    <span style="display:block;">
                                                        <h4>TREASURES FROM THE</h4>
                                                        <h2 style="margin-top: 0px;">SOULFUL ECONOMY MARKETPLACE</h2>
                                                    </span>
                
                                                    <p style= "font-size: 1em;">Visit our holiday marketplace at the Urban Zen Center in New York City for
                                                        a collection of jewelry, apparel, home decor and objects of desires curated by
                                                        Donna Karan and inspired by her travels and a community of like-minded artisans
                                                        and philanthropists.<br /><br />
                                                        <a href="http://www.urbanzen.com/soulful-economy-marketplace/">LEARN MORE</a>
                                                        </p>
                                                </div>
									        </div>
									        <div id="economyMarketplace" class="col-md-6 col-xs-12" style="padding:0;">
									            <img src="http://www.urbanzen.com/wp-content/uploads/2014/12/soulful_economy_marketplace.jpg" style="width:100%;margin:0;">
									        </div>
									    </div>
									    
									    <div class="icon-row row clearfix">
									       <div class="col-md-3 col-xs-6">
                                                <div>
                                                <a class="a-icons" href="http://www.urbanzen.com/collection/jewelry/" style="position:relative;">
                                                 <div class="overlay">
                                                    <span id="box-label" class="two-lines">JEWELRY</span>
                                                 </div>
                                                 <img src="http://www.urbanzen.com/wp-content/uploads/2014/12/jewelry.jpg" alt="Jewelry" style="width:100%;">
                                                </a>
                                                </div>
                                            </div>
									        <div class="col-md-3 col-xs-6">
									            <div>
									                <a class="a-icons" href="javascript:void(0);" style="position:relative;" data-toggle="modal" data-target="#giftForSensesModal">
    									                <div class="overlay">
                                                            <span id="box-label" class="two-lines">GIFTS<br />FOR THE SENSES</span>
                                                         </div>
    									                <img src="http://www.urbanzen.com/wp-content/uploads/2014/12/gift_for_the_senses.png" alt="Gift For The Senses" style="width:100%;">
    									            </a>
    									            <!-- Modal -->
                                                    <div class="modal fade" id="giftForSensesModal" tabindex="-1" role="dialog" aria-labelledby="giftForSensesModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="background-color:#1b1b1b;">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h2 class="modal-title" id="giftForSensesModal">GIFTS FOR THE SENSES</h2>
                                                                </div>
                                                                <div class="modal-body" style="text-align:center;">
                                                                    <img src="http://www.urbanzen.com/wp-content/uploads/2014/12/gift_for_the_senses_modal.jpg" style="width:100%;" />
                                                                    <h2>GIFTS FOR THE SENSES</h2>
                                                                    <p>Contact our New York or Sag Harbor stores for a range of products based on the
                                                                    holistic and healthy living philosophy of Como Shambhala, made with high grade
                                                                    pure essential oils.<br /><br /><a href="http://www.urbanzen.com/locations/">OUR STORES</a></p>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
    									        </div>
									        </div>
									        <div class="col-md-3 col-xs-6">
									            <div>
									                <a class="a-icons" href="http://www.urbanzen.com/haiti-artisan-project/" style="position:relative;">
    									                <div class="overlay">
                                                            <span id="box-label" class="two-lines">HAITI ARTISAN<br />COLLECTION</span>
                                                         </div>
    									                <img src="http://www.urbanzen.com/wp-content/uploads/2014/12/haiti_artisan_collection.jpg" alt="Haiti Artisan Collection" style="width:100%;">
    									            </a>
    									        </div>
									        </div>
									        <div class="col-md-3 col-xs-6">
									            <div>
									                <a class="a-icons" href="http://www.urbanzen.com/collection/tabletop/" style="position:relative;">
    									                <div class="overlay">
                                                            <span id="box-label">TABLETOP</span>
                                                         </div>
    									                <img src="http://www.urbanzen.com/wp-content/uploads/2014/12/tabletop.jpg" alt="Tabletop" style="width:100%;">

    									            </a>
    									        </div>
									        </div>
									    </div>
									    
									    <div class="row clearfix" style="background-color:#151515;margin:0 0 20px 0;">
									        <div class="col-md-6 col-xs-12">
									            <div style="padding:10px; margin-right: 4em; padding-top: 3em; padding-bottom: 2em;">
									            <span style="display:block;"><h4>A GIFT FOR THE MIND, BODY &amp; SPIRIT</h4>
                                                    <h2 style="margin-top: 0px;">URBAN ZEN INTEGRATIVE THERAPY PROGRAM SESSION</h2></span>
                                                    <p style= "font-size: 1em;">In a world of chaos, over-stimulation and over-work, UZIT practices can offer you
                                                    and your loved ones a meditative sanctuary. Urban Zen classes and trainings blend
                                                    gentle movements, restorative yoga poses, body scans, breath practices,
                                                    aromatherapy and Reiki.<br /><br />
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#mindBodySpiritModal">LEARN MORE</a></p>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="mindBodySpiritModal" tabindex="-1" role="dialog" aria-labelledby="mindBodySpiritModal" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="background-color:#1b1b1b;">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h2 class="modal-title" id="mindBodySpiritModal">GIFTS FOR THE SENSES</h2>
                                                                </div>
                                                                <div class="modal-body" style="text-align:center;">
                                                                    <img src="http://www.urbanzen.com/wp-content/uploads/2014/12/a_gift_for_the_mind_body_spirit_modal.jpg" style="width:100%;" />
                                                                    <h2><span style="font=size:18px;display:block;">THE URBAN ZEN INTEGRATIVE THERAPY PROGRAM</span>MISSION</h2>
                                                                    <p>The mission of the Urban Zen Integrative Therapy program is to change the present
                                                                    healthcare paradigm, to treat the patient and not just the disease.</p>
                                                                    <p>Many of our graduates are available for private sessions. This holiday give a gift of peace and calming to your loved one.
                                                                        <br /><br /><a href="mailto:LISA@URBANZEN.COM" target="_blank">CONTACT LISA@URBANZEN.COM TO PURCHASE A GIFT CERTIFICATE</a></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
									        </div>
									        <div class="col-md-6 col-xs-12" style="padding:0;">
									            <img src="http://www.urbanzen.com/wp-content/uploads/2014/12/a_gift_for_the_mind_body_spirit.jpg" style="width:100%;margin:0;">
									        </div>
									    </div>
									    
									</div><!-- /holiday -->
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
