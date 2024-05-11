<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327073349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friend_list (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, friends_id INT NOT NULL, INDEX IDX_DEB224F8A76ED395 (user_id), INDEX IDX_DEB224F849CA8337 (friends_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE friend_list ADD CONSTRAINT FK_DEB224F8A76ED395 FOREIGN KEY (user_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE friend_list ADD CONSTRAINT FK_DEB224F849CA8337 FOREIGN KEY (friends_id) REFERENCES login (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE friend_list DROP FOREIGN KEY FK_DEB224F8A76ED395');
        $this->addSql('ALTER TABLE friend_list DROP FOREIGN KEY FK_DEB224F849CA8337');
        $this->addSql('DROP TABLE friend_list');
    }
}
