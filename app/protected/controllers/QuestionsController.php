<?php

class QuestionsController extends CController
{

  public function actionIndex()
  {
    $criteria = new CDbCriteria();
    $count = Question::model()->count($criteria);
    $pages = new CPagination($count);

    $pages->pageSize = 10;
    $pages->applyLimit($criteria);
    $models = Question::model()->findAll($criteria);

    $this->render('index', array('models' => $models, 'pages' => $pages));
  }


  public function actionAsk()
  {
    $this->pageTitle = "Ask Question";
    $model = new Question;

    if (isset($_POST['Question'])) {
      $model->attributes = $_POST['Question'];
      if ($model->validate()) {
        $model->user_id = Yii::app()->user->id;
        $model->save(false);
        $this->redirect(array('index'));
      }
    }

    $this->render('ask', array('model' => $model));
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
        'actions' => array('ask'),
        'users' => array('?'),
      ),
    );
  }
}