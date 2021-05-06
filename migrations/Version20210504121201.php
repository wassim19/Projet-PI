<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504121201 extends AbstractMigration
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
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE booking');
        $this->addSql('ALTER TABLE correctiontest CHANGE reponse_q1 reponse_q1 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q2 reponse_q2 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q3 reponse_q3 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q4 reponse_q4 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q5 reponse_q5 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q6 reponse_q6 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q7 reponse_q7 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q8 reponse_q8 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q9 reponse_q9 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q10 reponse_q10 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q11 reponse_q11 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q12 reponse_q12 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q13 reponse_q13 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q14 reponse_q14 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q15 reponse_q15 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q16 reponse_q16 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q17 reponse_q17 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q18 reponse_q18 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q19 reponse_q19 VARCHAR(255) DEFAULT NULL, CHANGE reponse_q20 reponse_q20 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE date_at date_at DATETIME NOT NULL, CHANGE picture picture VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE participant_e DROP seat');
        $this->addSql('ALTER TABLE reclamation DROP status2, DROP companyName');
        $this->addSql('ALTER TABLE surfer CHANGE mail_id emailadress VARCHAR(240) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(240) DEFAULT NULL, CHANGE description description VARCHAR(240) DEFAULT NULL, CHANGE tax_registration_number tax_registration_number VARCHAR(240) DEFAULT NULL, CHANGE localisation localisation VARCHAR(240) DEFAULT NULL, CHANGE images images VARCHAR(240) DEFAULT NULL, CHANGE numero numero INT DEFAULT NULL, CHANGE emailadresse emailadresse VARCHAR(240) DEFAULT NULL, CHANGE role role VARCHAR(240) DEFAULT NULL, CHANGE name name VARCHAR(240) DEFAULT NULL, CHANGE password password VARCHAR(240) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, date DATE DEFAULT NULL, objet VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, contenu VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, id_event INT NOT NULL, A1 INT DEFAULT NULL, A2 INT DEFAULT NULL, A3 INT DEFAULT NULL, A4 INT DEFAULT NULL, A5 INT DEFAULT NULL, A6 INT DEFAULT NULL, B1 INT DEFAULT NULL, B2 INT DEFAULT NULL, B3 INT DEFAULT NULL, B4 INT DEFAULT NULL, B5 INT DEFAULT NULL, B6 INT DEFAULT NULL, C1 INT DEFAULT NULL, C2 INT DEFAULT NULL, C3 INT DEFAULT NULL, C4 INT DEFAULT NULL, C5 INT DEFAULT NULL, C6 INT DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('DROP TABLE cv_imported');
        $this->addSql('DROP TABLE notif_user');
        $this->addSql('DROP TABLE notificationrdv');
        $this->addSql('ALTER TABLE correctiontest CHANGE reponse_q1 reponse_q1 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q2 reponse_q2 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q3 reponse_q3 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q4 reponse_q4 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q5 reponse_q5 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q6 reponse_q6 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q7 reponse_q7 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q8 reponse_q8 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q9 reponse_q9 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q10 reponse_q10 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q11 reponse_q11 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q12 reponse_q12 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q13 reponse_q13 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q14 reponse_q14 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q15 reponse_q15 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q16 reponse_q16 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q17 reponse_q17 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q18 reponse_q18 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q19 reponse_q19 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reponse_q20 reponse_q20 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE evenement CHANGE picture picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_at date_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE participant_e ADD seat VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reclamation ADD status2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD companyName VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE surfer CHANGE emailadress mail_id VARCHAR(240) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tax_registration_number tax_registration_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE localisation localisation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE images images VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE numero numero VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE emailadresse emailadresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE role role VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
