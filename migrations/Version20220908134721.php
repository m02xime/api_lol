<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220908134721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE champions (id INT AUTO_INCREMENT NOT NULL, id_name VARCHAR(255) NOT NULL, id_champ INT NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, blurb VARCHAR(255) NOT NULL, imagefull VARCHAR(255) NOT NULL, imagesprite VARCHAR(255) NOT NULL, sprite_x INT NOT NULL, sprite_y INT NOT NULL, sprite_h INT NOT NULL, sprite_w INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE champions');
    }
}
