<?php

class QuestionsController extends Controller
{

  public $defaultAction = 'list';

  public function actionList()
  {
    throw new CHttpException(500, "World ended with 2012.");

    $this->section = 'questions';
    $this->subSection = 'newest';

    $criteria = new CDbCriteria;
    $criteria->order = 'created_at DESC';
    $criteria->scopes = array();

    if ($_REQUEST['category'] == 'unanswered') {
      $this->section = 'unanswered';
      $criteria->scopes += array('unanswered');
    }

    if (isset($_REQUEST['filterBy']) && $_REQUEST['filterBy'] == 'no-answers') {
      $this->subSection = 'no-answers';
      $criteria->scopes += array('no-answers');
    }

    $numOfQuestions = Question::model()->count($criteria);
    $pages = new CPagination($numOfQuestions);

    $pages->pageSize = 10;
    $pages->applyLimit($criteria);

    $models = Question::model()->findAll($criteria);

    $this->render('list', array(
      'models' => $models,
      'pages' => $pages
    ));
  }

  public function actionAccept()
  {
    $answer = Answer::model()->findByPk($_REQUEST['id']);

    if ($answer == null)
      throw new CHttpException(404, "Answer not found.");

    $question = $answer->question;

    if ($question->user_id != Yii::app()->user->id)
      throw new CHttpException(403);

    $question->answer_id = $answer->id;
    $question->save();

    $this->redirect(array('questions/read', 'id' => $question->id, 'title' => $question->title));
  }

  public function actionSearch()
  {
    $criteria = new CDbCriteria;
    $criteria->order = 'created_at DESC';
    $criteria->addSearchCondition('title', $_REQUEST['q']);

    $numOfQuestions = Question::model()->count($criteria);
    $pages = new CPagination($numOfQuestions);

    $pages->pageSize = 10;
    $pages->applyLimit($criteria);

    $models = Question::model()->findAll($criteria);

    $this->render('search', array(
      'models' => $models,
      'pages' => $pages
    ));
  }

  public function actionRead()
  {
    $model = Question::model()->findByPk($_REQUEST['id']);

    if ($model == null)
      throw new CHttpException(404, "Question not found.");

    if (Yii::app()->user->isGuest)
      $hasAnswered = true;
    else
      $hasAnswered = Answer::model()->countByAttributes(array('question_id' => $model->id, 'user_id' => Yii::app()->user->id));

    $this->render('read', array('model' => $model, 'hasAnswered' => $hasAnswered, 'answer' => new Answer));
  }

  public function actionAsk()
  {
    $this->section = 'ask';

    $model = new Question;

    if (isset($_POST['Question'])) {
      $model->attributes = $_POST['Question'];
      if ($model->validate()) {
        $model->user_id = Yii::app()->user->id;
        $model->save(false);
        $this->redirect(array('questions/read', 'id' => $model->id, 'title' => $model->title));
      }
    }

    $this->render('ask', array('model' => $model));
  }

  public function actionRevise()
  {
    $model = Question::model()->findByPk($_REQUEST['id']);

    if ($model == null)
      throw new CHttpException(404, "Question not found.");

    if ($model->user_id != Yii::app()->user->id)
      throw new CHttpException(403);

    if (isset($_POST['Question'])) {
      $model->attributes = $_POST['Question'];
      if ($model->validate()) {
        $model->save(false);
        $this->redirect(array('questions/read', 'id' => $model->id, 'title' => $model->title));
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
        'actions' => array('ask', 'revise', 'accept'),
        'users' => array('?'),
      ),
    );
  }
}