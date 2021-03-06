<h1><?php echo $model->fullName ?></h1>

<ul class="nav nav-tabs">
  <li>
    <?php echo CHtml::link('Answers', array('profile/read', 'id' => $model->id, 'name' => $model->fullName)) ?>
  </li>
  <li class="active">
    <?php echo CHtml::link('Questions', array('profile/questions', 'id' => $model->id, 'name' => $model->fullName)) ?>
  </li>
</ul>

<?php foreach ($questions as $question): ?>
<div class="zebra row question">
	<div class="span1 text-center">
		<span class="label"><?php echo $question->votesCount ?></span>
	</div>
	<div class="span11">
		<?php echo CHtml::link($question->title, array('questions/read', 'id' => $question->id, 'title' => $question->title)) ?>
	</div>
</div>
<?php endforeach; ?>