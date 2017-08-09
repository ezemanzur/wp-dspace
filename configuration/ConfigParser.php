<?php
	
	abstract class ConfigParser {
		//source from which configuration will be parsed
		public $source; 
		
		protected __construct($source = null) {  $this->source = $source; }
		
		protected function getSource() { return $this->source; }
		
		abstract public loadConfig(); 
	
	}
