<?php
echo "dfsdsf";
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email

//Usage
//File::put($path,$contents);
//Example
$path = $_SERVER['DOCUMENT_ROOT'].'/test/mytextdocument.txt';
$jsonString = file_get_contents("php://input");
//mail("vivek@nascenture.com","My subject",print_r($jsonString,true));
file_put_contents($path,$jsonString);

$data = json_decode($jsonString,true);
 
 $rec = json_decode(base64_decode($data['message']['data']),true);

$url = 'http://www.inboxoff.com/user/latestmessage/'.$rec['historyId'].'/'.$data['message']['publish_time'].'/'.$rec['emailAddress'];

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

header('HTTP/1.0 200 OK');
exit();
 
?>