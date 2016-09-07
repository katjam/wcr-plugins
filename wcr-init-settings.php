<?php

define( 'WCR_PLUGIN_PATH', plugin_dir_path( __FILE__ ) . 'wcr-settings.php' );
register_activation_hook( WCR_PLUGIN_PATH, 'wcr_init_settings' );
register_activation_hook( WCR_PLUGIN_PATH, 'wcr_add_pages' );

/**
 * Initialise West Country Rural site options.
 */
function wcr_init_settings() {
  // Set up core defaults options vars in wp_options table.
  // http://codex.wordpress.org/Option_Reference
  $core_settings = array(
    'default_comment_status' => 'closed',
    'default_role' => 'author',
    'comments_per_page' => 0,
    'blogdescription' => __( 'Chartered Surveyors, Valuers and Land Agents' ),
    'date_format' => __( 'j F Y' ),
    'permalink_structure' => '/%postname%/',
  );
  foreach ( $core_settings as $k => $v ) {
    update_option( $k, $v );
  }
  // Delete dummy content.
  wp_delete_post( 1, true );
  wp_delete_post( 2, true );
  wp_delete_comment( 1 );
}

/**
 * Add default pages to new West Country Rural install.
 */
function wcr_add_pages() {
  $lorem = '<p>Nullam pulvinar ante nec massa mollis tincidunt. Sed consectetur, lacus a vulputate molestie, velit ipsum semper enim, eu consectetur quam leo quis nisi. In mattis nisi eget orci convallis vel tempus eros imperdiet. Duis in lacus nec sapien porttitor iaculis eu et dui. Proin feugiat turpis ut tellus hendrerit pretium. Donec laoreet ante sed dui placerat venenatis. Aliquam pulvinar eros a velit eleifend elementum.</p>';
  /**********               Add Parent pages            ************/
  $parent_pages = array();
  // menu order => title
  $titles = array(
    5   => 'Contact Us',
    10  => 'About WCR',
    20  => 'BPS &amp; Grant Schemes',
    40  => 'Fodder &amp; Straw',
    50  => 'Valuations',
    60  => 'Planning',
    70  => 'Landlord &amp; Tenant',
    80  => 'Tax',
    90  => 'Compensation',
    100 => 'Development',
    110 => 'Agency'
  );
  foreach ( $titles as $menu_order => $title ) {
    $parent_pages[$menu_order]['title']   = $title;
    $parent_pages[$menu_order]['content'] = 'Please add content for ' . $title . '<br/>' . $lorem;
  }
  foreach ( $parent_pages as $p => $content ) {
    if ( !get_page_by_title( $content['title'] ) ) {
      $page = array(
        'post_author' => 1,
        'post_content' => $content['content'],
        'post_title' => $content['title'],
        'post_name' => sanitize_title( $content['title'] ),
        'post_type' => 'page',
        'post_status' => 'publish',
        'menu_order' => $p,
      );
      wp_insert_post( $page );
    }
  }
}
