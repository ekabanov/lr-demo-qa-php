<?php

return array(
  'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
  'name' => 'My Web Application',
  'defaultController' => 'questions',

  'preload' => array('log'),

  'import' => array(
    'application.models.*',
    'application.components.*',
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
        'questions/<id:\d+>/<title>' => array('questions/read'),
        'questions/<id:\d+>/revise' => array('questions/edit'),
        'questions/<id:\d+>/answer/submit' => array('answers/submit'),
        'questions/<id:\d+>/answer/revise' => array('answers/revise'),

        'questions/<category:(all|unanswered)>' => array('questions/list'),
        '' => array('questions/list', 'defaultParams' => array('category' => 'all')),

        'login' => 'authentication/login',
        'logout' => 'authentication/logout',
        'fb-connect' => 'authentication/connect',

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
    'db' => array(
  'connectionString' => 'mysql:host=localhost;dbname=qa',
  'emulatePrepare' => true,
  'username' => 'root',
  'password' => '',
  'charset' => 'utf8',
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

  'params' => array(
  'fbAppId' => '486587731404052',
  'fbAppSecret' => '6869727b1e3728132bfda0448821f8e7',
),
);