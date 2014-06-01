<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace backend\controllers;

use backend\events\MeasurementEvents;
use backend\events\TooBigValueEvent;
use backend\events\TooSmallValueEvent;
use common\models\Measurement;
use common\models\Subject;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\NotFoundHttpException;

/**
 * Class MesurementController
 * @package backend\controllers
 */
class MeasurementController extends \yii\rest\Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    /**
     * @param $subjectSlug
     * @param $values
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAddMeasurement($subjectSlug, $values)
    {
        $subject = Subject::findOne(['slug' => $subjectSlug]);
        if (null == $subject) {
            throw new NotFoundHttpException('There is no such subject');
        }

        /** @var Measurement $measurement */
        foreach ($measurements = $this->transformToArray($subject, $values) as $measurement) {
            if ($measurement->validate()) {
                $measurement->save(false);
            } else {
                return [[$measurement, $measurement->getErrors()]];
            }
        }

        return $measurements;
    }

    /**
     * @param Subject $subject
     * @param         $values
     *
     * @return array
     */
    public function transformToArray(Subject $subject, $values)
    {
        $splittedValues = preg_split(\Yii::$app->params['separatorSign'], $values);
        $result = [];

        foreach ($splittedValues as $value) {
            preg_match(\Yii::$app->params['restQueryRegExp'], $value, $matchGroups);
            $measurement = new Measurement();
            $measurement->dateTime = (new \DateTime())
                ->setDate($matchGroups['year'], $matchGroups['month'], $matchGroups['day'])
                ->setTime($matchGroups['hour'], $matchGroups['minute'], $matchGroups['second'])
                ->format('Y-m-d H:i:s');

            $measurement->link('subject', $subject);
            $measurement->value = $matchGroups['value'];

            if ($measurement->value > $subject->maxValue) {
                \Yii::$app->trigger(
                    MeasurementEvents::TOO_BIG_VALUE,
                    new TooBigValueEvent($measurement)
                );
            } else if ($measurement->value < $subject->minValue) {
                \Yii::$app->trigger(
                    MeasurementEvents::TOO_SMALL_VALUE,
                    new TooSmallValueEvent($measurement)
                );
            } else {
                $result[] = $measurement;
            }
        }

        return $result;
    }
}
