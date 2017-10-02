<?php

namespace greeschenko\sysmsgs\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%sysmsgs}}".
 *
 * @property int $id
 * @property string $content
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 * @property int $type
 */
class Sysmsgs extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_READ = 2;
    const STATUS_BLOCK = 3;

    const TYPE_DEFAULT = 1;
    const TYPE_SUCCSESS = 2;
    const TYPE_DANGER = 3;

    public $typelist = [
        self::TYPE_DEFAULT => 'info',
        self::TYPE_SUCCSESS => 'success',
        self::TYPE_DANGER => 'danger',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sysmsgs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'user_id', 'type'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'status', 'type'], 'integer'],
            [['content', 'group'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'type' => 'Type',
        ];
    }

    public static function Push($msg, $user_id, $type = self::TYPE_DEFAULT, $group = '')
    {
        $model = new static();
        $model->content = $msg;
        $model->user_id = $user_id;
        $model->status = self::STATUS_NEW;
        $model->type = $type;
        $model->group = $group;
        if ($model->save()) {
            return true;
        } else {
            throw new \yii\web\HttpException(501, 'sysmsg save error '.json_encode($model->errors));
        }

        return false;
    }
}
