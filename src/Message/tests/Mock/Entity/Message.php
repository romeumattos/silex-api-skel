<?php
declare(strict_types = 1);

namespace Message\Tests\Mock\Entity;

use Message\Entity\MessageInterface;
use Mockery as m;

/**
 * Message Entity Mock
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
abstract class Message
{
    /**
     * @return m\MockInterface
     */
    public static function getMock()
    {
        $message = m::mock(MessageInterface::class);
        $message->shouldReceive('getId')->andReturn(1)->byDefault();
        $message->shouldReceive('setTitle')->andReturnNull()->byDefault();
        $message->shouldReceive('getTitle')->andReturn('Lorem ipsum')->byDefault();
        $message->shouldReceive('setText')->andReturnNull()->byDefault();
        $message->shouldReceive('getText')->andReturn('Message Text')->byDefault();

        return $message;
    }
}
