<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace backend\events;

use common\models\Measurement;
use yii\base\Event;
use Yii;

/**
 * Class AbstractMeasurementEvent
 * @package backend\events
 */
abstract class AbstractMeasurementEvent extends Event
{
    /**
     * @var Measurement
     */
    private $measurement;

    public function __construct(Measurement $measurement, $config = [])
    {
        parent::__construct($config);
        $this->measurement = $measurement;
    }

    /**
     * @return \common\models\Measurement
     */
    public function getMeasurement()
    {
        return $this->measurement;
    }
}
