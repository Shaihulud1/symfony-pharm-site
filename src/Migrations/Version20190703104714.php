<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190703104714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about_logo ADD sort INT DEFAULT NULL');
        $this->addSql('ALTER TABLE about ADD sort INT DEFAULT NULL');
        $this->addSql('ALTER TABLE action ADD sort INT DEFAULT NULL');
        $this->addSql('ALTER TABLE advantage ADD sort INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pharm ADD sort INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD sort INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE about DROP sort');
        $this->addSql('ALTER TABLE about_logo DROP sort');
        $this->addSql('ALTER TABLE action DROP sort');
        $this->addSql('ALTER TABLE advantage DROP sort');
        $this->addSql('ALTER TABLE pharm DROP sort');
        $this->addSql('ALTER TABLE product DROP sort');
    }
}
