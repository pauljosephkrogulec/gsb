<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200929185548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brands (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense_categories (id INT AUTO_INCREMENT NOT NULL, wording VARCHAR(80) NOT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense_report_lines (id INT AUTO_INCREMENT NOT NULL, expense_report_id INT NOT NULL, expense_category_id INT NOT NULL, wording VARCHAR(191) NOT NULL, quantity SMALLINT NOT NULL, amount DOUBLE PRECISION NOT NULL, expense_date DATE NOT NULL, INDEX IDX_2B9AD8F8F758FBA (expense_report_id), INDEX IDX_2B9AD8F6B2A3179 (expense_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense_report_statues (id INT AUTO_INCREMENT NOT NULL, wording VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense_reports (id INT AUTO_INCREMENT NOT NULL, expences_report_status_id INT NOT NULL, user_id INT NOT NULL, report_date DATE NOT NULL, INDEX IDX_9C04EC7FA55DFD7D (expences_report_status_id), INDEX IDX_9C04EC7FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(80) NOT NULL, name VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT DEFAULT NULL, first_name VARCHAR(80) NOT NULL, last_name VARCHAR(80) NOT NULL, email VARCHAR(191) NOT NULL, password VARCHAR(191) NOT NULL, adress VARCHAR(191) NOT NULL, city VARCHAR(80) NOT NULL, postal_code VARCHAR(5) NOT NULL, token VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_roles (users_id INT NOT NULL, roles_id INT NOT NULL, INDEX IDX_51498A8E67B3B43D (users_id), INDEX IDX_51498A8E38C751C4 (roles_id), PRIMARY KEY(users_id, roles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicles (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, model VARCHAR(30) NOT NULL, matriculation VARCHAR(9) DEFAULT NULL, INDEX IDX_1FCE69FA44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expense_report_lines ADD CONSTRAINT FK_2B9AD8F8F758FBA FOREIGN KEY (expense_report_id) REFERENCES expense_reports (id)');
        $this->addSql('ALTER TABLE expense_report_lines ADD CONSTRAINT FK_2B9AD8F6B2A3179 FOREIGN KEY (expense_category_id) REFERENCES expense_categories (id)');
        $this->addSql('ALTER TABLE expense_reports ADD CONSTRAINT FK_9C04EC7FA55DFD7D FOREIGN KEY (expences_report_status_id) REFERENCES expense_report_statues (id)');
        $this->addSql('ALTER TABLE expense_reports ADD CONSTRAINT FK_9C04EC7FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicles (id)');
        $this->addSql('ALTER TABLE users_roles ADD CONSTRAINT FK_51498A8E67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_roles ADD CONSTRAINT FK_51498A8E38C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicles ADD CONSTRAINT FK_1FCE69FA44F5D008 FOREIGN KEY (brand_id) REFERENCES brands (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicles DROP FOREIGN KEY FK_1FCE69FA44F5D008');
        $this->addSql('ALTER TABLE expense_report_lines DROP FOREIGN KEY FK_2B9AD8F6B2A3179');
        $this->addSql('ALTER TABLE expense_reports DROP FOREIGN KEY FK_9C04EC7FA55DFD7D');
        $this->addSql('ALTER TABLE expense_report_lines DROP FOREIGN KEY FK_2B9AD8F8F758FBA');
        $this->addSql('ALTER TABLE users_roles DROP FOREIGN KEY FK_51498A8E38C751C4');
        $this->addSql('ALTER TABLE expense_reports DROP FOREIGN KEY FK_9C04EC7FA76ED395');
        $this->addSql('ALTER TABLE users_roles DROP FOREIGN KEY FK_51498A8E67B3B43D');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9545317D1');
        $this->addSql('DROP TABLE brands');
        $this->addSql('DROP TABLE expense_categories');
        $this->addSql('DROP TABLE expense_report_lines');
        $this->addSql('DROP TABLE expense_report_statues');
        $this->addSql('DROP TABLE expense_reports');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_roles');
        $this->addSql('DROP TABLE vehicles');
    }
}
