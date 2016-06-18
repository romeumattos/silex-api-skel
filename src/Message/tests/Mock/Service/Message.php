<?php
declare(strict_types = 1);

namespace Message\Tests\Mock\Service;

use Message\Service\MessageInterface;
use Mockery as m;

/**
 * Message Service Mock
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
        $message->shouldReceive('save')->andReturn(true)->byDefault();
        $message->shouldReceive('delete')->andReturn(true)->byDefault();
        $message->shouldReceive('update')->andReturn(true)->byDefault();
        $message->shouldReceive('findByMessageId')->andReturn(true)->byDefault();
        $message->shouldReceive('listAll')->andReturn(true)->byDefault();

        return $message;
    }
}
