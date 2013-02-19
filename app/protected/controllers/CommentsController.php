<?php

class CommentsController extends Controller {

  public function actionPost() {
    if (empty($_REQUEST['comment']))
      Yii::app()->end();

    if ($_REQUEST['type'] == Vote::TYPE_ANSWER)
      $model = Answer::model()->findByPk($_REQUEST['id']);
    else if ($_REQUEST['type'] == Vote::TYPE_QUESTION)
      $model = Question::model()->FindByPk($_REQUEST['id']);

    if (!$model)
      Yii::app()->end();

    $comment = new Comment;
    $comment->parent_type = $_REQUEST['type'];
    $comment->user_id = Yii::app()->user->id;
    $comment->parent_id = $_REQUEST['id'];
    $comment->content = $_REQUEST['comment'];
    $comment->save();
    $model->refresh();

    echo CJSON::encode(array(
      'content' => $this->renderPartial('comment', array('model' => $model), true)
    ));
  }

}
