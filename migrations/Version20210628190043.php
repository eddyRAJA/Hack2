<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628190043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE freelancer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number INT DEFAULT NULL, adress VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE freelancer_project (freelancer_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_A6DFD6B88545BDF5 (freelancer_id), INDEX IDX_A6DFD6B8166D1F9C (project_id), PRIMARY KEY(freelancer_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE freelancer_competence (freelancer_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_EEBBB0018545BDF5 (freelancer_id), INDEX IDX_EEBBB00115761DAB (competence_id), PRIMARY KEY(freelancer_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_competence (project_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_8C72134D166D1F9C (project_id), INDEX IDX_8C72134D15761DAB (competence_id), PRIMARY KEY(project_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE freelancer_project ADD CONSTRAINT FK_A6DFD6B88545BDF5 FOREIGN KEY (freelancer_id) REFERENCES freelancer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE freelancer_project ADD CONSTRAINT FK_A6DFD6B8166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE freelancer_competence ADD CONSTRAINT FK_EEBBB0018545BDF5 FOREIGN KEY (freelancer_id) REFERENCES freelancer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE freelancer_competence ADD CONSTRAINT FK_EEBBB00115761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_competence ADD CONSTRAINT FK_8C72134D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_competence ADD CONSTRAINT FK_8C72134D15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE freelancer_competence DROP FOREIGN KEY FK_EEBBB00115761DAB');
        $this->addSql('ALTER TABLE project_competence DROP FOREIGN KEY FK_8C72134D15761DAB');
        $this->addSql('ALTER TABLE freelancer_project DROP FOREIGN KEY FK_A6DFD6B88545BDF5');
        $this->addSql('ALTER TABLE freelancer_competence DROP FOREIGN KEY FK_EEBBB0018545BDF5');
        $this->addSql('ALTER TABLE freelancer_project DROP FOREIGN KEY FK_A6DFD6B8166D1F9C');
        $this->addSql('ALTER TABLE project_competence DROP FOREIGN KEY FK_8C72134D166D1F9C');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE freelancer');
        $this->addSql('DROP TABLE freelancer_project');
        $this->addSql('DROP TABLE freelancer_competence');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_competence');
    }
}
