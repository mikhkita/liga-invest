<?php $form=$this->beginWidget('CActiveForm'); ?>
	<div class="support left">
		<div>
			<h6>Создать обращение в службу поддержки</h6>
			<?php echo $form->textArea($new,'question',array('required'=>true,'placeholder' => 'Кратко опишите суть вашей проблемы, мы постараемся ответить как можно быстрее.')); ?>
			<?php echo $form->error($new,'question'); ?>
		</div>
		<input type="submit" class="green-button right" value="Отправить">
<?php $this->endWidget(); ?>
		<h6 class="often">Часто задаваемые вопросы</h6>
	</div>
	<div class="history right">
		<h6>История моих обращений</h6>
		<? foreach ($model as $item): ?>
		<div class="message">
			<p><?=$item->question?></p>
			<div class="clearfix">
				<? if( $item->answer ): ?>
					<h5 class="check left">ответ получен</h5>
				<? else: ?>
					<h5 class="wheit left">ожидание</h5>
				<? endif; ?>
				<h4 class="right"><?=$item->date?></h4>
			</div>
		</div>
		<? endforeach; ?>
	</div>
