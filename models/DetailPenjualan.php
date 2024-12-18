<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_penjualan".
 *
 * @property int $no
 * @property int $id_penjualan
 * @property int $id_barang
 * @property int $jumlah_barang_keluar
 *
 * @property Barang $barang
 * @property TransaksiPenjualan $penjualan
 */
class DetailPenjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no', 'id_penjualan', 'id_barang', 'jumlah_barang_keluar'], 'required'],
            [['no', 'id_penjualan', 'id_barang', 'jumlah_barang_keluar'], 'integer'],
            [['no'], 'unique'],
            [['id_penjualan'], 'exist', 'skipOnError' => true, 'targetClass' => TransaksiPenjualan::class, 'targetAttribute' => ['id_penjualan' => 'id']],
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
            'id_penjualan' => 'Id Penjualan',
            'id_barang' => 'Id Barang',
            'jumlah_barang_keluar' => 'Jumlah Barang Keluar',
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
     * Gets query for [[Penjualan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenjualan()
    {
        return $this->hasOne(TransaksiPenjualan::class, ['id' => 'id_penjualan']);
    }
}
