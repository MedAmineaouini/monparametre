<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241009162058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE PAYS (idpays INT IDENTITY NOT NULL, libpays NVARCHAR(50) NOT NULL, codepays NVARCHAR(4) NOT NULL, PRIMARY KEY (idpays))');
        $this->addSql('CREATE TABLE SOUSPAYS (seqsouspays INT IDENTITY NOT NULL, libsouspays NVARCHAR(50) NOT NULL, PRIMARY KEY (seqsouspays))');
        $this->addSql('CREATE TABLE PRODUIT (seqprod INT IDENTITY NOT NULL, libprod NVARCHAR(50) NOT NULL, adresse NVARCHAR(255), tel NVARCHAR(15), email NVARCHAR(255), SEQSOUSPAYS INT, IDPAYS INT, PRIMARY KEY (seqprod))');
        $this->addSql('CREATE INDEX IDX_29A5EC27FE3540F4 ON PRODUIT (SEQSOUSPAYS)');
        $this->addSql('CREATE INDEX IDX_29A5EC2717A80A88 ON PRODUIT (IDPAYS)');
        $this->addSql('ALTER TABLE PRODUIT ADD CONSTRAINT FK_29A5EC27FE3540F4 FOREIGN KEY (SEQSOUSPAYS) REFERENCES SOUSPAYS (SEQSOUSPAYS)');
        $this->addSql('ALTER TABLE PRODUIT ADD CONSTRAINT FK_29A5EC2717A80A88 FOREIGN KEY (IDPAYS) REFERENCES PAYS (IDPAYS)');

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
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT FK_29A5EC27FE3540F4');
        $this->addSql('ALTER TABLE produit DROP CONSTRAINT FK_29A5EC2717A80A88');
        $this->addSql('DROP TABLE PAYS');
        $this->addSql('DROP TABLE SOUSPAYS');
        $this->addSql('DROP TABLE produit');
        $this->addSql('ALTER TABLE [USER] ALTER COLUMN login NVARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE [USER] ALTER COLUMN password NVARCHAR(250) NOT NULL');
    }
}
