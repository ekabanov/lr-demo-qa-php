<?php

class AuthenticationController extends Controller
{

  public function actionLogin()
  {
    $model = new User;

    if (isset($_POST['User'])) {
      $model->attributes = $_POST['User'];

      if ($model->validate()) {
        $model->password = crypt($model->password, UserIdentity::blowfishSalt());
        $model->save(false);

        Yii::app()->user->login(new UserIdentity($model->id), 0);

        $this->redirect(Yii::app()->user->returnUrl);
      }

      $model->password = '';
    }

    $form = new LoginForm;

    if (isset($_POST['LoginForm'])) {
      $form->attributes = $_POST['LoginForm'];

      if ($form->validate()) {
        $form->login();
        $this->redirect(Yii::app()->user->returnUrl);
      }

      $form->password = '';
    }

    $this->render("login", array("model" => $model, "form" => $form));
  }

  public function actionConnect()
  {
    Yii::import('ext.facebook-php-sdk.*');

    $facebook = new Facebook(array(
      'appId' => Yii::app()->params['fbAppId'],
      'secret' => Yii::app()->params['fbAppSecret'],
    ));
    $user = $facebook->getUser();

    if (!$user)
      $this->redirect('login');

    try {
      $me = $facebook->api('/me');
      $model = User::model()->findByAttributes(array('facebook_id' => $me['id']));

      if (!$model) {
        $model = new User;
        $model->name = $me['name'];
        $model->facebook_id = $me['id'];
        $model->save(false);
      }

      Yii::app()->user->login(new UserIdentity($model->id), 0);
      $this->redirect(Yii::app()->user->returnUrl);

    } catch (FacebookApiException $e) {
    }
    $this->redirect('login');
  }

  public function actionLogout()
  {
    Yii::app()->user->logout();
    $this->redirect(Yii::app()->homeUrl);
  }

  public function actionPasswordRecovery()
  {
    $message = '';

    if (isset($_POST['email'])) {
      $user = User::model()->findByAttributes(array('email' => $_POST['email']));
      if ($user) {
        $message = new YiiMailMessage;
        $length = 10;
        $chars = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        shuffle($chars);
        $password = implode(array_slice($chars, 0, $length));
        $user->password = crypt($password, UserIdentity::blowfishSalt());
        $user->save(false);
        $message->setBody('Here is your new password: ' . $password, 'text/html');
        $message->subject = 'Password Reset';
        $message->addTo($_POST['email']);
        $message->from = "noreply@zeroturnaround.com";
        Yii::app()->mail->send($message);
        $this->render('recoverySent');
        return;
      }
      $message = 'User not registered with this e-mail.';
    }

    $this->render('recovery', array('message' => $message));
  }

  public function filters()
  {
    return array(
      'accessControl',
    );
  }

  public function accessRules()
  {
    return array(
      array('deny',
        'actions' => array('logout'),
        'users' => array('?'),
      ),
      array('deny',
        'actions' => array('connect', 'login'),
        'users' => array('@')
      ),
    );
  }

}
