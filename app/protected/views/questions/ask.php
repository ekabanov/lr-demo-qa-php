<div class="row">
  <?php echo CHtml::beginForm('', 'POST', array('class' => 'form form-horizontal')) ?>

  <?php echo CHtml::errorSummary($model); ?>

  <div class="control-group">
    <label class="control-label" for="Question_title"><strong>Title</strong></label>

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
      <button type="submit" class="btn">Post your question</button>
    </div>
    <?php echo CHtml::endForm() ?>
  </div>

  <script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/js/pagedown/Markdown.Converter.js"></script>
  <script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/js/pagedown/Markdown.Sanitizer.js"></script>
  <script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/js/pagedown/Markdown.Editor.js"></script>
  <script type="text/javascript">
    (function () {
      var converter = Markdown.getSanitizingConverter();

      var editor = new Markdown.Editor(converter);

      editor.run();
    })();
  </script>