<?php

namespace app\models;

use Cassandra\Date;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "Apple".
 *
 * @property int $id
 * @property float|null $size
 * @property int $status
 * @property string $color
 * @property int $created_at
 * @property int $expired
 * @property int $fall_at
 */
class Apple extends \yii\db\ActiveRecord
{
    const STATUS_ON_TREE = 0;
    const STATUS_FALL_TO_GROUND = 1;
    const STATUS_SPOILED = 2;
    private $_color;
    public function __construct($color = 'red')
    {
        $this->_color = $color;
    }

    public function createTree()
    {
        try
        {
            $this->color = $this->_color;
            $this->size = 100;
            $this->created_at = time();
            $this->save(false);
        }
        catch (\Exception $e)
        {
            Yii::error($e->getMessage(),'writeLog');
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size'], 'number'],
            [['status', 'created_at', 'fall_at'], 'integer'],
            [['color', 'created_at', 'fall_at'], 'required'],
            [['color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'size' => 'Size',
            'status' => 'Status',
            'color' => 'Color',
            'created_at' => 'Created At',
            'fall_at' => 'Fall At',
            'expired' => 'Expired Date'
        ];
    }
}
