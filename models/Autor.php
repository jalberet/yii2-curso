<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;

use Yii;

/**
 * This is the model class for table "autor".
 *
 * @property int $id
 * @property string $nombres
 * @property string $slug
 * @property int|null $pais_id
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $apellidos
 *
 * @property Libro[] $libros
 * @property Pais $pais
 */
class Autor extends ActiveRecord
{
    public $archivo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'autor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'slug'], 'required'],
            [['archivo'], 'required', 'on' => 'crear'],
            [['pais_id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['pais_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombres', 'slug'], 'string', 'max' => 155],
            [['apellidos', 'foto'], 'string', 'max' => 100],
            [['pais_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pais_id' => 'id']],
            [['foto'], 'string', 'max' => 100],
            [['archivo'], 'image', 'extensions' => 'png'],
        ];
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['crear'] = ['nombres','apellidos','archivo'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres',
            'slug' => 'Slug',
            'pais_id' => 'Pais ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'apellidos' => 'Apellidos',
            'foto' => 'Foto',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute'    => 'created_by',
                'updatedByAttribute'    => 'updated_by',
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'nombres',
                //'slugAttribute' => 'slug',
            ]
            ];
    }

    /**
     * Gets query for [[Libros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibros()
    {
        return $this->hasMany(Libro::className(), ['autor_id' => 'id']);
    }

    /**
     * Gets query for [[Pais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPais()
    {
        return $this->hasOne(Pais::className(), ['id' => 'pais_id']);
    }
    
    public function getNombre()
    {
        return $this->nombres.' '.$this->apellidos;
    }
    
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
