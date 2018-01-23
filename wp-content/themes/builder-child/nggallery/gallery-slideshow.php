<?php 
/**
Template Page for the gallery overview

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<style>

</style>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/library/css/nivo-slider.css" type="text/css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/library/js/jquery.nivo.slider.pack.js" type="text/javascript"></script>
<script type="text/javascript">
 jQuery(window).load(function() {
       jQuery('#slider').nivoSlider({
         effect: 'fade',
         nextText:'',
         prevText:'',
         controlNav: false,
         pauseTime:4000,
         directionNav: true
       });
   });
</script>
  <div id="slider" class="nivoSlider">
    <?php foreach ( $images as $image ) : ?>    
        <a href="<?php echo $image->ngg_custom_fields['Link URL']; ?>">
            <img title="<?php echo $image-> alttext; ?>" alt="<?php echo $image->alttext; ?>" src="<?php echo $image->imageURL; ?>" >
        </a>
    <?php endforeach; ?>       
  </div>