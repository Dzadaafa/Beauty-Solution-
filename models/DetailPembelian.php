<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_pembelian".
 *
 * @property int $no
 * @property int $id_pembelian
 * @property int $id_barang
 * @property int $jumlah_barang_masuk
 * @property int $harga_beli
 *
 * @property Barang $barang
 * @property TransaksiPembelian $pembelian
 */
class DetailPembelian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no', 'id_pembelian', 'id_barang', 'jumlah_barang_masuk', 'harga_beli'], 'required'],
            [['no', 'id_pembelian', 'id_barang', 'jumlah_barang_masuk', 'harga_beli'], 'integer'],
            [['no'], 'unique'],
            [['id_pembelian'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiPembelian::class, 'targetAttribute' => ['id_pembelian' => 'id']],
            [['id_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::class, 'targetAttribute' => ['id_barang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no' => 'No',
            'id_pembelian' => 'Id Pembelian',
            'id_barang' => 'Id Barang',
            'jumlah_barang_masuk' => 'Jumlah Barang Masuk',
            'harga_beli' => 'Harga Beli',
        ];
    }

    /**
     * Gets query for [[Barang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::class, ['id' => 'id_barang']);
    }

    /**
     * Gets query for [[Pembelian]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPembelian()
    {
        return $this->hasOne(TransaksiPembelian::class, ['id' => 'id_pembelian']);
    }
}
