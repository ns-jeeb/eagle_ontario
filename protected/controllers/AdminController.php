<?php

class AdminController extends Controller
{	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{		
		if ($this->isUserLoggedIn()) {
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/items");
		} else {
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		} 
	}
	
	public function actionItems()
	{
		if ($this->isUserLoggedIn()) {
			$this->render('items');
		} else {
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		} 
	}
	
	public function actionInsert() 
	{	
		if ($this->isUserLoggedIn()) {
			$this->render('update');
		} else {
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		} 
	}
	
	public function actionUpdate()
	{
		$item_id = Yii::app()->getRequest()->getQuery('id');
		if ($this->isUserLoggedIn()) {
			$item = Item::model()->find('ID=:ID', array(':ID'=>$item_id));
			$this->render('update', array('item'=>$item));
		} else {
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		}
	}
	
	public function actionSave() 
	{
		if ($this->isUserLoggedIn()) {
			if (isset($_POST)) {
				$pic_url = $this->savePicture('n_picture', $_POST['n_title']); // save new if available
				$old_pic_url = $_POST['n_pic_path']; // get old picture path
				if (!empty($pic_url) && $pic_url != $old_pic_url) @unlink($old_pic_url);
				
				$id = $_POST['n_id'];
				$item = Item::model()->findByPk($id);
				if (!isset($item)) {
					$item = new Item();
				}
				$item->title = $_POST['n_title'];
				$item->description = $_POST['n_desc'];
				$item->picture = (empty($pic_url)) ? $old_pic_url : $pic_url;
				$item->link = $_POST['n_link'];
				$item->save();
				echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/items");
			}
		} else {
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		}
	}
	
	public function savePicture($tag_name, $title)
	{
		$target_path = "images/itemImages/";
		$target_path = $target_path.$title."_".basename($_FILES[$tag_name]['name']);

		if (!empty($_FILES[$tag_name]['name']) && move_uploaded_file($_FILES[$tag_name]['tmp_name'], $target_path)) {
			return $target_path;
		} else{
			return null;
		}
	}
	
	public function actionDelete($id) 
	{	
		if ($this->isUserLoggedIn()) {
			if (isset($_POST)) {
				$item = Item::model()->findByPk($id);
				if (isset($item)) {
					@unlink($item->picture);
					$item->delete();
				}
			}
		} else {
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		}
	}
	
	public function actionContact()
	{
		if ($this->isUserLoggedIn()) {
			$this->render('contact');
		} else {
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		}
	}
	
	public function actionSaveContact() 
	{
		if ($this->isUserLoggedIn()) {
			if (isset($_POST)) {				
				$id = $_POST['n_id'];
				if (!empty($id) && $id != -1) {
					$contact_info = Contact::model()->findByPk($id);
					if (isset($contact_info)) {
						$contact_info->contact = $_POST['n_contact'];
						$contact_info->phone = $_POST['n_phone'];
						$contact_info->email = $_POST['n_email'];
						$contact_info->address = $_POST['n_address'];
						$contact_info->map_embed = $_POST['n_map_embed'];
						$contact_info->save();
					}		
				}
			}
			$this->render('contact');
		} else {
			echo $this->redirect(Yii::app()->baseurl."/index.php?r=admin/login");
		}
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

	public function isUserLoggedIn() {
		
		$user = Yii::app()->user;
		if ($user->isGuest) {
			return false;
		} else {
			return true;
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