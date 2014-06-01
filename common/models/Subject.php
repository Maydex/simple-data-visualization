<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer    $id
 * @property string     $name
 * @property string     $description
 * @property string     $presentationType
 * @property string     $unit
 * @property float      $maxValue
 * @property float      $minValue
 * @property string     $slug
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

            [['unit'], 'string', 'max' => 255],
            [['maxValue'], 'compare', 'compareAttribute' => 'minValue', 'operator' => '>'],
            [['minValue'], 'compare', 'compareAttribute' => 'maxValue', 'operator' => '<'],
            [['minValue', 'maxValue'], 'number'],

            [['name', 'description', 'presentationType', 'unit', 'maxValue', 'minValue'], 'required'],
            [['name', 'description', 'unit'], 'filter', 'filter' => 'trim'],
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
            'unit' => Yii::t('app', 'Unit'),
            'minValue' => Yii::t('app', 'Min value'),
            'maxValue' => Yii::t('app', 'Max value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeasurements()
    {
        return $this->hasMany(Measurement::className(), ['subject' => 'id']);
    }

    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'source_attribute' => 'name',
                'slug_attribute' => 'slug',

                // optional params
                'translit' => true,
                'replacement' => '-',
                'lowercase' => true,
                'unique' => true
            ]
        ];
    }
}
