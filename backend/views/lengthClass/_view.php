<?php $this->widget('bootstrap.widgets.TbAlert'); ?> 
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		array(
			'name'=>'name', 
			'header'=>'Name',
			'value'=>$model->getName(), 
		),
		'id',
		'value',
	),
)); ?>
<div class="hlinks hide">
<div class="uid"><?php echo $model->id; ?></div>
</div>