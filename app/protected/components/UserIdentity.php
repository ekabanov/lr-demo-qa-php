<?php

class UserIdentity extends CUserIdentity
{
  private $_id;

  public function __construct($username, $password = '')
  {
    $this->_id = $username;
    $this->username = $username;
    $this->password = $password;
  }

  public function authenticate()
  {
    $record = User::model()->findByAttributes(array('email' => $this->username));
    if ($record === null) {
      $this->errorCode = self::ERROR_USERNAME_INVALID;
    } else if ($record->password !== crypt($this->password, $record->password)) {
      $this->errorCode = self::ERROR_PASSWORD_INVALID;
    } else {
      $this->errorCode = self::ERROR_NONE;
      $this->_id = $record->id;
    }
    return !$this->errorCode;
  }

  public function getId()
  {
    return $this->_id;
  }

  /**
   * Generate a random salt in the crypt(3) standard Blowfish format.
   *
   * @param int $cost Cost parameter from 4 to 31.
   *
   * @throws Exception on invalid cost parameter.
   * @return string A Blowfish hash salt for use in PHP's crypt()
   */
  public static function blowfishSalt($cost = 13)
  {
    if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
      throw new Exception("cost parameter must be between 4 and 31");
    }
    $rand = array();
    for ($i = 0; $i < 8; $i += 1) {
      $rand[] = pack('S', mt_rand(0, 0xffff));
    }
    $rand[] = substr(microtime(), 2, 6);
    $rand = sha1(implode('', $rand), true);
    $salt = '$2a$' . str_pad((int)$cost, 2, '0', STR_PAD_RIGHT) . '$';
    $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
    return $salt;
  }
}