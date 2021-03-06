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
	$controller = Yii::app()->getController()->id;
	$action = Yii::app()->getController()->getAction()->id;
	
	switch ($action) {
		case 'index':
		echo "HOME";
		break;		
		case 'services':
		echo "SERVICES";
		break;
		case 'items':
		echo ($controller == 'admin') ? "EDIT ITEMS" : "ITEMS";
		break;
		case 'contact':
		echo ($controller == 'admin') ? "EDIT CONTACT" : "CONTACT";
		break;		
		case 'login':
		echo "LOGIN";
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
		echo "<a href='index.php?r=admin/items' id='admin'>Items</a> | ";
		echo "<a href='index.php?r=admin/contact' id='admin'>Contact</a> | ";
		echo "<a href='index.php?r=admin/logout' id='admin'>Logout</a>";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:ns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
	<div id="banner">
		<img width="1024px" src="<?php echo Yii::app()->request->baseUrl;?>/images/menu/banner.png" alt="scrap"/>
		<div id="mainmenu">
			<!-- <div class="menu_button"> -->
				<a href="<?php echo getUrl('home'); ?>"><img src="<?php echo getImageUrl('home'); ?>" alt="scrap metal" /></a>
			<!-- </div><div class="menu_button"> -->
				<a href="<?php echo getUrl('services'); ?>"><img src="<?php echo getImageUrl('services'); ?>"alt="scrap metal" /></a>
			<!-- </div><div class="menu_button"> -->
				<a href="<?php echo getUrl('items'); ?>"><img src="<?php echo getImageUrl('items'); ?>"alt="scrap alumunium" /></a>
			<!-- </div><div class="menu_button"> -->
				<a href="<?php echo getUrl('contact'); ?>"><img	src="<?php echo getImageUrl('contact'); ?>"alt="scrap copper" /></a>
			<!-- </div> -->
		</div><!-- mainmenu -->
	</div><!-- header -->	
		
	<div id="display_page">
		<span id="selected_page" class="indicator_region"> <?php displayPage();?></span>
		<span id="admin_region" class="indicator_region"> <?php displayAdmin();?></span>
	</div>
	
	<div id="page" class="container">
	
		<div id="content">
			<?php echo $content; ?>
			<?php $contact_info = Contact::model()->findByPk(1); ?>
		</div><div id="contact_bar">				
			<table>
				<tr>
					<td class="txt_contact_header">Contact:</td>
					<td><?php echo (isset($contact_info) && !empty($contact_info->contact)) ? $contact_info->contact : 'Error'; ?></td>
				</tr>
				<?php if (isset($contact_info) && !empty($contact_info->phone)) { ?>
				<tr>
					<td class="txt_contact_header">Phone:</td>
					<td><?php echo (isset($contact_info) && !empty($contact_info->phone)) ? $contact_info->phone : 'Error'; ?></td>
				</tr>
				<?php } ?>
				<?php if (isset($contact_info) && !empty($contact_info->email)) { ?>
				<tr>
					<td class="txt_contact_header">Email:</td>
					<td><?php echo (isset($contact_info) && !empty($contact_info->email)) ? $contact_info->email : 'Error'; ?> <a href="index.php?r=site/contact">Direct Email</a></td>
				</tr>
				<?php } ?>
				<?php if (isset($contact_info) && !empty($contact_info->address)) { ?>
				<tr>
					<td class="txt_contact_header">Address:</td>
					<td><?php echo (isset($contact_info) && !empty($contact_info->address)) ? $contact_info->address : 'Error'; ?></td>
				</tr>
				<?php } ?>
			</table>
			<?php if (isset($contact_info) && !empty($contact_info->map_embed)) { ?>
			<?php echo (isset($contact_info) && !empty($contact_info->map_embed)) ? $contact_info->map_embed : 'Error'; ?>
			<?php } ?>
		</div>
		
		<div class="clear"></div>
		
		<hr style="background-color: gray; margin: 0px;" />
		
		<div id="footer">
			Copyright &copy; <?php echo date('Y'); ?> Eagle Ontario Metal and Scrap.<br/>
			All Rights Reserved.<br/>
			<?php echo "Powerd by ". "<a href='http://inlightdevelopment.com/'>Inlightdevelopment</a>"; ?>
		</div><!-- footer -->
		
	</div><!-- page -->
</div>
</body>
</html>
