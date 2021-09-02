<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902172633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gear_armor (gear_id INT NOT NULL, armor_id INT NOT NULL, INDEX IDX_252E617077201934 (gear_id), INDEX IDX_252E6170F5AA3663 (armor_id), PRIMARY KEY(gear_id, armor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gear_weapon (gear_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_8DA7617277201934 (gear_id), INDEX IDX_8DA7617295B82273 (weapon_id), PRIMARY KEY(gear_id, weapon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gear_armor ADD CONSTRAINT FK_252E617077201934 FOREIGN KEY (gear_id) REFERENCES itemsTree__gear (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gear_armor ADD CONSTRAINT FK_252E6170F5AA3663 FOREIGN KEY (armor_id) REFERENCES itemsTree__armor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gear_weapon ADD CONSTRAINT FK_8DA7617277201934 FOREIGN KEY (gear_id) REFERENCES itemsTree__gear (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gear_weapon ADD CONSTRAINT FK_8DA7617295B82273 FOREIGN KEY (weapon_id) REFERENCES itemsTree__weapon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itemsTree__gear DROP FOREIGN KEY FK_9009332F12469DE2');
        $this->addSql('ALTER TABLE itemsTree__gear DROP FOREIGN KEY FK_9009332F35EA5BB8');
        $this->addSql('DROP INDEX IDX_9009332F35EA5BB8 ON itemsTree__gear');
        $this->addSql('DROP INDEX IDX_9009332F12469DE2 ON itemsTree__gear');
        $this->addSql('ALTER TABLE itemsTree__gear DROP category_id, DROP wearing_place_id, DROP name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gear_armor');
        $this->addSql('DROP TABLE gear_weapon');
        $this->addSql('ALTER TABLE itemsTree__gear ADD category_id INT NOT NULL, ADD wearing_place_id INT NOT NULL, ADD name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE itemsTree__gear ADD CONSTRAINT FK_9009332F12469DE2 FOREIGN KEY (category_id) REFERENCES itemsTree__gearCategory (id)');
        $this->addSql('ALTER TABLE itemsTree__gear ADD CONSTRAINT FK_9009332F35EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES itemsTree__wearingPlace (id)');
        $this->addSql('CREATE INDEX IDX_9009332F35EA5BB8 ON itemsTree__gear (wearing_place_id)');
        $this->addSql('CREATE INDEX IDX_9009332F12469DE2 ON itemsTree__gear (category_id)');
    }
}
