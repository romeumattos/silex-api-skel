<?php
declare(strict_types = 1);

namespace Message\Repository;

use Message\Entity\Message as MessageModel;

/**
 * Message Repository interface
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
interface MessageInterface
{
    /**
     * Get active message
     *
     * @param int $id
     * @return MessageModel
     */
    public function findById(int $id): MessageModel;

    /**
     * List all active messages
     *
     * @return array
     */
    public function findAll(): array;
}
