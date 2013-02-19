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
      'votesCount' => array(self::STAT, 'Vote', 'parent_id',
        'select' => 'SUM(type)',
        'condition' => 'parent_type=' . Vote::TYPE_QUESTION),
    );
  }

  public function scopes()
  {
    return array(
      'no-answers' => array(
        'select' => 't.*, COUNT(answer.id) AS answersCount',
        'join' => 'LEFT JOIN answers answer ON answer.question_id = t.id',
        'group' => 't.id',
        'having' => 'answersCount = 0'
      ),
      'unanswered' => array(
        'condition' => 't.answer_id IS NULL',
      ),
    );
  }


  public function getAnswers()
  {
    if (!$this->answer_id)
      return $this->answers;

    $answers = $this->answers;

    foreach ($answers as $key => $answer) {
      if ($answer->id == $this->answer_id) {
        unset($answers[$key]);
        $answers = array($answer) + $answers;
        break;
      }
    }
    return $answers;
  }

}