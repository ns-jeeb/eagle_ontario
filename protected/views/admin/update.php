<?php

$item;
$base_url = Yii::app()->baseurl;

$item_id = "";
$item_title = "";
$item_picture = "";
$item_description = "";
$item_link = "";

if (isset($item)) {
	
	$item_id = $item->id;
	$item_title = $item->title;
	$item_picture = $item->picture;
	$item_description = $item->description;
	$item_link = $item->link;
}

$item_picture_html = "";
if (!empty($item_picture) && $item_picture != "...") {
					
	$item_picture_html = "If you want to change the picture, click on 'Choose File'.<br><img src='".$item_picture."' alt='".$item_title."' width='120px' /><br>";	
					
} else {
	
	$item_picture_html = "There's no picture, please select a picture for this item.<br>";
}

$item_picture_html .= "<!--<input type='hidden' name='MAX_FILE_SIZE' value='300000' />-->".
					"<input type='file' name='n_picture' id='n_picture' >";

echo
<<<HTML
<form enctype="multipart/form-data" action="$base_url/index.php?r=admin/save" method="post">

	<input type="hidden" name="n_id" value="$item_id" />
	<table border="0" style="width='100%' cellpadding='3' cellspacing='3'">
		<tr>
			<td>Title:</td>
			<td><input type="text" name="n_title" value="$item_title" style="width:100%;" /></td>
		</tr>
		<tr>
			<td>Picture:</td>    		
			<td>
HTML
.
$item_picture_html	
.
<<<HTML
			</td>
		</tr>
		<tr>
			<td>Description:</td>
			<td><textarea name="n_desc" rows="10" style="width:100%; resize:none;">$item_description</textarea></td>
		</tr>
		<tr>
			<td>Description Link:</td>
			<td><input type="text" name="n_link" value="$item_link" style="width:100%;" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="n_submit" value="Save" /></td>
		</tr>
	</table>

</form>

HTML
?>