<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301002630 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, namesociete VARCHAR(255) NOT NULL, matriculefiscale DOUBLE PRECISION NOT NULL, description VARCHAR(240) NOT NULL, nationalite VARCHAR(40) NOT NULL, adresse VARCHAR(240) NOT NULL, nomad VARCHAR(240) NOT NULL, prenomadd VARCHAR(240) NOT NULL, cin DOUBLE PRECISION NOT NULL, numtelad INT NOT NULL, datead DATE NOT NULL, nomch VARCHAR(240) NOT NULL, prenomcher VARCHAR(240) NOT NULL, cincher INT NOT NULL, ntelcher INT NOT NULL, localisation VARCHAR(240) NOT NULL, adressecher VARCHAR(240) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reclamation ADD gsm VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE reclamation DROP gsm');
    }
}
