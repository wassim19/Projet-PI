<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304200145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participantf (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE participant_f');
        $this->addSql('ALTER TABLE company ADD localisation VARCHAR(240) DEFAULT NULL, ADD numero INT DEFAULT NULL');
        $this->addSql('ALTER TABLE correctiontest ADD chronometre TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD id_soc INT NOT NULL, ADD imagef VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offre ADD imagesoffre VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participant_f (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE participantf');
        $this->addSql('ALTER TABLE company DROP localisation, DROP numero');
        $this->addSql('ALTER TABLE correctiontest DROP chronometre');
        $this->addSql('ALTER TABLE formation DROP id_soc, DROP imagef');
        $this->addSql('ALTER TABLE offre DROP imagesoffre');
    }
}
