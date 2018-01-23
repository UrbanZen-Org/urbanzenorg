<?php
/*
This is the custom post type taxonomy template.
If you edit the custom taxonomy name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom taxonomy is called
register_taxonomy( 'shoes',
then your single template should be
taxonomy-shoes.php

*/
?>

<?php get_header(); ?>

<div class="container">

  <div id="content">
	  <div id="inner-content" class="wrap clearfix">
		  <div id="full-width" class="clearfix" role="main">
		  <div class="row">
		  	<div class="col-md-4">
		  	  <article>
		  	    <h1  style="text-transform:uppercase;font-size:bigger;margin-top:20px;">DONNA'S VOICE</h1>
		  	    <a href="http://urbanzen.org/donnas-voice/letter-from-donna/">
    	  	    <img class="img-responsive"  src="<?php echo get_site_url(); ?>/wp-content/uploads/2014/06/donnas-voice1.png" alt="Donna's Voice" />
    	  	  </a>
            <a href="<?php echo get_site_url(); ?>/letter-from-donna/">  
              <h4>Create, Connect, Collaborate, Communicate, Change.</h4>
              <p class="extra">This is my heart for Urban Zen Foundation.<br/>Join me on my journeys.</p>
            </a>
          </article>  
        </div>
        <div class="col-md-8">

  			  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    			  <article id="post-<?php the_ID(); ?>" class="col-lg-6 col-sm-6 col-xs-12 img-article" role="article">

    				<header class="article-header"></header> <!-- end article header -->

    				<section class="entry-content">
    				  <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
    				    <?php the_post_thumbnail('post-thumbnail', array( 'class'	=> "img-responsive attachment-post-thumbnail")); ?>
    				    <div class="caption-bg"></div>
    				    <span class="caption"><?php the_title(); ?></span>
    				    <span class="caption2">READ MORE</span>
    				  </a>
    				</section> <!-- end article section -->

    				<footer class="article-footer">

    				</footer> <!-- end article footer -->

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
            		<p><?php _e( 'This is the error message in the taxonomy-custom_cat.php template.', 'bonestheme' ); ?></p>
            	</footer>
            </article>
          <?php endif; ?>
          <?php if (function_exists("builder_numbered_pages")) { ?>
            <?php builder_numbered_pages(); ?>
            <?php } else { ?>
              <nav>
              	<ul class="pager">
              		<li class="previous"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' ) ); ?></li>
              		<li class="next"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' ) ); ?></li>
              	</ul><!-- end of .pager -->
              </nav>
              <?php } ?>
  	    </div>
  	    
      </div>
      
    </div>

    </div> <!-- end #inner-content -->
  </div> <!-- end #content -->
</div> <!-- end .container -->
<?php get_footer(); ?>