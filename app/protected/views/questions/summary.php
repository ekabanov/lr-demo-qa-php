<div class="row">
  <div class="span2">
    <p class="text-center">
      <?php echo $model->answersCount ?><br/>
      answer(s)
    </p>
    <p class="text-center">
      <?php echo $model->votesCount ?><br/>
      vote(s)
    </p>
  </div>
  <div class="span10">
    <h2><?php echo CHtml::link($model->title, array('questions/read', 'id' => $model->id, 'title' => $model->title)) ?></h2>
    <?php if ($model->answer): ?>
    <span class="label label-success">Answered</span>
    <?php endif; ?><br/>
    Asked by <?php echo CHtml::link($model->user->fullName, array('profile/read', 'id' => $model->user->id, 'name' => $model->user->fullName)) ?>&nbsp;
    <?php echo Yii::app()->format->timeago($model->created_at) ?>
  </div>
</div>