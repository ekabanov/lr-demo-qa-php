<?php

/**
 * Change the following URL based on your server configuration
 * Make sure the URL ends with a slash so that we can use relative URLs in test cases
 */
define('TEST_BASE_URL','http://localhost/');

/**
 * The base class for functional test cases.
 * In this class, we set the base URL for the test application.
 * We also provide some common methods to be used by concrete test classes.
 */
class WebTestCase extends CTestCase
{

  public $baseUrl = TEST_BASE_URL;
  /**
   * @var WebDriverSession
   */
  protected $session;

  protected function setUp()
  {
    $web_driver = new WebDriver();
    $this->session = $web_driver->session('chrome');

  }

  protected function tearDown()
  {
    $this->session->close();
    unset($this->session);
    parent::tearDown();
  }
}
