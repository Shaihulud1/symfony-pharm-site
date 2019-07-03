<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190703065308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE about_about_logo (about_id INT NOT NULL, about_logo_id INT NOT NULL, INDEX IDX_34A31D25D087DB59 (about_id), INDEX IDX_34A31D258E9E236B (about_logo_id), PRIMARY KEY(about_id, about_logo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE about_logo (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo_pic VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE about_about_logo ADD CONSTRAINT FK_34A31D25D087DB59 FOREIGN KEY (about_id) REFERENCES about (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE about_about_logo ADD CONSTRAINT FK_34A31D258E9E236B FOREIGN KEY (about_logo_id) REFERENCES about_logo (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about_about_logo DROP FOREIGN KEY FK_34A31D258E9E236B');
        $this->addSql('DROP TABLE about_about_logo');
        $this->addSql('DROP TABLE about_logo');
    }
}
