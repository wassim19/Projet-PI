<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303095525 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name_company VARCHAR(240) DEFAULT NULL, description VARCHAR(240) NOT NULL, tax_registration_number INT DEFAULT NULL, localisation VARCHAR(240) DEFAULT NULL, numero INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participantf (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE surfer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(240) DEFAULT NULL, first_name VARCHAR(240) DEFAULT NULL, cin INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_reseacher (id INT AUTO_INCREMENT NOT NULL, name_reseacher VARCHAR(240) DEFAULT NULL, first_name_reseacher VARCHAR(240) DEFAULT NULL, cin INT DEFAULT NULL, date_of_birth DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE participant_f');
        $this->addSql('ALTER TABLE correctiontest ADD chronometre TIME DEFAULT NULL');
        $this->addSql('ALTER TABLE offre ADD typecategorie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user DROP namesociete, DROP matriculefiscale, DROP description, DROP nationalite, DROP adresse, DROP nomad, DROP prenomadd, DROP cin, DROP numtelad, DROP datead, DROP nomch, DROP prenomcher, DROP cincher, DROP ntelcher, DROP localisation, DROP adressecher');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participant_f (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE participantf');
        $this->addSql('DROP TABLE surfer');
        $this->addSql('DROP TABLE work_reseacher');
        $this->addSql('ALTER TABLE correctiontest DROP chronometre');
        $this->addSql('ALTER TABLE offre DROP typecategorie');
        $this->addSql('ALTER TABLE user ADD namesociete VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD matriculefiscale DOUBLE PRECISION NOT NULL, ADD description VARCHAR(240) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nationalite VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adresse VARCHAR(240) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD nomad VARCHAR(240) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenomadd VARCHAR(240) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD cin DOUBLE PRECISION NOT NULL, ADD numtelad INT NOT NULL, ADD datead DATE NOT NULL, ADD nomch VARCHAR(240) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenomcher VARCHAR(240) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD cincher INT NOT NULL, ADD ntelcher INT NOT NULL, ADD localisation VARCHAR(240) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD adressecher VARCHAR(240) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
