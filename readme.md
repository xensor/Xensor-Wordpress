# Xensor's Features #

[![Build Status](https://travis-ci.org/xensor/Xensor-Wordpress.svg?branch=master)](https://travis-ci.org/xensor/Xensor-Wordpress)


![Xensor Community](http://www.pixelmonmemories.ml/wp-content/uploads/2017/06/xcommunity.png)
----


Contributors: Xensor, ChuChuYokai

version: 1.0.2

Donate link: http://www.leroymcqy.cf

Tags: membership 2 pro, membership, maintenance, ban, Minecraft, Rules

Requires at least: 4.7.5

Tested up to 4.7.5

Stable tag: 1.0.2

License: GPLv2 or later

License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to enable maintenace, place banned members in a time out, set up rules and also verify minecraft accounts. 

## Description ##

This is still in beta, so please be patience as we make sure that this plugin works fully.

The idea was to make a plugin that can be useful. So, I created this plugin to allow me to place the website into maintenance using membership 2 and setting up groups. These groups was given certain access and the ones that was not staff got the maintenance page. 

There is also the ability to make rules through the admin panel. Which using the shortcode `[showrules]` you can show rules on any page. You can also add it to any file by using `<?php do_action('showrules');?>` where you wish to place the rules. You add, delete and edit the rules in the admin panel. 

You can also verify minecraft usernames by heading over to the minecraft verification tab. With this, you just enter a Minecraft username and it will check the status. 

## Installation ##

This section describes how to install the plugin and get it working.

1. Upload `Xensor` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to `Dashboard -> Settings -> xensor` and pick which section you wish.

## Frequently Asked Questions ##

*What does this do?*

This allows admin(s) to set up ban pages and maintenance pages and then set the `page id` into the fields to be redirected to. This isn't just a redirect on login, it actually redirects them during the whole visit. 

*What is required?*

Membership 2 from WMPUDEV. (I have not tested it with the free version.)

*Settings*

To set up the options for the plugin, you would head over to `Dashboard -> Xensor -> Xensor`. From here you will see a form that gives you options to change the ids of the following: `ban, guest and default`, you will also see redirect URLs for `maintenance` and `banned`. You can also change the pages that are for the member(s) to be redirected to `ban page id` and `maintenance page id`.

The maintenance and ban page id are the ids you get from editing the post. Example: `wp-admin/post.php?post=`29749`&action=edit.`

That id after `post=` is the number you need for the page id. 

For the membership id, you can get that from the membership 2 area. You can do this 2 ways, one is by the shortcode option. It will give you the id of the membership or you can edit the membership and get it from the URL.

I am gonna show you how to get it from a shortcode: 

on the membership 2 page, you will see a column with 'shortcode', you click the show link to get the shortcode. `[ms-protect-content id="29578"][/ms-protect-content]` this is the shortcode you will be looking for. 

*What Shortcode is used to show the rules?*

You use `[showrules]` in any content that allows shortcodes and it will work. 


## Screenshots ##

[Maintenance Page](http://www.pixelmonmemories.ml/wp-content/uploads/2017/06/maint.png 'Maintenance Page')

[Banned Page](http://www.pixelmonmemories.ml/wp-content/uploads/2017/06/banned.png 'Banned Page')

[maintenance admin panel](https://box.everhelper.me/attachment/944331/ad10e51d-6828-4832-bf72-e493003daaeb/817279-SFErt1hKuMQDNbC5/screen.png 'maintenance admin panel')

## Changelog ##

# 1.0.3 #

* Added the ability to check Minecraft username's at the dashboard. 
* Cleaned up the code to make it even more cleaner and secured.

# 1.0.2 #

* Updated the fields to be more secured. 
* Modified some codes to make it more friendlier with speed. 


# 1.0.1 #

* cleaned up the code
* Added the ability to edit rules.
* Made Editors have access to the admin panel.

# 1.0.0 #

* Redid the maintenance and Minecraft Verification.
* Added Rules.
* Added shortcodes for rules.
* Fixed labels on the admin panel from `staff` to `Default` and `gym leader` to `Guest id`.
* Added the ability to uninstall the plugin.
* Initial start of the plugin path.
* Set up the code to allow admins to edit details for the plugin
* Set up redirects to kick ban members to a set page and also redirect non-staff to a maintenance page when maintenance is enabled.


## Upgrade Notice ##

# 1.0.3 #

Adds the ability to search Minecraft usernames through the dashboard.

# 1.0.2 #

Updated the security of the script to ensure that no data is hackable. 

# 1.0.1 #
Updated the coding and as well as added the editing rules section. Thus, allowing staff members to be able to modify the rules.

# 1.0.0 #

You can still use the other plugins I created, but this is with both the maintenance and minecraft included. This isa multi-plugin that I created for my community to make it easier to find the item.

New features which is only available at version 1.0.0. Rules are added and shortcode to show rules on pages/posts. You also get a new menu with all features under one section.

This will show the proper labels so you know which membership is needed to show the maintenance pages too. If you fail to update the plugin, you acknowledge that you are using an outdated plugin that does not show the proper labels.

Beta, Should not be used on a live site. This plugin has been created. We will post updates when we update the plugin.

