<?php
/**
 * This is the model base class for the table "option_value_description".
 * DO NOT MODIFY THIS FILE! It is automatically generated.
 * If any changes are necessary, you must set or override the required
 * property or method in class "OptionValueDescription".
 *
 * The followings are the available columns in table 'option_value_description':
 * @property integer $option_value_id
 * @property string $locale_code
 * @property integer $option_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property OptionValue $optionValue
 * @property Option $option
 */
abstract class BaseOptionValueDescription extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OptionValueDescription the static model class
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
		return 'option_value_description';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('option_value_id, locale_code, option_id, name', 'required'),
			array('option_value_id, option_id', 'numerical', 'integerOnly'=>true),
			array('locale_code', 'length', 'max'=>5),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('option_value_id, locale_code, option_id, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.

		$localeCode = Yii::app()->getLanguage(); 

		return array(
			'optionValue' => array(self::BELONGS_TO, 'OptionValue', 'option_value_id'),
			'option' => array(self::BELONGS_TO, 'Option', 'option_id'),
		);
	}

	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'option_value_id' => Yii::t('label', 'Option Value'),
			'locale_code' => Yii::t('label', 'Locale Code'),
			'option_id' => Yii::t('label', 'Option'),
			'name' => Yii::t('label', 'Name'),
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
		$criteria->compare('option_value_id',$this->option_value_id);
		$criteria->compare('locale_code',$this->locale_code,true);
		$criteria->compare('option_id',$this->option_id);
		$criteria->compare('name',$this->name,true);
		$dorder = '';
		if($this->hasAttribute('sort_order')){
			$dorder = 't.sort_order ASC';
		}
		else if($this->hasAttribute('id')){
			$dorder = 't.id DESC';
		}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array(
					'defaultOrder' => $dorder,
					'attributes' => array(			
							'*',
					),
			),		
        	'pagination'=>array(
				'pageSize'=>100,
			),
		));
	}
}