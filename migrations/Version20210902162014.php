<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902162014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_gear DROP FOREIGN KEY FK_C374176012469DE2');
        $this->addSql('CREATE TABLE item__gear (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, wearing_place_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_7CC6385012469DE2 (category_id), INDEX IDX_7CC6385035EA5BB8 (wearing_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item__gear_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item__gear ADD CONSTRAINT FK_7CC6385012469DE2 FOREIGN KEY (category_id) REFERENCES item__gear_category (id)');
        $this->addSql('ALTER TABLE item__gear ADD CONSTRAINT FK_7CC6385035EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES wearing_place (id)');
        $this->addSql('DROP TABLE item_gear');
        $this->addSql('DROP TABLE item_gear_category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item__gear DROP FOREIGN KEY FK_7CC6385012469DE2');
        $this->addSql('CREATE TABLE item_gear (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, wearing_place_id INT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C374176012469DE2 (category_id), INDEX IDX_C374176035EA5BB8 (wearing_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item_gear_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE item_gear ADD CONSTRAINT FK_C374176012469DE2 FOREIGN KEY (category_id) REFERENCES item_gear_category (id)');
        $this->addSql('ALTER TABLE item_gear ADD CONSTRAINT FK_C374176035EA5BB8 FOREIGN KEY (wearing_place_id) REFERENCES wearing_place (id)');
        $this->addSql('DROP TABLE item__gear');
        $this->addSql('DROP TABLE item__gear_category');
    }
}
