<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'faculties-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="data-cont clearfix">
	<div class="pasport left clearfix">
		<div>						
			<?php echo $form->labelEx($model,'usr_surname'); ?>
			<?php echo $form->textField($model,'usr_surname',array('maxlength'=>50,'required'=>true)); ?>
			<?php echo $form->error($model,'usr_surname'); ?>
		</div>
		<div>
			<?php echo $form->labelEx($model,'usr_name'); ?>
			<?php echo $form->textField($model,'usr_name',array('maxlength'=>50,'required'=>true)); ?>
			<?php echo $form->error($model,'usr_name'); ?>
		</div>
		<div>
			<?php echo $form->labelEx($model,'usr_middle_name'); ?>
			<?php echo $form->textField($model,'usr_middle_name',array('maxlength'=>50)); ?>
			<?php echo $form->error($model,'usr_middle_name'); ?>
		</div>
		<div class="left">
			<?php echo $form->labelEx($model,'usr_passport_series',array('class'=>'pasp-text')); ?>
			<?php echo $form->textField($model,'usr_passport_series',array('maxlength'=>4,'class' => 'pasp')); ?>
			<?php echo $form->error($model,'usr_passport_series'); ?>
		</div>
		<div class="right">
			<?php echo $form->labelEx($model,'usr_passport_number',array('class'=>'number-text')); ?>
			<?php echo $form->textField($model,'usr_passport_number',array('maxlength'=>6,'class' => 'number')); ?>
			<?php echo $form->error($model,'usr_passport_number'); ?>
		</div>
		<div>
			<?php echo $form->labelEx($model,'usr_output'); ?>
			<?php echo $form->textField($model,'usr_output',array('maxlength'=>255)); ?>
			<?php echo $form->error($model,'usr_output'); ?>
		</div>
		<div class="left">
			<?php echo $form->labelEx($model,'usr_output_date',array('class'=>'data-text')); ?>
			<?php echo $form->textField($model,'usr_output_date',array('maxlength'=>20,'class' => 'data')); ?>
			<?php echo $form->error($model,'usr_output_date'); ?>
		</div>
		<div class="right">
			<?php echo $form->labelEx($model,'usr_unit_code',array('class'=>'cod-text')); ?>
			<?php echo $form->textField($model,'usr_unit_code',array('maxlength'=>7,'class' => 'cod')); ?>
			<?php echo $form->error($model,'usr_unit_code'); ?>
		</div>
	</div>
	<div class="telephone right clearfix">
		<h3 class="telephone-h3">Подтверждение номера телефона</h3>
		<div>
			<?php echo $form->labelEx($model,'usr_phone_number'); ?>
			<?php echo $form->textField($model,'usr_phone_number',array('maxlength'=>20)); ?>
			<?php echo $form->error($model,'usr_phone_number'); ?>
		</div>
		<p class="telephone-p">На Ваш номер телефона отправлен 6-значный 
		   код,вводите его в это поле и нажмите 
		   кнопку подвердить
		</p>
		<div>
			<h2>Введите код</h2>
			<input type="text">
		</div>
		<div>
			<a class="code-button" href="#">Выслать еще один код</a>
			<a class="green-button ok" href="#">Подтвердить</a>
		</div>
	</div>
</div>
<div class="agreement">
	<input type="checkbox" id="check_agree"><label for="check_agree">Согласие на обработку моих персональных данных.</label>
	<div class="readme"><?=$this->getParam("AGREEMENT")?></div>
	<input type="submit" disabled class="right green-button disabled agree-btn" value="Сохранить">
</div>
<?php $this->endWidget(); ?>