<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124175314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_character (film_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_A7B6EE07567F5183 (film_id), INDEX IDX_A7B6EE071136BE75 (character_id), PRIMARY KEY(film_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE park_attractions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE park_attractions_character (park_attractions_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_88D841FC1B14C3BD (park_attractions_id), INDEX IDX_88D841FC1136BE75 (character_id), PRIMARY KEY(park_attractions_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_shows (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_shows_character (tv_shows_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_ABB05151BB9CED14 (tv_shows_id), INDEX IDX_ABB051511136BE75 (character_id), PRIMARY KEY(tv_shows_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_games (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_games_character (video_games_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_51229ABE3F7DF4CF (video_games_id), INDEX IDX_51229ABE1136BE75 (character_id), PRIMARY KEY(video_games_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_character ADD CONSTRAINT FK_A7B6EE07567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_character ADD CONSTRAINT FK_A7B6EE071136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE park_attractions_character ADD CONSTRAINT FK_88D841FC1B14C3BD FOREIGN KEY (park_attractions_id) REFERENCES park_attractions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE park_attractions_character ADD CONSTRAINT FK_88D841FC1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_shows_character ADD CONSTRAINT FK_ABB05151BB9CED14 FOREIGN KEY (tv_shows_id) REFERENCES tv_shows (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_shows_character ADD CONSTRAINT FK_ABB051511136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_games_character ADD CONSTRAINT FK_51229ABE3F7DF4CF FOREIGN KEY (video_games_id) REFERENCES video_games (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_games_character ADD CONSTRAINT FK_51229ABE1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_character DROP FOREIGN KEY FK_A7B6EE07567F5183');
        $this->addSql('ALTER TABLE film_character DROP FOREIGN KEY FK_A7B6EE071136BE75');
        $this->addSql('ALTER TABLE park_attractions_character DROP FOREIGN KEY FK_88D841FC1B14C3BD');
        $this->addSql('ALTER TABLE park_attractions_character DROP FOREIGN KEY FK_88D841FC1136BE75');
        $this->addSql('ALTER TABLE tv_shows_character DROP FOREIGN KEY FK_ABB05151BB9CED14');
        $this->addSql('ALTER TABLE tv_shows_character DROP FOREIGN KEY FK_ABB051511136BE75');
        $this->addSql('ALTER TABLE video_games_character DROP FOREIGN KEY FK_51229ABE3F7DF4CF');
        $this->addSql('ALTER TABLE video_games_character DROP FOREIGN KEY FK_51229ABE1136BE75');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE film_character');
        $this->addSql('DROP TABLE park_attractions');
        $this->addSql('DROP TABLE park_attractions_character');
        $this->addSql('DROP TABLE tv_shows');
        $this->addSql('DROP TABLE tv_shows_character');
        $this->addSql('DROP TABLE video_games');
        $this->addSql('DROP TABLE video_games_character');
    }
}
