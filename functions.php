<?php
add_filter('show_admin_bar', '__return_false');

add_action('after_setup_theme', function () {
  register_nav_menus([
    'main_menu'    => __('Main Menu', 'nailsalon'),
    'footer_legal' => __('Footer Legal Menu', 'nailsalon'),
  ]);
});

function mytheme_linkify_contact(string $value): string {
  $value = trim($value);
  if ($value === '') return '';

  if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
    $email = sanitize_email($value);
    return '<a class="hover:text-[#B97C8D] transition" href="mailto:' . esc_attr($email) . '">' . esc_html($value) . '</a>';
  }

  $digits = preg_replace('/\D+/', '', $value);
  if (strpos($value, '+') === 0 || strlen($digits) >= 9) {
    $tel = preg_replace('/[^\d\+]+/', '', $value);
    $tel = preg_replace('/(?!^\+)\+/', '', $tel);
    return '<a class="hover:text-[#B97C8D] transition" href="tel:' . esc_attr($tel) . '">' . esc_html($value) . '</a>';
  }

  return esc_html($value);
}

add_action('wp_enqueue_scripts', function () {

  $style_path = get_stylesheet_directory() . '/style.css';
  wp_enqueue_style(
    'mytheme-style',
    get_stylesheet_uri(),
    [],
    file_exists($style_path) ? filemtime($style_path) : wp_get_theme()->get('Version')
  );

  wp_enqueue_style(
    'fontawesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
    [],
    '6.5.1'
  );

  wp_enqueue_style(
    'swiper',
    get_template_directory_uri() . '/assets/vendor/swiper-bundle.min.css',
    [],
    '11'
  );

  $main_css_path = get_template_directory() . '/assets/main.css';
  if (file_exists($main_css_path)) {
    wp_enqueue_style(
      'nailsalon-main',
      get_template_directory_uri() . '/assets/main.css',
      ['mytheme-style', 'swiper'],
      filemtime($main_css_path)
    );
  }

  wp_enqueue_script(
    'swiper',
    get_template_directory_uri() . '/assets/vendor/swiper-bundle.min.js',
    [],
    '11',
    true
  );

  $main_js_path = get_template_directory() . '/assets/main.js';
  if (file_exists($main_js_path)) {
    wp_enqueue_script(
      'nailsalon-main-js',
      get_template_directory_uri() . '/assets/main.js',
      ['swiper'],
      filemtime($main_js_path),
      true
    );
  }

    $reveal_js_path = get_template_directory() . '/assets/js/reveal.js';
  if (file_exists($main_js_path)) {
    
    wp_enqueue_script(
      'reveal-js',
      get_template_directory_uri() . '/assets/js/reveal.js',
      [],
      filemtime($reveal_js_path),
      true
    );
  }

  $menu_js_path = get_template_directory() . '/assets/js/mobile-menu.js';
  if (file_exists($menu_js_path)) {
    wp_enqueue_script(
      'mytheme-mobile-menu',
      get_template_directory_uri() . '/assets/js/mobile-menu.js',
      [],
      filemtime($menu_js_path),
      true
    );
  }

  $modal_js_path = get_template_directory() . '/assets/js/modal.js';
  if (file_exists($modal_js_path)) {
    wp_enqueue_script(
      'mytheme-modal',
      get_template_directory_uri() . '/assets/js/modal.js',
      [],
      filemtime($modal_js_path),
      true
    );
  }

  $theme_js_path = get_template_directory() . '/assets/js/theme.js';
  if (file_exists($theme_js_path)) {
    wp_enqueue_script(
      'mytheme-theme',
      get_template_directory_uri() . '/assets/js/theme.js',
      [],
      filemtime($theme_js_path),
      true
    );
  }
});

add_filter('nav_menu_link_attributes', function ($atts) {
  $href = $atts['href'] ?? '';
  if ($href === '' || $href[0] !== '#') return $atts;

  if (!is_front_page() && !is_home()) {
    $atts['href'] = home_url('/') . $href;
  }
  return $atts;
});

add_action('wp_dashboard_setup', function () {

  if (!current_user_can('klient')) return;

  remove_meta_box('dashboard_activity', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

});

add_filter('use_block_editor_for_post', function ($use, $post) {
  if (!$post || $post->post_type !== 'page') return $use;

  $front_id = (int) get_option('page_on_front');
  if ($front_id && (int) $post->ID === $front_id) {
    return false; // Gutenberg off
  }

  return $use;
}, 10, 2);

add_action('admin_head-post.php', function () {
  $front_id = (int) get_option('page_on_front');
  $post_id  = isset($_GET['post']) ? (int) $_GET['post'] : 0;

  if ($front_id && $post_id === $front_id) {
    echo '<style>#postdivrich{display:none !important;}</style>';
  }
});

add_action('admin_head', function () {
  echo '
  <style>
    .acf-table .acf-image-uploader img {
      max-width: 64px;
      height: auto;
    }
  </style>';
});

if (function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title'  => 'Footer Settings',
    'menu_title'  => 'Footer Settings',
    'menu_slug'   => 'footer-settings',
    'capability'  => 'manage_footer_settings',
    'redirect'    => false,
    'position'    => 60,
  ]);
}

add_action('admin_menu', function () {
  if (!current_user_can('klient')) return;

  remove_menu_page('edit.php');

  remove_menu_page('edit-comments.php');

  remove_menu_page('tools.php');

  remove_menu_page('index.php');
}, 999);

add_action('admin_bar_menu', function ($bar) {
  if (!current_user_can('klient')) return;

  $bar->remove_node('new-content');

}, 999);