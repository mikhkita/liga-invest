<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'faculties-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>255,'required'=>true,'disabled'=> !( $this->getUserRole() == "root" ) )); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
<? if( $this->getUserRole() == "root" ):  ?>
	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort',array('maxlength'=>255,'required'=>true)); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>
<? endif; ?>
<? if( $this->getUserRole() == "root" ):  ?>
	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('maxlength'=>255,'required'=>true)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>
<? endif; ?>
<? if( $model->code!="ANKETA" ):  ?>
	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textArea($model,'value',array('class'=>"b-settings-textarea")); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>
<? else: ?>
	<div class="row">
		<?php echo CHtml::label("Файл",false); ?>
		<div class="b-image-cancel">Отменить удаление</div>
		<div class="b-image-cont">
			<div data-path="<? echo Yii::app()->createUrl('/uploader/getForm',array('maxFiles'=>1,'extensions'=>'doc,docx', 'title' => 'Загрузка анкеты', 'selector' => '.b-input-image', 'tmpPath' => Yii::app()->params['tempFolder']) ); ?>" class="b-input-image-add b-get-image<? if( $model->value != "" ) echo " hidden"; ?>" title="Добавить файл"></div>
			<div class="b-image-wrap<? if( $model->value == "" ) echo " hidden"; ?>">
				<div class="b-input-image-img" data-base="<? echo Yii::app()->request->baseUrl; ?>" style="background-image: url('<? echo (Yii::app()->request->baseUrl)."/".($model->value); ?>');"></div>
				<?php echo $form->textField($model,'value',array('class'=>'b-input-image')); ?>
				<?php echo $form->error($model,'value'); ?>
				<div class="b-image-controls clearfix">
					<div class="b-image-nav b-image-edit b-get-image" title="Заменить файл"></div>
					<div class="b-image-nav b-image-delete" title="Удалить файл"></div>
				</div>
			</div>
		</div>
	</div>
<? endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
		<input type="button" onclick="$.fancybox.close(); return false;" value="Отменить">
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->