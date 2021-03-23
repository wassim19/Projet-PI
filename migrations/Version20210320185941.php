<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210320185941 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv ADD skill_pro1_data VARCHAR(30) NOT NULL, ADD skill_pro2_data VARCHAR(30) NOT NULL, ADD skill_pro3_data VARCHAR(30) DEFAULT NULL, ADD skill_pro4_data VARCHAR(30) DEFAULT NULL, ADD skill_perso1_data VARCHAR(30) NOT NULL, ADD skill_perso2_data VARCHAR(30) NOT NULL, ADD skill_perso3_data VARCHAR(30) DEFAULT NULL, ADD skill_perso4_data VARCHAR(30) DEFAULT NULL, ADD lang1_data VARCHAR(30) NOT NULL, ADD lang2_data VARCHAR(30) NOT NULL, ADD lang3_data VARCHAR(30) DEFAULT NULL, ADD lang4_data VARCHAR(30) DEFAULT NULL, ADD photo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv DROP skill_pro1_data, DROP skill_pro2_data, DROP skill_pro3_data, DROP skill_pro4_data, DROP skill_perso1_data, DROP skill_perso2_data, DROP skill_perso3_data, DROP skill_perso4_data, DROP lang1_data, DROP lang2_data, DROP lang3_data, DROP lang4_data, DROP photo');
    }
}
