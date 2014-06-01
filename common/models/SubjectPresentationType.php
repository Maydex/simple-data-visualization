<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace common\models;

/**
 * Class SubjectPresentationType
 * @package common\models
 */
class SubjectPresentationType
{
    const PIE_CHART     = 'pie';
    const LINE_CHART    = 'line';
    const COLUMN_CHART  = 'column';

    /**
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::PIE_CHART,
            self::LINE_CHART,
            self::COLUMN_CHART,
        ];
    }

    /**
     * @param string $translationDomain
     *
     * @return array
     */
    public static function getTypesWithTranslations($translationDomain = 'app')
    {
        $result = [];
        foreach (self::getTypes() as $type) {
            $result[$type] = \Yii::t($translationDomain, $type);
        }

        return $result;
    }
}
