<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315071946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE like_dislike ADD like_dislike_id INT NOT NULL');
        $this->addSql('ALTER TABLE like_dislike ADD CONSTRAINT FK_ADB6A68952FAE844 FOREIGN KEY (like_dislike_id) REFERENCES login (id)');
        $this->addSql('CREATE INDEX IDX_ADB6A68952FAE844 ON like_dislike (like_dislike_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE like_dislike DROP FOREIGN KEY FK_ADB6A68952FAE844');
        $this->addSql('DROP INDEX IDX_ADB6A68952FAE844 ON like_dislike');
        $this->addSql('ALTER TABLE like_dislike DROP like_dislike_id');
    }
}
