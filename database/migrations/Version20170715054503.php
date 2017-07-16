<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20170715054503 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA site');
        $this->addSql('CREATE TABLE site.client (
            id SERIAL NOT NULL, 
            name VARCHAR(50) NOT NULL, 
            surname VARCHAR(50) NOT NULL, 
            code VARCHAR(50) NOT NULL, 
            email VARCHAR(255) NOT NULL, 
            address VARCHAR(255) NOT NULL, 
            city VARCHAR(100) NOT NULL, 
            country VARCHAR(100) NOT NULL, PRIMARY KEY(id))
        ');
        $this->addSql('
            CREATE OR REPLACE FUNCTION site.create_client(
                _id INTEGER, 
                _name VARCHAR(50), 
                _surname VARCHAR(50), 
                _code VARCHAR(50), 
                _email VARCHAR(255), 
                _address VARCHAR(255), 
                _city VARCHAR(100), 
                _country VARCHAR(100))
            RETURNS void AS
            $BODY$
            BEGIN
                INSERT INTO site.client(
                    id,
                    name, 
                    surname, 
                    code, 
                    email, 
                    address, 
                    city, 
                    country
                ) VALUES(
                    _id,
                    _name, 
                    _surname, 
                    _code, 
                    _email, 
                    _address, 
                    _city, 
                    _country
                );
            END;
            $BODY$
            LANGUAGE \'plpgsql\' VOLATILE
             COST 100;
        ');

        $this->addSql('
            CREATE OR REPLACE FUNCTION site.update_client(
                _id INTEGER, 
                _name VARCHAR(50), 
                _surname VARCHAR(50), 
                _code VARCHAR(50), 
                _email VARCHAR(255), 
                _address VARCHAR(255), 
                _city VARCHAR(100), 
                _country VARCHAR(100))
            RETURNS void AS
            $BODY$
            BEGIN
                UPDATE site.client SET
                    name = _name, 
                    surname = _surname, 
                    code = _code, 
                    email = _email, 
                    address = _address, 
                    city = _city, 
                    country = _country
                WHERE
                    id=_id;
            END;
            $BODY$
            LANGUAGE \'plpgsql\' VOLATILE
             COST 100;
        ');

        $this->addSql('
            CREATE OR REPLACE FUNCTION site.delete_client(
                _id INTEGER
                )
            RETURNS void AS
            $BODY$
            BEGIN
                DELETE FROM site.client
                WHERE
                    id=_id;
            END;
            $BODY$
            LANGUAGE \'plpgsql\' VOLATILE
             COST 100;
        ');

        $this->addSql('CREATE VIEW site.client_view AS
            SELECT *
            FROM site.client;
        ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP FUNCTION IF EXISTS site.create_client(_id INTEGER, 
                _name VARCHAR(50), 
                _surname VARCHAR(50), 
                _code VARCHAR(50), 
                _email VARCHAR(255), 
                _address VARCHAR(255), 
                _city VARCHAR(100), 
                _country VARCHAR(100));');
        $this->addSql('DROP FUNCTION IF EXISTS site.update_client(_id INTEGER, 
                _name VARCHAR(50), 
                _surname VARCHAR(50), 
                _code VARCHAR(50), 
                _email VARCHAR(255), 
                _address VARCHAR(255), 
                _city VARCHAR(100), 
                _country VARCHAR(100));');
        $this->addSql('DROP FUNCTION IF EXISTS site.delete_client(_id INTEGER);');
        $this->addSql('DROP VIEW site.client_view;');
        $this->addSql('DROP TABLE site.client CASCADE');
        $this->addSql('DROP SCHEMA site');
    }
}
