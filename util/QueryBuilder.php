<?php 

/** 
   * Esta clase se encarga de construir la url de consulta, utilizando los parametros de configuración obtenidos de la clase RespositoryHandler (url base, nombre del repositorio, etc) y los demas paremetros necesarios seteados en la variable $query_vars (handle, autor, etc)
   * @author ezemanzur
   * @project wp-dspace
   * @url http://sedici.unlp.edu.ar 
**/
class QueryBuilder{

protected $query_vars;
protected $urlBase;
protected $queryPath;
public function __consturct ($urlBase,$queryPath=""){
	$this->$urlBase=$this->checkUrlBase($urlBase);
	$this->$queryPath=$this->checkQueryPath($queryPath);
	$this->init();
}
private function checkUrlBase($urlBase){
	if (substr($urlBase, -1)!="/")
		$urlBase.="/";
	return $urlBase;
}
private function checkQueryPath($queryPath){
	if (substr($queryPath, -1)!="?" && !empty($queryPath))
		$queryPath.="?";
	return $queryPath;
}
public function init(){
	$query_vars= array();
}
/** 
   * metodo encargado de construir la url
**/
public function build($urlBase="",$queryPath=""){
	if(empty($urlBase) &&  empty($queryPath))
		$urlQuery= $this->$urlBase.$this->queryPath;
	else
		$urlQuery = empty($queryPath) ? $this->checkUrlBase($urlBase).$this->$queryPath  : $this->$urlBase.$this->checkQueryPath($queryPath);
	foreach ($query_vars as $key => $arrayValuealue)
		$urlQuery= $urlQuery.$key.'='.$this->recorrerArray($arrayValuealue).'&'; 
	return $urlQuery;
}
public function recorrerArray($arrayValue,$query=""){
	foreach ($arrayValue as $item){ 
		if(!is_array($item)){
			($item==end($arrayValuealue))? $query=$query.$item : $query=$query.$item." AND ";
		}
		else{
			return recorrerArray($item,$query)." OR ";
		}
	}
	return $query;	
}
/** 
   * metodo encargado de agregar parametros para construir la url mediante una palabra clave y un valor. Si se desea agregar mas de un valor a la clave y no pisarlo $override debe ser true.
**/
public function add_query_vars($key,$value,$override=false){
	if ($override) 
		$query_vars[$key]=array($value);
	else
		(has_query_vars($key)) ? $query_vars[$key]= array_push($query_vars[$key],$value) : $query_vars[$key]=array($value);

}
public function remove_query_vars($key){
	$this->has_query_vars($key) ? unset($query_vars[$key]): return false ;
	return true ;
}

public function has_query_vars($key){
	return array_key_exists($key,$query_vars);

}
public function get_query_vars($key){
	return $this->has_query_vars($key) ? $query_vars[$key]: false ;
}


}
?>