<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='admin';
	public $scripts = array();
    public $globalScripts = array();
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();

    public $interpreters = array();

    public $user;

    public $texts = NULL;

    public $start;
    public $render;
    public $debugText = "";

    public $adminMenu = array();
    public $settings = NULL;

    public function init() {
        parent::init();
        
        $this->user = User::model()->findByPk(Yii::app()->user->id);

        $this->adminMenu["items"] = ModelNames::model()->findAll(array("order" => "sort ASC","condition" => "admin_menu=1"));

        foreach ($this->adminMenu["items"] as $key => $value) {
            $this->adminMenu["items"][$key] = $this->toLowerCaseModelNames($value);
        }

        $this->adminMenu["cur"] = $this->toLowerCaseModelNames(ModelNames::model()->find(array("condition" => "code = '".Yii::app()->controller->id."'")));
        
        $this->start = microtime(true);
    }

    public function beforeRender($view){
        parent::beforeRender($view);

        $this->render = microtime(true);

        $this->debugText = "Controller ".round(microtime(true) - $this->start,4);
        
        return true;
    }

    public function afterRenderPartial(){
        parent::afterRenderPartial();

        $this->debugText = ($this->debugText."<br>View ".round(microtime(true) - $this->render,4));
    }

    public function getUserRole(){
        return $this->user->role->code;
    }

    public function getUserRoleRus() {
    	return $this->user->role->name;
    }

    public function getUserRoleFromModel(){
        $user = User::model()->findByPk(Yii::app()->user->id);
        return $user->role->code;
    }

    public function getText($id,$params = NULL){
        if( $this->texts == NULL ) $this->getTexts();
        $output = "";

        if( isset($this->texts[(int)$id]) ){

            if( !Yii::app()->user->isGuest ){
                $class = ( $params != NULL && isset($params["class"]) )?(" ".$params["class"]):"";
                $url = Yii::app()->createUrl('/text/adminupdate',array('id'=>$id,'json'=>'1'));
                $output .= '<font class="b-kit-update'.$class.'" href="'.$url.'" data-id="'.$id.'">';
            }
            $this->texts[(int)$id] = str_replace("\n", "<br>", $this->texts[(int)$id]);
            $output .= $this->texts[(int)$id];

            if( !Yii::app()->user->isGuest ){
                $output .= '</font>';
            }
        }
        return $output;
    }

    public function getTexts(){
        $model = Text::model()->findAll();

        $this->texts = array();

        foreach ($model as $text) {
            $this->texts[$text->id] = $text->text;
        }
    }

    public function getParam($code,$toBr = false){
        if( $this->settings == NULL ) $this->getSettings();

        return ($toBr)?$this->replaceToBr($this->settings[mb_strtoupper($code,"UTF-8")]):$this->settings[mb_strtoupper($code,"UTF-8")];
    }

    public function getSettings(){
        $model = Settings::model()->findAll();

        $this->settings = array();

        foreach ($model as $param) {
            $this->settings[mb_strtoupper($param->code,"UTF-8")] = $param->value;
        }
    }

    public function toLowerCaseModelNames($el){
        if( !$el ) return false;
        $el->vin_name = mb_strtolower($el->vin_name, "UTF-8");
        $el->rod_name = mb_strtolower($el->rod_name, "UTF-8");

        return $el;
    }

    public function replaceToBr($str){
        return str_replace("\n", "<br>", $str);
    }

    public function getMenuCodes(){
        $model = Page::model()->findAllByPk(array(1,2),array("order"=>"pag_id ASC"));
        return $model;
    }

    public function replaceImage($new_folder, $old_folder){
        if($new_folder!=$old_folder) {
            if(file_exists($old_folder)) unlink($old_folder);
            if($new_folder!="") {
                $temp = $new_folder;
                $new_folder = str_replace(Yii::app()->params['tempFolder'], Yii::app()->params['imageFolder'], $temp);
                rename($temp,$new_folder);
            }
        }
    }

    public function clearStr($array) {
        foreach ($array as &$value) {
            $value = trim($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            $value = mysql_escape_string($value);
        }
    }
}