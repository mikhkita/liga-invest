<?php

class InstController extends Controller
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
				'actions'=>array('Index'),
				'roles'=>array('root'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdminCreate()
	{
		$model=new Inst;

		if(isset($_POST['Inst']))
		{
			$model->attributes=$_POST['Inst'];
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

		if(isset($_POST['Inst']))
		{
			$model->attributes=$_POST['Inst'];
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
  
		$model = Inst::model()->findAll($criteria);
		$option = array(
			'data'=>$model,
			'labels'=>Inst::attributeLabels()
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
  
		$model = Inst::model()->findAll();
		$option = array(
			'data'=>$model,
			'labels'=>Inst::attributeLabels()
		);
		if( !$partial ){
			$this->render('Index',$option);
		}else{
			$this->renderPartial('Index',$option);
		}
	}
	public function loadModel($id)
	{
		$model=Inst::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
