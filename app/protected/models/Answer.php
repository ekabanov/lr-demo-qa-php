<?php

class Answer extends CActiveRecord
{
  public static function model($className = __CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'answers';
  }

  public function rules()
  {
    return array(
      array('content', 'required'),
    );
  }

  public function relations()
  {
    return array(
      'question' => array(self::BELONGS_TO, 'Question', 'question_id'),
      'user' => array(self::BELONGS_TO, 'User', 'user_id'),
    );
  }

}