<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace DoctrineMigrations;

use App\Shared\Infrastructure\Migration\AppAbstractMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20230917132411 extends AppAbstractMigration
{
    public function getDescription(): string
    {
        return 'Создает и заполняет dictionary.response';
    }

    public function up(Schema $schema): void
    {
        $multiSql = <<<SQL
            CREATE SEQUENCE "dictionary_response_id_seq" INCREMENT BY 1 MINVALUE 1 START 1;

            CREATE TABLE dictionary.response (
                id INT PRIMARY KEY DEFAULT NEXTVAL('dictionary_response_id_seq'),
                text VARCHAR(512) NOT NULL
            );

            COMMENT ON TABLE dictionary.response IS 'Справочник ответов';

            COMMENT ON COLUMN dictionary.response.id IS 'Уникальный идентификатор ответа';
            COMMENT ON COLUMN dictionary.response.text IS 'Текст ответа';

        --- 
            INSERT INTO dictionary.response (id, text) VALUES (1, '0');
            INSERT INTO dictionary.response (id, text) VALUES (2, '1');
            INSERT INTO dictionary.response (id, text) VALUES (3, '2');
            INSERT INTO dictionary.response (id, text) VALUES (4, '3');
            INSERT INTO dictionary.response (id, text) VALUES (5, '4');
            INSERT INTO dictionary.response (id, text) VALUES (6, '5');
            INSERT INTO dictionary.response (id, text) VALUES (7, '6');
            INSERT INTO dictionary.response (id, text) VALUES (8, '7');
            INSERT INTO dictionary.response (id, text) VALUES (9, '8');
            INSERT INTO dictionary.response (id, text) VALUES (10, '9');
            INSERT INTO dictionary.response (id, text) VALUES (11, '10');
            INSERT INTO dictionary.response (id, text) VALUES (12, '12');
            INSERT INTO dictionary.response (id, text) VALUES (13, '14');
            INSERT INTO dictionary.response (id, text) VALUES (14, '16');
            INSERT INTO dictionary.response (id, text) VALUES (15, '18');
            INSERT INTO dictionary.response (id, text) VALUES (16, '20');

            INSERT INTO dictionary.response (id, text) VALUES (17, '3 + 1');
            INSERT INTO dictionary.response (id, text) VALUES (18, '1 + 5');
            INSERT INTO dictionary.response (id, text) VALUES (19, '2 + 4');
            INSERT INTO dictionary.response (id, text) VALUES (20, '0 + 8');
            INSERT INTO dictionary.response (id, text) VALUES (21, '5 + 7');
            INSERT INTO dictionary.response (id, text) VALUES (22, '17 + 1');
            INSERT INTO dictionary.response (id, text) VALUES (23, '2 + 16');
        SQL;

        $this->addMultiSql($multiSql);
    }
}
