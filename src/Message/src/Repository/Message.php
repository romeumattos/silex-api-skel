<?php
declare(strict_types = 1);

namespace Message\Repository;

use Doctrine\ORM\EntityRepository;
use Message\Entity\Message as MessageModel;

/**
 * Message Repository
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
final class Message extends EntityRepository implements MessageInterface
{
    /**
     * @inheritdoc
     */
    public function findById(int $id): MessageModel
    {
        $message = $this->findOneBy(
            [
                'id' => $id,
                'active' => true
            ]
        );

        if (null === $message) {
            $message = new MessageModel();
        }

        return $message;
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        $messages = $this->findBy(
            [
                'active' => true
            ]
        );

        return $messages;
    }
}
