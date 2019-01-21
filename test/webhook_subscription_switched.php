<?php 
echo "dfsdsf";
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
//mail("vivek@nascenture.com","My subject",print_r($_REQUEST,true));
//Usage
//File::put($path,$contents);
//Example
$path = $_SERVER['DOCUMENT_ROOT'].'/test/mytextdocument.txt';
$jsonString = file_get_contents("php://input");
 
file_put_contents($path,$jsonString);
?>
