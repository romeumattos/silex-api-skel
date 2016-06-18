<?php
declare(strict_types = 1);

namespace Message\Service;

use Message\Entity\Message as MessageModel;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Message Service
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
interface MessageInterface
{
    /**
     * Message Service Constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em);

    /**
     * @param  MessageModel $message
     * @return MessageModel
     */
    public function save(MessageModel $message): MessageModel;

    /**
     * @param  MessageModel $message
     * @return MessageModel
     */
    public function delete(MessageModel $message): MessageModel;

    /**
     * Find one by message id
     *
     * @param  int $id id
     * @return MessageModel
     */
    public function findByMessageId(int $id): MessageModel;

    /**
     * List all messages
     *
     * @return array
     */
    public function listAll(): array;

    /**
     * Create an message
     *
     * @param string $title
     * @param string $text
     * @return MessageModel
     */
    public function create(string $title, string $text): MessageModel;

    /**
     * Update an message
     *
     * @param MessageModel $message
     * @param string $title
     * @param string $text
     * @return MessageModel
     */
    public function update(MessageModel $message, string $title, string $text): MessageModel;
}
