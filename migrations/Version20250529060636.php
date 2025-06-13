<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250529060636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicule ADD id_proprety_id INT DEFAULT NULL, ADD id_proprietaire VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DF02A4E78 FOREIGN KEY (id_proprety_id) REFERENCES proprietaire (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_292FFF1DF02A4E78 ON vehicule (id_proprety_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DF02A4E78
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_292FFF1DF02A4E78 ON vehicule
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicule DROP id_proprety_id, DROP id_proprietaire
        SQL);
    }
}
