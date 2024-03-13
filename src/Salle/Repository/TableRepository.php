<?php

namespace App\Salle\Repository;

use App\Salle\Entity\Table;

class TableRepository
{
    /**
     * @var array<Table>
     */
    private readonly array $tables;

    public function __construct()
    {
        $this->tables = [
            "A" => new Table("A", 2),
            "B" => new Table("B", 4),
            "C" => new Table("C", 6),
        ];
    }

    public function listTables(): array
    {
        return $this->tables;
    }
}
