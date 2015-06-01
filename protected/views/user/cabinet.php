<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'faculties-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="e-mail-password">
	<h3>Редактировать настройки доступа:</h3>
	<div>					
		<?php echo $form->labelEx($model,'usr_email'); ?>
		<?php echo $form->textField($model,'usr_email',array('maxlength'=>255,'required'=>true)); ?>
		<?php echo $form->error($model,'usr_email'); ?>
	</div>
	<div>
		<label for="Old_user_usr_password">Старый пароль</label>
		<input maxlength="128" class="<?php if( $error=='password' ) echo 'error'?>" name="User[old_usr_password]" id="Old_user_usr_password" type="password">
	</div>
	<div class="clearfix">
		<label for="New_user_usr_password">Новый пароль</label>
		<input maxlength="128" class="<?php if( $error=='password' ) echo 'error'?>" name="User[new_usr_password]" id="New_user_usr_password" type="password">
	</div>
</div>
<div class="e-mail-password">
	<h3>Платежная информация:</h3>
	<div>					
		<?php echo $form->labelEx($model,'usr_qiwi'); ?>
		<?php echo $form->textField($model,'usr_qiwi',array('maxlength'=>20)); ?>
		<?php echo $form->error($model,'usr_qiwi'); ?>
	</div>
	<div>
		<?php echo $form->labelEx($model,'usr_yandex'); ?>
		<?php echo $form->textField($model,'usr_yandex',array('maxlength'=>20)); ?>
		<?php echo $form->error($model,'usr_yandex'); ?>
	</div>
	<div>
		<?php echo $form->labelEx($model,'usr_webmoney'); ?>
		<?php echo $form->textField($model,'usr_webmoney',array('maxlength'=>13)); ?>
		<?php echo $form->error($model,'usr_webmoney'); ?>
	</div>
	<div>
		<?php echo $form->labelEx($model,'usr_card'); ?>
		<?php echo $form->textField($model,'usr_card',array('maxlength'=>20)); ?>
		<?php echo $form->error($model,'usr_card'); ?>
	</div>
	<input type="submit" class="right green-button agree-btn" value="Сохранить">
</div>
<?php $this->endWidget(); ?>