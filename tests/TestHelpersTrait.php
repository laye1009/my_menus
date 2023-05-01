<?php


namespace App\Tests;


trait TestHelpersTrait
{
    public function getLoginForm($crawler, $username, $password) {
        $form = $crawler->selectButton('login')->form([
            "_username" => $username,
            "_password" => $password
        ]);
        return $form;
    }
}