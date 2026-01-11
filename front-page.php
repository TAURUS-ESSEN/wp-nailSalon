<?php get_header(); ?>
  <h1><?php //the_title(); ?></h1>   
  <div class="page-content">
  </div>

  <?php get_template_part('parts/hero'); ?>
  <?php get_template_part('parts/slider'); ?>
  <?php get_template_part('parts/prices'); ?>
  <?php get_template_part('parts/gallery'); ?>
  <?php get_template_part('parts/testimonials'); ?>
  <?php get_template_part('parts/cta'); ?>
<?php   get_footer(); ?>