<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122160728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marker ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE marker ADD CONSTRAINT FK_82CF20FE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_82CF20FE7E3C61F9 ON marker (owner_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marker DROP FOREIGN KEY FK_82CF20FE7E3C61F9');
        $this->addSql('DROP INDEX IDX_82CF20FE7E3C61F9 ON marker');
        $this->addSql('ALTER TABLE marker DROP owner_id');
    }
}
