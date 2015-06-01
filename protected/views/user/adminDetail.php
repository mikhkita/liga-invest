<div class="b-popup">
	<h1>Редактирование пользователя</h1>
	<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'faculties-form',
			'enableAjaxValidation'=>false,
		)); ?>

		<?php echo $form->errorSummary($model); ?>

		<div class="row">
			<?php echo $form->labelEx($model,'usr_passport_series'); ?>
			<?php echo $form->textField($model,'usr_passport_series',array('maxlength'=>4)); ?>
			<?php echo $form->error($model,'usr_passport_series'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'usr_passport_number'); ?>
			<?php echo $form->textField($model,'usr_passport_number',array('maxlength'=>6)); ?>
			<?php echo $form->error($model,'usr_passport_number'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'usr_output'); ?>
			<?php echo $form->textField($model,'usr_output',array('maxlength'=>255)); ?>
			<?php echo $form->error($model,'usr_output'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'usr_output_date'); ?>
			<?php echo $form->textField($model,'usr_output_date',array('maxlength'=>20)); ?>
			<?php echo $form->error($model,'usr_output_date'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'usr_unit_code'); ?>
			<?php echo $form->textField($model,'usr_unit_code',array('maxlength'=>7)); ?>
			<?php echo $form->error($model,'usr_unit_code'); ?>
		</div>
		<div class="row">					
		<?php echo $form->labelEx($model,'usr_qiwi'); ?>
		<?php echo $form->textField($model,'usr_qiwi',array('maxlength'=>20)); ?>
		<?php echo $form->error($model,'usr_qiwi'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'usr_yandex'); ?>
			<?php echo $form->textField($model,'usr_yandex',array('maxlength'=>20)); ?>
			<?php echo $form->error($model,'usr_yandex'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'usr_webmoney'); ?>
			<?php echo $form->textField($model,'usr_webmoney',array('maxlength'=>13)); ?>
			<?php echo $form->error($model,'usr_webmoney'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'usr_card'); ?>
			<?php echo $form->textField($model,'usr_card',array('maxlength'=>20)); ?>
			<?php echo $form->error($model,'usr_card'); ?>
		</div>
		<div class="row buttons">
			<input type="submit" value="Сохранить">
			<input type="button" onclick="$.fancybox.close(); return false;" value="Отменить">
		</div>

		<?php $this->endWidget(); ?>

	</div>
</div>