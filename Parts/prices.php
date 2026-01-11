<?php $prices = get_field('prices'); ?>

<?php if ($prices) : ?>
<section id="preise" data-reveal class="bg-white px-6 py-12 md:py-18">

  <?php if (!empty($prices['header'])) : ?>
    <div class="slider-header mb-10 text-center">
      <h2 class="slider-title"><?php echo esc_html($prices['header']); ?></h2>

      <?php if (!empty($prices['subtitle'])) : ?>
        <p class="slider-subtitle"><?php echo esc_html($prices['subtitle']); ?></p>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
    <?php if (!empty($prices['price_sections'])) : ?>
      <?php foreach ($prices['price_sections'] as $section) : ?>
        <article class="h-full bg-[#fbfaf9] rounded-2xl shadow-sm border border-black/5 px-6 py-6">

          <?php if (!empty($section['section_title'])) : ?>
            <header class="mb-4">
              <h3 class="text-[#B76E79] font-semibold text-base md:text-xl uppercase">
                <?php echo esc_html($section['section_title']); ?>
              </h3>
              <div class="h-px bg-black/10 mt-3"></div>
            </header>
          <?php endif; ?>

          <?php if (!empty($section['services'])) : ?>
            <ul class="space-y-1">
              <?php foreach ($section['services'] as $service) :
                $name  = trim((string)($service['service_name'] ?? ''));
                $price = trim((string)($service['service_price'] ?? ''));
                if ($name === '' && $price === '') continue;
              ?>
               <li class="flex items-start justify-between gap-4  border-b border-[#d8d6d64a]">
                <span class="flex-1 min-w-0 text-[#2B2B2B] text-base md:text-lg leading-snug break-words">
                  <?php echo esc_html($service['service_name'] ?? ''); ?>
                </span>

                <span class="shrink-0 text-[#2B2B2B] text-base md:text-lg font-medium whitespace-nowrap">
                  <?php echo esc_html($service['service_price'] ?? ''); ?>€
                </span>
              </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</section>
<?php endif; ?>
