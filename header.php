<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="wrapper">
  <header class="relative z-10 bg-white shadow-xs">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

      <div class="shrink-0">
        <div class="logo leading-none">
          <a href="<?php echo esc_url(home_url('/')); ?>"
            class="block font-serif text-[22px] tracking-wide text-[#B97C8D]">
            <?php bloginfo('name'); ?>
          </a>

          <div class="flex items-center gap-2 mt-2" aria-hidden="true">
            <span class="block w-12 h-px bg-[#D8A7AF]"></span>
            <span class="block w-1.5 h-1.5 rounded-full bg-[#B97C8D]"></span>
            <span class="block w-12 h-px bg-[#D8A7AF]"></span>
          </div>
        </div>
      </div>

      <!-- Desktop nav -->
      <nav class="hidden md:block" aria-label="Hauptnavigation">
        <?php
          wp_nav_menu([
            'theme_location' => 'main_menu',
            'container'      => false,
            'menu_class'     => 'flex gap-10 text-[18px] tracking-widest text-[#2B2B2B]',
            'fallback_cb'    => false,
          ]);
        ?>
      </nav>

      <!-- Mobile toggle -->
      <button
        class="md:hidden inline-flex items-center justify-center w-11 h-11 rounded-lg border border-black/10"
        type="button"
        aria-controls="mobile-menu"
        aria-expanded="false"
        data-mobile-toggle
      >
        <span class="sr-only">Menü öffnen</span>
        <i class="fa-solid fa-bars text-[#2B2B2B]" aria-hidden="true"></i>
      </button>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden hidden border-t border-black/5 bg-white">
      <div class="px-6 py-4">
        <?php
          wp_nav_menu([
            'theme_location' => 'main_menu',
            'container'      => false,
            'menu_class'     => 'flex flex-col gap-4 text-[18px] tracking-widest text-[#2B2B2B]',
            'fallback_cb'    => false,
          ]);
        ?>
      </div>
    </div>
  </header>

  <main>
