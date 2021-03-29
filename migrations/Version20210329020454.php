<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329020454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eventlikes DROP FOREIGN KEY FK_B2472CD71F7E88B');
        $this->addSql('ALTER TABLE eventlikes DROP FOREIGN KEY FK_B2472CDA76ED395');
        $this->addSql('ALTER TABLE eventlikes ADD CONSTRAINT FK_B2472CD71F7E88B FOREIGN KEY (event_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eventlikes ADD CONSTRAINT FK_B2472CDA76ED395 FOREIGN KEY (user_id) REFERENCES participant_e (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eventlikes DROP FOREIGN KEY FK_B2472CDA76ED395');
        $this->addSql('ALTER TABLE eventlikes DROP FOREIGN KEY FK_B2472CD71F7E88B');
        $this->addSql('ALTER TABLE eventlikes ADD CONSTRAINT FK_B2472CDA76ED395 FOREIGN KEY (user_id) REFERENCES participant_e (id)');
        $this->addSql('ALTER TABLE eventlikes ADD CONSTRAINT FK_B2472CD71F7E88B FOREIGN KEY (event_id) REFERENCES evenement (id)');
    }
}
