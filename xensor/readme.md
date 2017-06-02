# Xensor's Maintenance #
Contributors: Xensor, ChuChuYokai

Donate link: http://www.leroymcqy.cf

Tags: membership 2 pro, membership, maintenance, ban

Requires at least: 4.7.5

Tested up to 4.7.5

Stable tag: 4.7.5

License: GPLv2 or later

License URI: http://www.gnu.org/licenses/gpl-2.0.html

This add-on allows you to set up a page for banned groups and also a maintenance page based on staff levels. You can enter the id(s) in the admin panel so it's all easy to do from a page. 

## Description ##

This is still in beta, so please be patience as we make sure that this plugin works fully.

The idea was to create a plugin for Membership Pro 2 from WMPUDEV that allows admins to set up a banned page to redirect banned members to and also put the website into maintenance using their own maintenance page. I always got tired of using premade maintenance pages. 

I will also be looking into how to set up regular wp roles as an option as well for the ban option and maintenance. Right now, I am using Membership Pro.

## Installation ##

This section describes how to install the plugin and get it working.

1. Upload `maintenance.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Dashboard -> Settings -> Maintenance and fill in the details.

## Frequently Asked Questions ##

What does this do? 

This allows admin(s) to set up ban pages and maintenance pages and then set the `page id` into the fields to be redirected to. This isn't just a redirect on login, it actually redirects them during the whole visit. 

What is required?

Membership 2 from WMPUDEV. (I have not tested it with the free version.)

Settings

To set up the options for the plugin, you would head over to `Dashboard -> Settings -> Maintenance`. From here you will see a form that gives you options to change the ids of the following: `ban, guest and default`, you will also see redirect URLs for `maintenance` and `banned`. You can also change the pages that are for the member(s) to be redirected to `ban page id` and `maintenance page id`.

The maintenance and ban page id are the ids you get from editing the post. Example: wp-admin/post.php?post=`29749`&action=edit.

That id after `post=` is the number you need for the page id. 

For the membership id, you can get that from the membership 2 area. You can do this 2 ways, one is by the shortcode option. It will give you the id of the membership or you can edit the membership and get it from the URL.

I am gonna show you how to get it from a shortcode: 

on the membership 2 page, you will see a column with 'shortcode', you click the show link to get the shortcode. `[ms-protect-content id="29578"][/ms-protect-content]` this is the shortcode you will be looking for. 



## Screenshots ##

![Maintenance Page](http://www.pixelmonmemories.ml/wp-content/uploads/2017/06/maint.png 'Maintenance Page')

![Banned Page](http://www.pixelmonmemories.ml/wp-content/uploads/2017/06/banned.png 'Banned Page')

![maintenance admin panel](https://box.everhelper.me/attachment/944331/ad10e51d-6828-4832-bf72-e493003daaeb/817279-SFErt1hKuMQDNbC5/screen.png 'maintenance admin panel')
## Changelog ##

# 1.0.1 #
1. Fixed labels on the admin panel from `staff` to `Default` and `gym leader` to `Guest id`.
1. Added the ability to uninstall the plugin.

# 1.0 #
* Initial start of the plugin path.
* Set up the code to allow admins to edit details for the plugin
* Set up redirects to kick ban members to a set page and also redirect non-staff to a maintenance page when maintenance is enabled.


## Upgrade Notice ##

# 1.0.1 #
This will show the proper labels so you know which membership is needed to show the maintenance pages too. If you fail to update the plugin, you acknowledge that you are using an outdated plugin that does not show the proper labels.

# 1.0 #
Beta, Should not be used on a live site. This plugin has been created. We will post updates when we update the plugin.

