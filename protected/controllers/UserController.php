<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
                'actions'=>array('adminIndex','adminDetail','adminCreate','adminUpdate','adminDelete'),
                'roles'=>array('admin'),
            ),
            array('allow',
				'actions'=>array('index','cabinet'),
				'roles'=>array('manager'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAdminCreate()
	{
		$model=new User;

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];

			if($model->save()){
				$this->actionAdminindex(true);
				return true;
			}
		}

		$this->renderPartial('adminCreate',array(
			'model'=>$model,
		));

	}

	public function actionAdminUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['User']))
		{
			$model->prevPass = $model->usr_password;
			$model->prevRole = $model->role->code;
			$model->attributes=$_POST['User'];
			if($model->save()){
				$this->actionAdminindex(true);
			}
				
		}else{
			$this->renderPartial('adminUpdate',array(
				'model'=>$model,
			));
		}
	}

	public function actionAdminDelete($id)
	{
		$this->loadModel($id)->delete();

		$this->actionAdminindex(true);
	}

	public function actionAdminIndex($partial = false)
	{
		if( !$partial ){
			$this->layout='admin';
		}

        $model = User::model()->findAll();

		if( !$partial ){
			$this->render('adminIndex',array(
				'data'=>$model,
				'labels'=>User::attributeLabels()
			));
		}else{
			$this->renderPartial('adminIndex',array(
				'data'=>$model,
				'labels'=>User::attributeLabels()
			));
		}
	}

	public function actionAdminDetail($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save()){
				$this->actionAdminindex(true);
			}
				
		}else{
			$this->renderPartial('adminDetail',array(
				'model'=>$model,
			));
		}
	}

	public function actionIndex($partial = false,$error = NULL)
	{
		if( !$partial ){
			$this->layout='site';
		}
		$model = User::model()->findByPk(Yii::app()->user->getId());
		if(isset($_POST['User']))
		{
			header('Location: '.$this->createUrl('/user'));
			$this->clearStr($_POST['User']);
			$model->attributes=$_POST['User'];
			if(!$model->save()) header('Location: '.$this->createUrl('/user',array("error" => 'save')));
		} else {
			$option = array(
				'model'=>$model,
				'error' => $error,
				'labels'=>User::attributeLabels()
			);
			if( !$partial ){
				$this->render('index',$option);
			}else{
				$this->renderPartial('index',$option);
			}
		}
	}

	public function actionCabinet($partial = false,$error = NULL)
	{
		if( !$partial ){
			$this->layout='site';
		}
		$model = User::model()->findByPk(Yii::app()->user->getId());

		if(isset($_POST['User']) )
		{
			$this->clearStr($_POST['User']);
			header('Location: '.$this->createUrl('/user/cabinet'));
			if( $model->usr_password == md5($_POST['User']['old_usr_password']."eduplan") && $_POST['User']['new_usr_password']) {	
				$model->prevPass = $model->usr_password;
				$_POST['User']['usr_password'] = $_POST['User']['new_usr_password'];			
			} else if($_POST['User']['old_usr_password'] || $_POST['User']['new_usr_password']){	
				header('Location: '.$this->createUrl('/user/cabinet',array("error" => 'password')));
			}
			$model->attributes=$_POST['User'];
			if(!$model->save()) header('Location: '.$this->createUrl('/user/cabinet',array("error" => 'save')));				
		} else {
			$option = array(
				'model'=>$model,
				'error' => $error,
				'labels'=>User::attributeLabels()
			);
			if( !$partial ){
				$this->render('cabinet',$option);
			}else{
				$this->renderPartial('cabinet',$option);
			}
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->with("role")->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
