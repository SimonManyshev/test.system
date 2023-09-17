<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace <namespace>;

use App\Shared\Infrastructure\Migration\AppAbstractMigration;
use Doctrine\DBAL\Schema\Schema;

final class <className> extends AppAbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {<up>
        $multiSql = <<<SQL

        SQL;

        $this->addMultiSql($multiSql);
    }<override>
}
