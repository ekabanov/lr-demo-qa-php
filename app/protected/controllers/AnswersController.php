<?php

class AnswersController extends Controller
{

  public function actionSubmit()
  {
    $question = Question::model()->findByPk($_REQUEST['id']);

    if ($question == null)
      $this->redirect(array('questions/list', 'category' => 'all'));

    $hasAnswered = Answer::model()->countByAttributes(array('question_id' => $question->id, 'user_id' => Yii::app()->user->id));

    if ($hasAnswered)
      $this->redirect(array('questions/read', 'id' => $question->id, 'title' => $question->title));

    $answer = new Answer;

    if (isset($_POST['Answer'])) {
      $answer->attributes = $_POST['Answer'];
      if ($answer->validate()) {
        $answer->question_id = $question->id;
        $answer->user_id = Yii::app()->user->id;
        $answer->save(false);
        $this->redirect(array('questions/read', 'id' => $question->id, 'title' => $question->title));
      }
    }

    $this->render('/questions/read', array('model' => $question, 'hasAnswered' => $hasAnswered, 'answer' => $answer));
  }

  public function actionRevise()
  {
    $model = Answer::model()->findByPk($_REQUEST['id']);

    if ($model == null)
      throw new CHttpException(404, "Answer not found.");

    if ($model->user_id != Yii::app()->user->id)
      throw new CHttpException(403);

    if (isset($_POST['Answer'])) {
      $model->attributes = $_POST['Answer'];
      if ($model->validate()) {
        $model->save(false);
        $this->redirect(array('questions/read', 'id' => $model->question->id, 'title' => $model->question->title));
      }
    }

    $this->render('revise', array('model' => $model));
  }

  public function filters()
  {
    return array(
      'accessControl',
    );
  }

  public function accessRules()
  {
    return array(
      array('deny',
        'actions' => array('submit', 'revise'),
        'users' => array('?'),
      ),
    );
  }

}
