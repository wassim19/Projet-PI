<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311112956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notif_event (id INT AUTO_INCREMENT NOT NULL, notif VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD viewed INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD company_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD status TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_CE606404979B1AD6 ON reclamation (company_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE notif_event');
        $this->addSql('ALTER TABLE evenement DROP viewed');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404979B1AD6');
        $this->addSql('DROP INDEX IDX_CE606404979B1AD6 ON reclamation');
        $this->addSql('ALTER TABLE reclamation DROP company_id, DROP created_at, DROP status');
    }
}
