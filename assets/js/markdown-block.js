'use strict';

var __ = wp.i18n.__;
var el = wp.element.createElement;

wp.blocks.registerBlockType('mdblock/markdown-block', {

	title: 'Markdown',

	description: [ __( 'Write your content in plain-text Markdown syntax.' ), React.createElement(
		'p',
		null,
		React.createElement(
			'a',
			{ href: 'https://en.support.wordpress.com/markdown-quick-reference/' },
			'Support Reference'
		)
	) ],

	icon: el( 'svg', {
			xmlns: 'http://www.w3.org/2000/svg',
			'class': 'dashicons',
			width: '208',
			height: '128',
			viewBox: '0 0 208 128',
			stroke: 'currentColor'
		}, el('rect', {
			width: '198',
			height: '118',
			x: '5',
			y: '5',
			ry: '10',
			'stroke-width': '10',
			fill: 'none'
		}
	), el( 'path', { d: 'M30 98v-68h20l20 25 20-25h20v68h-20v-39l-20 25-20-25v39zM155 98l-30-33h20v-35h20v35h20z' } )),

	category: 'formatting',

	attributes: {
	content: {
		type: 'text',
		source: 'property',
		selector: 'pre',
		property: 'textContent'
	}
	},

	supports: {
		html: false
	},
	edit: function edit(_ref) {
		var attributes    = _ref.attributes,
			setAttributes = _ref.setAttributes,
			className     = _ref.className,
			isSelected    = _ref.isSelected;

		return [isSelected && React.createElement(
			wp.editor.BlockControls,
			{ key: 'controls' },
			React.createElement(
				'div',
				{ className: 'components-toolbar' },
				React.createElement(
					'button',
					{
						className: 'components-tab-button is-active' },
					React.createElement(
						'span',
						null,
						'Markdown'
					)
				)
			)
		), React.createElement( wp.editor.PlainText, {
			className: className,
			value: attributes.content,
			onChange: function onChange(content) {
				return setAttributes( { content: content } );
			},
			'aria-label': __( 'Markdown' )
		})];
	},
	save: function save(_ref2) {
		var attributes = _ref2.attributes,
			className  = _ref2.className;

		return React.createElement(
			'pre',
			{ className: className },
			attributes.content
		);
	}
});
