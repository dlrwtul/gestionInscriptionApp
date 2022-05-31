<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220531073901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annee_scolaire (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(10) NOT NULL, etat VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, filiere VARCHAR(25) NOT NULL, niveau VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, sexe VARCHAR(2) NOT NULL, adresse VARCHAR(50) NOT NULL, matricule VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, annee_scolaire_id INT NOT NULL, etudiant_id INT NOT NULL, date DATETIME NOT NULL, etat VARCHAR(10) NOT NULL, INDEX IDX_5E90F6D68F5EA509 (classe_id), INDEX IDX_5E90F6D69331C741 (annee_scolaire_id), INDEX IDX_5E90F6D6DDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, grade VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur_module (professeur_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_BB082478BAB22EE9 (professeur_id), INDEX IDX_BB082478AFC2B591 (module_id), PRIMARY KEY(professeur_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur_classe (professeur_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_38ABBDC6BAB22EE9 (professeur_id), INDEX IDX_38ABBDC68F5EA509 (classe_id), PRIMARY KEY(professeur_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D68F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D69331C741 FOREIGN KEY (annee_scolaire_id) REFERENCES annee_scolaire (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE professeur_module ADD CONSTRAINT FK_BB082478BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_module ADD CONSTRAINT FK_BB082478AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_classe ADD CONSTRAINT FK_38ABBDC6BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_classe ADD CONSTRAINT FK_38ABBDC68F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D69331C741');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D68F5EA509');
        $this->addSql('ALTER TABLE professeur_classe DROP FOREIGN KEY FK_38ABBDC68F5EA509');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6DDEAB1A3');
        $this->addSql('ALTER TABLE professeur_module DROP FOREIGN KEY FK_BB082478AFC2B591');
        $this->addSql('ALTER TABLE professeur_module DROP FOREIGN KEY FK_BB082478BAB22EE9');
        $this->addSql('ALTER TABLE professeur_classe DROP FOREIGN KEY FK_38ABBDC6BAB22EE9');
        $this->addSql('DROP TABLE annee_scolaire');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE professeur_module');
        $this->addSql('DROP TABLE professeur_classe');
        $this->addSql('DROP TABLE user');
    }
}
