<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261023205937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disertante ADD especialidad VARCHAR(150) DEFAULT \'\' NOT NULL, ADD activo TINYINT DEFAULT 1 NOT NULL, CHANGE nombre nombre VARCHAR(100) NOT NULL, CHANGE apellido apellido VARCHAR(100) NOT NULL, CHANGE biografia biografia LONGTEXT DEFAULT NULL, CHANGE telefono telefono VARCHAR(255) DEFAULT NULL, CHANGE url url VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE twitter twitter VARCHAR(255) DEFAULT NULL, CHANGE linkedin linkedin VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disertante DROP especialidad, DROP activo, CHANGE nombre nombre VARCHAR(255) NOT NULL, CHANGE apellido apellido VARCHAR(255) NOT NULL, CHANGE biografia biografia LONGTEXT NOT NULL, CHANGE telefono telefono VARCHAR(255) NOT NULL, CHANGE url url VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE twitter twitter VARCHAR(255) NOT NULL, CHANGE linkedin linkedin VARCHAR(255) NOT NULL');
    }
}
