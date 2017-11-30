<?php 
require_once 'tokens.php';

function sendAudio($chatID,$token,$filepath,$artist,$title){
	$url = "https://api.telegram.org/" . $token . "/sendAudio?chat_id=" . $chatID;
	$post_fields = array('chat_id'   => $chatID,
		'audio'     => new CURLFile($filepath),
		'title'=>$title,
		'performer' =>$artist
		);
	echo ('Составляю ch');
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"Content-Type:multipart/form-data"
		));
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 
	echo ('Начинаю отправку');
	$output = curl_exec($ch);
	curl_close($ch);
	echo $output;
}

$token = "bot".$tgToken;


$chatid = "";

$file='';
$artist='';
$title='';
//sendAudio($chatid,$token,$file,$artist,$title)
?>
