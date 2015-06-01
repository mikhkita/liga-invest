<div class="news-more clearfix">
	<h4><?=$model->name?></h4>
	<h5><?=$model->date?></h5>
	<p><?=$model->text?></p>
	<a href="<?php echo Yii::app()->createUrl('/news')?>" class="right">&lt;- Назад к новостям</a>
</div>
