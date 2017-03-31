<?php 

/** 
   * Esta clase se encarga de construir la url de consulta, utilizando los parametros de configuración obtenidos de la clase RespositoryHandler (url base, nombre del repositorio, etc) y los demas paremetros necesarios seteados en la variable $query_vars (handle, autor, etc)
**/
class QueryBuilder{

protected $query_vars

public function __consturct (){
	$this->init()
}
/** 
   * 'start' es un parametro que nos va a permitir obtener la totalidad de la consulta.
   *Cada consulta trae como máximo 100 resultados de todos los posibles, paginando el total y siendo 'start' el numero de item por el cual se comienza la busqueda. ( ejemplo item 101, página 2).
**/
public function init(){
	$query_vars= array();
	$this->add_query_vars('start',0);
}
/** 
   * metodo encargado de construir la url
**/
public function build($handlerRepository){

}
/** 
   * metodo encargado de agregar parametros para construir la url mediante una palabra clave y un valor. Si se desea agregar mas de un valor a la clave y no pisarlo $override debe ser true.
**/
public function add_query_vars($key,$value,$override=false){
	if (!$override) 
		$query_vars[$key]=array($value);
	else
		(isset($query_vars[$key])) ? $query_vars[$key]= array_push($query_vars[$key],$value) : $query_vars[$key]=array($value);

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