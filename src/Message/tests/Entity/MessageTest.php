<?php
declare(strict_types = 1);

namespace Message\Tests\Entity;

use Common\ChangeProtectedAttribute;
use Message\Entity\Message;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * Message test case.
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
class MessageTest extends PHPUnit_Framework_TestCase
{
    use ChangeProtectedAttribute;

    /**
     * @return multitype:multitype:number
     */
    public function validObjects()
    {
        $obj = new stdClass();
        $obj->id = 1;
        $obj->name  = 'Teste';
        $obj->email = 'teste@teste.net';

        return [
            [
                $obj
            ]
        ];
    }

    /**
     * @return multitype:multitype:number
     */
    public function invalidObjects()
    {
        $obj = new stdClass();
        $obj->id = 'SS';
        $obj->name = '';
        $obj->email = 'lalala';

        return [
            [
                $obj
            ]
        ];
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \Message\Entity\Message::setName
     */
    public function setNameReturnEmptyOnSuccess($obj)
    {
        $message = new Message();

        $result = $message->setName($obj->name);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @covers       \Message\Entity\Message::setName
     * @expectedException \InvalidArgumentException
     */
    public function setNameThrowsExceptionWhenEmpty($obj)
    {
        $message = new Message();
        $message->setName($obj->name);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \Message\Entity\Message::getName
     */
    public function getNameReturnNameAttribute($obj)
    {
        $message = new Message();

        $this->modifyAttribute($message, 'name', $obj->name);

        $this->assertEquals($message->getName(), $obj->name);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \Message\Entity\Message::getEmail
     */
    public function getEmailReturnEmailAttribute($obj)
    {
        $message = new Message();

        $this->modifyAttribute($message, 'email', $obj->email);

        $this->assertEquals($message->getEmail(), $obj->email);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \Message\Entity\Message::setEmail
     */
    public function setEmailReturnEmptyOnSuccess($obj)
    {
        $message = new Message();

        $result = $message->setEmail($obj->email);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @covers       \Message\Entity\Message::setEmail
     * @expectedException \InvalidArgumentException
     */
    public function setEmailThrowsInvalidArgumentExceptoinWhenInvalid($obj)
    {
        $message = new Message();
        $message->setEmail($obj->email);
    }
}
