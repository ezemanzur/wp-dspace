<?php 



/**
* 
*/
class Query
{
    


function __construct(){
    
    
}
function keywordsVars($keywords){
    $keywords_Vars=array();
    foreach ($keywords as  $keyword) 
    $keywords_Vars= new OperadorSimple($keyword);
}

function addVarsDefault($queryBuilder){
    $queryBuilder-> add_query_vars('format',Q_FORMAT);
    $queryBuilder-> add_query_vars('sort_by',Q_SORTBY);
    $queryBuilder-> add_query_vars('order',Q_ORDER);
    $queryBuilder-> add_query_vars('start',S_START);
}
public function standarQuery($handle, $author, $keywords,$max_results,$configuration){
    $queryBuilder = new QueryBuilder();
    $this -> addVarsDefault($queryBuilder);
    !empty($max_results) ? $queryBuilder -> add_query_vars('rpp',$max_results);
    !empty($handle) ? $queryBuilder ->add_query_vars('scope',$handle);
    !empty($keywords) ? $keywords=$this ->keywordsVars($keywords);
    if (!empty($author)) {
                    $words = $this->splitImputs($author);
                    $queryBuilder ->add_query_vars('author', $configuration->author($words));
    }
    

}
public function standarQuery($handle, $author, $keywords,$max_results,$configuration){
            $this->subtype_query = $configuration->get_subtype_query();
            $queryEstandar = $configuration->standar_query($max_results);
            $query= Array();
                if (!empty($handle)) {$queryEstandar .="&". SQ_HANDLE . "=".$handle;}
                if (!empty($author)) {
                    $words = $this->splitImputs($author);
                    array_push($query, $configuration->author($words));
                }
                if (!empty($keywords)) {
                    $words = $this->splitImputs($keywords);
                    array_push($query, $this->concatenarCondiciones($words));
                }
                if (!empty($query)) { $queryEstandar.="&". Q_QUERY."=". implode('%20AND%20', $query); }
                return $queryEstandar.DEFAULT_QUERY;
        }

