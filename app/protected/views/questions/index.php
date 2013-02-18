<div class="row">
  <ul class="nav nav-pills">
    <li class="nav-header">All Questions</li>
    <li><a href="#">newest</a></li>
    <li><a href="#">no answers</a></li>
  </ul>
</div>

<?php foreach ($models as $model): ?>
  <div class="row">
    <div class="span1">
      <p class="text-center">
        <?php echo $model->answersCount ?><br/>
        answer(s)
      </p>
    </div>
    <div class="span14">
      <a href="#"><?php echo $model->title ?></a><br/>
      <?php if ($model->answer): ?>
        <span class="label label-success">Answered</span>
      <?php endif; ?>
      Asked by <?php echo $model->user->fullName ?>
      <?php echo Yii::app()->format->timeago($model->created_at) ?>
    </div>
  </div>
<?php endforeach; ?>

<div class="pagination">
  <?php $this->widget('LinkPager', array(
    'pages' => $pages,
    'cssFile' => false,
    'header' => '',
    'selectedPageCssClass' => 'active'
  )) ?>
</div>