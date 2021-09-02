<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902171439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE itemsTree__armor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, defence INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__weapon (id INT AUTO_INCREMENT NOT NULL, wearing_place_id INT NOT NULL, name VARCHAR(50) NOT NULL, min_dmg INT NOT NULL, max_dmg INT NOT NULL, INDEX IDX_A428364F35EA5BB8 (wearing_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE itemsTree__weapon ADD CONSTRAINT FK_A428364F35EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES itemsTree__wearingPlace (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE itemsTree__armor');
        $this->addSql('DROP TABLE itemsTree__weapon');
    }
}
