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
        $obj        = new stdClass();
        $obj->id    = 1;
        $obj->title = 'Message';
        $obj->text  = 'Message text';

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
        $obj        = new stdClass();
        $obj->id    = 'SS';
        $obj->title = '';
        $obj->text  = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec leo egestas, 
                      suscipit mauris a, vulputate nunc. Pellentesque id risus congue, lobortis tortor a, 
                      elementum justo. Proin placerat tellus tellus, in auctor metus hendrerit non. Mauris dictum arcu 
                      sit amet pellentesque mollis. Integer ut imperdiet dui. Donec efficitur at magna vel ornare. 
                      Quisque convallis egestas iaculis. ';

        return [
            [
                $obj
            ]
        ];
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \Message\Entity\Message::setTitle
     */
    public function setTitleReturnEmptyOnSuccess($obj)
    {
        $message = new Message();

        $result = $message->setTitle($obj->title);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @covers       \Message\Entity\Message::setTitle
     * @expectedException \InvalidArgumentException
     */
    public function setTitleThrowsExceptionWhenEmpty($obj)
    {
        $message = new Message();
        $message->setTitle($obj->title);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \Message\Entity\Message::getTitle
     */
    public function getTitleReturnTitleAttribute($obj)
    {
        $message = new Message();

        $this->modifyAttribute($message, 'title', $obj->title);

        $this->assertEquals($message->getTitle(), $obj->title);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \Message\Entity\Message::getText
     */
    public function getTextReturnTextAttribute($obj)
    {
        $message = new Message();

        $this->modifyAttribute($message, 'text', $obj->text);

        $this->assertEquals($message->getText(), $obj->text);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \Message\Entity\Message::setText
     */
    public function setTextReturnEmptyOnSuccess($obj)
    {
        $message = new Message();

        $result = $message->setText($obj->text);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @covers       \Message\Entity\Message::setText
     * @expectedException \InvalidArgumentException
     */
    public function setTextThrowsInvalidArgumentExceptoinWhenInvalid($obj)
    {
        $message = new Message();
        $message->setText($obj->text);
    }
}
