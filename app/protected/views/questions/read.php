<h3><?php echo $model->title ?></h3>
<div class="row">
  <div class="span1">
    <?php echo $model->votesCount ?>
  </div>
  <div class="span11">
    <?php echo MarkdownScripts::encode($model->content) ?><br/>
    Asked by <?php echo $model->user->fullName ?>&nbsp;
    <?php echo Yii::app()->format->timeago($model->created_at) ?>

    <?php if ($model->user_id == Yii::app()->user->id): ?>
      <?php echo CHtml::link('Revise', array('questions/revise', 'id' => $model->id)) ?>
    <?php endif; ?>
  </div>
</div>
<hr/>

<?php foreach ($model->getAnswers() as $a): ?>
  <div class="row">
    <div class="span1">
      <?php echo $model->votesCount ?>
    </div>
    <div class="span11">
      <?php echo Markdown($a->content) ?><br/>
      Answered by <?php echo $a->user->fullName ?>&nbsp;
      <?php echo Yii::app()->format->timeago($a->created_at) ?>

      <?php if ($model->user_id == Yii::app()->user->id && $model->answer_id != $a->id): ?>
        <?php echo CHtml::link('Accept as answer', array('questions/accept', 'id' => $a->id)) ?>
      <?php endif; ?>

      <?php if ($model->answer_id == $a->id): ?>
        <span class="label label-success">Accepted answer</span>
      <?php endif; ?>

      <?php if ($a->user_id == Yii::app()->user->id): ?>
        <?php echo CHtml::link('Revise', array('answers/revise', 'id' => $model->id)) ?>
      <?php endif; ?>
    </div>
  </div>
  <hr/>
<?php endforeach; ?>

<?php if (!$hasAnswered): ?>
<?php echo CHtml::beginForm(array('answers/submit', 'id' => $model->id), 'POST', array('class' => 'form form-horizontal')) ?>
<legend>Your answer</legend>

<?php echo CHtml::errorSummary($answer); ?>

<div class="control-group">
  <div class="controls">
    <div class="wmd-panel">
      <div id="wmd-button-bar"></div>
      <?php echo CHtml::activeTextArea($answer, 'content', array('class' => 'wmd-input input-xxlarge', 'id' => 'wmd-input', 'rows' => '15')) ?>
    </div>
  </div>
</div>
<div class="control-group">
  <div class="controls">
    <div id="wmd-preview" class="wmd-panel wmd-preview input-xxlarge"></div>
  </div>
</div>
<div class="control-group">
  <div class="controls">
    <button type="submit" class="btn">Post your answer</button>
  </div>
  <?php echo CHtml::endForm() ?>
  <?php $this->widget('MarkdownScripts') ?>
  <?php endif; ?>

