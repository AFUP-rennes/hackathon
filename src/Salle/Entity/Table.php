<?php

namespace App\Salle\Entity;

final class Table
{
    /**
     * @var array<Client>
     */
    private array $clients;


    public function __construct(
        private readonly string $name,
        private readonly int $capacity,
    ){}

    public function isFree(): bool
    {
        return empty($this->clients);
    }

    public function countSeatedPersons(): int
    {
        return count($this->clients);
    }

    /**
     * @param array<Client> $clients
     */
    public function addClients(array $clients): void
    {
        if (!$this->isFree()) {
            throw new \LogicException("This table is already occupied.");
        }
        $this->clients = $clients;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function canSeatClients(int $nbClients): bool
    {
        return $this->getCapacity() >= $nbClients
            && $this->isFree();
    }
}
