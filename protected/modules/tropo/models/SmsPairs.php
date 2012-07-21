<?php

/**
 * This is the model class for table "sms_pairs".
 *
 * The followings are the available columns in table 'sms_pairs':
 * @property integer $id
 * @property integer $alice_cvid
 * @property integer $bob_cvid
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CidVcidLookup $bobCv
 * @property CidVcidLookup $aliceCv
 */
class SmsPairs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SmsPairs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sms_pairs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alice_cvid, bob_cvid, status', 'required'),
			array('alice_cvid, bob_cvid, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, alice_cvid, bob_cvid, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'bobCv' => array(self::BELONGS_TO, 'CidVcidLookup', 'bob_cvid'),
			'aliceCv' => array(self::BELONGS_TO, 'CidVcidLookup', 'alice_cvid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'alice_cvid' => 'Alice Cvid',
			'bob_cvid' => 'Bob Cvid',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('alice_cvid',$this->alice_cvid);
		$criteria->compare('bob_cvid',$this->bob_cvid);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}