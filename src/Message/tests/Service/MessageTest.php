<?php
declare(strict_types = 1);

namespace Message\Tests\Service;

use Common\ChangeProtectedAttribute;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Tests\OrmTestCase;
use Message\Entity\Message;
use Message\Entity\MessageInterface;
use Message\Service\Message as MessageService;
use Message\Tests\Mock\Repository\Message as CreateMessageRepositoryMock;

/**
 * Message service test case.
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
class MessageTest extends OrmTestCase
{
    use ChangeProtectedAttribute;

    /**
     * @var MessageService
     */
    private $obj;

    /**
     * Boot
     */
    public function setUp()
    {
        parent::setUp();

        $reader = new AnnotationReader();
        $metadataDriver = new AnnotationDriver($reader, Message::class);

        $em = $this->_getTestEntityManager();
        $em->getConfiguration()->setMetadataDriverImpl($metadataDriver);

        $this->obj = new MessageService($em);

        $this->modifyAttribute($this->obj, 'messages', CreateMessageRepositoryMock::getMock());
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
     * @covers \Message\Service\Message::save()
     */
    public function saveMustBeReturnSameObject()
    {
        $messageModel = new Message();

        $result = $this->obj->save($messageModel);

        $this->assertSame($messageModel, $result);
    }

    /**
     * @test
     * @covers \Message\Service\Message::delete()
     */
    public function deleteMustBeReturnSameObject()
    {
        $messageModel = new Message();

        $result = $this->obj->delete($messageModel);

        $this->assertSame($messageModel, $result);
    }

    /**
     * @test
     * @covers \Message\Service\Message::findByMessageId()
     */
    public function findByMessageIdMustBeReturnMessageInterface()
    {
        $result = $this->obj->findByMessageId(1);

        $this->assertInstanceOf(MessageInterface::class, $result);
    }

    /**
     * @test
     * @covers \Message\Service\Message::listAll()
     */
    public function listAllMustBeReturnArray()
    {
        $result = $this->obj->listAll();

        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     */
    public function updateMustBeReturnSameObject()
    {
        $message = new Message();

        $result = $this->obj->update($message, 'foo', 'foo@bar.bar');

        $this->assertInstanceOf(MessageInterface::class, $result);
    }

    /**
     * @test
     */
    public function createMustBeReturnMessageObject()
    {
        $result = $this->obj->create('Foo', 'foo@foo.net');

        $this->assertInstanceOf(MessageInterface::class, $result);
    }
}
