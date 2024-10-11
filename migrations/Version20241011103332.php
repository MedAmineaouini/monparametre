<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241011103332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE SOUSPAYS ADD IDPAYS INT NOT NULL');
        $this->addSql('ALTER TABLE SOUSPAYS ADD CONSTRAINT FK_C760C8517A80A88 FOREIGN KEY (IDPAYS) REFERENCES PAYS (IDPAYS)');
        $this->addSql('CREATE INDEX IDX_C760C8517A80A88 ON SOUSPAYS (IDPAYS)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('ALTER TABLE SOUSPAYS DROP CONSTRAINT FK_C760C8517A80A88');
        $this->addSql('DROP INDEX IDX_C760C8517A80A88 ON SOUSPAYS');
        $this->addSql('ALTER TABLE SOUSPAYS DROP COLUMN IDPAYS');
        $this->addSql('ALTER TABLE produit ALTER COLUMN libprod NVARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT DF_29A5EC27_89834DDB DEFAULT \'\' FOR libprod');
        $this->addSql('ALTER TABLE produit ALTER COLUMN adresse NVARCHAR(255)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT DF_29A5EC27_C35F0816 DEFAULT \'\' FOR adresse');
        $this->addSql('ALTER TABLE produit ALTER COLUMN tel NVARCHAR(50)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT DF_29A5EC27_F037AB0F DEFAULT \'\' FOR tel');
        $this->addSql('ALTER TABLE produit ALTER COLUMN email NVARCHAR(255)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT DF_29A5EC27_E7927C74 DEFAULT \'\' FOR email');
        $this->addSql('ALTER TABLE [USER] ALTER COLUMN login NVARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE [USER] ALTER COLUMN password NVARCHAR(250) NOT NULL');
    }
}
