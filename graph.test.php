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

//check on node count
if( $theGraph->nodeCount() != 3 ){
  echo "FAIL: Node Count is $theGraph->nodeCount(). Expected 3";  
}

if( $theGraph->edgeCount(FALSE) != 1 ){
  echo "FAIL: Edge Count is ".$theGraph->edgeCount(FALSE).". Expected 1";
}

//check on degree
if( $theGraph->degree('b') != 1 ){
  echo "FAIL: Degree of 'b' is ".$theGraph->degree('b').". Expected 1";
}
if( $theGraph->degree('a') != 0 ){
  echo "FAIL: Degree of 'a' is ".$theGraph->degree('a').". Expected 0";
}
if( $theGraph->inDegree('c') != 1 ){
  echo "FAIL: In Degree of 'c' is ".$theGraph->inDegree('c').". Expected 1";
}


//remove node c
$theGraph->removeNode('c', FALSE);
if( $theGraph->nodeCount() != 2 ){
  echo "FAIL: Node count is $theGraph->nodeCount(). Expected 2";
}

if( $theGraph->edgeCount(FALSE) != 0 ){
  echo "FAIL: Edge count is ".$theGraph->edgeCount(FALSE).". Expected 0";
}

//$theGraph->debug();
