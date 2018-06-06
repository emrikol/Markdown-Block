<?php
/**
 * Name: Markdown Block
 * Plugin URI: https://github.com/emrikol/Markdown-Block
 * Description: A markdown block for the Gutenberg editor.  Requires Jetpack and the Jetpack Markdown module enabled.
 * Version: 1.1
 * Author: Derrick Tennant
 * Author URI: https://github.com/emrikol/Markdown-Block
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/emrikol/markdown-block/
 * Text Domain: markdown-block
 *
 * @package WordPress
 */

/**
 * Main Class for the Markdown Block
 */
class Markdown_Block {

	/**
	 * Registers the markdown-block Block Type.
	 *
	 * @access public
	 * @return void
	 */
	public static function register_block_types() {
		register_block_type(
			'mdblock/markdown-block', array(
				'render_callback' => array( 'Markdown_Block', 'render_markdown' ),
				'attributes' => array( 'content' => array( 'type' => 'string' ) ),
			)
		);
	}

	/**
	 * Enqueues Block JS and CSS assets.
	 *
	 * @access public
	 * @return void
	 */
	public static function enqueue_block_editor_assets() {
		wp_enqueue_script(
			'markdown-block',
			plugins_url( 'assets/js/markdown-block.js', __FILE__ ),
			array( 'wp-blocks', 'wp-element' )
		);
		wp_enqueue_style(
			'markdown-block',
			plugins_url( 'assets/css/markdown-block.css', __FILE__ ),
			array()
		);
	}

	/**
	 * Filters the post content to Markdown-ify the block contents.
	 *
	 * @param string $content The post content.
	 * @access public
	 * @return string
	 */
	public static function render_markdown( $attributes ) {
		$wpcom_markdown = WPCom_Markdown::get_instance();

		$mdown = $wpcom_markdown->transform( $attributes['content'], array( 'unslash' => false ) );
		return '<div class="wp-block-mdblock-markdown-block">' . wpautop( $mdown ) . '</div>';
	}

}