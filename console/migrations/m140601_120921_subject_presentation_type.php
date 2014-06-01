<?php

use yii\db\Schema;
use common\models\Subject;

class m140601_120921_subject_presentation_type extends \yii\db\Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->addColumn(
            Subject::TABLE_NAME,
            'presentationType',
            sprintf('%s NOT NULL', Schema::TYPE_STRING)
        );

        $this->addColumn(
            Subject::TABLE_NAME,
            'unit',
            sprintf('%s NOT NULL', Schema::TYPE_STRING)
        );

        $this->addColumn(
            Subject::TABLE_NAME,
            'minValue',
            Schema::TYPE_FLOAT
        );

        $this->addColumn(
            Subject::TABLE_NAME,
            'maxValue',
            Schema::TYPE_FLOAT
        );

        $this->addColumn(
            Subject::TABLE_NAME,
            'slug',
            sprintf('%s NOT NULL', Schema::TYPE_STRING)
        );
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->dropColumn(Subject::TABLE_NAME, 'presentationType');
        $this->dropColumn(Subject::TABLE_NAME, 'unit');
        $this->dropColumn(Subject::TABLE_NAME, 'minValue');
        $this->dropColumn(Subject::TABLE_NAME, 'maxValue');
    }
}
