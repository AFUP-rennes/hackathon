<?php

declare(strict_types=1);

namespace App\Salle\Command;

use App\Common\Container;
use App\Salle\Entity\Client;
use App\Salle\Service\TableService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\SingleCommandApplication;

#[AsCommand(name: 'accueil')]
final class WelcomeCommand extends SingleCommandApplication
{

    private Container $container;
    public function __construct()
    {
        $this->container = new Container();
        parent::__construct('accueil');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Bonjour, bienvenue chez `Pufa Senner`');

        $helper = $this->getHelper('question');
        $question = new Question("Combien êtes-vous ?\n");
        $nbClients = (int) $helper->ask($input, $output, $question);
        $tableService = $this->container->get(TableService::class);

        $table = $tableService->findFreeTable($nbClients);

        if (is_null($table)) {
            $output->writeln("Il n'y a pas de tables disponibles malheureusement.");
            return self::FAILURE;
        }
        $output->writeln($nbClients . ' personnes, très bien suivez-moi vers la table ' . $table->getName());
        $clients = [];

        for ($i = 0; $i < $nbClients; $i++) {
            $clients[] = new Client($i);
        }

        $tableService->seatPeople($table, $clients);
        return self::SUCCESS;
    }
}
