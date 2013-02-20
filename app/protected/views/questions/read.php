<h3><?php echo $model->title ?></h3>
<div class="row question">
  <div class="span1 voting">
    <?php if (!Yii::app()->user->isGuest): ?>
      <span class="label vote-up<?php echo $model->hasUpvoted() ? ' label-success' : ''?>"><a
            href="<?php echo $this->createUrl('votes/voteQuestion', array('id' => $model->id, 'type' => 1)) ?>">+</a></span>
    <?php endif; ?>
    <span class="votes"><?php echo $model->votesCount ?></span>
    <?php if (!Yii::app()->user->isGuest): ?>
      <span class="label vote-down<?php echo $model->hasDownvoted() ? ' label-inverse' : ''?>"><a
            href="<?php echo $this->createUrl('votes/voteQuestion', array('id' => $model->id, 'type' => -1)) ?>">-</a></span>
    <?php endif; ?>
  </div>
  <div class="span11">
    <div class="question">
		<?php echo MarkdownScripts::encode($model->content) ?>
	</div>
	<div class="note">
		Asked by <?php echo $model->user->fullName ?>&nbsp;
		<?php echo Yii::app()->format->timeago($model->created_at) ?>
	</div>

    <?php if ($model->user_id == Yii::app()->user->id): ?>
      <?php echo CHtml::link('Revise', array('questions/revise', 'id' => $model->id)) ?>
    <?php endif; ?>
    <div class="comments">
      <?php foreach ($model->comments as $comment): ?>
        <?php $this->renderPartial('/comments/comment', array('model' => $comment)) ?>
      <?php endforeach; ?>
    </div>
    <div class="post-comment">
      <?php echo CHtml::link('add comment', array('comments/post', 'id' => $model->id, 'type' => Vote::TYPE_QUESTION), array('class' => 'add-comment')) ?>
    </div>
  </div>
</div>
<hr/>

<?php foreach ($model->getAnswers() as $a): ?>
  <div class="row answer">
    <div class="span1 voting">
      <?php if (!Yii::app()->user->isGuest): ?>
        <span class="label vote-up<?php echo $a->hasUpvoted() ? ' label-success' : ''?>"><a
              href="<?php echo $this->createUrl('votes/voteAnswer', array('id' => $a->id, 'type' => 1)) ?>">+</a></span>
      <?php endif; ?>
      <span class="votes"><?php echo $a->votesCount ?></span>
      <?php if (!Yii::app()->user->isGuest): ?>
        <span class="label vote-down<?php echo $a->hasDownvoted() ? ' label-inverse' : ''?>"><a
              href="<?php echo $this->createUrl('votes/voteAnswer', array('id' => $a->id, 'type' => -1)) ?>">-</a></span>
      <?php endif; ?>
    </div>
    <div class="span11">
		<div>
			<?php echo Markdown($a->content) ?>
		</div>
		<div class="note">
			Answered by <?php echo $a->user->fullName ?>&nbsp;
			<?php echo Yii::app()->format->timeago($a->created_at) ?>
		</div>

      <?php if ($model->user_id == Yii::app()->user->id && $model->answer_id != $a->id): ?>
        <?php echo CHtml::link('Accept as answer', array('questions/accept', 'id' => $a->id)) ?>
      <?php endif; ?>

      <?php if ($model->answer_id == $a->id): ?>
        <span class="label label-success">Accepted answer</span>
      <?php endif; ?>

      <?php if ($a->user_id == Yii::app()->user->id): ?>
        <?php echo CHtml::link('Revise', array('answers/revise', 'id' => $model->id)) ?>
      <?php endif; ?>
      <div class="comments">
        <?php foreach ($a->comments as $comment): ?>
          <?php $this->renderPartial('/comments/comment', array('model' => $comment)) ?>
        <?php endforeach; ?>
      </div>
      <div class="post-comment">
        <?php echo CHtml::link('add comment', array('comments/post', 'id' => $a->id, 'type' => Vote::TYPE_ANSWER), array('class' => 'add-comment')) ?>
      </div>
    </div>
  </div>
  <hr/>
<?php endforeach; ?>

<?php if (!$hasAnswered): ?>
<?php echo CHtml::beginForm(array('answers/submit', 'id' => $model->id), 'POST', array('class' => 'form form-horizontal')) ?>
<legend>Your answer</legend>

<?php echo CHtml::errorSummary($answer); ?>

<div class="control-group">
  <div class="controls">
    <div class="wmd-panel">
      <div id="wmd-button-bar"></div>
      <?php echo CHtml::activeTextArea($answer, 'content', array('class' => 'wmd-input input-xxlarge', 'id' => 'wmd-input', 'rows' => '15')) ?>
    </div>
  </div>
</div>
<div class="control-group">
  <div class="controls">
    <div id="wmd-preview" class="wmd-panel wmd-preview input-xxlarge"></div>
  </div>
</div>
<div class="control-group">
  <div class="controls">
    <button type="submit" class="btn">Post your answer</button>
  </div>
  <?php echo CHtml::endForm() ?>
  <?php $this->widget('MarkdownScripts') ?>
  <?php endif; ?>

  <script id="comment-template" type="text/template">
    <form class="comment-form">
      <textarea></textarea>
      <button type="submit" class="btn">Post comment</button>
    </form>
  </script>

