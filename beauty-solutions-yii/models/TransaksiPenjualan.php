<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi_penjualan".
 *
 * @property int $id
 * @property int $id_owner
 * @property string|null $tanggal
 *
 * @property DetailPenjualan[] $detailPenjualans
 * @property Owner $owner
 */
class TransaksiPenjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_owner'], 'required'],
            [['id', 'id_owner'], 'integer'],
            [['tanggal'], 'safe'],
            [['id'], 'unique'],
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
            'id_owner' => 'Id Owner',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * Gets query for [[DetailPenjualans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, ['id_penjualan' => 'id']);
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
