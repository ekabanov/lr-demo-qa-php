<?php if ($this->section == 'questions'): ?>
  <h1>All Questions</h1>
<?php else: ?>
  <h1>Unanswered Questions</h1>
<?php endif; ?>
<ul class="nav nav-pills">
  <li<?php echo $this->subSection == 'newest' ? ' class="active"' : ''?>>
    <?php echo CHtml::link('newest', array('questions/list', 'category' => $_REQUEST['category'])) ?>
  </li>
  <li<?php echo $this->subSection == 'no-answers' ? ' class="active"' : '' ?>>
    <?php echo CHtml::link('no answers', array('questions/list', 'category' => $_REQUEST['category'], 'filterBy' => 'no-answers')) ?>
  </li>
</ul>

<?php foreach ($models as $model): ?>
  <?php $this->renderPartial('summary', array('model' => $model)) ?>
<?php endforeach; ?>

<?php if (empty($models)): ?>
 No questions available yet.
<?php endif; ?>

<?php $this->widget('LinkPager', array(
  'pages' => $pages,
  'cssFile' => false,
  'header' => '',
  'selectedPageCssClass' => 'active'
)) ?>