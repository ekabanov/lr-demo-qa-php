<h1><?php echo $model->fullName ?></h1>

<ul class="nav nav-tabs">
  <li class="active">
    <?php echo CHtml::link('Answers', array('profile/read', 'id' => $model->id, 'name' => $model->fullName)) ?>
  </li>
  <li>
    <?php echo CHtml::link('Questions', array('profile/questions', 'id' => $model->id, 'name' => $model->fullName)) ?>
  </li>
</ul>

<?php foreach ($answers as $answer): ?>
<div class="zebra row question">
	<div class="span1">
		<?php echo $answer->votesCount ?> vote(s)
	</div>
	<div class="span11">
		<?php echo CHtml::link($answer->question->title, array('questions/read', 'id' => $answer->question->id, 'title' => $answer->question->title)) ?>
	</div>
</div>
<?php endforeach; ?>