<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260522204400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disertante (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, biografia LONGTEXT NOT NULL, telefono VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, twitter VARCHAR(255) NOT NULL, linkedin VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE evento (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, fecha DATE NOT NULL, hora TIME NOT NULL, duracion INT NOT NULL, idioma VARCHAR(255) NOT NULL, disertante_id INT NOT NULL, INDEX IDX_47860B0554115B4B (disertante_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE usuario_evento (usuario_id INT NOT NULL, evento_id INT NOT NULL, INDEX IDX_BD94E80CDB38439E (usuario_id), INDEX IDX_BD94E80C87A5F842 (evento_id), PRIMARY KEY (usuario_id, evento_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE evento ADD CONSTRAINT FK_47860B0554115B4B FOREIGN KEY (disertante_id) REFERENCES disertante (id)');
        $this->addSql('ALTER TABLE usuario_evento ADD CONSTRAINT FK_BD94E80CDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_evento ADD CONSTRAINT FK_BD94E80C87A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evento DROP FOREIGN KEY FK_47860B0554115B4B');
        $this->addSql('ALTER TABLE usuario_evento DROP FOREIGN KEY FK_BD94E80CDB38439E');
        $this->addSql('ALTER TABLE usuario_evento DROP FOREIGN KEY FK_BD94E80C87A5F842');
        $this->addSql('DROP TABLE disertante');
        $this->addSql('DROP TABLE evento');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE usuario_evento');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
