<?php

class Markdown_Block {

	public static function register_block_types() {
		register_block_type(
			'mdblock/markdown-block'
		);
	}

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
				$matches['mdtext']  = $wpcom_markdown->transform( $matches['mdtext'] );
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
