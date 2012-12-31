<?php

$dataProvider = new CActiveDataProvider('Item');

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
 	'columns'=>array(
        'title',          // display the 'title' attribute
		'picture',
		'description',
		'link',
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        	'template'=>'{update}{delete}'
        ),
    ),
));

?>