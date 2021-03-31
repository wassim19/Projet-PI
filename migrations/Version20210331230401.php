<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331230401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(255) NOT NULL, date_at DATETIME NOT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, localitation VARCHAR(255) NOT NULL, id_societe INT NOT NULL, viewed INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eventlikes (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, event_id INT DEFAULT NULL, INDEX IDX_B2472CDA76ED395 (user_id), INDEX IDX_B2472CD71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, date_at DATETIME NOT NULL, title VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, id_soc INT NOT NULL, imagef VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notif_event (id INT AUTO_INCREMENT NOT NULL, notif VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notif_offre (id INT AUTO_INCREMENT NOT NULL, notifoffre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notificationf (id INT AUTO_INCREMENT NOT NULL, notif VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notificationrdv (id INT AUTO_INCREMENT NOT NULL, notification VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, typecategorie_id INT DEFAULT NULL, specialite VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, nb_dem INT NOT NULL, description VARCHAR(255) NOT NULL, imagesoffre VARCHAR(255) NOT NULL, INDEX IDX_AF86866FA9518242 (typecategorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_employe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant_e (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant_f (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation_e (id INT AUTO_INCREMENT NOT NULL, id_participant INT NOT NULL, id_evenement INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation_f (id INT AUTO_INCREMENT NOT NULL, id_formation INT NOT NULL, id_participant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, motif VARCHAR(255) NOT NULL, gsm VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, status TINYINT(1) DEFAULT NULL, INDEX IDX_CE606404979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, mail_id INT DEFAULT NULL, date DATETIME NOT NULL, meet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_65E8AA0AC8776F01 (mail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE surfer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(240) DEFAULT NULL, first_name VARCHAR(240) DEFAULT NULL, cin INT DEFAULT NULL, emailadress VARCHAR(240) DEFAULT NULL, password VARCHAR(240) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, mail_id INT DEFAULT NULL, INDEX IDX_D87F7E0CC8776F01 (mail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_reclamation (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_reseacher (id INT AUTO_INCREMENT NOT NULL, name_reseacher VARCHAR(240) DEFAULT NULL, first_name_reseacher VARCHAR(240) DEFAULT NULL, cin INT DEFAULT NULL, date_of_birth DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eventlikes ADD CONSTRAINT FK_B2472CDA76ED395 FOREIGN KEY (user_id) REFERENCES participant_e (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eventlikes ADD CONSTRAINT FK_B2472CD71F7E88B FOREIGN KEY (event_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FA9518242 FOREIGN KEY (typecategorie_id) REFERENCES categorie_offre (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AC8776F01 FOREIGN KEY (mail_id) REFERENCES surfer (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CC8776F01 FOREIGN KEY (mail_id) REFERENCES surfer (id)');
        $this->addSql('DROP TABLE notifuser');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE correctiontest ADD CONSTRAINT FK_243419BDC8776F01 FOREIGN KEY (mail_id) REFERENCES surfer (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92FC2A98F7 FOREIGN KEY (categoryType_id) REFERENCES cv_tech (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eventlikes DROP FOREIGN KEY FK_B2472CD71F7E88B');
        $this->addSql('ALTER TABLE eventlikes DROP FOREIGN KEY FK_B2472CDA76ED395');
        $this->addSql('ALTER TABLE correctiontest DROP FOREIGN KEY FK_243419BDC8776F01');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AC8776F01');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CC8776F01');
        $this->addSql('CREATE TABLE notifuser (id INT AUTO_INCREMENT NOT NULL, notif VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, hashed_token VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE eventlikes');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE notif_event');
        $this->addSql('DROP TABLE notif_offre');
        $this->addSql('DROP TABLE notificationf');
        $this->addSql('DROP TABLE notificationrdv');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_employe');
        $this->addSql('DROP TABLE participant_e');
        $this->addSql('DROP TABLE participant_f');
        $this->addSql('DROP TABLE participation_e');
        $this->addSql('DROP TABLE participation_f');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE surfer');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE type_reclamation');
        $this->addSql('DROP TABLE work_reseacher');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92FC2A98F7');
    }
}
