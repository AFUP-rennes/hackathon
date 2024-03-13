<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Entity\Category;
use App\Repository\CarteRepositoryInMemory;
use App\Repository\IngredientRepositoryInMemory;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('unitTest')]
final class CarteRepositoryTest extends TestCase
{
    public function testGetCarteAperoCategory(): void
    {
        // Arrange
        $ingredientRepository = new IngredientRepositoryInMemory();
        $repository = new CarteRepositoryInMemory($ingredientRepository);

        // Act
        $aperos = $repository->get(Category::Apero);

        // Assert
        self::assertCount(10, $aperos);
    }

    public function testGetCartePlatsCategory(): void
    {
        // Arrange
        $ingredientRepository = new IngredientRepositoryInMemory();
        $repository = new CarteRepositoryInMemory($ingredientRepository);

        // Act
        $plats = $repository->get(Category::Plats);

        // Assert
        self::assertCount(3, $plats);
    }
}
