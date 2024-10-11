<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241011095314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE PRODUIT DROP CONSTRAINT FK_29A5EC2717A80A88');
        $this->addSql('ALTER TABLE PRODUIT DROP CONSTRAINT FK_29A5EC27FE3540F4');
        $this->addSql('DROP INDEX IDX_29A5EC27FE3540F4 ON PRODUIT');
        $this->addSql('DROP INDEX IDX_29A5EC2717A80A88 ON PRODUIT');
        $this->addSql('ALTER TABLE PRODUIT DROP COLUMN SEQSOUSPAYS');
        $this->addSql('ALTER TABLE PRODUIT DROP COLUMN IDPAYS');
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
        $this->addSql('ALTER TABLE produit ADD SEQSOUSPAYS INT');
        $this->addSql('ALTER TABLE produit ADD IDPAYS INT');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2717A80A88 FOREIGN KEY (IDPAYS) REFERENCES PAYS (idpays) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27FE3540F4 FOREIGN KEY (SEQSOUSPAYS) REFERENCES SOUSPAYS (seqsouspays) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_29A5EC27FE3540F4 ON produit (SEQSOUSPAYS)');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_29A5EC2717A80A88 ON produit (IDPAYS)');
        $this->addSql('ALTER TABLE [USER] ALTER COLUMN login NVARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE [USER] ALTER COLUMN password NVARCHAR(250) NOT NULL');
    }
}
