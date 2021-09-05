<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210905181708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_gear DROP FOREIGN KEY FK_C3741760126F525E');
        $this->addSql('CREATE TABLE itemsTree__item (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itemsTree__ItemIsGear (item_id INT NOT NULL, gear_id INT NOT NULL, INDEX IDX_C24646E2126F525E (item_id), INDEX IDX_C24646E277201934 (gear_id), PRIMARY KEY(item_id, gear_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE itemsTree__ItemIsGear ADD CONSTRAINT FK_C24646E2126F525E FOREIGN KEY (item_id) REFERENCES itemsTree__item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itemsTree__ItemIsGear ADD CONSTRAINT FK_C24646E277201934 FOREIGN KEY (gear_id) REFERENCES itemsTree__gear (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_gear');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE itemsTree__ItemIsGear DROP FOREIGN KEY FK_C24646E2126F525E');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item_gear (item_id INT NOT NULL, gear_id INT NOT NULL, INDEX IDX_C374176077201934 (gear_id), INDEX IDX_C3741760126F525E (item_id), PRIMARY KEY(item_id, gear_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE item_gear ADD CONSTRAINT FK_C3741760126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_gear ADD CONSTRAINT FK_C374176077201934 FOREIGN KEY (gear_id) REFERENCES itemsTree__gear (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE itemsTree__item');
        $this->addSql('DROP TABLE itemsTree__ItemIsGear');
    }
}
