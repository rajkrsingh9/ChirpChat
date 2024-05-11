<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311075614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts ADD details_id INT NOT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFABB1A0722 FOREIGN KEY (details_id) REFERENCES login (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFABB1A0722 ON posts (details_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFABB1A0722');
        $this->addSql('DROP INDEX IDX_885DBAFABB1A0722 ON posts');
        $this->addSql('ALTER TABLE posts DROP details_id');
    }
}
