<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531183023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ac (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, sexe VARCHAR(2) NOT NULL, adresse VARCHAR(50) NOT NULL, matricule VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT NOT NULL, grade VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rp (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ac ADD CONSTRAINT FK_E98478FBBF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rp ADD CONSTRAINT FK_CD578B7BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F87BF96A4D60759 ON classe (libelle)');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6DDEAB1A3');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D655CAF762 ON inscription (etat)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C242628A4D60759 ON module (libelle)');
        $this->addSql('DROP INDEX UNIQ_FCEC9EFAA08CB10 ON personne');
        $this->addSql('ALTER TABLE personne DROP grade, DROP login, DROP roles, DROP password, DROP sexe, DROP adresse, DROP matricule');
        $this->addSql('ALTER TABLE professeur_module DROP FOREIGN KEY FK_BB082478BAB22EE9');
        $this->addSql('ALTER TABLE professeur_module ADD CONSTRAINT FK_BB082478BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_classe DROP FOREIGN KEY FK_38ABBDC6BAB22EE9');
        $this->addSql('ALTER TABLE professeur_classe ADD CONSTRAINT FK_38ABBDC6BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6DDEAB1A3');
        $this->addSql('ALTER TABLE professeur_module DROP FOREIGN KEY FK_BB082478BAB22EE9');
        $this->addSql('ALTER TABLE professeur_classe DROP FOREIGN KEY FK_38ABBDC6BAB22EE9');
        $this->addSql('DROP TABLE ac');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE rp');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX UNIQ_8F87BF96A4D60759 ON classe');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6DDEAB1A3');
        $this->addSql('DROP INDEX UNIQ_5E90F6D655CAF762 ON inscription');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES personne (id)');
        $this->addSql('DROP INDEX UNIQ_C242628A4D60759 ON module');
        $this->addSql('ALTER TABLE personne ADD grade VARCHAR(25) DEFAULT NULL, ADD login VARCHAR(180) DEFAULT NULL, ADD roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) DEFAULT NULL, ADD sexe VARCHAR(2) DEFAULT NULL, ADD adresse VARCHAR(50) DEFAULT NULL, ADD matricule VARCHAR(25) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FCEC9EFAA08CB10 ON personne (login)');
        $this->addSql('ALTER TABLE professeur_classe DROP FOREIGN KEY FK_38ABBDC6BAB22EE9');
        $this->addSql('ALTER TABLE professeur_classe ADD CONSTRAINT FK_38ABBDC6BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_module DROP FOREIGN KEY FK_BB082478BAB22EE9');
        $this->addSql('ALTER TABLE professeur_module ADD CONSTRAINT FK_BB082478BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES personne (id) ON DELETE CASCADE');
    }
}
