<?php
/**
 * Plugin Name: DobsonDev WordPress TinyMCE Example
 * Plugin URI: http://dobsondev.com
 * Description: An example plugin that shows you have to add your own TinyMCE buttons to WordPress for whatever your own plugin.
 * Version: 0.666
 * Author: Alex Dobson
 * Author URI: http://dobsondev.com/
 * License: GPLv2
 *
 * Copyright 2015  Alex Dobson  (email : alex@dobsondev.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


/*
 * Adds the CSS required for non-standard dashicons icons and custom icons
 */
function dobsondev_tinymce_example_css() {
  wp_enqueue_style( 'dobsondev-wordpress-tinymce-example', plugins_url( 'css/tinymce-example.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'dobsondev_tinymce_example_css' );


/*
 * Hooks in the plugin file for TinyMCE as well as the buttons to the editor
 */
function dobsondev_tinymce_example_main() {
  global $typenow;
  // check the current user's permissions
  if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
    return;
  }

  // verify the post type that the user will work with
  if ( !in_array( $typenow, array( 'post', 'page' ) ) ) {
    return;
  }

  // check if WYSIWYG is enabled
  if ( get_user_option('rich_editing') == 'true' ) {
    add_filter( 'mce_external_plugins', 'dobsondev_tinymce_example_add_tinymce_plugin' );
    add_filter( 'mce_buttons_3', 'dobsondev_tinymce_example_register_buttons' );
  }
}
add_action('admin_head', 'dobsondev_tinymce_example_main');


/*
 * Adds our TinyMCE plugin file to TinyMCE editor
 */
function dobsondev_tinymce_example_add_tinymce_plugin( $plugin_array ) {
  $plugin_array['dobsondev_tinymce_example_plugin'] = plugins_url( '/js/tinymce-example-plugin.js', __FILE__ );
  return $plugin_array;
}


/*
 * Adds the buttons defined in our plugin file to the button list on TinyMCE
 */
function dobsondev_tinymce_example_register_buttons( $buttons ) {
  array_push( $buttons, 'dobsondev_tinymce_example_text_button' );
  array_push( $buttons, 'dobsondev_tinymce_example_icon_button' );
  array_push( $buttons, 'dobsondev_tinymce_example_dashicons_button' );
  array_push( $buttons, 'dobsondev_tinymce_example_custom_icon_button' );
  array_push( $buttons, 'dobsondev_tinymce_example_custom_icon_text_button' );
  array_push( $buttons, 'dobsondev_tinymce_example_sub_menu_button' );
  array_push( $buttons, 'dobsondev_tinymce_example_sub_menu_icon_button' );
  array_push( $buttons, 'dobsondev_tinymce_example_sub_sub_menu_button' );
  array_push( $buttons, 'dobsondev_tinymce_example_popup_button' );
  return $buttons;
}


?>