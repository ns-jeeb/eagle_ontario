<?php
// $items should have lla the images form database and diplay in the follwing table....

//print_r($item);
	echo "<table><tr><th>Name</th><th>Picture</th><th>Description</th><th>Link</th></tr>";
	for ($i =0; $i<count($item); $i++)
	{
		echo "<tr>";
		if (!empty($item[$i]))
		{
			for ($td =0; $td< 1; $td++)
			{
				echo "<td>".$item[$i]->title."</td>";
				echo "<td><img src='".$item[$i]->picture."' alt='scrap' style='width: 150px; background: red;' /></td>";
				echo "<td>".$item[$i]->description."</td>";
				echo "<td>".$item[$i]->link."</td>";
			}
				
		}else
		{
				
		}
		echo "</tr>";

	}
	echo "</table>";
?>
