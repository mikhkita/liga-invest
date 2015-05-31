<?php

class InstructionController extends Controller
{
	public function filters()
	{
		return array(
				'accessControl'
			);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('adminIndex','adminCreate','adminUpdate','adminDelete'),
				'roles'=>array('manager'),
			),
			array('allow',
				'actions'=>array('index','redirect'),
				'roles'=>array('manager'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionRedirect() {
		header('Location: /instruction');
	}
	public function actionAdminCreate()
	{
		$model=new Settings;

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save()){
				$this->actionAdminIndex(true);
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

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save())
				$this->actionAdminIndex(true);
		}else{
			$this->renderPartial('adminUpdate',array(
				'model'=>$model,
			));
		}
	}

	public function actionAdminDelete($id)
	{
		$this->loadModel($id)->delete();

		$this->actionAdminIndex(true);
	}

	public function actionAdminIndex($partial = false)
	{
		if( !$partial ){
			$this->layout='admin';
		}
		$criteria = new CDbCriteria();

        $criteria->order = 'sort ASC';
        $criteria->condition = 'code="INST_TITLE" OR code="INST_VIDEO"';
  
		$model = Settings::model()->findAll($criteria);
		$option = array(
			'data'=>$model,
			'labels'=>Settings::attributeLabels()
		);
		if( !$partial ){
			$this->render('adminIndex',$option);
		}else{
			$this->renderPartial('adminIndex',$option);
		}
	}
	
	public function actionIndex($partial = false)
	{
		if( !$partial ){
			$this->layout='site';
		}
  		$criteria = new CDbCriteria();
        $criteria->condition = 'code="INST_TITLE" OR code="INST_VIDEO"';
		$model = Settings::model()->findAll($criteria);
		$option = array(
			'data'=>$model,
			'labels'=>Settings::attributeLabels()
		);
		if( !$partial ){
			$this->render('index',$option);
		}else{
			$this->renderPartial('index',$option);
		}
	}
	public function loadModel($id)
	{
		$model=Settings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
