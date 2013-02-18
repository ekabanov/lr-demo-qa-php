<?php

class Question extends CActiveRecord
{
  public static function model($className = __CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'questions';
  }

  public function rules()
  {
    return array(
      array('title, content', 'required'),
    );
  }

  public function relations()
  {
    return array(
      'answer' => array(self::BELONGS_TO, 'Answer', 'answer_id'),
      'answers' => array(self::HAS_MANY, 'Answer', 'question_id'),
      'user' => array(self::BELONGS_TO, 'User', 'user_id'),
      'answersCount' => array(
        self::STAT, 'Answer', 'question_id'
      ),
    );
  }

}