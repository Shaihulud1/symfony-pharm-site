<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190703062533 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE about_about_image');
        $this->addSql('ALTER TABLE about_image DROP name, DROP text');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE about_about_image (about_id INT NOT NULL, about_image_id INT NOT NULL, INDEX IDX_A57BC41D087DB59 (about_id), INDEX IDX_A57BC4171BB2404 (about_image_id), PRIMARY KEY(about_id, about_image_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE about_about_image ADD CONSTRAINT FK_A57BC4171BB2404 FOREIGN KEY (about_image_id) REFERENCES about_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE about_about_image ADD CONSTRAINT FK_A57BC41D087DB59 FOREIGN KEY (about_id) REFERENCES about (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE about_image ADD name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD text LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
