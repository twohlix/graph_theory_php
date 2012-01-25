<?php

//lets test out the graph class
require_once 'graph.class.php';

$theGraph = new Graph();



//lets add three nodes and connect 2 of them undirected
echo 'Adding three nodes and connecting 2 of them';
$theGraph->addNode('a');
$theGraph->addNode('b');
$theGraph->addNode('c');
$theGraph->addEdge('b','c', FALSE); //false means undirected there

//print some tests out
$pass = TRUE;
if( !$theGraph->edgeExists('b','c') || !$theGraph->edgeExists('c', 'b') ){
  $pass = FALSE;
}
if($pass){
  echo "\n\tSuccess!\n";
}else{
  echo "\n\tFailed!\n";
}

//$theGraph->debug();
