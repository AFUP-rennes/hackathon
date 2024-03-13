<?php

namespace App\Salle\Service;

use App\Salle\Entity\Client;
use App\Salle\Entity\Table;
use App\Salle\Repository\TableRepository;

final readonly class TableService
{
    public function __construct(
        private TableRepository $tableRepository,
        private TableSorter $tableSorter,
    )
    {

    }

    public function findFreeTable(int $nbClients): ?Table
    {
        $tables = $this->tableRepository->listTables();
        $this->tableSorter->sort($tables);
        foreach ($tables as $table) {
            if ($table->canSeatClients($nbClients)) {
                return $table;
            }
        }
        return null;
    }

    /**
     * @param array<Client> $clients
     */
    public function seatPeople(Table $table, array $clients): void
    {
        $table->addClients($clients);
    }
}