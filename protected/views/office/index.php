<h3><?=$this->getParam("OFFICE_TITLE")?></h3>
<p class="agreement-p">
	<?=$this->getParam("OFFICE_DESCRIPTION",true)?>
</p>
<a href="#" class="green-button b-green right">Распечатать схему проезда</a>
<div class="map" id="map_canvas" data-coords="<?=$this->getParam("OFFICE_MAP",true)?>"></div>
<div class="adress clearfix">
	<div class="left">
		<h4>Наш адрес:</h4>
		<p>
			Город: Санкт-Петербург<br>
			Улица: Миллионная<br>
			Дом: 29<br>
			Телефон: +7 812 389 55 22
		</p>
	</div>
	<div class="right">
		<h4>Время работы:</h4>
		<p class="right-p">
			Часы приема:<br>
			Понедельник-Пятница с 10:00 до 19:00<br>
			Суббота с 10:00 до 16:00<br>
			Воскресенье выходной<br>
		</p>
	</div>
</div>