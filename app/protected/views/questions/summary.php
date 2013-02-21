<div class="zebra row">
  <div class="span2 counters">
    <p class="text-center counter-answers">
      <?php echo $model->answersCount ?><br/>
      answer(s)
    </p>
    <p class="text-center counter-votes">
      <?php echo $model->votesCount ?><br/>
      vote(s)
    </p>
  </div>
  <div class="span10">
    <h2><?php echo CHtml::link($model->title, array('questions/read', 'id' => $model->id, 'title' => $model->title)) ?></h2>
    <?php if ($model->answer): ?>
    <span class="label label-success">Answered</span>
    <?php endif; ?>
	<div class="note">
		Asked by <?php echo CHtml::link($model->user->fullName, array('profile/read', 'id' => $model->user->id, 'name' => $model->user->fullName)) ?>&nbsp;
		<?php echo Yii::app()->format->timeago($model->created_at) ?>
	</div>
  </div>
</div>
