<?php

use yii\db\Schema;

class m140601_120921_subject_presentation_type extends \yii\db\Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->addColumn(
            \common\models\Subject::TABLE_NAME,
            'presentationType',
            Schema::TYPE_STRING
        );
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->dropColumn(\common\models\Subject::TABLE_NAME, 'presentationType');
    }
}
