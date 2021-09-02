<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902163313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appendix DROP FOREIGN KEY FK_B13D90B7C54C8C93');
        $this->addSql('ALTER TABLE item__gear DROP FOREIGN KEY FK_7CC6385012469DE2');
        $this->addSql('ALTER TABLE item__gear DROP FOREIGN KEY FK_7CC6385035EA5BB8');
        $this->addSql('CREATE TABLE itemsTree_appendix (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(30) NOT NULL, boost_to VARCHAR(20) NOT NULL, value INT NOT NULL, INDEX IDX_6AB27117C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree_appendixType (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree_enchantment (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, boost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree_gear (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, wearing_place_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_6F8D4EA112469DE2 (category_id), INDEX IDX_6F8D4EA135EA5BB8 (wearing_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree_gearCategory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree_itemType (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree_wearingPlace (id INT AUTO_INCREMENT NOT NULL, location VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE itemsTree_appendix ADD CONSTRAINT FK_6AB27117C54C8C93 FOREIGN KEY (type_id) REFERENCES itemsTree_appendixType (id)');
        $this->addSql('ALTER TABLE itemsTree_gear ADD CONSTRAINT FK_6F8D4EA112469DE2 FOREIGN KEY (category_id) REFERENCES itemsTree_gearCategory (id)');
        $this->addSql('ALTER TABLE itemsTree_gear ADD CONSTRAINT FK_6F8D4EA135EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES itemsTree_wearingPlace (id)');
        $this->addSql('DROP TABLE appendix');
        $this->addSql('DROP TABLE appendix_type');
        $this->addSql('DROP TABLE enchantment');
        $this->addSql('DROP TABLE item__gear');
        $this->addSql('DROP TABLE item__gear_category');
        $this->addSql('DROP TABLE item_type');
        $this->addSql('DROP TABLE wearing_place');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE itemsTree_appendix DROP FOREIGN KEY FK_6AB27117C54C8C93');
        $this->addSql('ALTER TABLE itemsTree_gear DROP FOREIGN KEY FK_6F8D4EA112469DE2');
        $this->addSql('ALTER TABLE itemsTree_gear DROP FOREIGN KEY FK_6F8D4EA135EA5BB8');
        $this->addSql('CREATE TABLE appendix (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, boost_to VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, value INT NOT NULL, INDEX IDX_B13D90B7C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE appendix_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE enchantment (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, boost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item__gear (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, wearing_place_id INT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_7CC6385035EA5BB8 (wearing_place_id), INDEX IDX_7CC6385012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item__gear_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wearing_place (id INT AUTO_INCREMENT NOT NULL, location VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE appendix ADD CONSTRAINT FK_B13D90B7C54C8C93 FOREIGN KEY (type_id) REFERENCES appendix_type (id)');
        $this->addSql('ALTER TABLE item__gear ADD CONSTRAINT FK_7CC6385012469DE2 FOREIGN KEY (category_id) REFERENCES item__gear_category (id)');
        $this->addSql('ALTER TABLE item__gear ADD CONSTRAINT FK_7CC6385035EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES wearing_place (id)');
        $this->addSql('DROP TABLE itemsTree_appendix');
        $this->addSql('DROP TABLE itemsTree_appendixType');
        $this->addSql('DROP TABLE itemsTree_enchantment');
        $this->addSql('DROP TABLE itemsTree_gear');
        $this->addSql('DROP TABLE itemsTree_gearCategory');
        $this->addSql('DROP TABLE itemsTree_itemType');
        $this->addSql('DROP TABLE itemsTree_wearingPlace');
    }
}
