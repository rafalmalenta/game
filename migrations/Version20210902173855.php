<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902173855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE itemsTree__gearIsArmor (gear_id INT NOT NULL, armor_id INT NOT NULL, INDEX IDX_72C609FD77201934 (gear_id), INDEX IDX_72C609FDF5AA3663 (armor_id), PRIMARY KEY(gear_id, armor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__gearIsWeapon (gear_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_1EF9768777201934 (gear_id), INDEX IDX_1EF9768795B82273 (weapon_id), PRIMARY KEY(gear_id, weapon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE itemsTree__gearIsArmor ADD CONSTRAINT FK_72C609FD77201934 FOREIGN KEY (gear_id) REFERENCES itemsTree__gear (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itemsTree__gearIsArmor ADD CONSTRAINT FK_72C609FDF5AA3663 FOREIGN KEY (armor_id) REFERENCES itemsTree__armor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itemsTree__gearIsWeapon ADD CONSTRAINT FK_1EF9768777201934 FOREIGN KEY (gear_id) REFERENCES itemsTree__gear (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itemsTree__gearIsWeapon ADD CONSTRAINT FK_1EF9768795B82273 FOREIGN KEY (weapon_id) REFERENCES itemsTree__weapon (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE gear_armor');
        $this->addSql('DROP TABLE gear_weapon');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gear_armor (gear_id INT NOT NULL, armor_id INT NOT NULL, INDEX IDX_252E6170F5AA3663 (armor_id), INDEX IDX_252E617077201934 (gear_id), PRIMARY KEY(gear_id, armor_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE gear_weapon (gear_id INT NOT NULL, weapon_id INT NOT NULL, INDEX IDX_8DA7617277201934 (gear_id), INDEX IDX_8DA7617295B82273 (weapon_id), PRIMARY KEY(gear_id, weapon_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE gear_armor ADD CONSTRAINT FK_252E617077201934 FOREIGN KEY (gear_id) REFERENCES itemsTree__gear (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gear_armor ADD CONSTRAINT FK_252E6170F5AA3663 FOREIGN KEY (armor_id) REFERENCES itemsTree__armor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gear_weapon ADD CONSTRAINT FK_8DA7617277201934 FOREIGN KEY (gear_id) REFERENCES itemsTree__gear (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gear_weapon ADD CONSTRAINT FK_8DA7617295B82273 FOREIGN KEY (weapon_id) REFERENCES itemsTree__weapon (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE itemsTree__gearIsArmor');
        $this->addSql('DROP TABLE itemsTree__gearIsWeapon');
    }
}
