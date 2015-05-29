<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'faculties-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>255,'required'=>true)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('class'=>"b-settings-textarea")); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<div class="b-image-cancel">Отменить удаление</div>
		<div class="b-image-cont">
			<div data-path="<? echo Yii::app()->createUrl('/uploader/getForm',array('maxFiles'=>1,'extensions'=>'*', 'title' => 'Загрузка изображения программы', 'selector' => '.b-input-image', 'tmpPath' => Yii::app()->params['tempFolder']) ); ?>" class="b-input-image-add b-get-image<? if( $model->image != "" ) echo " hidden"; ?>" title="Добавить изображение"></div>
			<div class="b-image-wrap<? if( $model->image == "" ) echo " hidden"; ?>">
				<div class="b-input-image-img" data-base="<? echo Yii::app()->request->baseUrl; ?>" style="background-image: url('<? echo (Yii::app()->request->baseUrl)."/".($model->image); ?>');"></div>
				<?php echo $form->textField($model,'image',array('class'=>'b-input-image')); ?>
				<?php echo $form->error($model,'image'); ?>
				<div class="b-image-controls clearfix">
					<div class="b-image-nav b-image-edit b-get-image" title="Изменить изображение"></div>
					<div class="b-image-nav b-image-delete" title="Удалить изображение"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
		<input type="button" onclick="$.fancybox.close(); return false;" value="Отменить">
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->