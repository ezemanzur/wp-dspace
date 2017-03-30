<?php
	/**
 * Parser for config files in INI format
 * @author gonetil
 * @project wp-dspace
 * @url http://sedici.unlp.edu.ar 
 */
	class ConfigIniParser extends ConfigParser {
		
		public __construct($ini_file) { parent::__construct($ini_file); }
		
		/**
		 * loads and parses the $source file . 
		 *  @returns parsed data, or empty array if $source file does not exist
		 **/
		public loadConfig() { 
			return file_exists($this->source) ? parse_ini_file($this->getSource())//$setCongfig retorna falso si no carga el archivo
		} 									  : array();
	
	}
