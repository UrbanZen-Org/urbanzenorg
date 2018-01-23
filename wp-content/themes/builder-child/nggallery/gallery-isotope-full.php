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

<?php

add_action('wp_head', 'uz_zoom_css');
add_action('wp_head', 'uz_zoom_js');

?>
<style type="text/css">

/**** centre nav and put at bottom ****/

#isotopegallery{
	padding-bottom: 40px;
}

/**** Isotope Filtering ****/

.isotope-item {
  z-index: 2;
}

.isotope-hidden.isotope-item {
  pointer-events: none;
  z-index: 1;
}

/**** Isotope CSS3 transitions ****/

.isotope,
.isotope .isotope-item {
  -webkit-transition-duration: 0.8s;
     -moz-transition-duration: 0.8s;
      -ms-transition-duration: 0.8s;
       -o-transition-duration: 0.8s;
          transition-duration: 0.8s;
}

.isotope {
  -webkit-transition-property: height, width;
     -moz-transition-property: height, width;
      -ms-transition-property: height, width;
       -o-transition-property: height, width;
          transition-property: height, width;
}

.isotope .isotope-item {
  -webkit-transition-property: -webkit-transform, opacity;
     -moz-transition-property:    -moz-transform, opacity;
      -ms-transition-property:     -ms-transform, opacity;
       -o-transition-property:         top, left, opacity;
          transition-property:         transform, opacity;
}

/**** disabling Isotope CSS3 transitions ****/

.isotope.no-transition,
.isotope.no-transition .isotope-item,
.isotope .isotope-item.no-transition {
  -webkit-transition-duration: 0s;
     -moz-transition-duration: 0s;
      -ms-transition-duration: 0s;
       -o-transition-duration: 0s;
          transition-duration: 0s;
}

.photo{
	float:left;
	margin:10px;
	height:auto;
	overflow:hidden;
}

#filters li{
  float:left;
  list-style-type: none;
  clear:both;
}

#filters li .btn.btn-link{font-size:15px;font-weight:100;padding-left:0;display:block;}
.isotope-item {
  z-index: 2;
}

.isotope-hidden.isotope-item {
  pointer-events: none;
  z-index: 1;
}

/* 5 columns, percentage width */

.portrait{max-width:277px;}
.square { width:277px; height:277px;overflow:hidden; }
.landscape{width:559px !important;height:auto;}


</style>
<script type="text/javascript">
jQuery(window).load(function(){  
  var $container =  jQuery('#isotopegallery');
  $container.isotope({
    itemSelector: '.photo',
    masonry:{}
  });

  jQuery('#filters a').click(function(){
    var selector = jQuery(this).attr('data-filter');
    $container.isotope({ filter: selector });
    return false;
  });
});
</script>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#domready=1"></script>
<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>
<?php /*
  <div class="col-md-3">
  <h1 class="collection-title" itemprop="headline">
    <?php the_title(); ?>
  </h1>
  <ul id="filters" class="inline clearfix" style="padding-left:0;">
    <li>
	    <a href="#" class="btn btn-link" style="font-size:18px;" data-filter="*">SHOW ALL</a>
	  </li>
    <?php $tags_used=array(); ?>
     <?php foreach ( $images as $image ) :
       $tags = wp_get_object_terms($image->pid,'ngg_tag');
       $tag_name = '';

       foreach ( $tags as $tag ) : 
         $tag_name = $tag->name;?>
         <?php if(!in_array($tag_name,$tags_used)): ?>
           <?php $tags_used[]=$tag_name; ?>
         <li>
         <a href="#" class="btn btn-link" data-filter=".<?php echo $tag_name ?>">
           <?php echo $tag_name ?>
         </a>
         </li>
       <?php endif; ?>
    <?php endforeach; ?>    
  <?php endforeach; ?>      
  </ul>
</div> */?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>
  
  <div class="row col-md-12">
     <h1 class="collection-title pull-left" style="padding-left:15px"><?php the_title(); ?></h1><p class="collection-note pull-right">INQUIRE | 212 206 3999 or <a href="mailto:705@URBANZEN.COM">705@URBANZEN.COM</a></p>
   </div>
<div class="col-md-12 photos clearfix" id="isotopegallery" id="<?php echo $gallery-> anchor; ?>">
 
        <?php
                //Used to break down and extract the width and height of each image
                function get_string_between($string, $start, $end){
                        $string = " ".$string;
                        $ini = strpos($string,$start);
                        if ($ini == 0) return "";
                        $ini += strlen($start);
                        $len = strpos($string,$end,$ini) - $ini;
                        return substr($string,$ini,$len);
                }
        ?>
 
        <!-- Thumbnails -->
        <?php foreach ( $images as $image ) : ?>    
                <?php if ( !$image->hidden ) {
                                    //GET the Size parameters for each image. this i used to size the div box that the images go inside of.
                                    $the_size_string = $image->size;
                                    $thewidth = get_string_between($the_size_string, "width=\"", "\"");
                                    $theheight = get_string_between($the_size_string, "height=\"", "\"");
                                    $divstyle = 'width:'.$thewidth.'px; height:'.$theheight.'px;'; 
                            }?>
               
 
                        <?php
                                //Get the TAGS for this image  
                                $tags = wp_get_object_terms($image->pid,'ngg_tag');
                                $tag_string = ''; //store the list of strings to be put into the class menu for isotpe filtering       
                                ?>
                                <?php foreach ( $tags as $tag ) : ?>     
                                  <?php $tag_string = $tag_string.$tag->slug.' ';  //alternativley can use $tag->name;, slug with put hyphen between words ?>      
                                <?php endforeach; ?>
                                               
                <div class="photo <?php echo $tag_string; ?><?php echo $image->ngg_custom_fields['Image Shape']; ?>">
                        <a href="<?php echo $image->imageURL ?>" title="<?php echo $image-> description; ?>" class="<?php echo $tag_string; ?><?php echo $image->ngg_custom_fields['Image Shape']; ?>" <?php echo $image->thumbcode ?> >
                           <div class="caption"><span class="title"><?php echo $image-> description; ?></span><br/><?php echo $image->ngg_custom_fields['Price']; ?></span><div class="caption-bg"></div></div>
                                <?php if ( !$image->hidden ) { ?>
                                  </a>
                                  
                                <img title="<?php echo $image-> alttext; ?>" alt="<?php echo $image->alttext ?>" src="<?php echo $image-> thumbnailURL; ?>" class="<?php echo $tag_string; ?><?php echo $image->ngg_custom_fields['Image Shape']; ?>" />
                                <?php }; ?>
                </div> 
       
                <?php if ( $image->hidden ) continue; ?>
                <?php if ( $gallery->columns > 0 && ++$i % $gallery->columns == 0 ) { ?>

                <?php } ?>
 
        <?php endforeach; ?>
       
        <!-- Pagination -->
        <?php echo $pagination; ?>
       
</div>
<?php endif; ?>

