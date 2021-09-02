<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902171552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE itemsTree__armor ADD wearing_place_id INT NOT NULL');
        $this->addSql('ALTER TABLE itemsTree__armor ADD CONSTRAINT FK_73B0C40935EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES itemsTree__wearingPlace (id)');
        $this->addSql('CREATE INDEX IDX_73B0C40935EA5BB8 ON itemsTree__armor (wearing_place_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE itemsTree__armor DROP FOREIGN KEY FK_73B0C40935EA5BB8');
        $this->addSql('DROP INDEX IDX_73B0C40935EA5BB8 ON itemsTree__armor');
        $this->addSql('ALTER TABLE itemsTree__armor DROP wearing_place_id');
    }
}
