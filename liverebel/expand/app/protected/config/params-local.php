<?php

return array(
  'components' => array(
    'db' => array(
      'connectionString' => '$LR{db.url}',
      'emulatePrepare' => true,
      'username' => '$LR{db.username}',
      'password' => '$LR{db.password}',
      'charset' => 'utf8',
    ),
  ),

  'params' => array(
    'fbAppId' => '$LR{fb.appId}',
    'fbAppSecret' => '$LR{fb.appSecret}',
  ),
);