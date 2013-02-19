<?php

class ProfileController extends Controller {

  public function actionRead() {
    $model = User::model()->findByPk($_REQUEST['id']);

    if (!$model)
      throw new CHttpException(404, "User not found");

    $answers = Answer::model()->findAllByAttributes(array('user_id' => $model->id));

    $this->render('read', array('model' => $model, 'answers' => $answers));
  }

  public function actionQuestions() {
    $model = User::model()->findByPk($_REQUEST['id']);

    if (!$model)
      throw new CHttpException(404, "User not found");

    $questions = Question::model()->findAllByAttributes(array('user_id' => $model->id));

    $this->render('questions', array('model' => $model, 'questions' => $questions));
  }

}
