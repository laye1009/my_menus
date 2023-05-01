<?php

namespace Tests\Unit\Controller;

use App\Repository\CustomersRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class LoginControllerTest extends WebTestCase

{
    public function setUp():void
    {
        $this->client = static::createClient();
    }

    public function testLogin()
    {
        $userRepository = static::$container->get(CustomersRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'michelle@gmail.com']);
        $this->client->loginUser($testUser);

        // user is now logged in, so you can test protected resources
        $this->client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('button', 'login');
    }
}