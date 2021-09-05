<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210905200240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C2502824E7927C74 (email), UNIQUE INDEX UNIQ_C2502824F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enemy_modifier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, boost_to LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enemy_prototype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, level INT NOT NULL, health INT NOT NULL, damage INT NOT NULL, accuracy INT NOT NULL, defence INT NOT NULL, dodge INT NOT NULL, attack_range INT NOT NULL, coins LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, class_id INT NOT NULL, level_id INT NOT NULL, name VARCHAR(40) NOT NULL, experience INT NOT NULL, strenght INT NOT NULL, dexterity INT NOT NULL, wisdom INT NOT NULL, willpower INT NOT NULL, constitution INT NOT NULL, stats_points INT NOT NULL, sex VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_51CE6E86A76ED395 (user_id), INDEX IDX_51CE6E86EA000B10 (class_id), INDEX IDX_51CE6E865FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_currency (id BIGINT AUTO_INCREMENT NOT NULL, hero_id INT NOT NULL, currency_id INT NOT NULL, amount BIGINT NOT NULL, INDEX IDX_CC48399745B0BCD (hero_id), INDEX IDX_CC48399738248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_items (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, hero_id INT NOT NULL, item_id INT NOT NULL, location_id INT NOT NULL, INDEX IDX_7E21E68A45B0BCD (hero_id), INDEX IDX_7E21E68A126F525E (item_id), INDEX IDX_7E21E68A64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_items_enchantment (hero_items_id BIGINT UNSIGNED NOT NULL, enchantment_id INT NOT NULL, INDEX IDX_58D22F65CEAE1F2C (hero_items_id), INDEX IDX_58D22F65F3927CF3 (enchantment_id), PRIMARY KEY(hero_items_id, enchantment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__appendix (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(30) NOT NULL, boost_to VARCHAR(20) NOT NULL, value INT NOT NULL, INDEX IDX_49F0F9DEC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__appendixType (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__enchantment (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, boost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__gear (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, type_id INT NOT NULL, name VARCHAR(70) NOT NULL, min_dmg INT DEFAULT NULL, maxdmg INT DEFAULT NULL, defence INT DEFAULT NULL, INDEX IDX_9009332F12469DE2 (category_id), INDEX IDX_9009332FC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__gearCategory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__TypeInCategory (gear_category_id INT NOT NULL, gear_type_id INT NOT NULL, INDEX IDX_3F8B7D1CA5EE8B2C (gear_category_id), INDEX IDX_3F8B7D1C32CA4F08 (gear_type_id), PRIMARY KEY(gear_category_id, gear_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__gearType (id INT AUTO_INCREMENT NOT NULL, wearing_place_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_D35D34BB35EA5BB8 (wearing_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__item (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__ItemInGear (item_id INT NOT NULL, gear_id INT NOT NULL, INDEX IDX_5A3615D1126F525E (item_id), INDEX IDX_5A3615D177201934 (gear_id), PRIMARY KEY(item_id, gear_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__wearingPlace (id INT AUTO_INCREMENT NOT NULL, location VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, xpto_next BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loot_table (id INT AUTO_INCREMENT NOT NULL, enemy_id INT NOT NULL, identyfier VARCHAR(40) NOT NULL, from_tables LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', probability INT NOT NULL, INDEX IDX_77B446AB900C982F (enemy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86A76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E86EA000B10 FOREIGN KEY (class_id) REFERENCES hero_class (id)');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E865FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE hero_currency ADD CONSTRAINT FK_CC48399745B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id)');
        $this->addSql('ALTER TABLE hero_currency ADD CONSTRAINT FK_CC48399738248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE hero_items ADD CONSTRAINT FK_7E21E68A45B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id)');
        $this->addSql('ALTER TABLE hero_items ADD CONSTRAINT FK_7E21E68A126F525E FOREIGN KEY (item_id) REFERENCES itemsTree__item (id)');
        $this->addSql('ALTER TABLE hero_items ADD CONSTRAINT FK_7E21E68A64D218E FOREIGN KEY (location_id) REFERENCES itemsTree__wearingPlace (id)');
        $this->addSql('ALTER TABLE hero_items_enchantment ADD CONSTRAINT FK_58D22F65CEAE1F2C FOREIGN KEY (hero_items_id) REFERENCES hero_items (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_items_enchantment ADD CONSTRAINT FK_58D22F65F3927CF3 FOREIGN KEY (enchantment_id) REFERENCES itemsTree__enchantment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itemsTree__appendix ADD CONSTRAINT FK_49F0F9DEC54C8C93 FOREIGN KEY (type_id) REFERENCES itemsTree__appendixType (id)');
        $this->addSql('ALTER TABLE itemsTree__gear ADD CONSTRAINT FK_9009332F12469DE2 FOREIGN KEY (category_id) REFERENCES itemsTree__gearCategory (id)');
        $this->addSql('ALTER TABLE itemsTree__gear ADD CONSTRAINT FK_9009332FC54C8C93 FOREIGN KEY (type_id) REFERENCES itemsTree__gearType (id)');
        $this->addSql('ALTER TABLE itemsTree__TypeInCategory ADD CONSTRAINT FK_3F8B7D1CA5EE8B2C FOREIGN KEY (gear_category_id) REFERENCES itemsTree__gearCategory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itemsTree__TypeInCategory ADD CONSTRAINT FK_3F8B7D1C32CA4F08 FOREIGN KEY (gear_type_id) REFERENCES itemsTree__gearType (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itemsTree__gearType ADD CONSTRAINT FK_D35D34BB35EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES itemsTree__wearingPlace (id)');
        $this->addSql('ALTER TABLE itemsTree__ItemInGear ADD CONSTRAINT FK_5A3615D1126F525E FOREIGN KEY (item_id) REFERENCES itemsTree__item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itemsTree__ItemInGear ADD CONSTRAINT FK_5A3615D177201934 FOREIGN KEY (gear_id) REFERENCES itemsTree__gear (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loot_table ADD CONSTRAINT FK_77B446AB900C982F FOREIGN KEY (enemy_id) REFERENCES enemy_prototype (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86A76ED395');
        $this->addSql('ALTER TABLE hero_currency DROP FOREIGN KEY FK_CC48399738248176');
        $this->addSql('ALTER TABLE loot_table DROP FOREIGN KEY FK_77B446AB900C982F');
        $this->addSql('ALTER TABLE hero_currency DROP FOREIGN KEY FK_CC48399745B0BCD');
        $this->addSql('ALTER TABLE hero_items DROP FOREIGN KEY FK_7E21E68A45B0BCD');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E86EA000B10');
        $this->addSql('ALTER TABLE hero_items_enchantment DROP FOREIGN KEY FK_58D22F65CEAE1F2C');
        $this->addSql('ALTER TABLE itemsTree__appendix DROP FOREIGN KEY FK_49F0F9DEC54C8C93');
        $this->addSql('ALTER TABLE hero_items_enchantment DROP FOREIGN KEY FK_58D22F65F3927CF3');
        $this->addSql('ALTER TABLE itemsTree__ItemInGear DROP FOREIGN KEY FK_5A3615D177201934');
        $this->addSql('ALTER TABLE itemsTree__gear DROP FOREIGN KEY FK_9009332F12469DE2');
        $this->addSql('ALTER TABLE itemsTree__TypeInCategory DROP FOREIGN KEY FK_3F8B7D1CA5EE8B2C');
        $this->addSql('ALTER TABLE itemsTree__gear DROP FOREIGN KEY FK_9009332FC54C8C93');
        $this->addSql('ALTER TABLE itemsTree__TypeInCategory DROP FOREIGN KEY FK_3F8B7D1C32CA4F08');
        $this->addSql('ALTER TABLE hero_items DROP FOREIGN KEY FK_7E21E68A126F525E');
        $this->addSql('ALTER TABLE itemsTree__ItemInGear DROP FOREIGN KEY FK_5A3615D1126F525E');
        $this->addSql('ALTER TABLE hero_items DROP FOREIGN KEY FK_7E21E68A64D218E');
        $this->addSql('ALTER TABLE itemsTree__gearType DROP FOREIGN KEY FK_D35D34BB35EA5BB8');
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E865FB14BA7');
        $this->addSql('DROP TABLE app_users');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE enemy_modifier');
        $this->addSql('DROP TABLE enemy_prototype');
        $this->addSql('DROP TABLE hero');
        $this->addSql('DROP TABLE hero_class');
        $this->addSql('DROP TABLE hero_currency');
        $this->addSql('DROP TABLE hero_items');
        $this->addSql('DROP TABLE hero_items_enchantment');
        $this->addSql('DROP TABLE itemsTree__appendix');
        $this->addSql('DROP TABLE itemsTree__appendixType');
        $this->addSql('DROP TABLE itemsTree__enchantment');
        $this->addSql('DROP TABLE itemsTree__gear');
        $this->addSql('DROP TABLE itemsTree__gearCategory');
        $this->addSql('DROP TABLE itemsTree__TypeInCategory');
        $this->addSql('DROP TABLE itemsTree__gearType');
        $this->addSql('DROP TABLE itemsTree__item');
        $this->addSql('DROP TABLE itemsTree__ItemInGear');
        $this->addSql('DROP TABLE itemsTree__wearingPlace');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE loot_table');
    }
}
