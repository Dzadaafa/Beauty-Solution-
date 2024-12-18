<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransaksiPembelian;

/**
 * TransaksiPembelianSearch represents the model behind the search form of `app\models\TransaksiPembelian`.
 */
class TransaksiPembelianSearch extends TransaksiPembelian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_distributor', 'id_owner', 'jumlah_bayar'], 'integer'],
            [['tanggal'], 'safe'],
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
        $query = TransaksiPembelian::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_distributor' => $this->id_distributor,
            'id_owner' => $this->id_owner,
            'jumlah_bayar' => $this->jumlah_bayar,
            'tanggal' => $this->tanggal,
        ]);

        return $dataProvider;
    }
}
