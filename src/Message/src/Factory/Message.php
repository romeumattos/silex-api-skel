<?php
declare(strict_types = 1);

namespace Message\Factory;

use Message\Entity\Message as MessageModel;

/**
 * The Message Factory
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
abstract class Message
{
    /**
     * Create message object
     *
     * @param string $name
     * @param string $email
     * @return MessageModel
     */
    public static function create(string $name, string $email): MessageModel
    {
        $message = new MessageModel();
        $message->setName($name);
        $message->setEmail($email);

        return $message;
    }

    /**
     * Update message object
     *
     * @param MessageModel $message
     * @param string $name
     * @param string $email
     * @return MessageModel
     */
    public static function update(MessageModel $message, string $name, string $email): MessageModel
    {
        $message->setName($name);
        $message->setEmail($email);

        return $message;
    }
}
