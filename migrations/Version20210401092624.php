<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401092624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cv_imported (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notif_user (id INT AUTO_INCREMENT NOT NULL, notifuser VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notificationrdv (id INT AUTO_INCREMENT NOT NULL, notification VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE correctiontest CHANGE reponse_q1 reponse_q1 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q2 reponse_q2 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q3 reponse_q3 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q4 reponse_q4 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q5 reponse_q5 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q6 reponse_q6 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q7 reponse_q7 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q8 reponse_q8 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q9 reponse_q9 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q10 reponse_q10 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q11 reponse_q11 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q12 reponse_q12 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q13 reponse_q13 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q14 reponse_q14 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q15 reponse_q15 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q16 reponse_q16 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q17 reponse_q17 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q18 reponse_q18 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q19 reponse_q19 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q20 reponse_q20 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(240) DEFAULT NULL, ADD description VARCHAR(240) DEFAULT NULL, ADD tax_registration_number VARCHAR(240) DEFAULT NULL, ADD localisation VARCHAR(240) DEFAULT NULL, ADD images VARCHAR(240) DEFAULT NULL, ADD password VARCHAR(240) DEFAULT NULL, ADD numero INT DEFAULT NULL, ADD emailadresse VARCHAR(240) DEFAULT NULL, ADD first_name VARCHAR(255) DEFAULT NULL, ADD cin VARCHAR(255) DEFAULT NULL, ADD role VARCHAR(240) DEFAULT NULL, ADD name VARCHAR(240) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cv_imported');
        $this->addSql('DROP TABLE notif_user');
        $this->addSql('DROP TABLE notificationrdv');
        $this->addSql('ALTER TABLE correctiontest CHANGE reponse_q1 reponse_q1 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q2 reponse_q2 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q3 reponse_q3 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q4 reponse_q4 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q5 reponse_q5 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q6 reponse_q6 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q7 reponse_q7 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q8 reponse_q8 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q9 reponse_q9 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q10 reponse_q10 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q11 reponse_q11 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q12 reponse_q12 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q13 reponse_q13 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q14 reponse_q14 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q15 reponse_q15 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q16 reponse_q16 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q17 reponse_q17 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q18 reponse_q18 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q19 reponse_q19 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q20 reponse_q20 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user DROP username, DROP description, DROP tax_registration_number, DROP localisation, DROP images, DROP password, DROP numero, DROP emailadresse, DROP first_name, DROP cin, DROP role, DROP name');
    }
}
