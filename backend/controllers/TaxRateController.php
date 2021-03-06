<?php

class TaxRateController extends CrudController
{
	public $modelName = 'TaxRate';
	
	public function actionView($id) {
		parent::view($id, $this->modelName);
	}

	public function actionCreate() {		
		$model = new TaxRate;
		$description = new TaxRateDescription;
		$this->performAjaxValidation(array($model,$description), 'tax-rate-form');
		
		if (isset($_POST[$this->modelName])) {
			$model->setAttributes($_POST[$this->modelName]);
			$description->setAttributes($_POST[$this->modelName.'Description']);
			$suc = Yii::t('info','TaxRate was successfully created');
			$err = Yii::t('info','Could not update TaxRate');
			$description->tax_rate_id = 0;
			$description->locale_code = Yii::app()->getLanguage();
			if ($model->validate() && $description->validate()){
				if ($model->save()) {
					$description->tax_rate_id = $model->id;
					$description->save();
					
					Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,$suc);
					if (Yii::app()->getRequest()->getIsAjaxRequest()){
						$this->renderPartial('_view', array('model' => $model, 'description' => $description), false, true);					
						Yii::app()->end();
					}else
						$this->redirect(array('view', 'id' => $model->id));
				}else{
					Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,$err);
				}
			}else $description->validate();
		}
		if (Yii::app()->getRequest()->getIsAjaxRequest()){
			$this->renderPartial('_form', array('model' => $model, 'description' => $description), false, true);
			Yii::app()->end();
		}
		$this->render('create', array( 'model' => $model, 'description' => $description));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, $this->modelName);
		$description = $model->taxRateDescriptions[0];
		$this->performAjaxValidation(array($model,$description), 'tax-rate-form');
		
		if (isset($_POST[$this->modelName])) {
			$model->setAttributes($_POST[$this->modelName]);
			$description->setAttributes($_POST[$this->modelName.'Description']);
			$suc = Yii::t('info','TaxRate was successfully updated');
			$err = Yii::t('info','Could not update TaxRate');
			if ($model->validate() && $description->validate()){
				if ($model->save()) {
					$description->tax_rate_id = $model->id;
					$description->save();
					
					Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,$suc);
					if (Yii::app()->getRequest()->getIsAjaxRequest()){
						$this->renderPartial('_view', array('model' => $model, 'description' => $description), false, true);					
						Yii::app()->end();
					}else
						$this->redirect(array('view', 'id' => $model->id));
				}else{
					Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR,$err);
				}
			}else $description->validate();
		}
		if (Yii::app()->getRequest()->getIsAjaxRequest()){
			$this->renderPartial('_form', array('model' => $model, 'description' => $description), false, true);
			Yii::app()->end();
		}
		$this->render('update', array( 'model' => $model, 'description' => $description));
	}
	
	public function actionDelete($id) {
			parent::delete($id, $this->modelName, array('taxRateDescriptions'));
	}
	
	public function actionBatchDelete() {
			parent::batchDelete($this->modelName, array('taxRateDescriptions'));
	}
	
	public function actionExportSelected() {
		$criteriaWith = array();
		$exportfield = array(
		'id',
		'geo_zone_id',
		'rate',
		'date_added',
		'date_modified',
		);
		 		$criteriaWith = array(
			'taxRateDescriptions'=>array(
                          'together'=>true
                     ),
		);
		parent::exportSelected($this->modelName, 't.id', $criteriaWith, $exportfield);
	}
	
	public function actionExportAll() {
		$criteriaWith = array();
		$exportfield = array(
		'id',
		'geo_zone_id',
		'rate',
		'date_added',
		'date_modified',
		);
		$criteriaWith = array(
			'taxRateDescriptions'=>array(
                          'together'=>true
                     ),
		);
		
		parent::exportAll($this->modelName, $criteriaWith, $exportfield);
	}

	public function actionIndex() {
		$dorder = '';
		$modelName = $this->modelName;
		if($modelName::model()->hasAttribute('sort_order'))
			$dorder = 't.sort_order ASC';
		else if($modelName::model()->hasAttribute('id'))
			$dorder = 't.id DESC';
		$criteriaWith = $attr = array();
		$criteriaWith = array(
			'taxRateDescriptions'=>array(
                          'together'=>true
                     ),
		);
		$attr['name'] = array('asc' => 'taxRateDescriptions.name ASC', 'desc' => 'taxRateDescriptions.name DESC');
		
		$attr[] = '*';
		$sort = array( 'defaultOrder' => $dorder, 'attributes' => $attr);
		parent::index($this->modelName, $sort, $criteriaWith);
	}

	public function actionAdmin() {
		$model = new TaxRate('search');
		parent::admin($model, $this->modelName);	
	}
}
