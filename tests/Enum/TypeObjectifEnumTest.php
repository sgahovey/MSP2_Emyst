<?php

namespace App\Tests\Enum;

use App\Enum\TypeObjectifEnum;
use PHPUnit\Framework\TestCase;

class TypeObjectifEnumTest extends TestCase
{
    public function testAllEnumCasesExist(): void
    {
        $expectedCases = [
            'PERTE_POIDS',
            'PRISE_MASSE',
            'SECHE',
            'AMELIORATION_CARDIO',
            'AUGMENTATION_FORCE',
            'ENDURANCE',
            'VITESSE',
            'FLEXIBILITE',
            'FREQUENCE_SEANCES',
            'COMPETITION',
            'RECORD_PERSONNEL',
        ];

        // Obtenir tous les cas de l'enum
        $actualCases = TypeObjectifEnum::cases();
        $actualCaseNames = array_map(fn($case) => $case->name, $actualCases);

        // Vérifier que tous les cas attendus existent
        foreach ($expectedCases as $caseName) {
            $this->assertContains(
                $caseName,
                $actualCaseNames,
                "Le cas {$caseName} devrait exister dans l'enum TypeObjectifEnum"
            );
        }

        // Vérifier qu'on a bien le bon nombre de cas
        $this->assertCount(count($expectedCases), $actualCases, 'Le nombre de cas devrait correspondre');
    }

    public function testEnumValues(): void
    {
        $this->assertSame('Perte de poids', TypeObjectifEnum::PERTE_POIDS->value);
        $this->assertSame('Prise de masse', TypeObjectifEnum::PRISE_MASSE->value);
        $this->assertSame('Sèche musculaire', TypeObjectifEnum::SECHE->value);
        $this->assertSame('Amélioration cardio-vasculaire', TypeObjectifEnum::AMELIORATION_CARDIO->value);
        $this->assertSame('Augmentation de la force', TypeObjectifEnum::AUGMENTATION_FORCE->value);
        $this->assertSame('Amélioration de l\'endurance', TypeObjectifEnum::ENDURANCE->value);
        $this->assertSame('Amélioration de la vitesse', TypeObjectifEnum::VITESSE->value);
        $this->assertSame('Amélioration de la flexibilité', TypeObjectifEnum::FLEXIBILITE->value);
        $this->assertSame('Augmentation de la fréquence des séances', TypeObjectifEnum::FREQUENCE_SEANCES->value);
        $this->assertSame('Préparation à une compétition', TypeObjectifEnum::COMPETITION->value);
        $this->assertSame('Battre un record personnel', TypeObjectifEnum::RECORD_PERSONNEL->value);
    }

    public function testEnumFromValue(): void
    {
        $this->assertSame(
            TypeObjectifEnum::PERTE_POIDS,
            TypeObjectifEnum::from('Perte de poids')
        );
        
        $this->assertSame(
            TypeObjectifEnum::AUGMENTATION_FORCE,
            TypeObjectifEnum::from('Augmentation de la force')
        );
    }

    public function testEnumTryFromValue(): void
    {
        $this->assertSame(
            TypeObjectifEnum::ENDURANCE,
            TypeObjectifEnum::tryFrom('Amélioration de l\'endurance')
        );
        
        $this->assertNull(
            TypeObjectifEnum::tryFrom('Valeur inexistante')
        );
    }
}

