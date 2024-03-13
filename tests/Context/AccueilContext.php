<?php

declare(strict_types=1);

namespace Tests\Context;

use App\Salle\Command\WelcomeCommand;
use Behat\Behat\Context\Context;
use Symfony\Component\Console\Tester\CommandTester;
use function PHPUnit\Framework\assertStringContainsString;

final class AccueilContext implements Context
{
    public function __construct(
        private ?CommandTester $commandTester = null
    ) {
        $command = new WelcomeCommand();
        $command->setAutoExit(false);
        $this->commandTester = new CommandTester($command);
    }

    /**
     * @When un groupe de :nbPersonnes personnes rentre dans le restaurant
     */
    public function unGroupeRentreDansLeRestaurant(int $nbPersonnes): void
    {
        $this->commandTester->setInputs([$nbPersonnes]);
        $this->commandTester->execute([]);
    }

    /**
     * @Then le groupe de :nbPersonnes est placé à la table :table
     */
    public function leGroupeEstPlaceALaTable(int $nbPersonnes, string $table): void
    {
        $output = $this->commandTester->getDisplay();
        assertStringContainsString(
            sprintf(
                '%1$d personnes, très bien suivez-moi vers la table %2$s',
                $nbPersonnes,
                $table
            ),
            $output
        );
    }
}
