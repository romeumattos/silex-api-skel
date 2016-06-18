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
     * Get the Name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set Name
     *
     * @param string $name
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setName(string $name);

    /**
     * Get the email
     *
     * @return string
     */
    public function getEmail(): string;

    /**
     * Set the email
     *
     * @param string $email
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setEmail(string $email);

    /**
     * Mark message as deleted
     *
     * @return bool
     */
    public function delete(): bool;
}
