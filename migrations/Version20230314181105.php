<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314181105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AD1472936 FOREIGN KEY (login_comments_id) REFERENCES login (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AD1472936 ON comments (login_comments_id)');
        $this->addSql('ALTER TABLE posts ADD thums_up INT DEFAULT NULL, ADD thums_down INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AD1472936');
        $this->addSql('DROP INDEX IDX_5F9E962AD1472936 ON comments');
        $this->addSql('ALTER TABLE posts DROP thums_up, DROP thums_down');
    }
}
