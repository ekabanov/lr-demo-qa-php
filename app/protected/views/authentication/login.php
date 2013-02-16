<div class="row">
  <div class="span4">
    <?php echo CHtml::beginForm(); ?>
    <fieldset>
      <legend>Log in</legend>
      <p>Please log in to continue.</p>

      <?php echo CHtml::errorSummary($form); ?>

      <?php echo CHtml::activeLabel($form, 'email'); ?>
      <?php echo CHtml::activeTextField($form, 'email') ?>

      <?php echo CHtml::activeLabel($form, 'password'); ?>
      <?php echo CHtml::activePasswordField($form, 'password') ?>

      <label class="checkbox" for="LoginForm_rememberMe">
        <?php echo CHtml::activeCheckBox($form, 'rememberMe'); ?> Remember me
      </label>

      <button type="submit" class="btn">Log me in!</button>
    </fieldset>
    <?php echo CHtml::endForm(); ?>
  </div>
  <div class="span4">
    <?php echo CHtml::beginForm(); ?>
    <fieldset>
      <legend>New to Rebel Answers?</legend>
      <p>A Rebel Answers account is required to continue.</p>

      <?php echo CHtml::errorSummary($model); ?>

      <?php echo CHtml::activeLabel($model, 'name'); ?>
      <?php echo CHtml::activeTextField($model, 'name'); ?>

      <?php echo CHtml::activeLabel($model, 'email'); ?>
      <?php echo CHtml::activeTextField($model, 'email'); ?>


      <?php echo CHtml::activeLabel($model, 'password'); ?>
      <?php echo CHtml::activePasswordField($model, 'password'); ?>

      <?php echo CHtml::label('Re-enter password', 'verifyPassword') ?>
      <?php echo CHtml::passwordfield('verifyPassword') ?> <br/>

      <button type="submit" class="btn">Sign me up!</button>

    </fieldset>
    <?php echo CHtml::endForm(); ?>
  </div>
  <div class="span4">
    <form>
      <fieldset>
        <legend>Log in with Facebook</legend>
        <p>It's fast and easy.</p>

        <a id="fb-connect" href="#">Log in with Facebook</a>
      </fieldset>
    </form>
  </div>
</div>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function () {
    FB.init({
      appId: '<?php echo Yii::app()->params['fbAppId'] ?>',
      cookie: true,
      xfbml: true,
      oauth: true
    });
    $('#fb-connect').on('click', function () {
      FB.login(function (response) {
        if (response.authResponse)
          document.location.href = '<?php echo Yii::app()->createUrl('authentication/connect') ?>';
      });
      return false;
    });
  };
  (function () {
    var e = document.createElement('script');
    e.async = true;
    e.src = document.location.protocol +
        '//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);
  }());
</script>

