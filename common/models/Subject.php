<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $presentationType
 */
class Subject extends \yii\db\ActiveRecord
{
    const TABLE_NAME = 'subject';

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
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['presentationType'], 'string', 'max' => 255],
            [['presentationType'], 'in', 'range' => SubjectPresentationType::getTypes()],
            [['presentationType'], 'default', 'value' => SubjectPresentationType::LINE_CHART],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'presentationType' => Yii::t('app', 'Presentation type'),
        ];
    }
}
