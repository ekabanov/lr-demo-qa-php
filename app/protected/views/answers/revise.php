<h1><?php echo $model->question->title ?></h1>
<?php echo CHtml::beginForm(array('answers/revise', 'id' => $model->id), 'POST', array('class' => 'form form-horizontal')) ?>
<legend>Answer</legend>

<?php echo CHtml::errorSummary($model); ?>

<div class="control-group">
  <div class="controls">
    <div class="wmd-panel">
      <div id="wmd-button-bar"></div>
      <?php echo CHtml::activeTextArea($model, 'content', array('class' => 'wmd-input input-xxlarge', 'id' => 'wmd-input', 'rows' => '15')) ?>
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
    <button type="submit" class="btn">Save revision</button>
    <?php echo CHtml::link('Cancel', array('questions/read', 'id' => $model->question->id, 'title' => $model->question->title)) ?>
  </div>
<?php echo CHtml::endForm() ?>

<?php $this->widget('MarkdownScripts') ?>