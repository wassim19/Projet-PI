<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302142805 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE correctiontest (id INT AUTO_INCREMENT NOT NULL, reponse_q1 VARCHAR(255) NOT NULL, reponse_q2 VARCHAR(255) NOT NULL, reponse_q3 VARCHAR(255) NOT NULL, reponse_q4 VARCHAR(255) NOT NULL, reponse_q5 VARCHAR(255) NOT NULL, reponse_q6 VARCHAR(255) NOT NULL, reponse_q7 VARCHAR(255) NOT NULL, reponse_q8 VARCHAR(255) NOT NULL, reponse_q9 VARCHAR(255) NOT NULL, reponse_q10 VARCHAR(255) NOT NULL, reponse_q11 VARCHAR(255) NOT NULL, reponse_q12 VARCHAR(255) NOT NULL, reponse_q13 VARCHAR(255) NOT NULL, reponse_q14 VARCHAR(255) NOT NULL, reponse_q15 VARCHAR(255) NOT NULL, reponse_q16 VARCHAR(255) NOT NULL, reponse_q17 VARCHAR(255) NOT NULL, reponse_q18 VARCHAR(255) NOT NULL, reponse_q19 VARCHAR(255) NOT NULL, reponse_q20 VARCHAR(255) NOT NULL, note VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participantf (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE test DROP test');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE correctiontest');
        $this->addSql('DROP TABLE participantf');
        $this->addSql('ALTER TABLE test ADD test VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
