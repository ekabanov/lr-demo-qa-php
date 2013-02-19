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
  <?php echo $question->votesCount ?>
  <?php echo CHtml::link($question->title, array('questions/read', 'id' => $question->id, 'title' => $question->title)) ?>
  <br/>

<?php endforeach; ?>