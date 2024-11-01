<?php
/*
Plugin Name: Snooth Widget
Description: Adds a sidebar widget to display Shooth updates.
Author: Nicholas Krut
Author URI: http://www.nicholaskrut.com/
License: GPL

This software comes without any warranty, express or otherwise.

*/

function widget_snooth_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_snooth($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_snooth');
		$account = $options['account'];  // Your Snooth Account Number
		$hash    - $options['hash'];     // Your Snooth Hash
		$title   = $options['title'];    // Title in sidebar for widget
		$show    = (intval($options['show']) == 0)?4:intval($options['show']);  // Number of items shown
		
		
		$data = json_decode(end(explode("= ", file_get_contents("http://syndication.snooth.com/" . $hash . "user_" . $account . "_ratings.js"))));
		echo "http://syndication.snooth.com/" . $hash . "user_" . $account . "_ratings.js";
		for ($i = 0; $i < $show; $i++)
		{
			$wines .= "<li>\n"; 
			$wines .= "  <a href=\"" . $data[$i]->link . "\" target=\"_blank\">" . $data[$i]->name . "</a> (" . $data[$i]->vintage . ")<br />\n";
			$wines .= "  My Rating: " . $data[$i]->myRating . "/5<br />\n";
			$wines .= "</li>\n";
		}

        // Output
		echo $before_widget;

		// start
		echo '<div id="snooth_widget">'
              .$before_title.$title.$after_title . "\n";
        echo '<ul id="snooth_winePlaceholder">' . $wines . '</ul>';
        echo '<small><a href="http://www.snooth.com/" target="_blank">Visit Snooth.com</a></small></div>';
		


		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_snooth_control() {

		// Get options
		$options = get_option('widget_snooth');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array(
							'account' => '88249',
							'hash'    => '4/5/5/',
							'title'   => 'Snooth Updates',
							'show'    => '4'
						);

        // form posted?
		if ( $_POST['snooth-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['account'] = strip_tags(stripslashes($_POST['snooth-account']));
			$options['hash']    = strip_tags(stripslashes($_POST['snooth-hash']));
			$options['title']   = strip_tags(stripslashes($_POST['snooth-title']));
			$options['show']   = strip_tags(stripslashes($_POST['snooth-show']));
			update_option('widget_snooth', $options);
		}

		// Get options for form fields to show
		$account = htmlspecialchars($options['account'], ENT_QUOTES);
		$title   = htmlspecialchars($options['title'], ENT_QUOTES);
		$show    = intval(htmlspecialchars($options['show'], ENT_QUOTES));

		// The form fields
		echo '<p style="text-align:right;">
				<label for="snooth-account">' . __('Account:') . '
				<input style="width: 200px;" id="snooth-account" name="snooth-account" type="text" value="'.$account.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="snooth-hash">' . __('Hash:') . '
				<input style="width: 200px;" id="snooth-hash" name="snooth-hash" type="text" value="'.$hash.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="snooth-title">' . __('Title:') . '
				<input style="width: 200px;" id="snooth-title" name="snooth-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="snooth-show">' . __('Show:') . '
				<input style="width: 200px;" id="snooth-show" name="snooth-show" type="text" value="'.$show.'" />
				</label></p>';
		echo '<input type="hidden" id="snooth-submit" name="snooth-submit" value="1" />';
	}


	// Register widget for use
	register_sidebar_widget(array('Snooth', 'widgets'), 'widget_snooth');

	// Register settings for use, 300x200 pixel form
	register_widget_control(array('Snooth', 'widgets'), 'widget_snooth_control', 300, 200);
}

// Run code and init
add_action('widgets_init', 'widget_snooth_init');

?>
