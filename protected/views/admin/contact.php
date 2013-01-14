<?php

$this->pageTitle=Yii::app()->name . ' - Contact Us';

$contact_info = Contact::model()->findByPk(1);
?>

<h3>Edit the Contact Page</h3>

<form action="index.php?r=admin/savecontact" method="post" id="frm_contact_update">
<input type="hidden" name="n_id" value="<?php echo (isset($contact_info) && !empty($contact_info->id)) ? $contact_info->id : -1; ?>" />
<table>
	<tr>
		<td class="txt_contact_header">Contact:</td>
		<td>
			<?php $contact_val = (isset($contact_info) && !empty($contact_info->contact)) ? $contact_info->contact : ''; ?>
			<input type="text" name="n_contact" value="<?php echo $contact_val; ?>" maxlength="100" style="width:100%;" />			
		</td>
	</tr>
	<tr>
		<td class="txt_contact_header">Phone:</td>
		<td>
			<?php $phone_val = (isset($contact_info) && !empty($contact_info->phone)) ? $contact_info->phone : ''; ?>
			<input type="text" name="n_phone" value="<?php echo $phone_val; ?>" maxlength="20" style="width:100%;" />	
		</td>
	</tr>
	<tr>
		<td class="txt_contact_header">Email:</td>
		<td>
			<?php $email_val = (isset($contact_info) && !empty($contact_info->email)) ? $contact_info->email : ''; ?>
			<input type="text" name="n_email" value="<?php echo $email_val; ?>" maxlength="255" style="width:100%;" />	
		</td>
	</tr>
	<tr>
		<td class="txt_contact_header">Address:</td>
		<td>
			<?php $address_val = (isset($contact_info) && !empty($contact_info->address)) ? $contact_info->address : ''; ?>
			<input type="text" name="n_address" value="<?php echo $address_val; ?>" maxlength="255" style="width:100%;" />	
		</td>
	</tr>
</table>
<span class="txt_contact_header">Map Embed Code:</span>
<?php $map_embed_val = (isset($contact_info) && !empty($contact_info->map_embed)) ? $contact_info->map_embed : ''; ?>
<textarea name="n_map_embed" rows="10" style="width:100%; resize:vertical;"><?php echo $map_embed_val; ?></textarea>
<hr>
<input type="submit" name="n_submit" value="Save" />
	
</form>
