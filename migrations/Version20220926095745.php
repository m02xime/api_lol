<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926095745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, account_id VARCHAR(255) NOT NULL, puuid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, profile_icon_id INT NOT NULL, revision_date INT NOT NULL, summoner_level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE champions (id INT AUTO_INCREMENT NOT NULL, id_name VARCHAR(255) NOT NULL, id_champ INT NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, blurb VARCHAR(255) NOT NULL, imagefull VARCHAR(255) NOT NULL, imagesprite VARCHAR(255) NOT NULL, sprite_x INT NOT NULL, sprite_y INT NOT NULL, sprite_h INT NOT NULL, sprite_w INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, plaintext VARCHAR(255) NOT NULL, imagefull VARCHAR(255) NOT NULL, imagesprite VARCHAR(255) NOT NULL, sprite_x INT NOT NULL, sprite_y INT NOT NULL, sprite_h INT NOT NULL, sprite_w INT NOT NULL, gold INT NOT NULL, stats LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_timeline (id INT AUTO_INCREMENT NOT NULL, id_match VARCHAR(255) NOT NULL, match_json LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matchs (id INT AUTO_INCREMENT NOT NULL, assists INT NOT NULL, champ_level INT NOT NULL, champion_id INT NOT NULL, champion_name VARCHAR(255) NOT NULL, deaths INT NOT NULL, item0 INT NOT NULL, item1 INT NOT NULL, item2 INT NOT NULL, item3 INT NOT NULL, item4 INT NOT NULL, item5 INT NOT NULL, item6 INT NOT NULL, kills INT NOT NULL, total_damage_dealt INT NOT NULL, profile_icon INT NOT NULL, summoner_id VARCHAR(255) NOT NULL, summoner_level INT NOT NULL, summoner_name VARCHAR(255) NOT NULL, time_played INT NOT NULL, win TINYINT(1) NOT NULL, gold_earned INT NOT NULL, baron_kills INT NOT NULL, dragon_kills INT NOT NULL, summoner1_id INT NOT NULL, summoner2_id INT NOT NULL, total_minions_killed INT NOT NULL, turret_lost INT NOT NULL, vision_wards_bought_in_game INT NOT NULL, id_match VARCHAR(255) NOT NULL, puuid VARCHAR(255) NOT NULL, game_mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE champions');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE match_timeline');
        $this->addSql('DROP TABLE matchs');
    }
}
