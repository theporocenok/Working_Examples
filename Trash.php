<?php 
require_once 'tokens.php';
function sendAudio($chatID,$token,$filepath,$artist,$title){
	$url = "https://api.telegram.org/" . $token . "/sendAudio?chat_id=" . $chatID;
	$post_fields = array('chat_id'   => $chatID,
		'audio'     => new CURLFile($filepath),
		'title'=>$title,
		'performer' =>$artist
		);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"Content-Type:multipart/form-data"
		));
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 
	$output = curl_exec($ch);
	curl_close($ch);
	unlink($filepath);
}

function downloadFile($url,$path)
{
    $newfname = $path;
    $file = fopen ($url, 'rb');
    if ($file) {
        $newf = fopen ($newfname, 'wb');
        if ($newf) {
            while(!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
            }
        }
    }
    if ($file) {
        fclose($file);
    }
    if ($newf) {
        fclose($newf);
    }
}

$token = "bot".$tgToken;

header('Access-Control-Allow-Origin: *'); 

$obj=json_decode($_POST['data']);

$chatid = $obj->chatID;
$url=$obj->href;
$file='mp3//temp'.$obj->id.'.mp3';
$artist=$obj->artist;
$title=$obj->title;

downloadFile($url,$file);
$info=sendAudio($chatid,$token,$file,$artist,$title);
//$info="vse ok";
$json_data = array ('id'=>$obj->id,'ok'=>'ok');
echo json_encode($json_data);
?>
