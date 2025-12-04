<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251204094120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE seance_exercice DROP FOREIGN KEY `FK_8A3473510F09302`');
        $this->addSql('ALTER TABLE seance_exercice DROP FOREIGN KEY `FK_8A34735192C7251`');
        $this->addSql('DROP TABLE objectif');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE seance_exercice');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE objectif (id INT AUTO_INCREMENT NOT NULL, valeur_cible INT NOT NULL, date_limite DATETIME NOT NULL, type_objectif VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, date_entrainement DATETIME NOT NULL, type_seance VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, durée TIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE seance_exercice (id INT AUTO_INCREMENT NOT NULL, ordre INT NOT NULL, seances_id INT NOT NULL, exercices_id INT NOT NULL, INDEX IDX_8A3473510F09302 (seances_id), INDEX IDX_8A34735192C7251 (exercices_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE seance_exercice ADD CONSTRAINT `FK_8A3473510F09302` FOREIGN KEY (seances_id) REFERENCES seance (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE seance_exercice ADD CONSTRAINT `FK_8A34735192C7251` FOREIGN KEY (exercices_id) REFERENCES exercice (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE user');
    }
}
