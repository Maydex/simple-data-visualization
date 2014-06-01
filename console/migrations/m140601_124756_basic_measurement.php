<?php

use yii\db\Schema;

class m140601_124756_basic_measurement extends \yii\db\Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->createTable(
            \common\models\Measurement::TABLE_NAME,
            [
                'id' => Schema::TYPE_PK,
                'value' => sprintf('%s NOT NULL', Schema::TYPE_FLOAT),
                'dateTime' => sprintf('%s NOT NULL', Schema::TYPE_DATETIME),
            ]
        );

        $this->addForeignKey(
            'subjectFK',
            \common\models\Measurement::TABLE_NAME,
            'subject',
            \common\models\Subject::TABLE_NAME,
            'id'
        );
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->dropForeignKey('subjectFK', \common\models\Measurement::TABLE_NAME);
        $this->dropTable(\common\models\Measurement::TABLE_NAME);
    }
}
