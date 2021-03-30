<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330123933 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, pro1_titre VARCHAR(255) NOT NULL, pro1_socie VARCHAR(255) NOT NULL, pro1_date_debut INT NOT NULL, pro1_date_fin INT NOT NULL, etabl VARCHAR(255) NOT NULL, etabl_type VARCHAR(255) NOT NULL, etab_date_debut INT NOT NULL, etab_date_fin INT NOT NULL, skill_pro1 VARCHAR(255) NOT NULL, skill_perso1 VARCHAR(255) NOT NULL, interest1 VARCHAR(255) NOT NULL, lang1 VARCHAR(255) NOT NULL, pro2_titre VARCHAR(255) NOT NULL, pro2_socie VARCHAR(255) NOT NULL, pro2_date_debut INT NOT NULL, pro2_date_fin INT NOT NULL, etabl2 VARCHAR(255) NOT NULL, etabl2_type VARCHAR(255) NOT NULL, etab2_date_debut INT NOT NULL, etab2_date_fin INT NOT NULL, skill_pro2 VARCHAR(255) NOT NULL, skill_perso2 VARCHAR(255) NOT NULL, interest2 VARCHAR(255) NOT NULL, lang2 VARCHAR(255) NOT NULL, pro3_titre VARCHAR(255) DEFAULT NULL, pro3_socie VARCHAR(255) DEFAULT NULL, pro3_date_debut INT DEFAULT NULL, pro3_date_fin INT DEFAULT NULL, etabl3 VARCHAR(255) DEFAULT NULL, etabl3_type VARCHAR(255) DEFAULT NULL, etab3_date_debut INT DEFAULT NULL, etab3_date_fin INT DEFAULT NULL, skill_pro3 VARCHAR(255) DEFAULT NULL, skill_perso3 VARCHAR(255) DEFAULT NULL, interest3 VARCHAR(255) DEFAULT NULL, lang3 VARCHAR(255) DEFAULT NULL, pro4_titre VARCHAR(255) DEFAULT NULL, pro4_socie VARCHAR(255) DEFAULT NULL, pro4_date_debut INT DEFAULT NULL, pro4_date_fin INT DEFAULT NULL, etabl4 VARCHAR(255) DEFAULT NULL, etabl4_type VARCHAR(255) DEFAULT NULL, etab4_date_debut INT DEFAULT NULL, etab4_date_fin INT DEFAULT NULL, skill_pro4 VARCHAR(255) DEFAULT NULL, skill_perso4 VARCHAR(255) DEFAULT NULL, interest4 VARCHAR(255) DEFAULT NULL, lang4 VARCHAR(255) DEFAULT NULL, skill_pro1_data VARCHAR(30) NOT NULL, skill_pro2_data VARCHAR(30) NOT NULL, skill_pro3_data VARCHAR(30) DEFAULT NULL, skill_pro4_data VARCHAR(30) DEFAULT NULL, skill_perso1_data VARCHAR(30) NOT NULL, skill_perso2_data VARCHAR(30) NOT NULL, skill_perso3_data VARCHAR(30) DEFAULT NULL, skill_perso4_data VARCHAR(30) DEFAULT NULL, lang1_data VARCHAR(30) NOT NULL, lang2_data VARCHAR(30) NOT NULL, lang3_data VARCHAR(30) DEFAULT NULL, lang4_data VARCHAR(30) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, categoryType_id INT DEFAULT NULL, INDEX IDX_B66FFE92FC2A98F7 (categoryType_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv_tech (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eventlikes (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, event_id INT DEFAULT NULL, INDEX IDX_B2472CDA76ED395 (user_id), INDEX IDX_B2472CD71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notif_offre (id INT AUTO_INCREMENT NOT NULL, notifoffre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92FC2A98F7 FOREIGN KEY (categoryType_id) REFERENCES cv_tech (id)');
        $this->addSql('ALTER TABLE eventlikes ADD CONSTRAINT FK_B2472CDA76ED395 FOREIGN KEY (user_id) REFERENCES participant_e (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eventlikes ADD CONSTRAINT FK_B2472CD71F7E88B FOREIGN KEY (event_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE correctiontest ADD mail_id INT DEFAULT NULL, DROP email, DROP chronometre');
        $this->addSql('ALTER TABLE correctiontest ADD CONSTRAINT FK_243419BDC8776F01 FOREIGN KEY (mail_id) REFERENCES surfer (id)');
        $this->addSql('CREATE INDEX IDX_243419BDC8776F01 ON correctiontest (mail_id)');
        $this->addSql('ALTER TABLE participant_e ADD age INT NOT NULL');
        $this->addSql('ALTER TABLE test DROP chronometre');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92FC2A98F7');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE cv_tech');
        $this->addSql('DROP TABLE eventlikes');
        $this->addSql('DROP TABLE notif_offre');
        $this->addSql('ALTER TABLE correctiontest DROP FOREIGN KEY FK_243419BDC8776F01');
        $this->addSql('DROP INDEX IDX_243419BDC8776F01 ON correctiontest');
        $this->addSql('ALTER TABLE correctiontest ADD email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD chronometre TIME DEFAULT NULL, DROP mail_id');
        $this->addSql('ALTER TABLE participant_e DROP age');
        $this->addSql('ALTER TABLE test ADD chronometre TIME NOT NULL');
    }
}
