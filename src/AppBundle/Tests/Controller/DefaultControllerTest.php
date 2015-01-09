<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertTrue($crawler->filter('html:contains("History")')->count() > 0);
    }

    public function testindex2()
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testIndexError()
    {
        $client = static::createClient();
        $client->request('GET', '/ua');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testPersonal()
    {
        $client = static::createClient();
        $client->request('GET', '/personal');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPersonalError()
    {
        $client = static::createClient();
        $client->request('GET', '/personal/ua');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testContact()
    {
        $client = static::createClient();
        $client->request('GET', '/contact');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testContactError()
    {
        $client = static::createClient();
        $client->request('GET', '/contact/ua/ua');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testServices()
    {
        $client = static::createClient();
        $client->request('GET', '/services');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testServicesError()
    {
        $client = static::createClient();
        $client->request('GET', '/services/ua');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
