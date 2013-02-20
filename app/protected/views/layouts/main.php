<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Rebel Answers</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl ?>/css/main.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="span12">

            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand" href="<?php echo Yii::app()->homeUrl ?>">Rebel Answers</a>

                    <?php echo CHtml::beginForm(array('questions/search'), 'GET', array('class' => 'navbar-search pull-left')) ?>
                        <input name="q" type="text" class="search-query span6" placeholder="Search">
                    <?php echo CHtml::endForm() ?>
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
                <li<?php echo $this->section == 'questions' ? ' class="active"' : '' ?>>
                    <?php echo CHtml::link('Questions', array('questions/list', 'category' => 'all')) ?>
                </li>
                <li<?php echo $this->section == 'unanswered' ? ' class="active"' : ''?>>
                    <?php echo CHtml::link('Unanswered', array('questions/list', 'category' => 'unanswered')) ?>
                </li>
                <li class="pull-right<?php echo $this->section == 'ask' ? ' active' : '' ?>">
                    <?php echo CHtml::link('Ask Question', array('questions/ask')) ?>
                </li>
            </ul>

			<div class="content">
				<?php echo $content; ?>
			</div>

        </div>
    </div>
</div>

</body>
</html>

