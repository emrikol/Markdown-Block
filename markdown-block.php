<?php
/**
 * Plugin Name: Markdown Block
 * Plugin URI: https://github.com/emrikol/markdown-block/
 * Description: A markdown block for the Gutenberg editor.
 * Version: 0.1.0
 * Author: Derrick Tennant
 * Author URI: https://github.com/emrikol/markdown-block/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/emrikol/markdown-block/
 * Text Domain: markdown-block
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require 'class-markdown-block.php';

if ( class_exists( 'WPCom_Markdown' ) ) {
	add_action( 'init', array( WPCom_Markdown::get_instance(), 'load' ) );
}

add_action( 'init', array( 'Markdown_Block', 'register_block_types' ) );
add_action( 'enqueue_block_editor_assets', array( 'Markdown_Block', 'enqueue_block_editor_assets' ) );

add_filter( 'the_content', array( 'Markdown_Block', 'filter_the_content' ), 10, 1 );

