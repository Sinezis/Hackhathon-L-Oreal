<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118091153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD id INT AUTO_INCREMENT NOT NULL, ADD category_id INT NOT NULL, ADD name VARCHAR(255) NOT NULL, ADD picture VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, ADD link VARCHAR(255) NOT NULL, DROP productId, DROP productName, DROP productCategory, CHANGE brand brand VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('ALTER TABLE product MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('DROP INDEX `primary` ON product');
        $this->addSql('ALTER TABLE product ADD productId TEXT DEFAULT NULL, ADD productName TEXT DEFAULT NULL, ADD productCategory TEXT DEFAULT NULL, DROP id, DROP category_id, DROP name, DROP picture, DROP description, DROP link, CHANGE brand brand TEXT DEFAULT NULL');
    }
}
