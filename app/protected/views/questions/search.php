<h1>Search results for '<?php echo $_REQUEST['q'] ?>'</h1>

<?php foreach ($models as $model): ?>
  <?php $this->renderPartial('summary', array('model' => $model)) ?>
<?php endforeach; ?>

<?php if (empty($models)): ?>
  No questions found.
<?php endif; ?>

<?php $this->widget('LinkPager', array(
  'pages' => $pages,
  'cssFile' => false,
  'header' => '',
  'selectedPageCssClass' => 'active'
)) ?>