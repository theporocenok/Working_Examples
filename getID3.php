<?
function setTegs($filepath,$artist,$title){
	$TaggingFormat = 'UTF-8';

	$getID3 = new getID3;
	$getID3->setOption(array('encoding'=>$TaggingFormat));

	getid3_lib::IncludeDependency(GETID3_INCLUDEPATH.'write.php', __FILE__, true);

	$TagFormatsToWrite = array('id3v2.4');

	echo 'starting to write tag(s)<BR>';

	$tagwriter = new getid3_writetags;
	$tagwriter->filename       = $filepath;
	$tagwriter->tagformats     = $TagFormatsToWrite;
	$tagwriter->overwrite_tags = true;
	$tagwriter->tag_encoding   = $TaggingFormat;


	$TagData['title'][] = $title;
	$TagData['ARTIST'][] = $artist;
	$tagwriter->tag_data = $TagData;

	if ($tagwriter->WriteTags()){
		echo 'Successfully wrote tags<BR>';
		if (!empty($tagwriter->warnings)) {
			echo 'There were some warnings:<blockquote style="background-color: #FFCC33; padding: 10px;">'.implode('<br><br>', $tagwriter->warnings).'</div>';
		}
	} else {
		echo 'Failed to write tags!<div style="background-color: #FF9999; padding: 10px;">'.implode('<br><br>', $tagwriter->errors).'</div>';
	}
}
?>