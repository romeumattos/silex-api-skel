<?php
declare(strict_types = 1);

namespace Message\Entity;

use Doctrine\ORM\Mapping as ORM;
use Common\Entity;
use InvalidArgumentException;
use JMS\Serializer\Annotation as Serializer;
use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

/**
 * Message Entity
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="\Message\Repository\Message")
 * @ORM\HasLifecycleCallbacks
 */
class Message implements MessageInterface
{
    use Entity;

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Type("integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string", length=1024, nullable=false, unique=true)
     * @Serializer\Type("string")
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(name="text", type="string", length=255, nullable=false)
     * @Serializer\Type("string")
     * @var string
     */
    protected $text;

    /**
     * @ORM\Column(name="active", type="boolean", nullable=true)
     * @Serializer\Type("boolean")
     * @Serializer\Exclude
     * @var bool
     */
    protected $active;

    /**
     * @ORM\Column(name="created", type="datetime", nullable=false)
     * @Serializer\Type("DateTime")
     * @var DateTime
     */
    protected $created;

    /**
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     * @Serializer\Type("DateTime")
     * @var DateTime
     */
    protected $updated;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->active = true;
    }

    /**
     * @inheritDoc
     */
    public function getId(): int
    {
        return $this->id ?: 0;
    }

    /**
     * @inheritdoc
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function setTitle(string $title)
    {
        try {
            v::notEmpty()->assert($title);

            $this->title = $title;
        } catch (AllOfException $e) {
            throw new InvalidArgumentException('Title is invalid');
        }
    }

    /**
     * @inheritdoc
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @inheritdoc
     */
    public function setText(string $text)
    {
        try {
            v::stringType()->length(1,140)->assert($text);

            $this->text = $text;
        } catch (AllOfException $e) {
            throw new InvalidArgumentException('Text is invalid');
        }
    }

    /**
     * @inheritdoc
     */
    public function delete(): bool
    {
        $this->active = false;

        return true;
    }
}
