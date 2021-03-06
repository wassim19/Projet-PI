<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210306205215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offre_employe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant_f (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE participantf');
        $this->addSql('ALTER TABLE company ADD pass VARCHAR(300) DEFAULT NULL, ADD emailadresse VARCHAR(240) DEFAULT NULL');
        $this->addSql('ALTER TABLE correctiontest ADD chronometre TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD id_soc INT NOT NULL, ADD imagef VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offre ADD imagesoffre VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participantf (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE offre_employe');
        $this->addSql('DROP TABLE participant_f');
        $this->addSql('ALTER TABLE company DROP pass, DROP emailadresse');
        $this->addSql('ALTER TABLE correctiontest DROP chronometre');
        $this->addSql('ALTER TABLE formation DROP id_soc, DROP imagef');
        $this->addSql('ALTER TABLE offre DROP imagesoffre');
    }
}
