=== ShrinkTheWeb (STW) Website Previews Plugin ===
Contributors: puravida1976, DanHarrison, Andreas Pachler, STW Support
Donate link: http://www.shrinktheweb.com/
Tags: website preview, website thumbnail, website screenshot, snapshot, thumbshot, websnapr, webshot, pagepix, mshots, stw, shrink the web
Requires at least: 2.9
Tested up to: 4.1
Stable tag: 2.4

This plugin accesses the ShrinkTheWeb API to automatically replace special tags in posts with website screenshots, where desired.

== Description ==

This plugin allows any WordPress user to **easily add thumbnail previews** of websites right in the content of their posts using a simple `[stwthumb]http://www.yourwebsite.com[/stwthumb]` format. Loads of examples are available within the plugin documentation (you'll see it when you activate the plugin).

The plugin requires a free or paid account from the thumbnail provider service [ShrinkTheWeb.com](http://www.shrinktheweb.com/). No purchase is required to use the plugin or the free service.

**Other Cool Features** 

* Option to enable mouseover previews (you see a screenshot of a link if a website visitor hovers the mouse over any external links on the site). 
* Option for capturing inside pages (rather than just the homepage of a website).
* Plenty of examples in the plugin documentation
* Plugin automatically shows you which features are available based on your account type.

**Supported STW PRO features**  

* Caching of thumbnails (Basic or PLUS accounts only)
* Custom thumbnail image quality (PRO upgrade feature)
* Full length image captures (PRO upgrade feature)
* Custom thumbnail sizes in addition to the standard STW thumbnails.

Take a look at ShrinkTheWeb for more information [Shrink The Web](http://www.shrinktheweb.com/ "Automated Website Preview Provider").



== Installation ==

1. Upload `stw-wp-thumbnails.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The default shortcode is [stwthumb]. Select [thumb] for legacy support.


== Frequently Asked Questions ==


= Is it possible for STW to add more of the STW PRO Features to this plugin? =

Yes, but priority is based on demand or a financial sponsor for the project. 

= Do I have to pay for your service in order to show website previews? =

Generally, no. Most of our users sign up for free and never pay any fees. Higher volume sites, companies, or power users may actually hit some of our high limits and need to pay for bandwidth or "capture generator" upgrades to keep up with their requests. Additionally, some users may wish to add unique PRO features to their sites and those are an optional upgrade.

= Where have all of my settings gone from pre V2.0? =

If you've just uploaded the latest version of this plugin to your WordPress website, you just need to deactivate and activate the plugin. The settings will be migrated automatically. If that does't work, then just set your settings again.
  

== Screenshots ==

1. The ShrinkTheWeb WP Plugin admin settings page.
2. An example of an optional mouseover preview bubble
3. An example of how easy it is to use the embedding feature when writing your posts
4. An example of an embedded website preview in post (www.shrinktheweb.com in this case)

== Changelog ==

= 2.4 = 
* changed shortcode default to [thumb] (plan to support [stwthumb] if detected, else support legacy [thumb]).
* rearranged admin panel settings.
* changed labels on admin panel settings for accuracy.

= 2.3 =
* added new shortcode [stwthumb]

= 2.2 =
* fixed PHP 5.4 fatal error

= 2.1 =
* purged the whole PVP code out

= 2.0 = 
* Complete overhaul of the plugin to make it really easy to use, with new documentation and features. 
* Addition of support for free STW account. 
* Settings automatically enable/disable based on your account type
* Added thumbnail caching support for Basic and Plus accounts.
* Detailed Error Logging when using caching mode, to help you solve problems quickly. 

= 1.2.2 = 
* Changes a few parameter names that may eventually be deprecated

= 1.2.1 = 
* Changes request from www.shrinktheweb.com/xino.php to images.shrinktheweb.com/xino.php

= 1.2 =
* Fixes a minor security oversight regarding our service (overcome by "locking to" specific domains/IPs at our site).
* Introduces streamlined code.
* Adds support for some PRO Features, such as "Specific Pages", "Full-length Captures", and "Custom Quality."

= 1.1 = 
* This version made Mouseover Preview bubbles optional and added support for Embedded website previews (shown in posts themselves).

= 1.0 =
* This version supported Mouseover Preview bubbles showing website previews over links.


== Upgrade Notice ==

= 2.0 =
This release is a massive improvement to the original plugin, and adds support for thumbnail caching, and adds error logging capabilities. So please deactivate and re-activate the plugin to upgrade your settings.

= 1.2.1 = 
Minor modification to some parameter names for maximum long-term compatibility

= 1.2.1 = 
Slight modification to request location to prepare for image migration

= 1.2 =
Security Vulnerability and added Feature Support

= 1.1 = 
Added functionality using embedded website screenshots in posts

= 1.0 =
This version supported Mouseover Preview bubbles showing website previews over links.
