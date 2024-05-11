<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323065256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friend_request (id INT AUTO_INCREMENT NOT NULL, from_request_id INT NOT NULL, to_request_id INT NOT NULL, request_status INT NOT NULL, INDEX IDX_F284D9469DA7EA2 (from_request_id), INDEX IDX_F284D94654D5AD8 (to_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D9469DA7EA2 FOREIGN KEY (from_request_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE friend_request ADD CONSTRAINT FK_F284D94654D5AD8 FOREIGN KEY (to_request_id) REFERENCES login (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE friend_request DROP FOREIGN KEY FK_F284D9469DA7EA2');
        $this->addSql('ALTER TABLE friend_request DROP FOREIGN KEY FK_F284D94654D5AD8');
        $this->addSql('DROP TABLE friend_request');
    }
}
