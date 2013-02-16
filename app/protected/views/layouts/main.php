<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
  <script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
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

  <ul class="nav nav-tabs">
    <li class="active"><a href="#">Questions</a></li>
    <li><a href="#">Unanswered</a></li>
    <li class="pull-right"><a href="#">Ask Question</a></li>
  </ul>

  <?php echo $content; ?>

</div>
</body>
</html>

