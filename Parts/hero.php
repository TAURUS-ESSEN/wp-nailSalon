<?php
$pid  = get_queried_object_id();
$hero = get_field('hero', $pid);
if (!$hero) return;

$headline    = $hero['headline'] ?? '';
$subheadline = $hero['subheadline'] ?? '';
$text1 = $hero['text_antwort'] ?? '';
$topservices = $hero['topservices'] ?? [];
$cta_primary = $hero['call_to_action_primary'] ?? '';
$img_id      = (int)($hero['hero_image'] ?? 0);
?>

<section class="hero relative flex bg-[#eeeae8] overflow-hidden">

  <!-- MOBILE BG IMAGE   -->
  <?php if ($img_id) : ?>
    <div class="absolute inset-0 md:hidden">
      <?php
        echo wp_get_attachment_image(
          $img_id,
          'large',
          false,
          [
            'loading' => 'lazy',
            'class'   => 'hero-bg-img w-full h-full object-cover'
          ]
        );
      ?>
      <div class="absolute inset-0 z-10 pointer-events-none
        bg-gradient-to-r from-[#eeeae8]/35 via-[#efe9e8]/55 to-transparent"></div>
    </div>
  <?php endif; ?>

  <!-- TEXT -->
  <div class="relative z-20 flex flex-col items-start gap-3 md:gap-5
              px-4 md:px-8 py-10 md:py-0 justify-center
              w-full md:w-auto ">

    <?php if ($headline) : ?>
      <h1 class="text-xl md:text-2xl lg:text-4xl text-gray-600 w-full max-w-[220px]  sm:max-w-xs md:max-w-lg  font-semibold">
        <?php echo esc_html($headline); ?>
      </h1>
    <?php endif; ?>

    <?php if ($subheadline) : ?>
      <p class="text-sm md:text-base lg:text-lg text-[#796767] w-full max-w-[220px] sm:max-w-xs md:max-w-md leading-snug break-words">


        <?php echo esc_html($subheadline); ?>
      </p>
    <?php endif; ?>
    
        
    <?php if (!empty($topservices) && is_array($topservices)) : ?>
      <div class="hero-topservices" role="list">
        <?php foreach ($topservices as $i => $item) :
          $title = $item['service_title'] ?? '';

          $icon_field = $item['service_icon'] ?? 0;
          $icon_id = 0;
          if (is_array($icon_field) && !empty($icon_field['ID'])) $icon_id = (int)$icon_field['ID'];
          elseif (is_numeric($icon_field)) $icon_id = (int)$icon_field;

          if (!$title) continue;
        ?>
          <div class="hero-topservices__item" role="listitem">
            <?php if ($icon_id) : ?>
              <span class="hero-topservices__icon" aria-hidden="true">
                <?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, [
                  'loading' => 'lazy',
                  'class' => 'hero-topservices__img'
                ]); ?>
              </span>
            <?php endif; ?>

            <span class="hero-topservices__text">
              <?php echo esc_html($title); ?>
            </span>

            <?php if ($i < count($topservices) - 1) : ?>
              <span class="hero-topservices__sep" aria-hidden="true"></span>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ($cta_primary) : ?>
      <div class="">
      <button type="button" data-modal-open class="cta-native">
        <?php echo esc_html($cta_primary); ?>
      </button>    
      <?php if ($text1) : ?>
      <p class="text-xs md:text-xs lg:text-xs text-[#796767] max-w-xs md:max-w-md mt-2">
        <?php echo esc_html($text1); ?>
      </p>
    </div>
    <?php endif; ?>
    <?php endif; ?>

  </div>

  <!-- DESKTOP/TABLET IMAGE BLOCK  -->
  <?php if ($img_id) : ?>
    <div class="hidden md:block w-full max-h-[480px] overflow-hidden relative">
      <?php
        echo wp_get_attachment_image(
          $img_id,
          'large',
          false,
          [
            'loading' => 'lazy',
            'class'   => 'hero-bg-img  w-full h-auto object-cover'
          ]
        );
      ?>
      <div class="absolute inset-0 z-10 pointer-events-none
        bg-gradient-to-r from-[#eeeae8] via-[#efe9e8]/5 to-transparent"></div>
    </div>
  <?php endif; ?>

</section>
