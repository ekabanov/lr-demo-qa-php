<?php echo CHtml::beginForm('', 'POST', array('class' => 'form form-horizontal')) ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="control-group">
  <?php echo CHtml::activeLabel($model, 'title', array('class' => 'control-label')) ?>
  <div class="controls">
    <?php echo CHtml::activeTextField($model, 'title', array('class' => 'input-xxlarge', 'placeholder' => "What's your question?")) ?>
  </div>
</div>
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
    <?php echo CHtml::link('Cancel', array('questions/read', 'id' => $model->id, 'title' => $model->title)) ?>
  </div>
</div>
<?php echo CHtml::endForm() ?>

<?php $this->widget('MarkdownScripts') ?>