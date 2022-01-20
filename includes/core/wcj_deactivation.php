<?php

register_deactivation_hook( __FILE__, 'my_plugin_remove_database' );

function my_plugin_remove_database(){
	
	delete_option("wcj_addon_package_name");
}