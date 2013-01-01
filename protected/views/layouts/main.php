<?php /* @var $this Controller */

function getSelected($button)
{

	if (Yii::app()->getController()->id == "site")
	{
		$page = Yii::app()->getController()->getAction()->id;
		if ($button == $page)
		{
			return "_s";
		} else if ($page == "index" && $button == "home")
		{
			return "_s";
		} else {
			return "";
		}
	}
}

function getUrl($button)
{
	if ($button =="home"){
		return  Yii::app()->request->baseUrl.'/index.php?r=site/index';
			
	}elseif ($button == "contact"){
		return  Yii::app()->request->baseUrl.'/index.php?r=site/contact';
	}
	if ($button =="items"){
		return  Yii::app()->request->baseUrl.'/index.php?r=site/items';
	}elseif ($button == "services"){
		return  Yii::app()->request->baseUrl.'/index.php?r=site/services';
	}
}

function getImageUrl($button)
{
	if ($button =="home"){
		return  Yii::app()->request->baseUrl.'/images/menu/home'.getSelected($button).'.png';

	}elseif ($button == "contact"){
		return  Yii::app()->request->baseUrl.'/images/menu/contact'.getSelected($button).'.png';
	}
	if ($button =="services"){
		return  Yii::app()->request->baseUrl.'/images/menu/services'.getSelected($button).'.png';
	}elseif ($button == "items"){
		return  Yii::app()->request->baseUrl.'/images/menu/items'.getSelected($button).'.png';
	}
}

function displayPage()
{	
	$button = Yii::app()->getController()->getAction()->id;
	
	switch ($button) {
		case 'index':
		echo "HOME";
		break;		
		case 'services':
		echo "SERVICES";
		break;
		case 'items':
		echo "ITEMS";
		break;
		case 'contact':
		echo "CONTACT";
		break;
		
		default:
		//echo $button	;
		break;
	}
}

function displayAdmin() {
	
	$user = Yii::app()->user;
	if ($user->isGuest) {
		//echo 'is not logged in';
		echo "<a href='index.php?r=admin/index' id='admin'>Admin</a>";
	} else {
		//echo 'is logged in';
		echo "<a href='index.php?r=admin/items' id='admin'>Edit Items</a> | ";
		echo "<a href='index.php?r=admin/logout' id='admin'>Logout</a>";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div id="blue_background">

<div id="header">
		<div id="logo"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/menu/banner.png" alt="scrap"/></div>
		
		<div id="mainmenu"class="menuNdLogo">
			<ul>
				<li><a href="<?php echo getUrl('home'); ?>"><img src="<?php echo getImageUrl('home'); ?>" alt="scrap metal" /> </a>
				</li>
				<li><a href="<?php echo getUrl('services'); ?>"><img src="<?php echo getImageUrl('services'); ?>"alt="scrap metal" /> </a>
				</li>
				<li><a href="<?php echo getUrl('items'); ?>"><img	src="<?php echo getImageUrl('items'); ?>"alt="scrap alumunium" /> </a>
				</li>
				<li><a href="<?php echo getUrl('contact'); ?>"><img	src="<?php echo getImageUrl('contact'); ?>"alt="scrap copper" /> </a>
				</li>
				
			</ul>
		</div>
		<!-- mainmenu -->
</div><!-- header -->	
	
<div id="display_page">

	<div class="l_r_display"> <?php displayPage();?></div>
	<div class="l_r_display" id ="display"> <?php displayAdmin();?></div>
</div>

<div class="container" id="page">	
	
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> Eagle Ontario Metal and Scrap.<br/>
		All Rights Reserved.<br/>
		<?php echo "Powerd by ". "<a href='http://inlightdevelopment.com/'>Inlightdevelopment</a>"; ?>
	</div><!-- footer -->

</div><!-- page -->
</div>
</body>
</html>
