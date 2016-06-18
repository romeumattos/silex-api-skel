<?php
declare(strict_types = 1);

namespace Message\Service;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Message\Factory\Message as MessageFactory;
use Message\Entity\Message as MessageModel;
use Exception;
use InvalidArgumentException;

/**
 * Message Service
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
final class Message implements MessageInterface
{
    /**
     * @var \Message\Repository\MessageInterface
     */
    private $messages;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Message Service Constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em       = $em;
        $this->messages    = $em->getRepository(MessageModel::class);
    }

    /**
     * @inheritdoc
     */
    public function save(MessageModel $message): MessageModel
    {
        $this->em->beginTransaction();

        try {
            $this->em->persist($message);
            $this->em->flush();
            $this->em->commit();

            return $message;
        } catch (UniqueConstraintViolationException $ex) {
            $this->em->rollBack();

            throw new InvalidArgumentException('Title is already registered', 409, $ex);
        } catch (Exception $ex) {
            $this->em->rollBack();

            throw new InvalidArgumentException($ex->getMessage(), 500, $ex);
        }
    }

    /**
     * @inheritdoc
     */
    public function delete(MessageModel $message): MessageModel
    {
        $message->delete();

        $this->em->persist($message);
        $this->em->flush();

        return $message;
    }

    /**
     * @inheritdoc
     */
    public function findByMessageId(int $id): MessageModel
    {
        return $this->messages->findById($id);
    }

    /**
     * @inheritdoc
     */
    public function listAll(): array
    {
        $messages = $this->messages->findAll();

        return $messages;
    }

    /**
     * @inheritdoc
     */
    public function create(string $title, string $text): MessageModel
    {
        $message = MessageFactory::create($title, $text);

        return $this->save($message);
    }

    /**
     * @inheritdoc
     */
    public function update(MessageModel $message, string $title, string $text): MessageModel
    {
        /* @var $update \Message\Entity\Message */
        $update = MessageFactory::update($message, $title, $text);

        return $this->save($update);
    }
}
