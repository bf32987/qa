<?php
class UserLogin extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*googlechrome");
    $this->setBrowserUrl("http://crowdsurge.github.io/");
  }

  public function testMyTestCase()
  {
    $userEmail = "qa@crowdsurge.com";
    $userPass = "crowdsurge1";
    // Login Page
    $this->open("/qa-web-tests/#/");
    try {
        $this->assertEquals("http://crowdsurge.github.io/qa-web-tests/#/", $this->getLocation());
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    $this->verifyText("css=h2.form-signin-heading", "Please sign in");
    $this->type("//input[@type='email']", $userEmail);
    $this->type("//input[@type='password']", $userPass);
    $this->check("css=input[type=\"checkbox\"]");
    $this->click("//button[@type='submit']");
    $this->verifyText("css=h1.ng-binding", "Welcome qa@crowdsurge.com!");
  }
}
?>