<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property int $id_barang
 * @property string $nama
 * @property int $harga_jual
 * @property int|null $stok
 *
 * @property DetailPembelian[] $detailPembelians
 * @property DetailPenjualan[] $detailPenjualans
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'harga_jual'], 'required'],
            [['harga_jual', 'stok'], 'integer'],
            [['nama'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_barang' => 'Id Barang',
            'nama' => 'Nama',
            'harga_jual' => 'Harga Jual',
            'stok' => 'Stok',
        ];
    }

    /**
     * Gets query for [[DetailPembelians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPembelians()
    {
        return $this->hasMany(DetailPembelian::class, ['id_barang' => 'id_barang']);
    }

    /**
     * Gets query for [[DetailPenjualans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, ['id_barang' => 'id_barang']);
    }
}
