<?php
$testimonials = get_field('testimonials');
if (!$testimonials) return;

$title    = $testimonials['title'] ?? '';
$subtitle = $testimonials['subtitle'] ?? '';
$items    = $testimonials['customers'] ?? [];
?>

<section data-reveal  id="bewertungen" class="py-12 md:py-18 bg-white">
  <div class="max-w-5xl mx-auto px-4">

    <?php if ($title) : ?>
      <div class="slider-header">
        <h2 class="slider-title"><?php echo esc_html($title); ?></h2>
      </div>
    <?php endif; ?>

    <?php if ($subtitle) : ?>
      <p class="text-center text-sm md:text-base text-gray-500 mb-10">
        <?php echo esc_html($subtitle); ?>
      </p>
    <?php endif; ?>

    <?php if (!empty($items) && is_array($items)) : ?>
      <div class="grid gap-6 md:grid-cols-3">

        <?php foreach ($items as $item) :
          $name = trim((string)($item['name'] ?? ''));
          $date = trim((string)($item['date'] ?? ''));
          $text = trim((string)($item['review_text'] ?? ''));

          $initials = '';
          if ($name !== '') {
            $parts = preg_split('/\s+/', $name);
            $first  = mb_substr($parts[0] ?? '', 0, 1);
            $second = mb_substr($parts[1] ?? '', 0, 1);
            $initials = mb_strtoupper($first . $second);
          }
        ?>
          <article class="bg-white rounded-3xl shadow-soft p-6 flex flex-col h-full">
            <header class="flex items-center gap-4 mb-4">
              <div class="w-12 h-12 rounded-full border border-gray-300 flex items-center justify-center text-xs font-semibold text-[#7A6262]">
                <?php echo esc_html($initials ?: '★'); ?>
              </div>

              <div>
                <?php if ($name !== '') : ?>
                  <div class="font-semibold text-sm text-[#2B2B2B]">
                    <?php echo esc_html($name); ?>
                  </div>
                <?php endif; ?>

                <?php if ($date !== '') : ?>
                  <div class="text-xs text-gray-500">
                    <?php echo esc_html($date); ?>
                  </div>
                <?php endif; ?>
              </div>
            </header>

            <div class="text-[#796767] text-sm mb-4" aria-label="5 von 5 Sternen">
              ★★★★★
            </div>

            <?php if ($text !== '') : ?>
              <p class="text-sm leading-relaxed text-gray-700">
                <?php echo esc_html($text); ?>
              </p>
            <?php endif; ?>
          </article>

        <?php endforeach; ?>

      </div>
    <?php endif; ?>

  </div>
</section>
