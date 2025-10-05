<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251004200005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pickme ADD COLUMN updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__pickme AS SELECT id, name, description, profile_pic_name FROM pickme');
        $this->addSql('DROP TABLE pickme');
        $this->addSql('CREATE TABLE pickme (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, profile_pic_name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO pickme (id, name, description, profile_pic_name) SELECT id, name, description, profile_pic_name FROM __temp__pickme');
        $this->addSql('DROP TABLE __temp__pickme');
    }
}
