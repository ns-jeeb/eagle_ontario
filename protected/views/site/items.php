<h3>Accepted Metals</h3>
<p>
We accept the following metals.
</p>
<?php
for ($i = 0; $i < count($item); $i++) {
?>
	<div class='items_item'>	
		<div class='items_item_image <?php if ($i == 0) echo "hr_top_item_image"; ?>' >
			<img width='140px' src='<?php echo $item[$i]->picture; ?>' alt='<?php echo $item[$i]->title; ?>' />
		</div>
		<div class='items_item_text <?php if ($i == 0) echo "hr_top_item_text"; ?>'>
			<h3><?php echo $item[$i]->title; ?></h3>	
			<?php $link_text = (!empty($item[$i]->link)) ? "For more info click <a href='".$item[$i]->link."'>here</a>." : ""; ?>
			<p><?php echo $item[$i]->description." ".$link_text.""; ?></p>
		</div>
	</div>
<?php 
}
?>

