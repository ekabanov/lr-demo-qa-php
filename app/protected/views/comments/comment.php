<div>
	<div class="post">
		<?php echo CHtml::encode($model->content) ?>
	</div>
	<div class="note">
		Commented by <?php echo CHtml::link($model->user->fullName, array('profile/read', 'id' => $model->user->id, 'name' => $model->user->fullName)) ?>&nbsp;
		<?php echo Yii::app()->format->timeago($model->created_at) ?>
	</div>
</div>
<hr />