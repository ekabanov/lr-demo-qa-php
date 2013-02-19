<div>
<?php echo CHtml::encode($model->content) ?><br/>
Commented by <?php echo $model->user->fullName ?>&nbsp;
<?php echo Yii::app()->format->timeago($model->created_at) ?>
<hr />
</div>