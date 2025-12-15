<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration initiale complète - Crée toutes les tables du schéma
 */
final class Version20251215053730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration initiale complète - Crée toutes les tables (user, exercice, objectif, seance, seance_exercice)';
    }

    public function up(Schema $schema): void
    {
        // Table user
        $this->addSql('CREATE TABLE user (
            id INT AUTO_INCREMENT NOT NULL,
            email VARCHAR(180) NOT NULL,
            name VARCHAR(255) NOT NULL,
            roles JSON NOT NULL,
            password VARCHAR(255) NOT NULL,
            taille DOUBLE PRECISION DEFAULT NULL,
            poids DOUBLE PRECISION DEFAULT NULL,
            date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Table exercice
        $this->addSql('CREATE TABLE exercice (
            id INT AUTO_INCREMENT NOT NULL,
            image_url VARCHAR(255) DEFAULT NULL,
            nom VARCHAR(255) NOT NULL,
            repetitions INT NOT NULL,
            charge INT DEFAULT NULL,
            duree TIME NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Table objectif (dépend de user)
        $this->addSql('CREATE TABLE objectif (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL,
            valeur_cible INT NOT NULL,
            date_limite DATETIME NOT NULL,
            type_objectif VARCHAR(255) NOT NULL,
            INDEX IDX_E2F86851A76ED395 (user_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Table seance (dépend de user)
        $this->addSql('CREATE TABLE seance (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL,
            date_entrainement DATETIME NOT NULL,
            type_seance VARCHAR(255) NOT NULL,
            duree TIME NOT NULL,
            INDEX IDX_3797162AA76ED395 (user_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Table seance_exercice (dépend de seance et exercice)
        $this->addSql('CREATE TABLE seance_exercice (
            id INT AUTO_INCREMENT NOT NULL,
            seances_id INT NOT NULL,
            exercices_id INT NOT NULL,
            ordre INT NOT NULL,
            repetitions INT NOT NULL,
            charge INT NOT NULL,
            duree TIME NOT NULL,
            INDEX IDX_8F3A5A1A8B3F3F7 (seances_id),
            INDEX IDX_8F3A5A1A8B3F3F8 (exercices_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Contraintes de clés étrangères
        $this->addSql('ALTER TABLE objectif ADD CONSTRAINT FK_E2F86851A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_3797162AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seance_exercice ADD CONSTRAINT FK_8F3A5A1A8B3F3F7 FOREIGN KEY (seances_id) REFERENCES seance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seance_exercice ADD CONSTRAINT FK_8F3A5A1A8B3F3F8 FOREIGN KEY (exercices_id) REFERENCES exercice (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // Suppression dans l'ordre inverse (dépendances d'abord)
        $this->addSql('ALTER TABLE seance_exercice DROP FOREIGN KEY FK_8F3A5A1A8B3F3F7');
        $this->addSql('ALTER TABLE seance_exercice DROP FOREIGN KEY FK_8F3A5A1A8B3F3F8');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_3797162AA76ED395');
        $this->addSql('ALTER TABLE objectif DROP FOREIGN KEY FK_E2F86851A76ED395');
        
        $this->addSql('DROP TABLE seance_exercice');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE objectif');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE user');
    }
}
