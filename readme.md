=== Set HTML lang attribute per post ===
Contributors: Nils N. Haukås
Tags: html, language, lang
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: 0.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This wordpress plugin adds a meta box for specifying html lang="" language per post.

=== Description ===

== The problem this plugin solves ==

Wordpress allows us to specify site-wide language defaults like so:

`<meta http-equiv="content-language" content="es">`

The problem comes about if you have blog posts in various languages. Personally I write posts in either English or Norwegian. And since English is set as the site-wide language posts that are in Norwegian end up looking kinda weird due to weirdly placed `-` (hyphenations).

== Solution

The solution is to add more specific html `lang` attributes when needed.

`<article id="" class="" lang="vi">`

For example this specifies that the post is in Vietnamese. This plugin enables a meta box when editing posts where you may specify the post's language.

== Contributing

This plugin was made in a jiffy. But by all means do suggest improvements. For instance the plugin obviously lacks testing code.

== Licensing

Copyright 2014  Nils Norman Haukås

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

Wondering about something?

== Screenshots ==

== Changelog ==

= 0.0.1 =

* Initial publish.

