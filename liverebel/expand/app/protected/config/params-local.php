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
  'mail' => array(
    'transportOptions' => array(
      'host' => '$LR{mail.host}',
      'username' => '$LR{mail.username}',
      'password' => '$LR{mail.password}',
      'port' => '$LR{mail.port}',
      'encryption' => '$LR{mail.encryption}'
    )
  ),
  'params' => array(
    'fbAppId' => '$LR{fb.appId}',
    'fbAppSecret' => '$LR{fb.appSecret}',
  ),
);