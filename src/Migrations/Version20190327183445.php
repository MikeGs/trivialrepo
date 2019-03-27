<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327183445 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usuari (id INT AUTO_INCREMENT NOT NULL, codialumne VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, cognoms VARCHAR(255) NOT NULL, nick VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuari_partida (usuari_id INT NOT NULL, partida_id INT NOT NULL, INDEX IDX_2F2D0FFB5F263030 (usuari_id), INDEX IDX_2F2D0FFBF15A1987 (partida_id), PRIMARY KEY(usuari_id, partida_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipus_partida (id INT AUTO_INCREMENT NOT NULL, tipus VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinio (id INT AUTO_INCREMENT NOT NULL, id_usuari_id INT NOT NULL, contingut LONGTEXT NOT NULL, puntuacio INT NOT NULL, data DATETIME NOT NULL, UNIQUE INDEX UNIQ_DCE70E67DF138C17 (id_usuari_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tema (id INT AUTO_INCREMENT NOT NULL, id_nivell_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_61E3A5385E8AFC02 (id_nivell_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dificultat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, punts DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grup (id INT AUTO_INCREMENT NOT NULL, id_nivell_id INT NOT NULL, nom VARCHAR(255) NOT NULL, codi VARCHAR(255) NOT NULL, datainici DATETIME NOT NULL, datafinal DATETIME NOT NULL, finalitzat TINYINT(1) NOT NULL, tempsresposta DOUBLE PRECISION NOT NULL, id_administrador INT NOT NULL, INDEX IDX_D28D50175E8AFC02 (id_nivell_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grup_usuari (grup_id INT NOT NULL, usuari_id INT NOT NULL, INDEX IDX_FA23DCFA569AD2DE (grup_id), INDEX IDX_FA23DCFA5F263030 (usuari_id), PRIMARY KEY(grup_id, usuari_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pregunta_partida (id INT AUTO_INCREMENT NOT NULL, id_tema_partida_id INT DEFAULT NULL, id_pregunta_id INT NOT NULL, resposta TINYINT(1) NOT NULL, INDEX IDX_54A333F4B96D5CB0 (id_tema_partida_id), INDEX IDX_54A333F429B74DE9 (id_pregunta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partida (id INT AUTO_INCREMENT NOT NULL, id_nivell_id INT NOT NULL, id_tipus_partida_id INT NOT NULL, data DATETIME NOT NULL, INDEX IDX_A9C1580C5E8AFC02 (id_nivell_id), UNIQUE INDEX UNIQ_A9C1580CD7DCC453 (id_tipus_partida_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pregunta (id INT AUTO_INCREMENT NOT NULL, id_grup_id INT DEFAULT NULL, id_dificultat_id INT DEFAULT NULL, id_tema_id INT DEFAULT NULL, text LONGTEXT NOT NULL, resposta_correcta LONGTEXT NOT NULL, resposta_incorrecta1 LONGTEXT NOT NULL, resposta_incorrecta2 LONGTEXT NOT NULL, resposta_incorrecta3 LONGTEXT NOT NULL, INDEX IDX_AEE0E1F788077BAE (id_grup_id), INDEX IDX_AEE0E1F7DB8A3CB0 (id_dificultat_id), INDEX IDX_AEE0E1F778D72367 (id_tema_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nivell (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tema_partida (id INT AUTO_INCREMENT NOT NULL, usuari_id INT DEFAULT NULL, partida_id INT DEFAULT NULL, id_tema_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, puntuacio DOUBLE PRECISION NOT NULL, encerts INT NOT NULL, errors INT NOT NULL, formatges INT NOT NULL, INDEX IDX_AAB03AA15F263030 (usuari_id), INDEX IDX_AAB03AA1F15A1987 (partida_id), INDEX IDX_AAB03AA178D72367 (id_tema_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE usuari_partida ADD CONSTRAINT FK_2F2D0FFB5F263030 FOREIGN KEY (usuari_id) REFERENCES usuari (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuari_partida ADD CONSTRAINT FK_2F2D0FFBF15A1987 FOREIGN KEY (partida_id) REFERENCES partida (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE opinio ADD CONSTRAINT FK_DCE70E67DF138C17 FOREIGN KEY (id_usuari_id) REFERENCES usuari (id)');
        $this->addSql('ALTER TABLE tema ADD CONSTRAINT FK_61E3A5385E8AFC02 FOREIGN KEY (id_nivell_id) REFERENCES nivell (id)');
        $this->addSql('ALTER TABLE grup ADD CONSTRAINT FK_D28D50175E8AFC02 FOREIGN KEY (id_nivell_id) REFERENCES nivell (id)');
        $this->addSql('ALTER TABLE grup_usuari ADD CONSTRAINT FK_FA23DCFA569AD2DE FOREIGN KEY (grup_id) REFERENCES grup (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grup_usuari ADD CONSTRAINT FK_FA23DCFA5F263030 FOREIGN KEY (usuari_id) REFERENCES usuari (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pregunta_partida ADD CONSTRAINT FK_54A333F4B96D5CB0 FOREIGN KEY (id_tema_partida_id) REFERENCES tema_partida (id)');
        $this->addSql('ALTER TABLE pregunta_partida ADD CONSTRAINT FK_54A333F429B74DE9 FOREIGN KEY (id_pregunta_id) REFERENCES pregunta (id)');
        $this->addSql('ALTER TABLE partida ADD CONSTRAINT FK_A9C1580C5E8AFC02 FOREIGN KEY (id_nivell_id) REFERENCES nivell (id)');
        $this->addSql('ALTER TABLE partida ADD CONSTRAINT FK_A9C1580CD7DCC453 FOREIGN KEY (id_tipus_partida_id) REFERENCES tipus_partida (id)');
        $this->addSql('ALTER TABLE pregunta ADD CONSTRAINT FK_AEE0E1F788077BAE FOREIGN KEY (id_grup_id) REFERENCES grup (id)');
        $this->addSql('ALTER TABLE pregunta ADD CONSTRAINT FK_AEE0E1F7DB8A3CB0 FOREIGN KEY (id_dificultat_id) REFERENCES dificultat (id)');
        $this->addSql('ALTER TABLE pregunta ADD CONSTRAINT FK_AEE0E1F778D72367 FOREIGN KEY (id_tema_id) REFERENCES tema (id)');
        $this->addSql('ALTER TABLE tema_partida ADD CONSTRAINT FK_AAB03AA15F263030 FOREIGN KEY (usuari_id) REFERENCES usuari (id)');
        $this->addSql('ALTER TABLE tema_partida ADD CONSTRAINT FK_AAB03AA1F15A1987 FOREIGN KEY (partida_id) REFERENCES partida (id)');
        $this->addSql('ALTER TABLE tema_partida ADD CONSTRAINT FK_AAB03AA178D72367 FOREIGN KEY (id_tema_id) REFERENCES tema (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuari_partida DROP FOREIGN KEY FK_2F2D0FFB5F263030');
        $this->addSql('ALTER TABLE opinio DROP FOREIGN KEY FK_DCE70E67DF138C17');
        $this->addSql('ALTER TABLE grup_usuari DROP FOREIGN KEY FK_FA23DCFA5F263030');
        $this->addSql('ALTER TABLE tema_partida DROP FOREIGN KEY FK_AAB03AA15F263030');
        $this->addSql('ALTER TABLE partida DROP FOREIGN KEY FK_A9C1580CD7DCC453');
        $this->addSql('ALTER TABLE pregunta DROP FOREIGN KEY FK_AEE0E1F778D72367');
        $this->addSql('ALTER TABLE tema_partida DROP FOREIGN KEY FK_AAB03AA178D72367');
        $this->addSql('ALTER TABLE pregunta DROP FOREIGN KEY FK_AEE0E1F7DB8A3CB0');
        $this->addSql('ALTER TABLE grup_usuari DROP FOREIGN KEY FK_FA23DCFA569AD2DE');
        $this->addSql('ALTER TABLE pregunta DROP FOREIGN KEY FK_AEE0E1F788077BAE');
        $this->addSql('ALTER TABLE usuari_partida DROP FOREIGN KEY FK_2F2D0FFBF15A1987');
        $this->addSql('ALTER TABLE tema_partida DROP FOREIGN KEY FK_AAB03AA1F15A1987');
        $this->addSql('ALTER TABLE pregunta_partida DROP FOREIGN KEY FK_54A333F429B74DE9');
        $this->addSql('ALTER TABLE tema DROP FOREIGN KEY FK_61E3A5385E8AFC02');
        $this->addSql('ALTER TABLE grup DROP FOREIGN KEY FK_D28D50175E8AFC02');
        $this->addSql('ALTER TABLE partida DROP FOREIGN KEY FK_A9C1580C5E8AFC02');
        $this->addSql('ALTER TABLE pregunta_partida DROP FOREIGN KEY FK_54A333F4B96D5CB0');
        $this->addSql('DROP TABLE usuari');
        $this->addSql('DROP TABLE usuari_partida');
        $this->addSql('DROP TABLE tipus_partida');
        $this->addSql('DROP TABLE opinio');
        $this->addSql('DROP TABLE tema');
        $this->addSql('DROP TABLE dificultat');
        $this->addSql('DROP TABLE grup');
        $this->addSql('DROP TABLE grup_usuari');
        $this->addSql('DROP TABLE pregunta_partida');
        $this->addSql('DROP TABLE partida');
        $this->addSql('DROP TABLE pregunta');
        $this->addSql('DROP TABLE nivell');
        $this->addSql('DROP TABLE tema_partida');
    }
}
