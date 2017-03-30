<?php  
define ('CONFIG_' , 'config_');
define ('CONFIG_SUBTYPE' , 'supportedType');
/** 
   * La clase RepositoryHandlerIni es una instancia de RepositoryHandler en la que las configuraciones que se cargan son desde archivos de extensión .ini
**/
class RepositoryHandlerIni extends RepositoryHandler {

    /** 
     * Carga el archivo .ini de confiración mediante el nombre del archivo  o la ruta donde se encuentra el mismo. En caso de estar tanto el nombre, como la ruta se utilizará la ruta para cargar el archivo, si no hay ninguna de las 2 se carga  la configuración por default
     **/
 public function loadConfig($name="",$file_path=""){
    if( empty($name) && empty($file_path))
    	$setConfig=$this->loadDefaultConfig();
    elseif (!empty($file_path)) 
    	$setConfig=parse_ini_file($file_path);
    else{
    	$name=CONFIG_.$name.'.ini'
    	$setConfig=parse_ini_file($name);//$setCongfig retorna falso si no carga el archivo
    }
    $this->setConfigData($setConfig);
    return $setConfig;  
 };
 public function get_config_value($key){
 	return $this->$config_data[$key];
 }
 public function get_config_subtype(){
 	return $this->get_config_value(CONFIG_SUBTYPE);
 }
}

?>