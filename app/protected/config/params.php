<?php

return array(
  'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
  'name' => 'My Web Application',
  'defaultController' => 'questions',

  'preload' => array('log'),

  'import' => array(
    'application.models.*',
    'application.components.*',
    'ext.mail.YiiMailMessage',
    'ext.php-webdriver.*'
  ),

  'components' => array(
    'user' => array(
      'allowAutoLogin' => true,
      'class' => 'WebUser',
      'loginUrl' => array('authentication/login'),
    ),
    'urlManager' => array(
      'urlFormat' => 'path',
      'showScriptName' => false,
      'rules' => array(
        'profile/<id:\d+>/<name>' => array('profile/read'),
        'profile/<id:\d+>/<name>/questions' => array('profile/questions'),
        'questions/<id:\d+>/vote' => array('votes/voteQuestion'),
        'questions/<id:\d+>/answer/vote' => array('votes/voteAnswer'),

        'questions/<id:\d+>/<title>' => array('questions/read'),
        'questions/<id:\d+>/revise' => array('questions/edit'),
        'questions/<id:\d+>/answer/submit' => array('answers/submit'),
        'questions/<id:\d+>/answer/revise' => array('answers/revise'),

        'questions/<category:(all|unanswered)>' => array('questions/list'),
        '' => array('questions/list', 'defaultParams' => array('category' => 'all')),

        'login' => 'authentication/login',
        'logout' => 'authentication/logout',
        'fb-connect' => 'authentication/connect',
        'password-recovery' => 'authentication/passwordRecovery',

        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
      ),
    ),
    'format' => array(
      'class' => 'application.extensions.timeago.TimeagoFormatter',
    ),
    'clientScript' => array(
      'scriptMap' => array(
        'jquery.js' => false,
        'jquery.min.js' => false
      )
    ),
    'mail' => array(
      'class' => 'ext.mail.YiiMail',
      'viewPath' => 'application.views.mail',
      'logging' => true,
      'dryRun' => false,
      'transportType' => 'smtp',
    ),
    'log' => array(
      'class' => 'CLogRouter',
      'routes' => array(
        array(
          'class' => 'CFileLogRoute',
          'levels' => 'error, warning',
        ),
      ),
    ),
  ),

);