<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209153355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE a (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE a_produits (a_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_AB4B897A3BDE5358 (a_id), INDEX IDX_AB4B897ACD11A2CF (produits_id), PRIMARY KEY(a_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE a_produits ADD CONSTRAINT FK_AB4B897A3BDE5358 FOREIGN KEY (a_id) REFERENCES a (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE a_produits ADD CONSTRAINT FK_AB4B897ACD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE a_produits DROP FOREIGN KEY FK_AB4B897A3BDE5358');
        $this->addSql('DROP TABLE a');
        $this->addSql('DROP TABLE a_produits');
    }
}
