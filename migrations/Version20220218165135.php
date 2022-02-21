<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220218165135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE countries (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(63) NOT NULL, iso2 VARCHAR(2) NOT NULL COLLATE `ascii_bin` COMMENT \'ISO 3166-2 two letter upper case country code.\', iso3 VARCHAR(3) DEFAULT NULL COLLATE `ascii_bin` COMMENT \'ISO 3166-3 three letter upper case country code.\', INDEX name_index (name), INDEX iso2_index (iso2), INDEX iso3_index (iso3), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_details (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, citizenship_country_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2A2B1580A76ED395 (user_id), INDEX user_id_index (user_id), INDEX country_index (citizenship_country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_details ADD CONSTRAINT FK_2A2B1580A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_details ADD CONSTRAINT FK_2A2B15808F6E66E0 FOREIGN KEY (citizenship_country_id) REFERENCES countries (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_details DROP FOREIGN KEY FK_2A2B15808F6E66E0');
        $this->addSql('ALTER TABLE user_details DROP FOREIGN KEY FK_2A2B1580A76ED395');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE user_details');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
