<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190630125948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE landing_pharm (landing_id INT NOT NULL, pharm_id INT NOT NULL, INDEX IDX_1453C9EEEFD98736 (landing_id), INDEX IDX_1453C9EE61DD10D7 (pharm_id), PRIMARY KEY(landing_id, pharm_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE landing_about (landing_id INT NOT NULL, about_id INT NOT NULL, INDEX IDX_7DA84B5EFD98736 (landing_id), INDEX IDX_7DA84B5D087DB59 (about_id), PRIMARY KEY(landing_id, about_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE landing_action (landing_id INT NOT NULL, action_id INT NOT NULL, INDEX IDX_C57656F5EFD98736 (landing_id), INDEX IDX_C57656F59D32F035 (action_id), PRIMARY KEY(landing_id, action_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE landing_product (landing_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_1E4A8CEFD98736 (landing_id), INDEX IDX_1E4A8C4584665A (product_id), PRIMARY KEY(landing_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharm_advantage (pharm_id INT NOT NULL, advantage_id INT NOT NULL, INDEX IDX_69C7671161DD10D7 (pharm_id), INDEX IDX_69C767113864498A (advantage_id), PRIMARY KEY(pharm_id, advantage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE landing_pharm ADD CONSTRAINT FK_1453C9EEEFD98736 FOREIGN KEY (landing_id) REFERENCES landing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE landing_pharm ADD CONSTRAINT FK_1453C9EE61DD10D7 FOREIGN KEY (pharm_id) REFERENCES pharm (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE landing_about ADD CONSTRAINT FK_7DA84B5EFD98736 FOREIGN KEY (landing_id) REFERENCES landing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE landing_about ADD CONSTRAINT FK_7DA84B5D087DB59 FOREIGN KEY (about_id) REFERENCES about (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE landing_action ADD CONSTRAINT FK_C57656F5EFD98736 FOREIGN KEY (landing_id) REFERENCES landing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE landing_action ADD CONSTRAINT FK_C57656F59D32F035 FOREIGN KEY (action_id) REFERENCES action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE landing_product ADD CONSTRAINT FK_1E4A8CEFD98736 FOREIGN KEY (landing_id) REFERENCES landing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE landing_product ADD CONSTRAINT FK_1E4A8C4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharm_advantage ADD CONSTRAINT FK_69C7671161DD10D7 FOREIGN KEY (pharm_id) REFERENCES pharm (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharm_advantage ADD CONSTRAINT FK_69C767113864498A FOREIGN KEY (advantage_id) REFERENCES advantage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE landing ADD bonus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE landing ADD CONSTRAINT FK_EF3ACE1569545666 FOREIGN KEY (bonus_id) REFERENCES bonus (id)');
        $this->addSql('CREATE INDEX IDX_EF3ACE1569545666 ON landing (bonus_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE landing_pharm');
        $this->addSql('DROP TABLE landing_about');
        $this->addSql('DROP TABLE landing_action');
        $this->addSql('DROP TABLE landing_product');
        $this->addSql('DROP TABLE pharm_advantage');
        $this->addSql('ALTER TABLE landing DROP FOREIGN KEY FK_EF3ACE1569545666');
        $this->addSql('DROP INDEX IDX_EF3ACE1569545666 ON landing');
        $this->addSql('ALTER TABLE landing DROP bonus_id');
    }
}
