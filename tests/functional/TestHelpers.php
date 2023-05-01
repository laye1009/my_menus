<?php


namespace App\Tests\functional;


class TestHelpers
{
    public static function getLoginForm($crawler, $username, $password) {
        $form = $crawler->selectButton('login')->form([
            "_username" => $username,
            "_password" => $password
        ]);
        return $form;
    }
}