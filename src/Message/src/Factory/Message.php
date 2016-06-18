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
     * @param string $title
     * @param string $text
     * @return MessageModel
     */
    public static function create(string $title, string $text): MessageModel
    {
        $message = new MessageModel();
        $message->setTitle($title);
        $message->setText($text);

        return $message;
    }

    /**
     * Update message object
     *
     * @param MessageModel $message
     * @param string $title
     * @param string $text
     * @return MessageModel
     */
    public static function update(MessageModel $message, string $title, string $text): MessageModel
    {
        $message->setTitle($title);
        $message->setText($text);

        return $message;
    }
}
