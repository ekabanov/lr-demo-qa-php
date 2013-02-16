<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $created_at
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $facebook_id
 *
 * The followings are the available model relations:
 * @property Answers[] $answers
 * @property Comments[] $comments
 * @property Questions[] $questions
 * @property Votes[] $votes
 */
class User extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, name, password', 'required'),
      array('email, name', 'unique'),
			array('email, name', 'length', 'max'=>255),
			array('password', 'length', 'min' => 6),
      array('password', 'comparePassword'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_at, email, name, password, facebook_id', 'safe', 'on'=>'search'),
		);
	}

  public function comparePassword($attribute,$params)
  {
    if(!$this->hasErrors())
    {
      if (!isset($_POST['verifyPassword']) || $this->password != $_POST['verifyPassword'])
        $this->addError('password','Passwords do not match.');
    }
  }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'answers' => array(self::HAS_MANY, 'Answer', 'user_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
			'questions' => array(self::HAS_MANY, 'Question', 'user_id'),
			'votes' => array(self::HAS_MANY, 'Votes', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created_at' => 'Created At',
			'email' => 'Email',
			'name' => 'Full name',
			'password' => 'Password',
			'facebook_id' => 'Facebook',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('facebook_id',$this->facebook_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

  public function getFullName() {
    return $this->name;
  }
}