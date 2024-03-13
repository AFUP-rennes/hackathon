<?php

namespace App\Salle\Service;

use App\Salle\Entity\Table;

class TableSorter
{
    /**
     * @param array<Table> $tables
     */
    public function sort(array $tables): void
    {
        usort($tables, static fn(Table $a, Table $b) => $a->getCapacity() <=> $b->getCapacity());
    }
}