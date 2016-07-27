<?php

class Core {

	// Function to write the index file
	function write_index($timezone) {

		// Config path
		$template_path 	= 'config/index.php';
		$output_path 	= '../index.php';

		// Open the file
		$index_file = file_get_contents($template_path);

		$saved  = str_replace("%TIMEZONE%",$timezone,$index_file);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$saved)) {
				@chmod($output_path,0644);
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	// Function to write the config file
	function write_config($domain, $enckey = 'C9J2YnO82a49NPAwy6nXUCh3AiYtTX69') {

		// Config path
		$template_path 	= 'config/config.php';
		$output_path 	= '../app/config/config.php';

		// Open the file
		$config_file = file_get_contents($template_path);

		$saved  = str_replace("%DOMAIN%",$domain,$config_file);
        $saved  = str_replace("%ENCKEY%",$enckey,$saved);

		// Write the new config.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$saved)) {
				@chmod($output_path,0644);
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	// Function to write the database file
	function write_database($data) {

		// Config path
		$template_path 	= 'config/database.php';
		$output_path 	= '../app/config/database.php';

		// Open the file
		$database_file = file_get_contents($template_path);

		$saved  = str_replace("%HOSTNAME%",$data['hostname'],$database_file);
		$saved  = str_replace("%USERNAME%",$data['username'],$saved);
		$saved  = str_replace("%PASSWORD%",$data['password'],$saved);
		$saved  = str_replace("%DATABASE%",$data['database'],$saved);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$saved)) {
				@chmod($output_path,0644);
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

}
