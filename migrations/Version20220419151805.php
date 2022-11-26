<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419151805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE roles (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE roles_customers (roles_id INTEGER NOT NULL, customers_id INTEGER NOT NULL, PRIMARY KEY(roles_id, customers_id))');
        $this->addSql('CREATE INDEX IDX_2C7D980038C751C4 ON roles_customers (roles_id)');
        $this->addSql('CREATE INDEX IDX_2C7D9800C3568B40 ON roles_customers (customers_id)');
        $this->addSql('DROP INDEX IDX_5F9E962AF675F31B');
        $this->addSql('DROP INDEX UNIQ_5F9E962A9C0CEBF3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comments AS SELECT id, author_id, c_order_id, comment, rating FROM comments');
        $this->addSql('DROP TABLE comments');
        $this->addSql('CREATE TABLE comments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, c_order_id INTEGER DEFAULT NULL, comment CLOB NOT NULL, rating INTEGER DEFAULT NULL, CONSTRAINT FK_5F9E962AF675F31B FOREIGN KEY (author_id) REFERENCES customers (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5F9E962A9C0CEBF3 FOREIGN KEY (c_order_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comments (id, author_id, c_order_id, comment, rating) SELECT id, author_id, c_order_id, comment, rating FROM __temp__comments');
        $this->addSql('DROP TABLE __temp__comments');
        $this->addSql('CREATE INDEX IDX_5F9E962AF675F31B ON comments (author_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5F9E962A9C0CEBF3 ON comments (c_order_id)');
        $this->addSql('DROP INDEX IDX_E52FFDEE9395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__orders AS SELECT id, customer_id, quantite, order_date FROM orders');
        $this->addSql('DROP TABLE orders');
        $this->addSql('CREATE TABLE orders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id INTEGER NOT NULL, quantite INTEGER NOT NULL, order_date DATETIME NOT NULL, CONSTRAINT FK_E52FFDEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO orders (id, customer_id, quantite, order_date) SELECT id, customer_id, quantite, order_date FROM __temp__orders');
        $this->addSql('DROP TABLE __temp__orders');
        $this->addSql('CREATE INDEX IDX_E52FFDEE9395C3F3 ON orders (customer_id)');
        $this->addSql('DROP INDEX IDX_A0B446ECCFFE9AD6');
        $this->addSql('DROP INDEX IDX_A0B446EC6BB0AE84');
        $this->addSql('CREATE TEMPORARY TABLE __temp__orders_items AS SELECT orders_id, items_id FROM orders_items');
        $this->addSql('DROP TABLE orders_items');
        $this->addSql('CREATE TABLE orders_items (orders_id INTEGER NOT NULL, items_id INTEGER NOT NULL, PRIMARY KEY(orders_id, items_id), CONSTRAINT FK_A0B446ECCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A0B446EC6BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO orders_items (orders_id, items_id) SELECT orders_id, items_id FROM __temp__orders_items');
        $this->addSql('DROP TABLE __temp__orders_items');
        $this->addSql('CREATE INDEX IDX_A0B446ECCFFE9AD6 ON orders_items (orders_id)');
        $this->addSql('CREATE INDEX IDX_A0B446EC6BB0AE84 ON orders_items (items_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE roles_customers');
        $this->addSql('DROP INDEX IDX_5F9E962AF675F31B');
        $this->addSql('DROP INDEX UNIQ_5F9E962A9C0CEBF3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comments AS SELECT id, author_id, c_order_id, comment, rating FROM comments');
        $this->addSql('DROP TABLE comments');
        $this->addSql('CREATE TABLE comments (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, c_order_id INTEGER DEFAULT NULL, comment CLOB NOT NULL, rating INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO comments (id, author_id, c_order_id, comment, rating) SELECT id, author_id, c_order_id, comment, rating FROM __temp__comments');
        $this->addSql('DROP TABLE __temp__comments');
        $this->addSql('CREATE INDEX IDX_5F9E962AF675F31B ON comments (author_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5F9E962A9C0CEBF3 ON comments (c_order_id)');
        $this->addSql('DROP INDEX IDX_E52FFDEE9395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__orders AS SELECT id, customer_id, quantite, order_date FROM orders');
        $this->addSql('DROP TABLE orders');
        $this->addSql('CREATE TABLE orders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id INTEGER NOT NULL, quantite INTEGER NOT NULL, order_date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO orders (id, customer_id, quantite, order_date) SELECT id, customer_id, quantite, order_date FROM __temp__orders');
        $this->addSql('DROP TABLE __temp__orders');
        $this->addSql('CREATE INDEX IDX_E52FFDEE9395C3F3 ON orders (customer_id)');
        $this->addSql('DROP INDEX IDX_A0B446ECCFFE9AD6');
        $this->addSql('DROP INDEX IDX_A0B446EC6BB0AE84');
        $this->addSql('CREATE TEMPORARY TABLE __temp__orders_items AS SELECT orders_id, items_id FROM orders_items');
        $this->addSql('DROP TABLE orders_items');
        $this->addSql('CREATE TABLE orders_items (orders_id INTEGER NOT NULL, items_id INTEGER NOT NULL, PRIMARY KEY(orders_id, items_id))');
        $this->addSql('INSERT INTO orders_items (orders_id, items_id) SELECT orders_id, items_id FROM __temp__orders_items');
        $this->addSql('DROP TABLE __temp__orders_items');
        $this->addSql('CREATE INDEX IDX_A0B446ECCFFE9AD6 ON orders_items (orders_id)');
        $this->addSql('CREATE INDEX IDX_A0B446EC6BB0AE84 ON orders_items (items_id)');
    }
}
