<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502185916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pregunta CHANGE pregunta_es pregunta_es LONGTEXT DEFAULT NULL, CHANGE pregunta_en pregunta_en LONGTEXT DEFAULT NULL, CHANGE resposta_correcta_cat resposta_correcta_cat LONGTEXT DEFAULT NULL, CHANGE resposta_correcta_es resposta_correcta_es LONGTEXT DEFAULT NULL, CHANGE resposta_correcta_en resposta_correcta_en LONGTEXT DEFAULT NULL, CHANGE resposta_incorrecta1cat resposta_incorrecta1cat LONGTEXT DEFAULT NULL, CHANGE resposta_incorrecta1es resposta_incorrecta1es LONGTEXT DEFAULT NULL, CHANGE resposta_incorrecta1en resposta_incorrecta1en LONGTEXT DEFAULT NULL, CHANGE resposta_incorrecta2cat resposta_incorrecta2cat LONGTEXT DEFAULT NULL, CHANGE resposta_incorrecta2es resposta_incorrecta2es LONGTEXT DEFAULT NULL, CHANGE resposta_incorrecta2en resposta_incorrecta2en LONGTEXT DEFAULT NULL, CHANGE resposta_incorrecta3cat resposta_incorrecta3cat LONGTEXT DEFAULT NULL, CHANGE resposta_incorrecta3es resposta_incorrecta3es LONGTEXT DEFAULT NULL, CHANGE resposta_incorrecta3en resposta_incorrecta3en LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pregunta CHANGE pregunta_es pregunta_es LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE pregunta_en pregunta_en LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_correcta_cat resposta_correcta_cat LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_correcta_es resposta_correcta_es LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_correcta_en resposta_correcta_en LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_incorrecta1cat resposta_incorrecta1cat LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_incorrecta1es resposta_incorrecta1es LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_incorrecta1en resposta_incorrecta1en LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_incorrecta2cat resposta_incorrecta2cat LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_incorrecta2es resposta_incorrecta2es LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_incorrecta2en resposta_incorrecta2en LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_incorrecta3cat resposta_incorrecta3cat LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_incorrecta3es resposta_incorrecta3es LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE resposta_incorrecta3en resposta_incorrecta3en LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
