<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602123226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE sentence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sentence (id INT NOT NULL, author_id INT NOT NULL, content VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9D664ED5F675F31B ON sentence (author_id)');
        $this->addSql('COMMENT ON COLUMN sentence.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE sentence ADD CONSTRAINT FK_9D664ED5F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE sentence_id_seq CASCADE');
        $this->addSql('ALTER TABLE sentence DROP CONSTRAINT FK_9D664ED5F675F31B');
        $this->addSql('DROP TABLE sentence');
    }
}
