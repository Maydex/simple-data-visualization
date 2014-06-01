<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "measurement".
 *
 * @property integer $id
 * @property double $value
 * @property \DateTime $dateTime
 *
 * @property Subject $subject
 */
class Measurement extends \yii\db\ActiveRecord
{
    const TABLE_NAME = 'measurement';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return self::TABLE_NAME;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'number'],
            [['value'], 'required'],
            [['dateTime'], 'date', 'format' => 'Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject' => Yii::t('app', 'Subject'),
            'value' => Yii::t('app', 'Value'),
            'dateTime' => Yii::t('app', 'Date Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject']);
    }
}
