<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106160937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY favoris_ibfk_1');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY favoris_ibfk_2');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('ALTER TABLE acteur ADD id INT AUTO_INCREMENT NOT NULL, DROP acteur_id, CHANGE date_naissance date_naissance DATE NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY film_ibfk_1');
        $this->addSql('DROP INDEX realisateur_id ON film');
        $this->addSql('ALTER TABLE film ADD id INT AUTO_INCREMENT NOT NULL, DROP film_id, DROP realisateur_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY jouer_ibfk_1');
        $this->addSql('ALTER TABLE jouer DROP FOREIGN KEY jouer_ibfk_2');
        $this->addSql('DROP INDEX acteur_id ON jouer');
        $this->addSql('DROP INDEX IDX_825E5AED567F5183 ON jouer');
        $this->addSql('ALTER TABLE jouer ADD id INT AUTO_INCREMENT NOT NULL, ADD role VARCHAR(100) NOT NULL, DROP film_id, DROP acteur_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE realisateur ADD id INT AUTO_INCREMENT NOT NULL, DROP realisateur_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX email ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD id INT AUTO_INCREMENT NOT NULL, DROP utilisateur_id, CHANGE email email VARCHAR(100) NOT NULL, CHANGE role role VARCHAR(50) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoris (utilisateur_id VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, film_id VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX film_id (film_id), INDEX IDX_8933C432FB88E14F (utilisateur_id), PRIMARY KEY(utilisateur_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT favoris_ibfk_1 FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (utilisateur_id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT favoris_ibfk_2 FOREIGN KEY (film_id) REFERENCES film (film_id)');
        $this->addSql('ALTER TABLE acteur MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON acteur');
        $this->addSql('ALTER TABLE acteur ADD acteur_id VARCHAR(50) NOT NULL, DROP id, CHANGE date_naissance date_naissance DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE acteur ADD PRIMARY KEY (acteur_id)');
        $this->addSql('ALTER TABLE film MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON film');
        $this->addSql('ALTER TABLE film ADD film_id VARCHAR(50) NOT NULL, ADD realisateur_id VARCHAR(50) DEFAULT NULL, DROP id');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT film_ibfk_1 FOREIGN KEY (realisateur_id) REFERENCES realisateur (realisateur_id)');
        $this->addSql('CREATE INDEX realisateur_id ON film (realisateur_id)');
        $this->addSql('ALTER TABLE film ADD PRIMARY KEY (film_id)');
        $this->addSql('ALTER TABLE jouer MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON jouer');
        $this->addSql('ALTER TABLE jouer ADD film_id VARCHAR(50) NOT NULL, ADD acteur_id VARCHAR(50) NOT NULL, DROP id, DROP role');
        $this->addSql('ALTER TABLE jouer ADD CONSTRAINT jouer_ibfk_1 FOREIGN KEY (film_id) REFERENCES film (film_id)');
        $this->addSql('ALTER TABLE jouer ADD CONSTRAINT jouer_ibfk_2 FOREIGN KEY (acteur_id) REFERENCES acteur (acteur_id)');
        $this->addSql('CREATE INDEX acteur_id ON jouer (acteur_id)');
        $this->addSql('CREATE INDEX IDX_825E5AED567F5183 ON jouer (film_id)');
        $this->addSql('ALTER TABLE jouer ADD PRIMARY KEY (film_id, acteur_id)');
        $this->addSql('ALTER TABLE realisateur MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON realisateur');
        $this->addSql('ALTER TABLE realisateur ADD realisateur_id VARCHAR(50) NOT NULL, DROP id');
        $this->addSql('ALTER TABLE realisateur ADD PRIMARY KEY (realisateur_id)');
        $this->addSql('ALTER TABLE utilisateur MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD utilisateur_id VARCHAR(50) NOT NULL, DROP id, CHANGE email email VARCHAR(50) NOT NULL, CHANGE role role VARCHAR(50) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX email ON utilisateur (email)');
        $this->addSql('ALTER TABLE utilisateur ADD PRIMARY KEY (utilisateur_id)');
    }
}
