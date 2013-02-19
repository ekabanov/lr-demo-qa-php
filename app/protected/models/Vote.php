<?php

class Vote extends CActiveRecord
{

  const TYPE_ANSWER = 1;
  const TYPE_QUESTION = 2;

  public static function model($className = __CLASS__)
  {
    return parent::model($className);
  }

  public function tableName()
  {
    return 'votes';
  }

}