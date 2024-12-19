<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi_pembelian".
 *
 * @property int $id
 * @property int $id_distributor
 * @property int $id_owner
 * @property int $jumlah_bayar
 * @property string|null $tanggal
 *
 * @property DetailPembelian[] $detailPembelians
 * @property Distributor $distributor
 * @property Owner $owner
 */
class TransaksiPembelian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_distributor', 'id_owner', 'jumlah_bayar'], 'required'],
            [['id', 'id_distributor', 'id_owner', 'jumlah_bayar'], 'integer'],
            [['tanggal'], 'safe'],
            [['id'], 'unique'],
            [['id_distributor'], 'exist', 'skipOnError' => true, 'targetClass' => Distributor::class, 'targetAttribute' => ['id_distributor' => 'id']],
            [['id_owner'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::class, 'targetAttribute' => ['id_owner' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_distributor' => 'Id Distributor',
            'id_owner' => 'Id Owner',
            'jumlah_bayar' => 'Jumlah Bayar',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * Gets query for [[DetailPembelians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPembelians()
    {
        return $this->hasMany(DetailPembelian::class, ['id_pembelian' => 'id']);
    }

    /**
     * Gets query for [[Distributor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistributor()
    {
        return $this->hasOne(Distributor::class, ['id' => 'id_distributor']);
    }

    /**
     * Gets query for [[Owner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owner::class, ['id' => 'id_owner']);
    }
}
