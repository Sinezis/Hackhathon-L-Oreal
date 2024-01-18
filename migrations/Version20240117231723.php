<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240117231723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('ALTER TABLE product ADD product_id INT AUTO_INCREMENT NOT NULL, ADD product_name LONGTEXT NOT NULL, ADD product_category LONGTEXT NOT NULL, DROP productId, DROP productName, DROP productCategory, CHANGE brand brand LONGTEXT NOT NULL, ADD PRIMARY KEY (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product MODIFY product_id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON product');
        $this->addSql('ALTER TABLE product ADD productId TEXT DEFAULT NULL, ADD productName TEXT DEFAULT NULL, ADD productCategory TEXT DEFAULT NULL, DROP product_id, DROP product_name, DROP product_category, CHANGE brand brand TEXT DEFAULT NULL');
    }
}
