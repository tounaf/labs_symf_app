<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220729185343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entry ADD type_collection_fond_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D70B4A3A775 FOREIGN KEY (type_collection_fond_id) REFERENCES type_collection_fond (id)');
        $this->addSql('CREATE INDEX IDX_2B219D70B4A3A775 ON entry (type_collection_fond_id)');
        $this->addSql('ALTER TABLE `group` ADD association_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('CREATE INDEX IDX_6DC044C5EFB9C8A5 ON `group` (association_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D70B4A3A775');
        $this->addSql('DROP INDEX IDX_2B219D70B4A3A775 ON entry');
        $this->addSql('ALTER TABLE entry DROP type_collection_fond_id');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5EFB9C8A5');
        $this->addSql('DROP INDEX IDX_6DC044C5EFB9C8A5 ON `group`');
        $this->addSql('ALTER TABLE `group` DROP association_id');
    }
}
