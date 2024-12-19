<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "owner".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $no_telepon
 *
 * @property TransaksiPembelian[] $transaksiPembelians
 * @property TransaksiPenjualan[] $transaksiPenjualans
 */
class Owner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'owner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama', 'alamat', 'no_telepon'], 'required'],
            [['id'], 'integer'],
            [['nama'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 100],
            [['no_telepon'], 'string', 'max' => 13],
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
            'alamat' => 'Alamat',
            'no_telepon' => 'No Telepon',
        ];
    }

    /**
     * Gets query for [[TransaksiPembelians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiPembelians()
    {
        return $this->hasMany(TransaksiPembelian::class, ['id_owner' => 'id']);
    }

    /**
     * Gets query for [[TransaksiPenjualans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiPenjualans()
    {
        return $this->hasMany(TransaksiPenjualan::class, ['id_owner' => 'id']);
    }
}
