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
        $message->shouldReceive('setName')->andReturnNull()->byDefault();
        $message->shouldReceive('getName')->andReturn('Lorem ipsum')->byDefault();
        $message->shouldReceive('setEmail')->andReturnNull()->byDefault();
        $message->shouldReceive('getEmail')->andReturn('foo@bar.bar')->byDefault();

        return $message;
    }
}
