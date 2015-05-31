<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $usr_id
 * @property string $usr_login
 * @property string $usr_password
 * @property string $usr_name
 * @property string $usr_surname
 * @property string $usr_middle_name
 * @property string $usr_passport_series
 * @property string $usr_passport_number
 * @property string $usr_output
 * @property string $usr_output_date
 * @property string $usr_unit_code
 * @property string $usr_phone_number
 * @property string $usr_email
 * @property string $usr_rol_id
 */
class User extends CActiveRecord
{
	const ROLE_MANAGER = 'manager';
	const ROLE_ADMIN = 'admin';
	const ROLE_ROOT = 'root';

	const STATE_ACTIVE = 1;
	const STATE_DISABLED = 0;

	public $prevRole = null;
	public $prevPass = null;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usr_login, usr_password, usr_name, usr_surname, usr_email, usr_rol_id', 'required'),
			array('usr_login, usr_password, usr_email', 'length', 'max'=>128),
			array('usr_name, usr_surname, usr_middle_name', 'length', 'max'=>50),
			array('usr_passport_series', 'length', 'max'=>4),
			array('usr_passport_number', 'length', 'max'=>6),
			array('usr_output', 'length', 'max'=>255),
			array('usr_output_date, usr_phone_number', 'length', 'max'=>20),
			array('usr_unit_code', 'length', 'max'=>7),
			array('usr_rol_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('usr_id, usr_login, usr_password, usr_name, usr_surname, usr_middle_name, usr_passport_series, usr_passport_number, usr_output, usr_output_date, usr_unit_code, usr_phone_number, usr_email, usr_rol_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'role' => array(self::BELONGS_TO, 'Role', 'usr_rol_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usr_id' => 'ID',
			'usr_login' => 'Логин',
			'usr_password' => 'Пароль',
			'usr_name' => 'Имя',
			'usr_surname' => 'Фамилия',
			'usr_middle_name' => 'Отчество',
			'usr_passport_series' => 'Паспорт серия',
			'usr_passport_number' => 'Номер',
			'usr_output' => 'Кем выдан',
			'usr_output_date' => 'Дата выдачи',
			'usr_unit_code' => 'Код подразделения',
			'usr_phone_number' => 'Телефон',
			'usr_email' => 'E-mail',
			'usr_rol_id' => 'Роль',
		);
	}

	public function beforeSave() {
		parent::beforeSave();
		$this->usr_password = ( $this->prevPass == $this->usr_password ) ? $this->usr_password : md5($this->usr_password."eduplan");

		if( !$this->usr_login || !$this->usr_email || !$this->usr_password ){
	        return false;
		}

		if( ($this->role->code == User::ROLE_ADMIN || $this->role->code == User::ROLE_ROOT) && Controller::getUserRoleFromModel() != User::ROLE_ROOT && Controller::getUserRoleFromModel() != User::ROLE_ADMIN )
			throw new CHttpException(403,'Доступ запрещен');

		if( !isset($this->prevRole) ) $this->prevRole = $this->role->code;
		return true;
	}

	public function afterSave() {
		parent::afterSave();
		//связываем нового пользователя с ролью
		$auth=Yii::app()->authManager;
		//предварительно удаляем старую связь
		$auth->revoke($this->prevRole, $this->usr_id);
		$auth->assign($this->role->code, $this->usr_id);
		$auth->save();
		return true;
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('usr_id',$this->usr_id);
		$criteria->compare('usr_login',$this->usr_login,true);
		$criteria->compare('usr_password',$this->usr_password,true);
		$criteria->compare('usr_name',$this->usr_name,true);
		$criteria->compare('usr_surname',$this->usr_surname,true);
		$criteria->compare('usr_middle_name',$this->usr_middle_name,true);
		$criteria->compare('usr_passport_series',$this->usr_passport_series,true);
		$criteria->compare('usr_passport_number',$this->usr_passport_number,true);
		$criteria->compare('usr_output',$this->usr_output,true);
		$criteria->compare('usr_output_date',$this->usr_output_date,true);
		$criteria->compare('usr_unit_code',$this->usr_unit_code,true);
		$criteria->compare('usr_phone_number',$this->usr_phone_number,true);
		$criteria->compare('usr_email',$this->usr_email,true);
		$criteria->compare('usr_rol_id',$this->usr_rol_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
