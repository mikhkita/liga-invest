<?php

class InvestitionController extends Controller
{
	static private $instance = NULL;

	static public function getInstance()
    {
        if(self::$instance == NULL)
        {
            self::$instance = new InvestitionController();
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
				'actions'=>array('index'),
				'roles'=>array('manager'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdminCreate()
	{
		$model=new Investition;

		if(isset($_POST['Investition']))
		{
			foreach ($_POST['Investition'] as &$value) {
		    	$value = trim($value);
			}
			$program = Investition::model()->findByAttributes(array("name" =>$_POST['Investition']['name']));
			if($program=="") {	
				$this->replaceImage($_POST['Investition']['image'],$model->image);
				$model->attributes=$_POST['Investition'];
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

		if(isset($_POST['Investition']))
		{
			foreach ($_POST['Investition'] as &$value) {
		    	$value = trim($value);
			}

			$program = Investition::model()->findByAttributes(array("name" =>$_POST['Investition']['name']));
			if($program=="" || $_POST['Investition']['name']==$model->name) {	
				$this->replaceImage($_POST['Investition']['image'],$model->image);
				$model->attributes=$_POST['Investition'];
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
  		$filter = new Investition('filter');
		$criteria = new CDbCriteria();

		if (isset($_GET['Investition']))
        {
            $filter->attributes = $_GET['Investition'];
            foreach ($_GET['Investition'] AS $key => $val)
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

        $criteria->order = 'name ASC';
        
		$model = Investition::model()->findAll($criteria);
		$option = array(
			'data'=>$model,
			'filter' => $filter,
			'labels'=>Investition::attributeLabels()
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
		$criteria->order = 'name ASC';

		$model = Investition::model()->findAll($criteria);
		$anketa = Settings::model()->find('code="ANKETA"')->value;
		$option = array(
			'model' => $model,
			'anketa' => $anketa,
			'labels'=>Investition::attributeLabels()
		);
		if( !$partial ){
			$this->render('index',$option);
		}else{
			$this->renderPartial('index',$option);
		}
	}

	public function loadModel($id)
	{
		$model=Investition::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
