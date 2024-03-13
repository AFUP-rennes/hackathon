<?php

declare(strict_types=1);

namespace App\Salle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\SingleCommandApplication;

#[AsCommand(name: 'accueil')]
final class WelcomeCommand extends SingleCommandApplication
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Bonjour, bienvenue chez `Pufa Senner`');

        $helper = $this->getHelper('question');
        $question = new Question("Combien êtes-vous ?\n");
        $nbPersonnes = $helper->ask($input, $output, $question);

        $output->writeln($nbPersonnes.' personnes, très bien suivez-moi vers la table B');

        return self::SUCCESS;
    }
}
