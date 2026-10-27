<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261027223602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario ADD roles JSON NOT NULL, CHANGE nombre nombre VARCHAR(255) DEFAULT NULL, CHANGE apellido apellido VARCHAR(255) DEFAULT NULL, CHANGE dni dni VARCHAR(255) DEFAULT NULL, CHANGE direccion direccion VARCHAR(255) DEFAULT NULL, CHANGE telefono telefono VARCHAR(255) DEFAULT NULL');
        $this->addSql("UPDATE usuario SET roles = '[]' WHERE roles = ''");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario DROP roles, CHANGE nombre nombre VARCHAR(255) NOT NULL, CHANGE apellido apellido VARCHAR(255) NOT NULL, CHANGE dni dni VARCHAR(255) NOT NULL, CHANGE direccion direccion VARCHAR(255) NOT NULL, CHANGE telefono telefono VARCHAR(255) NOT NULL');
    }
}
