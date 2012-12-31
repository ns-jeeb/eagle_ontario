<?php

$item;
$base_url = Yii::app()->baseurl;

echo
<<<HTML
<form enctype="multipart/form-data" action="$base_url/index.php?r=admin/save" method="post">

	<table border="0" style="width='100%' cellpadding='3' cellspacing='3'">
		<tr>
			<td>Title:</td>
			<td><input type="text" name="n_title" value="$item->title" style="width:100%;" /></td>
		</tr>
		<tr>
			<td>Picture:</td>    		
			<td>
				<!--<input type="hidden" name="MAX_FILE_SIZE" value="300000" />-->
				<input type="file" name="n_picture" id="n_picture">
			</td>
		</tr>
		<tr>
			<td>Description:</td>
			<td><textarea name="n_desc" rows="10" style="width:100%; resize:none;">$item->description</textarea></td>
		</tr>
		<tr>
			<td>Description Link:</td>
			<td><input type="text" name="n_link" value="$item->link" style="width:100%;" /></td>
		</tr>
		<tr>
			<td>Visibility:</td>
			<td>
				<input type="radio" name="visibility" value="true" checked>Visible
				<input type="radio" name="visibility" value="false" >Not Visible
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="n_submit" value="Save" /></td>
		</tr>
	</table>

</form>

HTML
?>