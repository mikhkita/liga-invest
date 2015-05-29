<h3><?=$this->adminMenu["cur"]->name?></h3>
<? foreach ($model as $item): ?>
	<div class="news clearfix">
		<div class="left">
			<h4><?=$item->name?></h4>
			<h5><?=$item->date?></h5>
		</div>
		<a href="<?php echo Yii::app()->createUrl('/'.$this->adminMenu["cur"]->code.'/detail',array('id'=>$item->id))?>" class="news-ajax green-button right">Подробнее</a>
	</div>
<? endforeach; ?>