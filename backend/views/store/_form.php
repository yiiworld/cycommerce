<?php
/* @var $this StoreController */
/* @var $model Store */
/* @var $form CActiveForm */
?>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?><div class="form aform">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'store-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ssl'); ?>
		<?php echo $form->textField($model,'ssl',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ssl'); ?>
	</div>

	<div class="row buttons">
		<?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('color' => TbHtml::BUTTON_COLOR_SUCCESS)); ?>
		<?php echo TbHtml::linkButton(Yii::t('label','Cancel'), array('class'=>'cancelButton','color' => TbHtml::BUTTON_COLOR_DANGER, 'url'=>Yii::app()->createUrl('store/admin')));?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="hlinks hide">
<div class="uid"><?php echo $model->id; ?></div>
</div>