<?php
class CsvFile {
	public static function add_csv_files( $index ){ // Geoff
		if( \Input::hasFile($index) ){
			if( \Input::file($index)->getClientOriginalExtension() == "csv"){
				\Input::file($index)->move(\Config::get('app.asset') . 'csv_files', \Input::file($index)->getClientOriginalName());
			} else {
				// $this->error[] = ucfirst($index) . " file should be CSV file.";
			}
		}
	
	}
	
	public static function get_csv_files($index){ // Geoff
		$uploaded_data = array();
		if( \Input::file($index) != null ){
			$uploaded_file = fopen(\Config::get('app.asset') . 'csv_files/' . \Input::file($index)->getClientOriginalName(), 'r');
	
			while(! feof($uploaded_file)){
				$uploaded_data[] = fgetcsv($uploaded_file);
			}
		}
		
		return $uploaded_data;
	}
	
	public static function copy_dir($src,$dst) { 
	    $dir = opendir($src); 
	    @mkdir($dst);
	    while(false !== ( $file = readdir($dir)) ) { 
	        if (( $file != '.' ) && ( $file != '..' )) { 
	            if ( is_dir($src . '/' . $file) ) { 
	                copy_dir($src . '/' . $file,$dst . '/' . $file); 
	            } 
	            else { 
	                copy($src . '/' . $file,$dst . '/' . $file); 
	            }
	        } 
	    } 
	    closedir($dir); 
	}
	
	public static function delete_dir($path) {
	    if (is_dir($path) === true) {
	        $files = array_diff(scandir($path), array('.', '..'));
	
	        foreach ($files as $file) {
	            delete_dir(realpath($path) . '/' . $file);
	        }
			
	        return rmdir($path);
	    }
	    else if (is_file($path) === true) {
	        return unlink($path);
	    }
		
	    return false;
	}
}