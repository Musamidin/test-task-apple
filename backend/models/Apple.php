<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Apple".
 *
 * @property int $id
 * @property float|null $size
 * @property int $status
 * @property string $color
 * @property int $created_at
 * @property int $fall_at
 */
class Apple extends \yii\db\ActiveRecord
{
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
        ];
    }
}
