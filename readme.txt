=== Markdown Block ===
Contributors: emrikol
Donate link: http://wordpressfoundation.org/donate/
Tags: gutenberg,markdown,jetpack
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A markdown block for the Gutenberg editor.  Requires Jetpack and the Jetpack Markdown module enabled.

== Description ==

This is a Markdown block for the new WordPress Gutenberg editor.

It's basically a ripoff of most of this PR to Jetpack: https://github.com/Automattic/jetpack/pull/9357

Enjoy :)

== Installation ==

Install like any other plugin, directly from your plugins page or manually by copying the files to the `plugins/` folder.

== Changelog ==

= 1.1 =

* Added WordPress.com compatability.

= 1.0 =

* BREAKING CHANGES: Now rendered server-side.  Old Markdown content will show as markdown in the post.
* Blocks now preview HTML when not in focus.

= 0.1.3 =

* Fixed formatting issue by adding a `wpautop()`

= 0.1.2 =

* Added absolute path include for main plugin file.

= 0.1.1 =

* Fixed slashing problem
* Some PHPCBF Whitespace Fixes
* PHPCS Documentation Additions

= 0.1.0 =

First version, basically a proof of concept.
