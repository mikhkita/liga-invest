<?php $form=$this->beginWidget('CActiveForm'); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="pay cleatfix">
		<h4 class="left summ">Сумма</h4>
		<input type="text" class="left" value="1000">
		<h4 class="left">руб.</h4>
		<h4 class="left types">Способ оплаты:</h4>
		<div class="radio-button right clearfix">
			<input type="radio" name="pay" id="pay-1" class="left but1" value="online" checked><label class="pay-online" for="pay-1">Оплата онлайн</label><br>
			<input type="radio" name="pay" id="pay-2" class="left but2" value="office"><label class="pay-office" for="pay-2">Через кассу в офисе компании</label>
		</div>
	</div>
	<div class="investition-program clearfix">
		<div class="clearfix">
			<h4 class="left">Инвестиционная программа:</h4>
			<?php echo CHtml::dropDownList($this->adminMenu["cur"]->code, $model[0]->id, CHtml::listData($model, 'id', 'name')); ?>
		</div>
		<div id="program" class="clearfix <?php if($model[0]->image=='') echo 'no-image'; ?>">
			<img src="<?php if($model[0]->image=='') echo Yii::app()->request->baseUrl; ?>/<?=$model[0]->image?>" class="left car-left">
			<div class="right car-right"><?=$model[0]->text?></div>
		</div>
		<div class="clearfix">
			<h6 class="left">Инвестор:</h6>
			<a href="<?=$this->getParam("ANKETA")?>" download>заполните анкету после чего нажмите на кнопку</a>
		</div>
		<div class="clearfix putin">
			<h6 class="left">Инвестор:</h6>
			<h5><? echo $this->user->usr_name." ".$this->user->usr_surname ?></h5>
		</div>
		<a href="#" class="green-button green right">Инвестировать</a>
	</div>
<?php $this->endWidget(); ?>
<? foreach ($model as $item): ?>
	<div data-id="<?=$item->id?>" style="display:none;">
		<?php if($item->image!=''): ?>
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/<?=$item->image?>">
		<? endif; ?>
		<div><?=$item->text?></div>
	</div>
<? endforeach; ?>