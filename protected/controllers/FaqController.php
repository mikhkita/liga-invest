<?php

class FaqController extends Controller
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
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdminCreate()
	{
		$model=new Faq;

		if(isset($_POST['Faq']))
		{
			foreach ($_POST['Faq'] as &$value) {
		    	$value = trim($value);
			}
			$program = Faq::model()->findByAttributes(array("question" =>$_POST['Faq']['question']));
			if($program=="") {	
				$model->attributes=$_POST['Faq'];
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

		if(isset($_POST['Faq']))
		{
			foreach ($_POST['Faq'] as &$value) {
		    	$value = trim($value);
			}
				$model->attributes=$_POST['Faq'];
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
  		$filter = new Faq('filter');
		$criteria = new CDbCriteria();

		if (isset($_GET['Faq']))
        {
            $filter->attributes = $_GET['Faq'];
            foreach ($_GET['Faq'] AS $key => $val)
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

        $criteria->order = 'sort ASC';
        
		$model = Faq::model()->findAll($criteria);
		$option = array(
			'data'=>$model,
			'filter' => $filter,
			'labels'=>Faq::attributeLabels()
		);
		if( !$partial ){
			$this->render('adminIndex',$option);
		}else{
			$this->renderPartial('adminIndex',$option);
		}
	}
	
	public function loadModel($id)
	{
		$model=Faq::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
