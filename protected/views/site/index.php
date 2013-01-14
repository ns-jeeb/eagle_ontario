<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div id="index_container">
	<div id="index_welcome" >
		<h3>Welcome</h3>
		<p>
		Welcome to Eagle Ontario Metal And Scrap Services. Our goal is to make our customers not worry about their non usable metals.
		Whether you have ferrous or non-ferrous metal, please <a href="index.php?r=site/contact">contact us</a> for more info.
		</p>
	</div>

	<img src="<?php echo Yii::app()->request->baseUrl;?>/images/pageImages/index_metals.png"  alt="copper scrap aluminum metal scrap" />
	
	<div class="index_box_metal left">
		<h3>Have Scrap Metal?</h3>
		<p>
		We buy your scrap and non useabble metal. We sort them out and either recycle or re-sell for re-usability.
		</p>
	</div>
	
	<div class="index_box_metal right">
		<h3>Need Metal?</h3>
		<p>
		Be environmently friendly and buy iron and metal from us. For prices and more info, 
		get in touch with us or <a href="index.php?r=site/contact" >email us</a> directly from here.
		</p>
	</div>
</div>
