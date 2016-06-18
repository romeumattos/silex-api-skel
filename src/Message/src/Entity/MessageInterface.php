<?php
declare(strict_types = 1);

namespace Message\Entity;

/**
 * Message Entity Interface
 *
 * @author Romeu Mattos <romeu.smattos@gmail.com>
 */
interface MessageInterface
{
    /**
     * Get the Id
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Get the Title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Set Title
     *
     * @param string $title
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setTitle(string $title);

    /**
     * Get the text
     *
     * @return string
     */
    public function getText(): string;

    /**
     * Set the text
     *
     * @param string $text
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setText(string $text);

    /**
     * Mark message as deleted
     *
     * @return bool
     */
    public function delete(): bool;
}
