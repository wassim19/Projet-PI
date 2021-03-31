<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330192023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cv_tech (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv ADD categoryType_id INT DEFAULT NULL, CHANGE pro1_date_debut pro1_date_debut INT NOT NULL, CHANGE pro1_date_fin pro1_date_fin INT NOT NULL, CHANGE etab_date_debut etab_date_debut INT NOT NULL, CHANGE etab_date_fin etab_date_fin INT NOT NULL, CHANGE pro2_date_debut pro2_date_debut INT NOT NULL, CHANGE pro2_date_fin pro2_date_fin INT NOT NULL, CHANGE etab2_date_debut etab2_date_debut INT NOT NULL, CHANGE etab2_date_fin etab2_date_fin INT NOT NULL, CHANGE pro3_date_debut pro3_date_debut INT DEFAULT NULL, CHANGE pro3_date_fin pro3_date_fin INT DEFAULT NULL, CHANGE etab3_date_debut etab3_date_debut INT DEFAULT NULL, CHANGE etab3_date_fin etab3_date_fin INT DEFAULT NULL, CHANGE pro4_date_debut pro4_date_debut INT DEFAULT NULL, CHANGE pro4_date_fin pro4_date_fin INT DEFAULT NULL, CHANGE etab4_date_debut etab4_date_debut INT DEFAULT NULL, CHANGE etab4_date_fin etab4_date_fin INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92FC2A98F7 FOREIGN KEY (categoryType_id) REFERENCES cv_tech (id)');
        $this->addSql('CREATE INDEX IDX_B66FFE92FC2A98F7 ON cv (categoryType_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92FC2A98F7');
        $this->addSql('DROP TABLE cv_tech');
        $this->addSql('DROP INDEX IDX_B66FFE92FC2A98F7 ON cv');
        $this->addSql('ALTER TABLE cv DROP categoryType_id, CHANGE pro1_date_debut pro1_date_debut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pro1_date_fin pro1_date_fin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etab_date_debut etab_date_debut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etab_date_fin etab_date_fin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pro2_date_debut pro2_date_debut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pro2_date_fin pro2_date_fin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etab2_date_debut etab2_date_debut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etab2_date_fin etab2_date_fin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pro3_date_debut pro3_date_debut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pro3_date_fin pro3_date_fin VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etab3_date_debut etab3_date_debut VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etab3_date_fin etab3_date_fin VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pro4_date_debut pro4_date_debut VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pro4_date_fin pro4_date_fin VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etab4_date_debut etab4_date_debut VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE etab4_date_fin etab4_date_fin VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
