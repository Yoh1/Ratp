<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531074906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gare (id INT AUTO_INCREMENT NOT NULL, nom_gare VARCHAR(255) NOT NULL, nom_long VARCHAR(255) NOT NULL, nom_iv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne (id INT AUTO_INCREMENT NOT NULL, ligne_code VARCHAR(255) NOT NULL, res_com VARCHAR(255) NOT NULL, cod_ligf VARCHAR(255) NOT NULL, indice_lig VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_staions (id INT AUTO_INCREMENT NOT NULL, ligne_code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_stations (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, ligne_id INT NOT NULL, INDEX IDX_F86D64DF21BDB235 (station_id), INDEX IDX_F86D64DF5A438E76 (ligne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, gare_id INT NOT NULL, idrefliga VARCHAR(255) NOT NULL, gares_id INT NOT NULL, geo_point VARCHAR(255) NOT NULL, geo_shape VARCHAR(255) NOT NULL, x DOUBLE PRECISION NOT NULL, y DOUBLE PRECISION NOT NULL, termetro TINYINT(1) NOT NULL, INDEX IDX_9F39F8B163FD956 (gare_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_stations ADD CONSTRAINT FK_F86D64DF21BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE ligne_stations ADD CONSTRAINT FK_F86D64DF5A438E76 FOREIGN KEY (ligne_id) REFERENCES ligne (id)');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B163FD956 FOREIGN KEY (gare_id) REFERENCES gare (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B163FD956');
        $this->addSql('ALTER TABLE ligne_stations DROP FOREIGN KEY FK_F86D64DF5A438E76');
        $this->addSql('ALTER TABLE ligne_stations DROP FOREIGN KEY FK_F86D64DF21BDB235');
        $this->addSql('DROP TABLE gare');
        $this->addSql('DROP TABLE ligne');
        $this->addSql('DROP TABLE ligne_staions');
        $this->addSql('DROP TABLE ligne_stations');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
