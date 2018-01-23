<?php /*
  Template Name: UZIT Donate V2 Page
 */ ?>
<?php
    $pageSlider = get_post_meta(get_the_ID(), 'pageSlider', true);
    $animation = get_post_meta(get_the_ID(), 'pageSliderAnimation', true);
    $controlNav = get_post_meta(get_the_ID(), 'pageSliderControlNav', true);
?>
<?php get_header(); ?>

<link rel='stylesheet'  href='/wp-content/themes/builder-child/stylesheets/custom/donate-2.css' type='text/css' media='all' />
<link rel='stylesheet'  href='/wp-content/themes/builder-child/stylesheets/jquery-ui.min.css' type='text/css' media='all' />
<script type="text/javascript" src="/wp-content/themes/builder-child/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/wp-content/themes/builder-child/js/custom/jquery.currency.js"></script>
<script type="text/javascript" src="/wp-content/themes/builder-child/js/custom/jquery.numeric.js"></script>

<div id="Donate">

    <div class="sliderWrapper">
        <div class="donation-form-container">
            <div class="container">
                <div class="form-box">
                    <h1 class="slogan">HELP US HELP</h1>
                    <p class="sub-slogan">YES, I WOULD LIKE TO DONATE</p>
                    <form action="http://urbanzen.org/donate/payment/" method="GET">
                     <!--<input  type="text" name="cost" value="" placeholder="$" autocomplete="off" style="margin:0 0 15px 0;"/>-->
						<select id="DonateCost" name="cost" style="margin:0 0 15px 0;">
						  <option value="5.00">$5.00</option>	
						  <option value="10.00">$10.00</option>
						  <option value="25.00">$25.00</option>
						  <option value="25.00">$35.00</option>						  
						  <option value="75.00">$75.00</option>
						  <option value="125.00">$125.00</option>
						  <option value="1000.00">$1000.00</option>
						</select>
						<br>
                        <script>
                            jQuery("#DonateCost").numeric();
                            jQuery("#DonateCost").change(function(){
                                var donate_cost = parseFloat(jQuery(this).val());
                                jQuery(this).val(donate_cost.toFixed(2));
                            });
                        </script>
                        <?php if(!$cost && isset($_GET['cost'])): ?>
                        <div class="error clearfix" style="background: none;padding: 0;">
                            <p>Please enter a donation amount.</p>
                        </div>
                        <?php endif; ?>
                        
                        <div class="clearfix">
                            <input class="button" type="submit" value="BY CREDIT CARD" style="margin-left:0;"/>
                            <input id="ByCheckBtn" class="button" type="button" value="BY CHECK" />
                            <div class="dialog">
                                <div class="dialog-container" style="padding:0 10px;">
                                    <p>DONATE TO CHECK</p>
                                    <p>
                                        To donate by check, please write your check to the Urban Zen Foundation. 
                                        Indicate "Integrative Therapy Program" in the memo section. Mail to:
                                    </p>
                                    <p>
                                        Urban Zen Foundation/Donations<br />
                                        705 Greenwich Street, 2nd Floor<br />
                                        New York, NY 10014<br />
                                    </p>
                                    <p>
                                        As a 501(c)(3) organization, Urban Zen is able to realize its mission for the Integrative Therapy Program 
                                        only through your generous support. All levels of donations are welcome and are tax-deductible.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="slider" class="flexslider">
            <ul class="slides">
             <li style="display:list-item;"><img src="http://urbanzen.org/wp-content/uploads/2015/02/Donation-Page-Slider-1.jpg" /></li>
			<li style="display:list-item;"><img src="http://urbanzen.org/wp-content/uploads/2015/02/Donation-Page-Slider-2.jpg" /></li>
			<li style="display:list-item;"><img src="http://urbanzen.org/wp-content/uploads/2015/02/Donation-Page-Slider-3.jpg" /></li>
            </ul>

			<link rel='stylesheet' id='mission-flexslider-css'  href='http://uzit.urbanzen.org/wp-content/themes/MissionWP22/stylesheets/flexslider.css?ver=20121010' type='text/css' media='all' />
<script type='text/javascript' src='http://uzit.urbanzen.org/wp-content/themes/MissionWP22/js/jquery.flexslider-min.js?ver=1.0'></script>
            <script type="text/javascript">
                jQuery(window).load(function() {
                    jQuery('#slider').flexslider({
                        animation: '<?php if($animation){echo $animation;}else{echo 'fade';} ?>',
                        directionNav: true,
                        controlNav: true,
                        slideshow: true,
						startAt:-2,
                        slideshowSpeed:3000,
						initDelay:0,
						pauseOnAction:false,
						pauseOnHover:false,
                        directionNav: false,
                        animationLoop: true
                    });
                });
            </script>
        </div>
    </div>

    <div class="bottom clearfix">
        <div class="container">
            <h2>THANK YOU</h2>
            <p>As a 501(c) 3 organization, Urban Zen Foundation is able to realize its mission only through your generous
            support. All levels of donation are welcome and tax deductible.</p>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery('#ByCheckBtn').click(function(){
        jQuery( ".dialog" ).dialog({
            resizable: false,
            width:400,
            modal: true,
            buttons: {
                "Okay": function() {
                    jQuery( this ).dialog( "close" );
                }
            }
        });
    });
</script>
<?php get_footer(); ?>