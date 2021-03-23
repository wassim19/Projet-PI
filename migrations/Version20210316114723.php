<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316114723 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE correctiontest ADD mail_id INT DEFAULT NULL, DROP chronometre');
        $this->addSql('ALTER TABLE correctiontest ADD CONSTRAINT FK_243419BDC8776F01 FOREIGN KEY (mail_id) REFERENCES surfer (id)');
        $this->addSql('CREATE INDEX IDX_243419BDC8776F01 ON correctiontest (mail_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE correctiontest DROP FOREIGN KEY FK_243419BDC8776F01');
        $this->addSql('DROP INDEX IDX_243419BDC8776F01 ON correctiontest');
        $this->addSql('ALTER TABLE correctiontest ADD chronometre TIME DEFAULT NULL, DROP mail_id');
    }
}
