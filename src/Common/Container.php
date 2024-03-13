<?php

namespace App\Common;

use App\Salle\Repository\TableRepository;
use App\Salle\Service\TableService;
use App\Salle\Service\TableSorter;

final readonly class Container
{
    private array $services;

    public function __construct()
    {
        $tableSorter = new TableSorter();
        $tableRepository = new TableRepository();
        $tableService = new TableService(
            $tableRepository,
            $tableSorter
        );
        $this->services = [
            TableSorter::class => $tableSorter,
            TableRepository::class => $tableRepository,
            TableService::class => $tableService,
        ];
    }

    /**
     * @template T
     * @param class-string<T> $name
     * @return T
     */
    public function get(string $name): mixed
    {
        return $this->services[$name] ?? throw new \RuntimeException(sprintf('Cannot find service "%s".', $name));
    }
}