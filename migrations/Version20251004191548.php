<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251004191548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pickme (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE pickme_user (pickme_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(pickme_id, user_id), CONSTRAINT FK_F4F42FAAF5396DE5 FOREIGN KEY (pickme_id) REFERENCES pickme (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F4F42FAAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F4F42FAAF5396DE5 ON pickme_user (pickme_id)');
        $this->addSql('CREATE INDEX IDX_F4F42FAAA76ED395 ON pickme_user (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pickme');
        $this->addSql('DROP TABLE pickme_user');
    }
}
