<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Rebel Answers - <?php echo CHtml::encode($this->pageTitle); ?></title>
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
  <link href="<?php echo Yii::app()->baseUrl ?>/css/main.css" rel="stylesheet">
  <script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="navbar">
      <div class="navbar-inner">
        <a class="brand" href="<?php echo Yii::app()->homeUrl ?>">Rebel Answers</a>

        <form class="navbar-search pull-left">
          <input type="text" class="search-query span6" placeholder="Search">
        </form>
        <ul class="nav pull-right">
          <?php if (Yii::app()->user->isGuest): ?>
            <li><?php echo CHtml::link('Log in', array('authentication/login')) ?></li>
          <?php else: ?>
            <li class="disabled"><a><?php echo Yii::app()->user->fullName ?></a></li>
            <li><?php echo CHtml::link('Log out', array('authentication/logout')) ?></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    <ul class="nav nav-tabs">
      <li<?php echo $this->action->id != 'ask' && !isset($_GET['unanswered']) && $this->uniqueId == 'questions' ? ' class="active"' : '' ?>>
        <?php echo CHtml::link('Questions', array('questions/index')) ?>
      </li>
      <li<?php echo isset($_GET['unanswered']) && $this->uniqueId == 'questions' ? ' class="active"' : ''?>>
        <?php echo CHtml::link('Unanswered', '/questions/unanswered') ?>
      </li>
      <li class="pull-right<?php echo $this->action->id == 'ask' ? ' active' : '' ?>">
        <?php echo CHtml::link('Ask Question', array('questions/ask')) ?>
      </li>
    </ul>
  </div>

  <?php echo $content; ?>

</div>
</body>
</html>

