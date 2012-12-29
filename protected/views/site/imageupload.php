<?php
?>

<form action="" method="post"enctype="multipart/form-data">
<table style="width: 406px;">
	<tr>
		<td>Image Name</td>
		<td><input type="text" name="txt_name"></td>
	</tr>
	<tr>
		<td>Image Descripation</td>
		<td><textarea cols="30"rows="6"name="txt_desc">this text </textarea><br /></td>
	</tr>
	<tr>
		<td>Image Location</td>
		<td><input type="file" name="file"id="file"><br /></td>
	</tr>
</table>	 
	<input type="submit" name="btn_submit" value="Submit">
	<input type="reset" name="btn_cancel" value="Reset">

</form>