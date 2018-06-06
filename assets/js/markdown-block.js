/**
 * Primary JS file for the Markdown Block.
 *
 * @link   https://github.com/emrikol/Markdown-Block
 * @author Derrick Tennant.
 * @package WordPress
 */

'use strict';

var __ = wp.i18n.__;
var el = wp.element.createElement;

wp.blocks.registerBlockType(
	'mdblock/markdown-block', {

		title: 'Markdown',

		description: [
			__( 'Write your content in plain-text Markdown syntax.' ),
			el( 'p', null, el( 'a', { href: 'https://en.support.wordpress.com/markdown-quick-reference/' }, 'Support Reference' ) )
		],

		icon: el( 'svg', { xmlns: 'http://www.w3.org/2000/svg', 'class': 'dashicons', width: '208', height: '128', viewBox: '0 0 208 128', stroke: 'currentColor' }, el( 'rect', { width: '198', height: '118', x: '5', y: '5', ry: '10', 'stroke-width': '10', fill: 'none' } ), el( 'path', { d: 'M30 98v-68h20l20 25 20-25h20v68h-20v-39l-20 25-20-25v39zM155 98l-30-33h20v-35h20v35h20z' } ) ),

		category: 'formatting',

		attributes: {
			content: {
				type: 'string',
			}
		},

		supports: {
			html: false
		},

		edit: function( props ) {
			var attributes    = props.attributes,
				setAttributes = props.setAttributes,
				className     = props.className,
				isSelected    = props.isSelected;

			var mdblock_editor = [ el(
				wp.editor.BlockControls,
				{ key: 'controls' },
				el(
					'div',
					{ className: 'components-toolbar' },
					el(
						'button',
						{ className: 'components-tab-button is-active' },
						el(
							'span',
							null,
							'Markdown'
						)
					)
				)
			), el( wp.editor.PlainText, {
				className: className,
				value: attributes.content,
				onChange: function onChange(content) {
					return setAttributes( { content: content } );
				},
				'aria-label': __( 'Markdown' )
			} ) ];

			if ( isSelected ) {
				return mdblock_editor;
			} else {
				if ( typeof wpcom.actionbar != 'undefined' ) {
					// Gutenberg on WordPress.com is still kind-of broken.
					return mdblock_editor;
				} else {
					return [
						el( wp.components.ServerSideRender, {
							block: 'mdblock/markdown-block',
							attributes: props.attributes
						} )
					];
				}
			}
		},

		save: function( props ) {
			return null;
		}
	}
);
