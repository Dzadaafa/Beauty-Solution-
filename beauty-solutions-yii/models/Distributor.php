<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distributor".
 *
 * @property int $id
 * @property string $nama
 *
 * @property TransaksiPembelian[] $transaksiPembelians
 */
class Distributor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distributor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama'], 'required'],
            [['id'], 'integer'],
            [['nama'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * Gets query for [[TransaksiPembelians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiPembelians()
    {
        return $this->hasMany(TransaksiPembelian::class, ['id_distributor' => 'id']);
    }
}
