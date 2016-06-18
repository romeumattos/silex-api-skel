<?php
declare(strict_types = 1);

namespace Message\Tests\Controller;

use Common\Response as View;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\ORM\Tools\SchemaTool;
use Silex\WebTestCase;

/**
 * Message Controller Test Case
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
class MessageTest extends WebTestCase
{
    /**
     * @var \Silex\Application
     */
    protected static $application;

    /**
     * @var array
     */
    protected $header = [
        'HTTP_Content-type' => 'application/json'
    ];

    /**
     * Class Bootstrap
     *
     * Load fixtures before controllers tests
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        if (!empty(self::$application) && self::$application['doctrine_orm.em']->isOpen()) {
            return self::$application;
        }

        $app = include __DIR__ . '/../../../../bootstrap.php';

        /* @var $metadata array */
        $metadata = $app['doctrine_orm.em']->getMetadataFactory()->getAllMetadata();

        /* @var $tool SchemaTool */
        $tool = new SchemaTool($app['doctrine_orm.em']);
        $tool->createSchema($metadata);

        /* @var $loader Loader */
        $loader = new Loader();
        $loader->loadFromDirectory(__DIR__ . '/../../../../fixtures');

        /* @var $executor ORMExecutor */
        $executor = new ORMExecutor($app['doctrine_orm.em']);
        $executor->execute($loader->getFixtures(), true);

        $app['logger']->addDebug('Fixtures loaded to ' . static::class);

        self::$application = $app;
    }

    /**
     * Test bootstrap
     *
     * @return \Silex\Application
     */
    public function createApplication()
    {
        return $this->app = self::$application;
    }

    /**
     * Data Provider
     *
     * @return array
     */
    public function validObjects()
    {
        return [
            [
                [
                    "title" => "Fooo Bar bar",
                    "text" => "message_test_one@messages.net"
                ]
            ]
        ];
    }

    /**
     * Data Provider
     *
     * @return multitype:multitype:multitype:string
     */
    public function validMessageIds()
    {
        return
            [
                [
                    1
                ]
            ];
    }

    /**
     * @test
     */
    public function getWithoutHeader()
    {
        /* @var $client \Symfony\Component\HttpKernel\Client */
        $client = $this->createClient();

        /* @var $crawler \Symfony\Component\DomCrawler\Crawler */
        $crawler = $client->request('GET', '/message/');

        /* @var $response \Symfony\Component\HttpFoundation\Response */
        $response = $client->getResponse();

        /* @var $content string */
        $content = $response->getContent();

        /* @var $object \stdClass */
        $object = json_decode($content);

        $this->assertJson($content);
        $this->assertEquals(View::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(View::HTTP_OK, $object->code);
        $this->assertTrue(is_array($object->data));
    }

    /**
     * @test
     */
    public function getWithHeader()
    {
        /* @var $client \Symfony\Component\HttpKernel\Client */
        $client = $this->createClient();

        /* @var $crawler \Symfony\Component\DomCrawler\Crawler */
        $crawler = $client->request('GET', '/message/', [], [], $this->header);

        /* @var $response \Symfony\Component\HttpFoundation\Response */
        $response = $client->getResponse();

        /* @var $content string */
        $content = $response->getContent();

        /* @var $object \stdClass */
        $object = json_decode($content);

        $this->assertJson($content);
        $this->assertEquals(View::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(View::HTTP_OK, $object->code);
        $this->assertTrue(is_array($object->data));
    }

    /**
     * @test
     * @dataProvider validMessageIds
     */
    public function getWithMessageIdWithoutHeader($id)
    {
        /* @var $client \Symfony\Component\HttpKernel\Client */
        $client = $this->createClient();

        /* @var $crawler \Symfony\Component\DomCrawler\Crawler */
        $crawler = $client->request('GET', '/message/' . $id);

        /* @var $response \Symfony\Component\HttpFoundation\Response */
        $response = $client->getResponse();

        /* @var $content string */
        $content = $response->getContent();

        /* @var $object \stdClass */
        $object = json_decode($content);

        $this->assertJson($content);
        $this->assertEquals(View::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(View::HTTP_OK, $object->code);
        $this->assertNotEmpty($object->data);
    }

    /**
     * @test
     * @dataProvider validObjects
     */
    public function postMessageWithHeader($object)
    {
        /* @var $client \Symfony\Component\HttpKernel\Client */
        $client = $this->createClient();

        /* @var $crawler \Symfony\Component\DomCrawler\Crawler */
        $crawler = $client->request('POST', '/message/', $object, [], $this->header);

        /* @var $response \Symfony\Component\HttpFoundation\Response */
        $response = $client->getResponse();

        /* @var $content string */
        $content = $response->getContent();

        /* @var $object \stdClass */
        $object = json_decode($content);

        $this->assertJson($content);
        $this->assertEquals(View::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals(View::HTTP_CREATED, $object->code);
        $this->assertNotEmpty($object->data);
    }
}
