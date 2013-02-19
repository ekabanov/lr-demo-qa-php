<?php

class VotesController extends Controller
{

  public function actionVoteAnswer()
  {
    $answer = Answer::model()->findByPk($_REQUEST['id']);

    if ($answer == null)
      throw new CHttpException(404);

    $type = Yii::app()->request->getQuery('type', 1);

    $vote = Vote::model()->findByAttributes(array('parent_type' => Vote::TYPE_ANSWER, 'parent_id' => $answer->id, 'user_id' => Yii::app()->user->id));

    if (!$vote) {
      $vote = new Vote;
    } else if ($vote->type == $type) {
      $vote->delete();
      echo CJSON::encode(array(
        'count' => $answer->votesCount,
        'type' => 0
      ));
      Yii::app()->end();
    }

    $vote->parent_type = Vote::TYPE_ANSWER;
    $vote->type = $type;
    $vote->user_id = Yii::app()->user->id;
    $vote->parent_id = $answer->id;
    $vote->save();

    echo CJSON::encode(array(
      'count' => $answer->votesCount,
      'type' => $vote->type
    ));
  }

  public function actionVoteQuestion()
  {
    $question = Question::model()->findByPk($_REQUEST['id']);

    if ($question == null)
      throw new CHttpException(404);

    $type = Yii::app()->request->getQuery('type', 1);

    $vote = Vote::model()->findByAttributes(array('parent_type' => Vote::TYPE_QUESTION, 'parent_id' => $question->id, 'user_id' => Yii::app()->user->id));

    if (!$vote) {
      $vote = new Vote;
    } else if ($vote->type == $type) {
      $vote->delete();
      echo CJSON::encode(array(
        'count' => $question->votesCount,
        'type' => 0
      ));
      Yii::app()->end();
    }

    $vote->parent_type = Vote::TYPE_QUESTION;
    $vote->type = $type;
    $vote->user_id = Yii::app()->user->id;
    $vote->parent_id = $question->id;
    $vote->save();

    echo CJSON::encode(array(
      'count' => $question->votesCount,
      'type' => $vote->type
    ));
  }

  public function accessRules()
  {
    return array(
      array('deny',
        'users' => array('?'),
      ),
    );
  }

}
