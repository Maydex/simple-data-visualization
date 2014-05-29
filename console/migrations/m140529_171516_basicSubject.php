<?php

use common\models\Subject;
use yii\db\Schema;

/**
 * Class m140529_171516_basicSubject
 * Will create basic table for subject
 */
class m140529_171516_basicSubject extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable(Subject::TABLE_NAME, [
            'id' => 'pk',
            'name' => sprintf('%s NOT NULL', Schema::TYPE_STRING),
            'description' => Schema::TYPE_TEXT,
        ]);

        $this->createIndex(
            'subjectNameUnique',
            Subject::TABLE_NAME,
            'name',
            true
        );
    }

    public function down()
    {
        $this->dropTable(Subject::TABLE_NAME);
    }
}
