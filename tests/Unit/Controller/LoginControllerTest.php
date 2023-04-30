<?php

namespace Tests\Unit\Controller;

use Symfony\Component\Panther\Client;
use App\Repository\CustomersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Panther\PantherTestCase;
#use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends PantherTestCase
{
    /*public function setUp():void
    {
        $this->client = static::createClient();

    }*/
    /*public function testLogin()
    {
        $userRepository = static::$container->get(CustomersRepository::class);
        $testUser = $userRepository->findOneBy(['email' => 'michelle@gmail.com']);

        $this->client->loginUser($testUser);

        // user is now logged in, so you can test protected resources
        $this->client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('button', 'login');
    }*/

    public function testIncorrectLogin() {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('login')->form([
            "_username" => "michelle@gmail.com",
            "_password" => "124"
        ]);
        $client->submit($form);
        $client->waitFor('.error',3);
        $this->assertSelectorTextContains('.error', 'Invalid credentials.');
    }
    public function testCorrectLogin() {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('login')->form([
            "_username" => "michelle@gmail.com",
            "_password" => "1234"
        ]);
        $client->submit($form);
        //$client->getWebDriver->followRedi
        $client->followRedirects(true);
        $this->assertSelectorTextContains('h1', 'Bienvenue Michelle Smith');
        $client->clickLink('"Voir nos produits"');
        $this->assertSelectorTextContains('h5','Menu Classic');
        //$link = $crawler->filter('a')->eq(0)->attr('href');
        /*$crawler = $client->followRedirects(true);
        $link = $crawler->selectLink("Voir nos produits")->link();
        $client->click($link);
        $this->assertSelectorTextContains('h5','Menu Classic'); */
    }
} 