<?php
/**
 * Name: Markdown Block
 * Plugin URI: https://github.com/emrikol/Markdown-Block
 * Description: A markdown block for the Gutenberg editor.  Requires Jetpack and the Jetpack Markdown module enabled.
 * Version: 0.1.2
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
			'mdblock/markdown-block'
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
	public static function filter_the_content( $content ) {
		// Just in case Jetpack isn't working for some reason.
		if ( ! class_exists( 'WPCom_Markdown' ) ) {
			return $content;
		}

		$content = preg_replace_callback(
			'|(?P<mdstart><pre class="wp-block-mdblock-markdown-block">)(?P<mdtext>.*)(?P<mdstop></pre>)|Uims',
			function( $matches ) {
				$wpcom_markdown = WPCom_Markdown::get_instance();
				// Swap out the <pre> for a <div>.
				// In testing, we need the <pre> in the admin for proper whitespace saving.
				$matches['mdstart'] = '<div class="wp-block-mdblock-markdown-block">';
				$matches['mdtext']  = $wpcom_markdown->transform( $matches['mdtext'], array( 'unslash' => false ) );
				$matches['mdstop']  = '</div>';

				// Let's just reset all of these for posterity.
				$matches[0] = $matches['mdstart'] . $matches['mdtext'] . $matches['mdstop'];
				$matches[1] = $matches['mdstart'];
				$matches[2] = $matches['mdtext'];
				$matches[3] = $matches['mdstop'];
				return $matches[0];
			},
			$content
		);
		return $content;
	}

}
