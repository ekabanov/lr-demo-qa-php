<?php

class SiteTest extends WebTestCase
{
	public function testIndex()
	{
    $session = $this->session;
		$session->open($this->baseUrl);
    $title = $session->element("xpath", "//title")->text();
    $this->assertEquals($title, "Rebel Answers");
	}

}
