<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329183056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE9244454CB7');
        $this->addSql('DROP INDEX IDX_B66FFE9244454CB7 ON cv');
        $this->addSql('ALTER TABLE cv CHANGE categorytype categoryType_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92FC2A98F7 FOREIGN KEY (categoryType_id) REFERENCES cv_tech (id)');
        $this->addSql('CREATE INDEX IDX_B66FFE92FC2A98F7 ON cv (categoryType_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92FC2A98F7');
        $this->addSql('DROP INDEX IDX_B66FFE92FC2A98F7 ON cv');
        $this->addSql('ALTER TABLE cv CHANGE categorytype_id categoryType INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE9244454CB7 FOREIGN KEY (categoryType) REFERENCES cv_tech (id)');
        $this->addSql('CREATE INDEX IDX_B66FFE9244454CB7 ON cv (categoryType)');
    }
}
