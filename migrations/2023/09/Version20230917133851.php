<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace DoctrineMigrations;

use App\Shared\Infrastructure\Migration\AppAbstractMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20230917133851 extends AppAbstractMigration
{
    public function getDescription(): string
    {
        return 'Создает и заполняет таблицу связей "Тест-Вопрос-Ответ" dictionary.relation';
    }

    public function up(Schema $schema): void
    {
        $multiSql = <<<SQL
            CREATE SEQUENCE "dictionary_relation_id_seq" INCREMENT BY 1 MINVALUE 1 START 1;

            CREATE TABLE dictionary.relation (
                id INT PRIMARY KEY DEFAULT NEXTVAL('dictionary_relation_id_seq'),
                test_id INT NOT NULL,
                question_id INT NOT NULL,
                response_id INT NOT NULL,
                is_right BOOLEAN NOT NULL
            );
        --- Внешние ключи
            ALTER TABLE dictionary.relation
                ADD CONSTRAINT test_fk
                FOREIGN KEY (test_id)
                REFERENCES dictionary.test(id);

            ALTER TABLE dictionary.relation
                ADD CONSTRAINT question_fk
                FOREIGN KEY (question_id)
                REFERENCES dictionary.question(id);

            ALTER TABLE dictionary.relation
                ADD CONSTRAINT response_fk
                FOREIGN KEY (response_id)
                REFERENCES dictionary.response(id);

        --- Комментарии
            COMMENT ON TABLE dictionary.relation IS 'Таблица связей "Тест-Вопрос-Ответ"';

            COMMENT ON COLUMN dictionary.relation.id IS 'Уникальный идентификатор связи';
            COMMENT ON COLUMN dictionary.relation.test_id IS 'Ссылка на ID теста (dictionary.test.id)';
            COMMENT ON COLUMN dictionary.relation.question_id IS 'Ссылка на ID вопроса (dictionary.question.id)';
            COMMENT ON COLUMN dictionary.relation.response_id IS 'Ссылка на ID ответа (dictionary.response.id)';
            COMMENT ON COLUMN dictionary.relation.is_right IS 'Флаг верного ответа';

        --- 1 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (1, 1, 1, 4, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (2, 1, 1, 3, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (3, 1, 1, 1, false);
        --- 2 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (4, 1, 2, 5, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (5, 1, 2, 17, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (6, 1, 2, 11, false);
        --- 3 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (7, 1, 3, 18, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (8, 1, 3, 2, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (9, 1, 3, 7, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (10, 1, 3, 19, true);
        --- 4 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (11, 1, 4, 9, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (12, 1, 4, 5, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (13, 1, 4, 1, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (14, 1, 4, 20, true);
        --- 5 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (15, 1, 5, 7, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (16, 1, 5, 15, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (17, 1, 5, 11, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (18, 1, 5, 10, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (19, 1, 5, 1, false);
        --- 6 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (20, 1, 6, 4, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (21, 1, 6, 10, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (22, 1, 6, 1, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (23, 1, 6, 12, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (24, 1, 6, 21, true);
        --- 7 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (25, 1, 7, 6, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (26, 1, 7, 13, true);
        --- 8 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (27, 1, 8, 14, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (28, 1, 8, 12, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (29, 1, 8, 10, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (30, 1, 8, 6, false);
        --- 8 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (31, 1, 8, 14, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (32, 1, 8, 12, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (33, 1, 8, 10, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (34, 1, 8, 6, false);
        --- 9 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (35, 1, 9, 15, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (36, 1, 9, 10, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (37, 1, 9, 22, true);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (38, 1, 9, 23, true);
        --- 10 Вопрос
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (39, 1, 10, 1, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (40, 1, 10, 3, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (41, 1, 10, 9, false);
            INSERT INTO dictionary.relation (id, test_id, question_id, response_id, is_right) 
                VALUES (42, 1, 10, 16, true);
        SQL;

        $this->addMultiSql($multiSql);
    }
}
