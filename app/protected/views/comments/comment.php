<div>
<?php echo CHtml::encode($model->content) ?><br/>
Commented by <?php echo CHtml::link($model->user->fullName, array('profile/read', 'id' => $model->user->id, 'name' => $model->user->fullName)) ?>&nbsp;
<?php echo Yii::app()->format->timeago($model->created_at) ?>
<hr />
</div>