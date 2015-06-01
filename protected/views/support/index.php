	<div class="support clearfix">
	<?php $form=$this->beginWidget('CActiveForm'); ?>
		<div>
			<h6>Создать обращение в службу поддержки</h6>
			<?php echo $form->textArea($new,'question',array('required'=>true,'placeholder' => 'Кратко опишите суть вашей проблемы, мы постараемся ответить как можно быстрее.')); ?>
			<?php echo $form->error($new,'question'); ?>
		</div>
		<input type="submit" class="green-button right" value="Отправить">
	<?php $this->endWidget(); ?>	
		<h6 class="often">Часто задаваемые вопросы</h6>
		<div id="accordion">
			<? foreach ($faq as $item): ?>
				<h3><?=$this->replaceToBr($item->question)?></h3>
				<div>
					<p><?=$this->replaceToBr($item->answer)?></p>
				</div>
			<? endforeach; ?>
		</div>
	</div>
	
	<div class="history">
		<h6>История моих обращений</h6>
		<ul>
		<? foreach ($model as $item): ?>	
			<li class="message">
				<p><?=$this->replaceToBr(mb_substr($item->question,0,125))?> . . .</p>
				<div class="clearfix b-answer">
					<? if( $item->answer ): ?>
						<a class="various fancybox.ajax check left" href="<?php echo Yii::app()->createUrl('/'.$this->adminMenu["cur"]->code.'/detail',array('id'=>$item->id))?>">ответ получен</a>
					<? else: ?>
						<h5 class="wheit left">ожидание</h5>
					<? endif; ?>
					<h4 class="right"><?=$item->date?></h4>
				</div>
			</li>
		
		<? endforeach; ?>
		</ul>
	</div>
