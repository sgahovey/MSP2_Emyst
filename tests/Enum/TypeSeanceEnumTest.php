<?php

namespace App\Tests\Enum;

use App\Enum\TypeSeanceEnum;
use PHPUnit\Framework\TestCase;

class TypeSeanceEnumTest extends TestCase
{
    public function testAllEnumCasesExist(): void
    {
        $expectedCases = [
            'FULL_BODY',
            'HAUT_DU_CORPS',
            'BAS_DU_CORPS',
            'CARDIO',
            'RENFORCEMENT',
            'STRETCHING',
            'HIIT',
            'ABDOS',
            'PLIOMETRIE',
        ];

        // Obtenir tous les cas de l'enum
        $actualCases = TypeSeanceEnum::cases();
        $actualCaseNames = array_map(fn($case) => $case->name, $actualCases);

        // Vérifier que tous les cas attendus existent
        foreach ($expectedCases as $caseName) {
            $this->assertContains(
                $caseName,
                $actualCaseNames,
                "Le cas {$caseName} devrait exister dans l'enum TypeSeanceEnum"
            );
        }

        // Vérifier qu'on a bien le bon nombre de cas
        $this->assertCount(count($expectedCases), $actualCases, 'Le nombre de cas devrait correspondre');
    }

    public function testEnumValues(): void
    {
        $this->assertSame('Full body', TypeSeanceEnum::FULL_BODY->value);
        $this->assertSame('Haut du corps', TypeSeanceEnum::HAUT_DU_CORPS->value);
        $this->assertSame('Bas du corps', TypeSeanceEnum::BAS_DU_CORPS->value);
        $this->assertSame('Cardio', TypeSeanceEnum::CARDIO->value);
        $this->assertSame('Renforcement', TypeSeanceEnum::RENFORCEMENT->value);
        $this->assertSame('Étirements', TypeSeanceEnum::STRETCHING->value);
        $this->assertSame('HIIT', TypeSeanceEnum::HIIT->value);
        $this->assertSame('Abdos', TypeSeanceEnum::ABDOS->value);
        $this->assertSame('Pliométrie', TypeSeanceEnum::PLIOMETRIE->value);
    }

    public function testEnumFromValue(): void
    {
        $this->assertSame(
            TypeSeanceEnum::FULL_BODY,
            TypeSeanceEnum::from('Full body')
        );
        
        $this->assertSame(
            TypeSeanceEnum::CARDIO,
            TypeSeanceEnum::from('Cardio')
        );
    }

    public function testEnumTryFromValue(): void
    {
        $this->assertSame(
            TypeSeanceEnum::HIIT,
            TypeSeanceEnum::tryFrom('HIIT')
        );
        
        $this->assertNull(
            TypeSeanceEnum::tryFrom('Valeur inexistante')
        );
    }
}

