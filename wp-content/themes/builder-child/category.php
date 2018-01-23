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

		<div id="main" class="clearfix" role="main">
      <h1 class="page-title h2"><span><?php _e( '', 'bonestheme' ); ?></span> <?php single_cat_title(); ?></h1>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <ul class="media-list">
          <li class="media">
            <a class="pull-left" href="#">
              <?php the_post_thumbnail('thumbnail', array( 'class'	=> "media-object")); ?>
            </a>
            <div class="media-body">
              <h4 class="media-heading">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
    	          <?php the_title(); ?>
    				  </a>
    				  </h4>
              <?php the_excerpt(); ?>
            </div>
          </li>
        </ul>


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

</div> <!-- end #main -->
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


</div> <!-- end #inner-content -->

</div> <!-- end #content -->

</div> <!-- end .container -->

<?php get_footer(); ?>
