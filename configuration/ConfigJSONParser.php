<?php

/**
 * Parser for config files in JSON format
 * @author gonetil
 * @project wp-dspace
 * @url http://sedici.unlp.edu.ar 
 */
 
class ConfigJSONParser extends ConfigParser {
		
	
		public __construct($json_location) { 
			parent::__construct($json_location);
			
		}
		
		/**
		 * Retrieves the JSON stream from $source and parses into an associative array
		 * Raises an Exception if JSON is not valid 
		 */
		public loadConfig() { 
			$contents = file_get_contents($this->getSource());
			
			$config_data =  json_decode($contents, false);

			if (json_last_error() === JSON_ERROR_NONE) 
			{ 
				return $config_data; 
			} else 
			{ 
				throw new Exception("Error: formato JSON incorrecto al leer ".$this->getSource()) ;
			} 
		}
	
	}
