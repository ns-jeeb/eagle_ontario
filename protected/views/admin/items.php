<?php

$dataProvider = new CActiveDataProvider('Item');
$base_url = Yii::app()->baseurl;
echo "<a href='$base_url./index.php?r=admin/insert' />Insert New Item</a>";

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
 	'columns'=>array(
        'title',          // display the 'title' attribute
		array(
            'name'=>'picture',
            'type'=>'html',
            'value'=>'CHtml::image($data->picture, $data->title, array("style"=>"height:45px;"))',
        ),
		'description',
		'link',
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        	'template'=>'{update}{delete}'
        ),
    ),
));

?>