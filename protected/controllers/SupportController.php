<?php

class SupportController extends Controller
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
		$model=new Support;

		if(isset($_POST['Support']))
		{
			foreach ($_POST['Support'] as &$value) {
		    	$value = trim($value);
			}
			$program = Support::model()->findByAttributes(array("name" =>$_POST['Support']['name']));
			if($program=="") {	
				$model->attributes=$_POST['Support'];
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

		if(isset($_POST['Support']))
		{
			foreach ($_POST['Support'] as &$value) {
		    	$value = trim($value);
			}
				$model->attributes=$_POST['Support'];
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
  		$filter = new Support('filter');
		$criteria = new CDbCriteria();

		if (isset($_GET['Support']))
        {
            $filter->attributes = $_GET['Support'];
            foreach ($_GET['Support'] AS $key => $val)
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
        
		$model = Support::model()->with("user")->findAll($criteria);
		foreach ($model as $item) {
			$item->date = Yii::app()->dateFormatter->format('dd.MM.yyyy',$item->date);
		}
		$option = array(
			'data'=>$model,
			'filter' => $filter,
			'labels'=>Support::attributeLabels()
		);
		if( !$partial ){
			$this->render('adminIndex',$option);
		}else{
			$this->renderPartial('adminIndex',$option);
		}
	}
	
	public function actionIndex($partial = false,$error = NULL)
	{
		if( !$partial ){
			$this->layout='site';
		}
		$user_id = Yii::app()->user->getId();

		
		$new = new Support;
		
		if(isset($_POST['Support']))
		{
			header('Location: '.$this->createUrl('/support'));
			$this->clearStr($_POST['Support']);
			$new->attributes=$_POST['Support'];
			$new->user_id=$user_id;
			$new->date = date("Y-m-d");
			if(!$new->save()) header('Location: '.$this->createUrl('/support',array("error" => 'save')));
		} else {
			$criteria = new CDbCriteria();
			$criteria->condition = 'user_id='.$user_id;
			$criteria->order = 'date DESC';
			$model = Support::model()->findAll($criteria);
			foreach ($model as $item) {
				$item->date = Yii::app()->dateFormatter->format('dd.MM.yyyy',$item->date);
			}
			$faq = Faq::model()->findAll();
			$option = array( 
				'new' => $new,
				'model'=>$model,
				'error' => $error,
				'faq' => $faq,
				'labels'=>User::attributeLabels()
			);
			if( !$partial ){
				$this->render('index',$option);
			}else{
				$this->renderPartial('index',$option);
			}
		}
	}

	public function actionDetail($id)
	{
		$model=$this->loadModel($id);

			$this->renderPartial('detail',array(
				'model'=>$model,
			));
	}
	public function loadModel($id)
	{
		$model=Support::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
