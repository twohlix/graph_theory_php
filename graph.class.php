<?php
/**
 * Graph 
 *
 * This class helps making graphs (as in Graph Theory) in PHP easier.
 *
 * Usage: $theGraph = new Graph();
 *        $theGraph->addNode('a');
 *        $theGraph->addNode('b');
 *        $theGraph->addEdge('a','b'); //creates a->b, however b->a doesnt exist
 *        $theGraph->addEdge('a','b',FALSE); //creates both a->b and b->a;
 */

class Graph {
  private $adj_mat;
  private $edges;
  private $nodes;

  function __construct(){
    $this->adj_mat = array();
    $this->edges = 0;
    $this->nodes = 0;
  }

  public function debug(){
    echo "\n".print_r($this->adj_mat, true);
  }

  private static function validateName($name){
    if(!$name) return FALSE;

    if(is_object($name) || is_array($name)) return FALSE;

    if($name == '') return FALSE;

    if(strlen($name) < 1) return FALSE;

    return TRUE;
  }

  //NODE OPERATIONS//////////////////////////////////////

  public function addNode($name){
    if(!self::validateName($name)){
      return FALSE;
    }

    if(!isset($this->adj_mat[$name])){
      $this->adj_mat[$name] = array();
      $this->nodes++;
    }
  }

  public function nodeExists($name){
    return isset($this->adj_mat[$name]);
  }

  public function nodeCount(){
    return $this->nodes;
  }

  public function removeNode($name, $directed=TRUE){
    if(!self::validateName($name)){
      return FALSE;
    }

    if(!$this->nodeExists($name)){
      return FALSE;
    }

    foreach($this->adj_mat[$name] as $node => $list ){
      $this->removeEdge($name, $node, $directed);
    } 
    
    //do the final cleanup pass through ESPECIALLY if its directed
    foreach($this->adj_mat as $n => $list){
      if( $n == $name ) continue;

      $this->removeEdge($n, $name, TRUE); 
    }

    unset($this->adj_mat[$name]);//leave this for the end since we need it for removeEdge();
    $this->nodes--;

  }

  //EDGE OPERATIONS//////////////////////////////////////

  public function edgeExists($start, $end){
    return $this->getEdge($start, $end) !== FALSE;
  }

  public function edgeCount($directed=TRUE){
    if(!$directed) return $this->edges / 2;    

    return $this->edges; 
  }

  public function getEdge($start, $end){
    if(!self::validateName($start) || !self::validateName($end)){
      return FALSE;
    }

    if($this->nodeExists($start) && $this->nodeExists($end)){
      if( isset($this->adj_mat[$start][$end]) ) return $this->adj_mat[$start][$end];
    }

    return FALSE;
  }
  
  public function addEdge($start, $end, $directed=TRUE, $weight=1){
    if(!self::validateName($start) || !self::validateName($end)){
      return FALSE;
    }

    if( $this->nodeExists($start) && $this->nodeExists($end) ){
      if(!isset($this->adj_mat[$start][$end])) $this->edges++;
      $this->adj_mat[$start][$end] = $weight;
      if(!$directed){
        if(!isset($this->adj_mat[$end][$start])) $this->edges++;
        $this->adj_mat[$end][$start] = $weight;
      }

      return TRUE;
    }

    return FALSE;
  }

  public function removeEdge($start, $end, $directed=TRUE){
    if( !self::validateName($start) || !self::validateName($end) ){
      return FALSE;
    }

    if( $this->nodeExists($start) && $this->nodeExists($end) ){
      if(isset($this->adj_mat[$start][$end])){
        unset($this->adj_mat[$start][$end]);
        $this->edges--;      
      }

      if(!$directed){
        if(isset($this->adj_mat[$end][$start])){
          unset($this->adj_mat[$end][$start]);
          $this->edges--;
        }
      }
  
      return TRUE;
    }

    return FALSE;
  }

}//end Graph Class
