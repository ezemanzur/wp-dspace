<?php  



abstract class RepositoryHandler {



	private $config_file, $config_data, $config_subtype;
	
	private setConfigData($config_data){
		$this->$config_data=$config_data;
		return $this;
	 }	
	 private getConfigData(){
		return $this->$config_data;
	 }
	 abstract public function loadConfig($name="",$file_path="");
	 /** 
	   * Se consulta la configuración por campo dada una clave ej.  $urlBase=get_config_value('urlBase').
	**/
	 abstract public function getConfigValue($key);
	 abstract public function getConfigSubtype();
	
    /** 
     * Retorna un array con las configuraciones por default ultilizando el repositorio de sedici
     **/ 
	 private function loadDefaultConfig(){
		
		return  array(
						'urlBase' =>'http://sedici.unlp.edu.ar:80/' , 
						'queryPath' => 'open-search/discover?',
						'authorQuery'=>'author_filter',
						'typeQuery' => 'sedici.subtype',
						'supportedType' => $this->getDefaultSupportedTypes()
				);

	 }
 
	 /** 
	  * Retorna un array para la configuración por default en el que se encuentran los subtipos que soporta el repositorio SEDICI UNLP
	  **/

	 private function getDefaultSupportedTypes(){
		return array(
 					'article' => 'Articulo',
                 	'conference_document' => 'Documento de conferencia',    
                	'book' => 'Libro',
                	'working_paper' =>  "Documento de trabajo",
                	'technical_report' => "Informe tecnico",
                	'conference_object' => "Objeto de conferencia",
                	'revision' => "Revision",
                	'work_specialization' => "Trabajo de especializacion",
                	'preprint' => 'Preprint'
                	'master_thesis'=>  "Tesis de maestria",
                  	'phD_thesis'=>"Tesis de doctorado",
                  	'licentiate_thesis'=>"Tesis de grado"
            );
	}
}

?>
