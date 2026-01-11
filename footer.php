</main>

<?php
$contacts    = get_field('contacts', 'option');
$impressum   = get_field('impressum', 'option');
$datenschutz = get_field('datenschutz', 'option');
$instagram   = get_field('instagram', 'option');
$facebook    = get_field('facebook', 'option');
$copyright   = get_field('copyright', 'option');
?>

<footer data-reveal  id="kontakt"
  class="relative overflow-hidden pt-10 md:pt-20 pb-8 text-[#6B5B5B]"
  style="
    background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/footer.webp');
    background-repeat: no-repeat;
    background-size: cover;
    
  "
>
  <div class="absolute inset-0 bg-white/15"></div>

  <div class="absolute inset-0 pointer-events-none
    bg-[radial-gradient(circle_at_15%_20%,rgba(255,255,255,0.55),transparent_55%),radial-gradient(circle_at_85%_35%,rgba(255,255,255,0.30),transparent_60%),radial-gradient(circle_at_25%_85%,rgba(255,255,255,0.22),transparent_60%)]">
  </div>

  <div class="relative max-w-6xl mx-auto px-6">

    <?php if (!empty($contacts) && is_array($contacts)) : ?>
      <div class="grid md:grid-cols-3 text-center mb-4 md:mb-10 gap-2">

        <?php foreach (array_values($contacts) as $i => $item) :
          $title = trim((string)($item['title'] ?? ''));
          $text1 = (string)($item['text1'] ?? '');
          $text2 = (string)($item['text2'] ?? '');

          $icon = $item['icon'] ?? null;
          $icon_id = null;
          if (is_array($icon)) $icon_id = $icon['ID'] ?? null;
          elseif (is_numeric($icon)) $icon_id = (int)$icon;
        ?>
          <div class="md:px-6 relative">
            <?php if ($i !== 0) : ?>
              <span class="hidden md:block absolute left-0 top-14 bottom-10 w-px bg-[#D7C3C3]/55"></span>
            <?php endif; ?>

            <?php if ($title !== '') : ?>
              <div class="flex items-center justify-center mb-6">
                <span class="h-px w-10 md:w-24 bg-[#D7C3C3]/70"></span>
                <h3 class="font-serif text-[24px] tracking-[0.08em] text-[#7A6262]">
                  <?php echo esc_html($title); ?>
                </h3>
                <span class="h-px w-10 md:w-24 bg-[#D7C3C3]/70"></span>
              </div>
            <?php endif; ?>

            <?php if ($icon_id || $text1 || $text2) : 
              $is_address = (mb_strtolower($title) === 'adresse');
              $maps_url = '';

              if ($is_address) {
                $addr = trim($text1 . ' ' . $text2);  
                if ($addr !== '') {
                  $maps_url = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($addr);
                }
              }
              ?>
              <div class="flex justify-center items-center gap-3 mb-3">
                <?php if ($icon_id) : ?>

            <?php if ($is_address && $maps_url) : ?>
              <a href="<?php echo esc_url($maps_url); ?>"
                target="_blank"
                rel="noopener"
                aria-label="Adresse auf Google Maps öffnen"
                class="hover:scale-110 transition">
            <?php endif; ?>

      <?php
        echo wp_get_attachment_image(
          (int)$icon_id,
          'thumbnail',
          false,
          ['class' => 'w-10 h-10 object-contain opacity-90', 'loading' => 'lazy']
        );
      ?>

  <?php if ($is_address && $maps_url) : ?>
    </a>
  <?php endif; ?>

<?php endif; ?>

                <div class="flex flex-col items-start">
                  <?php if (trim($text1) !== '') : ?>
                    <div class="text-[16px] text-[#6B5B5B]">
                      <?php echo mytheme_linkify_contact($text1); ?>
                    </div>
                  <?php endif; ?>

                  <?php if (trim($text2) !== '') : ?>
                    <div class="text-[16px] text-[#6B5B5B]">
                      <?php echo mytheme_linkify_contact($text2); ?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>

      </div>
    <?php endif; ?>

    <div class="flex flex-col md:flex-row items-center gap-5 text-base mt-20">

      <div class="flex items-center gap-4 text-[#7A6262] w-full md:w-auto justify-center md:justify-start">
        <?php if (has_nav_menu('footer_legal')) : ?>
          <nav aria-label="Footer legal navigation">
            <?php
              wp_nav_menu([
                'theme_location' => 'footer_legal',
                'container'      => false,
                'menu_class'     => 'flex gap-6 [&_a]:hover:text-[#B97C8D] [&_a]:transition',
                'fallback_cb'    => false,
              ]);
            ?>
          </nav>
        <?php else : ?>
          <?php if (!empty($impressum)) : ?>
            <a class="hover:text-[#B97C8D]  transition" href="<?php echo esc_url($impressum); ?>">Impressum</a>
          <?php endif; ?>
          <?php if (!empty($datenschutz)) : ?>
            <a class="hover:text-[#B97C8D] transition" href="<?php echo esc_url($datenschutz); ?>">Datenschutz</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <div class="flex flex-col md:flex-row items-center gap-5 w-full md:flex-1 md:order-0 order-3">
        <span class="hidden md:block h-px flex-1 bg-[#D7C3C3]/55"></span>

        <div class="flex items-center justify-center gap-4">
          <?php if (!empty($instagram)) : ?>
            <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" aria-label="Instagram">
              <i class="fa-brands fa-square-instagram fa-2xl hover:scale-110 duration-300" style="color:#cba19e;" aria-hidden="true"></i>
            </a>
          <?php endif; ?>

          <?php if (!empty($facebook)) : ?>
            <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" aria-label="Facebook">
              <i class="fa-brands fa-facebook fa-2xl hover:scale-110 duration-300" style="color:#cba19e;" aria-hidden="true"></i>
            </a>
          <?php endif; ?>
        </div>

        <span class="hidden md:block h-px flex-1 bg-[#D7C3C3]/55"></span>
      </div>

      <div class="text-base text-[#7A6262] w-full md:w-auto flex justify-center md:justify-end md:text-right">
        &copy; <?php echo esc_html(!empty($copyright) ? $copyright : date('Y')); ?>
      </div>

    </div>
  </div>
</footer>

<div id="modal-booking"
    class="fixed inset-0 z-50 flex items-center justify-center p-4
            opacity-0 pointer-events-none transition-opacity duration-200 ease-out"
    hidden
    aria-hidden="true"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-title">

  <div class="absolute inset-0 z-10 bg-black/45 backdrop-blur-[2px]
              opacity-0 transition-opacity duration-200 ease-out"
              data-modal-close></div>

  <div class="relative z-20 w-full max-w-lg rounded-3xl bg-white/90 p-7 md:p-8
              shadow-2xl ring-1 ring-[#D7C3C3]/60
              translate-y-3 scale-[0.98] opacity-0
              transition duration-200 ease-out">

    <div class="absolute inset-0 rounded-3xl pointer-events-none
      bg-[radial-gradient(circle_at_20%_20%,rgba(255,255,255,0.85),transparent_55%),radial-gradient(circle_at_80%_30%,rgba(255,255,255,0.55),transparent_60%)]">
    </div>

    <button
      type="button"
      class="absolute top-4 right-4 z-20 w-10 h-10 inline-flex items-center justify-center
            rounded-full text-[#7A6262] hover:bg-black/5
            focus:outline-none focus-visible:ring-2 focus-visible:ring-[#B97C8D]/40"
      aria-label="Dialog schließen"
      data-modal-close
    >
      <span class="sr-only">Schließen</span>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
          class="w-5 h-5" fill="none" stroke="currentColor"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          aria-hidden="true">
        <line x1="18" y1="6" x2="6" y2="18"/>
        <line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </button>

    <div class="relative">
      <div class="flex items-center gap-3 mb-6">
        <div class="h-px flex-1 bg-[#D7C3C3]/70"></div>
        <h2 id="modal-title" class="font-serif text-[26px] tracking-[0.08em] text-[#7A6262]">
          Schnellanfrage
        </h2>
        <div class="h-px flex-1 bg-[#D7C3C3]/70"></div>
      </div>

      <div class="cf7-modal">
        <?php echo do_shortcode('[contact-form-7 id="f074c6e" title="Contact form 1"]'); ?>
      </div>

      <div hidden class="mt-4 text-center text-[#7A6262]" data-booking-success>
        Danke! Anfrage wurde gesendet.
      </div>
    </div>

  </div>
</div>


<?php wp_footer(); ?>
</body>
</html>
