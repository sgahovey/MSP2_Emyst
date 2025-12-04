<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251203105722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, image_url VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, repetitions INT NOT NULL, charge INT DEFAULT NULL, duree TIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE objectif (id INT AUTO_INCREMENT NOT NULL, valeur_cible INT NOT NULL, date_limite DATETIME NOT NULL, type_objectif VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, date_entrainement DATETIME NOT NULL, type_seance VARCHAR(255) NOT NULL, durée TIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE seance_exercice (id INT AUTO_INCREMENT NOT NULL, ordre INT NOT NULL, seances_id INT NOT NULL, exercices_id INT NOT NULL, INDEX IDX_8A3473510F09302 (seances_id), INDEX IDX_8A34735192C7251 (exercices_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE seance_exercice ADD CONSTRAINT FK_8A3473510F09302 FOREIGN KEY (seances_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE seance_exercice ADD CONSTRAINT FK_8A34735192C7251 FOREIGN KEY (exercices_id) REFERENCES exercice (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance_exercice DROP FOREIGN KEY FK_8A3473510F09302');
        $this->addSql('ALTER TABLE seance_exercice DROP FOREIGN KEY FK_8A34735192C7251');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE objectif');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE seance_exercice');
    }
}
