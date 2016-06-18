<?php
declare(strict_types = 1);

namespace Message\Tests\Mock\Repository;

use Message\Repository\MessageInterface;
use Message\Entity\Message as MessageModel;
use Mockery as m;

/**
 * Message Repository Mock
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
        $messageModel = new MessageModel();
        
        $message = m::mock(MessageInterface::class);
        $message->shouldReceive('findById')->andReturn($messageModel)->byDefault();
        $message->shouldReceive('findAll')->andReturn([$messageModel])->byDefault();

        return $message;
    }
}
