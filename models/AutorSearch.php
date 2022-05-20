<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Autor;

/**
 * AutorSearch represents the model behind the search form of `app\models\Autor`.
 */
class AutorSearch extends Autor
{
    public $nombres;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pais_id', 'updated_by'], 'integer'],
            [['nombres', 'slug', 'created_at', 'updated_at', 'apellidos', 'created_by'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Autor::find();
        
        $query->joinWith('pais');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'nombres' => SORT_ASC,
                    'created_by' => SORT_DESC
                ],
                'attributes' => [
                    'nombres',
                    'pais_id' => [
                        'ASC' => ['pais.pais' => SORT_ASC],
                        'DESC' => ['pais.pais' => SORT_DESC]
                    ],
                    'created_by'
                ]
            ]
        ]);
        $query->joinWith('createdBy');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pais_id' => $this->pais_id,
            //'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(
            [
                'like', "concat(autor.nombres, ' ', autor.apellidos)", $this->nombres
            ])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'user.username', $this->created_by])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos]);

        return $dataProvider;
    }
}
