<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190703062003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about_image ADD about_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE about_image ADD CONSTRAINT FK_AE454080D087DB59 FOREIGN KEY (about_id) REFERENCES about (id)');
        $this->addSql('CREATE INDEX IDX_AE454080D087DB59 ON about_image (about_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about_image DROP FOREIGN KEY FK_AE454080D087DB59');
        $this->addSql('DROP INDEX IDX_AE454080D087DB59 ON about_image');
        $this->addSql('ALTER TABLE about_image DROP about_id');
    }
}
