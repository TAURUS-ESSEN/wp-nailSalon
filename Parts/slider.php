<?php
$pid = get_queried_object_id();
$image_ids = get_field('services', $pid);

if (empty($image_ids) || !is_array($image_ids)) return;
?>

<section class="slider-section pt-12 md:pt-18" id="porfolio">
  <div class="slider-inner">
    <div class="slider-header">
      <span class="slider-line"></span>
      <h2 class="slider-title">Services</h2>
      <span class="slider-line"></span>

      <p class="slider-subtitle">Individuelle Pflege, Design & Verlängerung</p>
    </div>

    <div class="slider-frame">
      <button class="slider-arrow slider-arrow--prev" type="button" aria-label="Previous"></button>

      <div class="swiper js-bestworks-swiper">
        <div class="swiper-wrapper">

          <?php foreach ($image_ids as $img_id): ?>
            <?php
              $title = get_the_title($img_id);
              $alt   = get_post_meta($img_id, '_wp_attachment_image_alt', true);
              if (!$alt) $alt = $title ?: 'Service';
            ?>
            <div class="swiper-slide slider-slide">
              <figure class="service-card">
                <?php echo wp_get_attachment_image($img_id, 'large', false, [
                  'loading' => 'lazy',
                  'class'   => 'slider-img',
                  'alt'     => esc_attr($alt),
                ]); ?>

                <?php if ($title): ?>
                  <figcaption class="service-title"><?= esc_html($title); ?></figcaption>
                <?php endif; ?>
              </figure>
            </div>
          <?php endforeach; ?>

        </div>

        <div class="swiper-pagination slider-pagination"></div>
      </div>

      <button class="slider-arrow slider-arrow--next" type="button" aria-label="Next"></button>
    </div>
  </div>
</section>
