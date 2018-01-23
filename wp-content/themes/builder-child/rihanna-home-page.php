<?php
/**
 * Full Content Template
 *
   Template Name:  Rhianna Homepage
 *
 */
?>
<?php get_header(); ?>

<div id="content">
	<div id="inner-content" class="wrap clearfix">
		<div id="full-width" class="clearfix" role="main">
			<div class="container-fluid">
				<ul class="bxslider">
					<li>
						<div class="centerContent centerBanner">
							<h2>Announcing the</h2>
							<h1>Stephan Weiss<br/>Apple Awards</h1>
							<br>
							<a id="link" href="/events/stephen-weiss-apple-awards" class="outline-yellow-button">LEARN MORE</a>
						</div>
						<?php 
						$image_1_d = get_field('slide_1_desktop');
						if( !empty($image_1_d) ): ?>
							<img class="mobile_hidden" src="<?php echo $image_1_d['url']; ?>" alt="<?php echo $image_1_d['alt']; ?>" />
						<?php endif; ?>
						<?php 
						$image_1_m = get_field('slide_1_mobile');
						if( !empty($image_1_m) ): ?>
							<img class="desktop_hidden" src="<?php echo $image_1_m['url']; ?>" alt="<?php echo $image_1_m['alt']; ?>" />
						<?php endif; ?>
					</li>
					<li>
						<div class="centerContent centerBanner">
							<h2>HAITI ARTISAN PROJECT</h2>
							<h1>PARTNERING WITH RIHANNA</h1>
							<br>
							<a id="link" href="/donna-karan-and-rhianna-partnership/" class="outline-yellow-button">LEARN MORE</a>
						</div>
						<?php 
						$image_2_d = get_field('slide_2_desktop');
						if( !empty($image_2_d) ): ?>
							<img class="mobile_hidden" src="<?php echo $image_2_d['url']; ?>" alt="<?php echo $image_2_d['alt']; ?>" />
						<?php endif; ?>
						<?php 
						$image_2_m = get_field('slide_2_mobile');
						if( !empty($image_2_m) ): ?>
							<img class="desktop_hidden" src="<?php echo $image_2_m['url']; ?>" alt="<?php echo $image_2_m['alt']; ?>" />
						<?php endif; ?>
					</li>
				  	<li>
				  		<div class="centerContent centerBanner">
							<h2>WELL-BEING</h2>
							<h1>UZIT PROGRAM</h1>
							<br>
							<a id="link" href="/our-initiatives/uzit" class="outline-yellow-button">LEARN MORE</a>
						</div>
				  		<?php 
						$image_3_d = get_field('slide_3_desktop');
						if( !empty($image_3_d) ): ?>
							<img class="mobile_hidden" src="<?php echo $image_3_d['url']; ?>" alt="<?php echo $image_3_d['alt']; ?>" />
						<?php endif; ?>
						<?php 
						$image_3_m = get_field('slide_3_mobile');
						if( !empty($image_3_m) ): ?>
							<img class="desktop_hidden" src="<?php echo $image_3_m['url']; ?>" alt="<?php echo $image_3_m['alt']; ?>" />
						<?php endif; ?>
				  	</li>
				  	<li>
				  		<div class="centerContent centerBanner">
							<h2>EDUCATION</h2>
							<h1>EMPOWERING CHILDREN</h1>
							<br>
							<a id="link" href="/our-initiatives/empowering-children" class="outline-yellow-button">LEARN MORE</a>
						</div>
				  		<?php 
						$image_4_d = get_field('slide_4_desktop');
						if( !empty($image_4_d) ): ?>
							<img class="mobile_hidden" src="<?php echo $image_4_d['url']; ?>" alt="<?php echo $image_4_d['alt']; ?>" />
						<?php endif; ?>
						<?php 
						$image_4_m = get_field('slide_4_mobile');
						if( !empty($image_4_m) ): ?>
							<img class="desktop_hidden" src="<?php echo $image_4_m['url']; ?>" alt="<?php echo $image_4_m['alt']; ?>" />
						<?php endif; ?>
				  	</li>								  									                                      
		        </ul>
		        <script>$('.bxslider').bxSlider({auto: true});</script>
			</div>
			<div class="container">
				<div class="row">
					<h2 class="heading yellow text-center">Mission</h2>
					<div class="col-md-6 col-md-offset-3 text-center">
						<p class="spaced-text">The Urban Zen Foundation creates, connects, and collaborates to raise awareness and inspire change in the areas of preservation of cultures, well being, and education.<br><br></p>
					</div>
				</div>
				<br>
				<?php /* ?>
			    <div class="ctas">
					<div class="col-md-4">
					    <div style="position:relative;">
						    <a class="rollover" href="/our-initiatives/d-o-t">
						        <div style="position:absolute;text-align:center;width:100%;margin-top:-35px;top:50%;">
						            <span style="color: #FFF;display:block;text-transform: uppercase;">Preservation of Culture</span>
						            <span style="color: #fdb913;display:block;font-size: 25px;line-height: 1em;font-weight: 300;">Haiti Artisan Project</span>
						        </div>
						        <img class="alignleft size-full wp-image-21316" src="/wp-content/uploads/2017/05/UZF_HP_Thb_HaitiArtisan.jpg" alt="Integrative Therapy Program" width="100%" height="auto" />
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
					            <img class="alignleft size-full wp-image-21314" src="/wp-content/uploads/2016/09/UZF_HP_Thb_Small_3_UZIT-300x205.jpg" alt="Connect And Create Urban Zen Center" width="100%" height="auto" />
					        </a>
					    </div>
					</div>
					<div class="col-md-4">
					    <div style="position:relative;">
					        <a class="rollover" href="/our-initiatives/haiti-wellness-initiative">
					            <div style="position:absolute;text-align:center;width:100%;margin-top:-35px;top:50%;">
						            <span style="color: #FFF;display:block;">EDUCATION</span>
						            <span style="color: #fdb913;display:block;font-size: 25px;line-height: 1em;font-weight: 300;">Empowering Children</span>
						        </div>
					            <img class="alignleft size-full wp-image-21314" src="/wp-content/uploads/2017/05/UZF_HP_Thb_Children.jpg" alt="Connect And Create Urban Zen Center" width="100%" height="auto" />
					        </a>
					    </div>
					</div>
				</div>
				<?php */ ?>
				<div class="table-container">		
					<div class="row founder">
						<div class="col-md-6 tableCell">
							<img src="<?php echo get_site_url();?>/wp-content/uploads/2016/05/founder-vid-link.jpg" width="100%" height="auto" />
						</div><div class="col-md-6 tableCell text-center">
							<h4>OUR FOUNDER</h4>
							<h2>DONNA KARAN</h2>
							<p class="spaced-text">A philanthropist, a world traveler, a lifelong yogi, as well as a mother and grandmother, Donna considers Urban Zen Foundation the natural extension of her desire to find the missing link in the areas she cares most about. It is also the realization of Donna’s dream not just to dress people, but to address them as well.
							</p>
						</div>
					</div>
				</div>
				<div class="table-container">
					<div class="row founder">
						<div class="col-md-6 tableCell desktop_hidden">
							<img src="<?php echo get_site_url();?>/wp-content/uploads/2017/05/dm_hp_large-box_UZ-Center.jpg" width="100%" height="auto" />
						</div><div class="col-md-6 tableCell text-center">
							<h4>Create, Connect, Collaborate, Communicate, Change</h4>
							<h2>Urban Zen Center</h2>
							<p class="spaced-text">Urban Zen Center is a space dedicated to raising awareness and inspiring change.</p>
							<br>
							<a href="/our-initiatives/urban-zen-center" class="outline-yellow-button">Urban Zen Center</a>
						</div><div class="col-md-6 tableCell mobile_hidden">
							<img src="<?php echo get_site_url();?>/wp-content/uploads/2017/05/dm_hp_large-box_UZ-Center.jpg" width="100%" height="auto" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>