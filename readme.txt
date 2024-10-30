=== Plugin Name ===
Contributors: andg,simo_m,evolvesnc
Donate link:
Tags: sticky, post
Requires at least: 3.0.1
Tested up to: 5.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allow only a certain number of sticky posts at a time.

== Description ==

By default, the plugin allows to have only one sticky post at a time, which
means that when saving a post that has been flagged as sticky, it automatically
unsticks other posts.

Under `Settings` > `Lonely Sticky`, an option can be found that allows you to
define how many sticky posts can exist at a time. For example, if a maximum of
3 posts is allowed, when saving a post that has been flagged as sticky, the two
most recent sticky posts present (if any) will be kept as sticky, along the one
that's being saved.

Setting the option to `0` will disable sticky posts completely.

== Installation ==

1. Upload the `lonely-sticky` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

No FAQ.

== Screenshots ==

No screenshots.

== Changelog ==

= 1.2 =
* Tested with WordPress 4.9.8.
* Moved plugin options to their page under `Settings > Lonely Sticky`.

= 1.1.1 =
* FIX: the plugin is now properly prepared for translation.

= 1.1 =
* NEW: added the ability to have a maximum number of sticky posts at a time, not just one.
* FIX: inline edit should work as intended, both for single and bulk modes.

= 1.0 =
* Initial version.

== Upgrade Notice ==

= 1.0 =
Initial version.
