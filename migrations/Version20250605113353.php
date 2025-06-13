<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250605113353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE tomobiles (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, motereur VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, image2 VARCHAR(255) NOT NULL, image3 VARCHAR(255) NOT NULL, image4 VARCHAR(255) NOT NULL, reservation VARCHAR(255) NOT NULL, INDEX IDX_64D9B54E76C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tomobiles ADD CONSTRAINT FK_64D9B54E76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE tomobiles DROP FOREIGN KEY FK_64D9B54E76C50E4A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tomobiles
        SQL);
    }
}
