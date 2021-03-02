<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205232658 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file_object (id INT AUTO_INCREMENT NOT NULL, marker_id INT NOT NULL, file_name VARCHAR(255) NOT NULL, INDEX IDX_10BA8D53474460EB (marker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file_object ADD CONSTRAINT FK_10BA8D53474460EB FOREIGN KEY (marker_id) REFERENCES marker (id)');
        $this->addSql('ALTER TABLE marker DROP filename');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE file_object');
        $this->addSql('ALTER TABLE marker ADD filename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
