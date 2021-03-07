<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307225110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE participatiant_e');
        $this->addSql('DROP TABLE participation_e_evenement');
        $this->addSql('ALTER TABLE participation_e ADD id_participant INT NOT NULL, ADD id_evenement INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participatiant_e (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participation_e_evenement (participation_e_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_B5EBFBC768C87B46 (participation_e_id), INDEX IDX_B5EBFBC7FD02F13 (evenement_id), PRIMARY KEY(participation_e_id, evenement_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participation_e_evenement ADD CONSTRAINT FK_B5EBFBC768C87B46 FOREIGN KEY (participation_e_id) REFERENCES participation_e (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_e_evenement ADD CONSTRAINT FK_B5EBFBC7FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_e DROP id_participant, DROP id_evenement');
    }
}
