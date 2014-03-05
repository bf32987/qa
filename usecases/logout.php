<?php
class LogoutUser extends PHPUnit_Extensions_SeleniumTestCase
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
    // User Page
    for ($second = 0; ; $second++) {
        if ($second >= 60) $this->fail("timeout");
        try {
            if ($this->isElementPresent("link=CrowdSurge")) break;
        } catch (Exception $e) {}
        sleep(1);
    }

    for ($second = 0; ; $second++) {
        if ($second >= 60) $this->fail("timeout");
        try {
            if ("Welcome qa@crowdsurge.com!" == $this->getText("css=h1.ng-binding")) break;
        } catch (Exception $e) {}
        sleep(1);
    }

    try {
        $this->assertTrue($this->isElementPresent("link=Logout"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
    // Logout
    $this->click("css=a@href:contains(Logout)");
    for ($second = 0; ; $second++) {
        if ($second >= 60) $this->fail("timeout");
        try {
            if ("Please sign in" == $this->getText("css=h2.form-signin-heading")) break;
        } catch (Exception $e) {}
        sleep(1);
    }

    try {
        $this->assertTrue($this->isChecked("css=input[type=\"checkbox\"]"));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
  }
}
?>