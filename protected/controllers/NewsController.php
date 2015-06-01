<?php

class NewsController extends Controller
{
	static private $instance = NULL;

	static public function getInstance()
    {
        if(self::$instance == NULL)
        {
            self::$instance = new NewsController();
        }
        return self::$instance;
    }

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
				'actions'=>array('index','detail'),
				'roles'=>array('manager'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdminCreate()
	{
		$model=new News;
		$model->date = date("d.m.Y");
		if(isset($_POST['News']))
		{
			foreach ($_POST['News'] as &$value) {
		    	$value = trim($value);
			}
			$program = News::model()->findByAttributes(array("name" =>$_POST['News']['name']));
			if($program=="") {
				$model->attributes=$_POST['News'];
				$model->date = date_format(date_create_from_format('d.m.Y',$_POST['News']['date']),'Y-m-d');
				if($model->save()){
					$this->actionAdminIndex(true);
					return true;
				}
			} else {
				$this->actionAdminIndex(true,"Такое имя уже существует");
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
		$model->date = Yii::app()->dateFormatter->format('dd.MM.yyyy',$model->date);
		if(isset($_POST['News']))
		{
			foreach ($_POST['News'] as &$value) {
		    	$value = trim($value);
			}
			$program = News::model()->findByAttributes(array("name" =>$_POST['News']['name']));
			if($program=="" || $_POST['News']['name']==$model->name) {				
				$model->attributes=$_POST['News'];
				$model->date = date_format(date_create_from_format('d.m.Y',$_POST['News']['date']),'Y-m-d');
				if($model->save())
					$this->actionAdminIndex(true);
			} else {
				$this->actionAdminIndex(true,"Такое имя уже существует");
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

		$this->actionAdminIndex(true);
	}

	public function actionAdminIndex($partial = false)
	{
		if( !$partial ){
			$this->layout='admin';
		}
  		$filter = new News('filter');
		$criteria = new CDbCriteria();

		if (isset($_GET['News']))
        {
            $filter->attributes = $_GET['News'];
            foreach ($_GET['News'] AS $key => $val)
            {
                if ($val != '')
                {
                    if( $key == "name" ){
                    	$criteria->addSearchCondition('name', $val);
                    }else{
                    	$criteria->addCondition("$key = '{$val}'");
                    }
                }
            }
        }

        $criteria->order = 'date DESC';
        $criteria->select = array('id','name','date');

		$model = News::model()->findAll($criteria);
		foreach ($model as $item) {
			$item->date = Yii::app()->dateFormatter->format('dd.MM.yyyy',$item->date);
		}
		$option = array(
			'data'=>$model,
			'filter' => $filter,
			'labels'=>News::attributeLabels()
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
		$criteria->order = 'date DESC';
		$criteria->select = array('id','name','date');

		$model = News::model()->findAll($criteria);
		foreach ($model as $item) {
			$item->date = Yii::app()->dateFormatter->format('dd.MM.yyyy',$item->date);
		}
		$option = array(
			'model' => $model,
			'labels'=>News::attributeLabels()
		);
		if( !$partial ){
			$this->render('index',$option);
		}else{
			$this->renderPartial('index',$option);
		}
	}

	public function actionDetail($id,$partial = false)
	{
		if( !$partial ){
			$this->layout='site';
		}

		$model = News::model()->findbyPk($id);
		$model->date = Yii::app()->dateFormatter->format('dd.MM.yyyy',$model->date);
		$option = array(
			'model' => $model,
			'labels'=>News::attributeLabels()
		);
		if( !$partial ){
			$this->render('detail',$option);
		}else{
			$this->renderPartial('detail',$option);
		}
	}


	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
