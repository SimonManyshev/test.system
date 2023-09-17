<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace DoctrineMigrations;

use App\Shared\Infrastructure\Migration\AppAbstractMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20230917085912 extends AppAbstractMigration
{
    public function getDescription(): string
    {
        return 'Создает схемы DICTIONARY и TESTING';
    }

    public function up(Schema $schema): void
    {
        $multiSql = <<<SQL
            CREATE SCHEMA DICTIONARY;
            CREATE SCHEMA TESTING;
        SQL;

        $this->addMultiSql($multiSql);
    }
}
