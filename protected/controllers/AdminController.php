<?php

class AdminController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		$user = Yii::app()->user;
		if ($user->isGuest) {
			//echo 'is not logged in';
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		} else {
			//echo 'is logged in'; 
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/items");
		} 
	}
	
	public function actionItems()
	{
		$user = Yii::app()->user;
		if ($user->isGuest) {
			//echo 'is not logged in';
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		} else {
			//echo 'is logged in'; 
			$this->render('items');
		} 
	}
	
	public function actionUpdate()
	{
		$item_id = Yii::app()->getRequest()->getQuery('id');
		//echo "item id: ".$item_id;
		$user = Yii::app()->user;
		if ($user->isGuest) {
			//echo 'is not logged in';
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		} else {
			//echo 'is logged in'; 
			$item = Item::model()->find('ID=:ID', array(':ID'=>$item_id));
			$this->render('update', array('item'=>$item));
		} 
	}
	
	public function actionSave() 
	{
		if (isset($_POST)) {
			//print_r($_POST);
			//print_r($_FILES);
			$pic_url = $this->savePicture('n_picture');
			
			$item = new Item();
			$item->title = $_POST['n_title'];
			$item->description = $_POST['n_desc'];
			$item->picture = $pic_url;
			$item->link = $_POST['n_link'];
			$item->insert();
		}		
	}
	
	public function savePicture($tag_name)
	{
		$target_path = "images/itemImages/";
		$target_path = $target_path.basename($_FILES[$tag_name]['name']);

		if (move_uploaded_file($_FILES[$tag_name]['tmp_name'], $target_path)) {
			return $target_path;
		} else{
			return "...";
		}
	}
	
	public function actionImageUpload()
	{
		$this->render('imageupload');
	}
	
	public function actionInsertImage()
	{
		$this->render('insert');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		Yii::app()->user->setReturnUrl(Yii::app()->baseurl."/index.php?r=admin/index");
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}