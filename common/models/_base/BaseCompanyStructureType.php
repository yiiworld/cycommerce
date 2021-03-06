<?php

/**
 * This is the model base class for the table "company_structure_type".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CompanyStructureType".
 *
 * Columns in table "company_structure_type" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $create_at
 * @property string $lastedit_at
 *
 */
abstract class BaseCompanyStructureType extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'company_structure_type';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'CompanyStructureType|CompanyStructureTypes', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, create_at', 'required'),
			array('name', 'length', 'max'=>128),
			array('description, lastedit_at', 'safe'),
			array('description, lastedit_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, description, create_at, lastedit_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'description' => Yii::t('app', 'Description'),
			'create_at' => Yii::t('app', 'Create At'),
			'lastedit_at' => Yii::t('app', 'Lastedit At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('create_at', $this->create_at, true);
		$criteria->compare('lastedit_at', $this->lastedit_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}