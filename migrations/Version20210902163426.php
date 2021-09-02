<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902163426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE itemsTree_appendix DROP FOREIGN KEY FK_6AB27117C54C8C93');
        $this->addSql('ALTER TABLE itemsTree_gear DROP FOREIGN KEY FK_6F8D4EA112469DE2');
        $this->addSql('ALTER TABLE itemsTree_gear DROP FOREIGN KEY FK_6F8D4EA135EA5BB8');
        $this->addSql('CREATE TABLE itemsTree__appendix (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(30) NOT NULL, boost_to VARCHAR(20) NOT NULL, value INT NOT NULL, INDEX IDX_49F0F9DEC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__appendixType (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__enchantment (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, boost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__gear (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, wearing_place_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_9009332F12469DE2 (category_id), INDEX IDX_9009332F35EA5BB8 (wearing_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__gearCategory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__itemType (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__wearingPlace (id INT AUTO_INCREMENT NOT NULL, location VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE itemsTree__appendix ADD CONSTRAINT FK_49F0F9DEC54C8C93 FOREIGN KEY (type_id) REFERENCES itemsTree__appendixType (id)');
        $this->addSql('ALTER TABLE itemsTree__gear ADD CONSTRAINT FK_9009332F12469DE2 FOREIGN KEY (category_id) REFERENCES itemsTree__gearCategory (id)');
        $this->addSql('ALTER TABLE itemsTree__gear ADD CONSTRAINT FK_9009332F35EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES itemsTree__wearingPlace (id)');
        $this->addSql('DROP TABLE itemsTree_appendix');
        $this->addSql('DROP TABLE itemsTree_appendixType');
        $this->addSql('DROP TABLE itemsTree_enchantment');
        $this->addSql('DROP TABLE itemsTree_gear');
        $this->addSql('DROP TABLE itemsTree_gearCategory');
        $this->addSql('DROP TABLE itemsTree_itemType');
        $this->addSql('DROP TABLE itemsTree_wearingPlace');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE itemsTree__appendix DROP FOREIGN KEY FK_49F0F9DEC54C8C93');
        $this->addSql('ALTER TABLE itemsTree__gear DROP FOREIGN KEY FK_9009332F12469DE2');
        $this->addSql('ALTER TABLE itemsTree__gear DROP FOREIGN KEY FK_9009332F35EA5BB8');
        $this->addSql('CREATE TABLE itemsTree_appendix (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, boost_to VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, value INT NOT NULL, INDEX IDX_6AB27117C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE itemsTree_appendixType (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE itemsTree_enchantment (id INT AUTO_INCREMENT NOT NULL, level INT NOT NULL, boost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE itemsTree_gear (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, wearing_place_id INT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_6F8D4EA112469DE2 (category_id), INDEX IDX_6F8D4EA135EA5BB8 (wearing_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE itemsTree_gearCategory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE itemsTree_itemType (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE itemsTree_wearingPlace (id INT AUTO_INCREMENT NOT NULL, location VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE itemsTree_appendix ADD CONSTRAINT FK_6AB27117C54C8C93 FOREIGN KEY (type_id) REFERENCES itemsTree_appendixType (id)');
        $this->addSql('ALTER TABLE itemsTree_gear ADD CONSTRAINT FK_6F8D4EA112469DE2 FOREIGN KEY (category_id) REFERENCES itemsTree_gearCategory (id)');
        $this->addSql('ALTER TABLE itemsTree_gear ADD CONSTRAINT FK_6F8D4EA135EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES itemsTree_wearingPlace (id)');
        $this->addSql('DROP TABLE itemsTree__appendix');
        $this->addSql('DROP TABLE itemsTree__appendixType');
        $this->addSql('DROP TABLE itemsTree__enchantment');
        $this->addSql('DROP TABLE itemsTree__gear');
        $this->addSql('DROP TABLE itemsTree__gearCategory');
        $this->addSql('DROP TABLE itemsTree__itemType');
        $this->addSql('DROP TABLE itemsTree__wearingPlace');
    }
}
