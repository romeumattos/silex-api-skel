<?php
declare(strict_types = 1);

namespace Message\Tests\Repository;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Tests\OrmTestCase;
use Message\Entity\Message;

/**
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
class MessageTest extends OrmTestCase
{
    /**
     * @var Message
     */
    protected $obj;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Bootstrap
     */
    public function setUp()
    {
        parent::setUp();

        $reader = new AnnotationReader();
        $metadataDriver = new AnnotationDriver($reader, Message::class);

        $this->em = $this->_getTestEntityManager();
        $this->em->getConfiguration()->setMetadataDriverImpl($metadataDriver);

        $this->obj = $this->em->getRepository(Message::class);
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        $this->obj = null;

        parent::tearDown();
    }

    /**
     * @test
     * @covers \Message\Repository\Message::findAll
     */
    public function findAll()
    {
        $result = $this->obj->findAll();

        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     * @covers \Message\Repository\Message::findById
     */
    public function findById()
    {
        $result = $this->obj->findById(1);

        $this->assertTrue(is_object($result));
    }
}
