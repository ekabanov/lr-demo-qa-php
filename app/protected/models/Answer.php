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

  public function hasDownvoted() {
    return Vote::model()->countByAttributes(array(
      'parent_id' => $this->id,
      'parent_type' => Vote::TYPE_ANSWER,
      'user_id' => Yii::app()->user->id,
      'type' => -1
    ));
  }

  public function hasUpvoted() {
    return Vote::model()->countByAttributes(array(
      'parent_id' => $this->id,
      'parent_type' => Vote::TYPE_ANSWER,
      'user_id' => Yii::app()->user->id,
      'type' => 1
    ));
  }


  public function relations()
  {
    return array(
      'comments' => array(self::HAS_MANY, 'Comment', 'parent_id', 'condition' => 'parent_type='.Vote::TYPE_ANSWER),
      'question' => array(self::BELONGS_TO, 'Question', 'question_id'),
      'user' => array(self::BELONGS_TO, 'User', 'user_id'),
      'votesCount' => array(self::STAT, 'Vote', 'parent_id',
        'select' => 'SUM(type)',
        'condition' => 'parent_type=' . Vote::TYPE_ANSWER),
    );
  }

}