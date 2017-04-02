<?php  

define ('PREFIX_CONFIG_FILE' , 'config_');
define ('CONFIG_FILE_EXTENSION','ini');
define ('CONFIG_SUBTYPE' , 'supportedType');
/** 
   * La clase RepositoryHandlerIni es una instancia de RepositoryHandler en la que las configuraciones que se cargan son desde archivos de extensión .ini
**/
class RepositoryHandlerIni extends RepositoryHandler {

    /** 
     * Carga el archivo .ini de confiración mediante el nombre del archivo  o la ruta donde se encuentra el mismo. En caso de estar tanto el nombre, como la ruta se utilizará la ruta para cargar el archivo, si no hay ninguna de las 2 se carga  la configuración por default
     **/
    public function __construct($name="",$file_path=""){
        if( empty($name) && empty($file_path))
    		$setConfig=$this->loadDefaultConfig();
    	else 
    		$setConfig=$this->loadConfig($name,$file_path);
    	$this->setConfigData($setConfig);
       }

 public function loadConfig($name="",$file_path=""){
    

    if ( empty($name) && empty($file_path) )
    	$config_data = $this->loadDefaultConfig();
    else { 
		
		// check whether the name of the file to parse is explicit or must be guessed
		$file_name = empty($file_path) ? PREFIX_CONFIG_FILE . $name.'.'.CONFIG_FILE_EXTENSION : file_path;
	
		$config_data = ( new ConfigIniParser($file_name) )->loadConfig();
	}
    
    $this->setConfigData($config_data);
    return $setConfig;   //FIXME why this value is returned? if it's already set, it might not be necessary elsewhere
 };
 
 public function getConfigValue($key) {
 	return $this->$config_data($key);
 }
 
 public function getConfigSubtype(){
 	return $this->getConfigValue(CONFIG_SUBTYPE);
 }
}

?>
