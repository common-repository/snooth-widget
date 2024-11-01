=== Snooth Widget ===
Contributors: njkrut
Donate link: http://www.nicholaskrut.com/
Tags: widget, snooth, wine

This is a quick widget I whipped up that grabs Snooth.com Wine Ratings and adds them to a sidebar on your WordPress Blog using the Widget engine.

== Installation ==

In order to setup this widget you must find your account number and hash.  That is broken down in the list

1. Upload the `snooth-widget` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to your widget editor, Design -> Widgets and Add Snooth to your sidebar by clicking 'Add' next to "Snooth"
4. While logged into Snooth.com navigate to: http://www.snooth.com/account/blog-widget/
5. In the area where is says, "Paste this wherever you want the wines to appear!" look for:
	var snooth_userID = 00000;
	var snooth_hashPath = '4/5/5/';
The numbers will be different but copy your userID and hashPath (minus the quotes).
6. Go back to your widget configuration and click edit next to "Snooth: Snooth Updates" now on the right side menu.
7. Copy and paste your userID into Account and your hashPath into hash.
8. Change any other configuration settings here such as Widget Title and Show (the number of reviews to show).
9. Click "Change", drag your Widget to the location you want it on your widget list and click "Save Changes"

Alright!  You've got your widget working!

== Frequently Asked Questions ==

= What is this widget for? =

This widget interfaces with Snooth.com (a wine review site and community) and pulls your most recent wine reviews, displaying them in your sidebar on your blog.

== Screenshots ==

1. A screenshot of the plugin in use on the creator's blog.
