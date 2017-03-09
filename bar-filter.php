<section class="filter-main">
<?php require_once 'functions-filter.php'; ?>
	<div class="container">
		<h3 class="text-center">Подбор проектов</h3>
		<form method="get" action="<?php echo esc_url(home_url('/test-filtra/')); ?>">
			<div class="row filter-section">
				<div class="col-md-3 col-sm-6 filterSelect">
					<div class="filterWrap">
						<h5>Тип строения</h5>
						<select name="category">
							<option value="any">Любой</option>
							<option <?php if(getFilterCat() === 14) echo 'selected'; ?> value="14">Дома из бруса</option>
							<option <?php if(getFilterCat() === 15) echo 'selected'; ?> value="15">Дома из бревна</option>
							<option <?php if(getFilterCat() === 16) echo 'selected'; ?> value="16">Бани</option>
						</select>
					</div>
				</div>
				<div class="col-md-5 col-sm-6 filterSelect">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							<div class="filterWrap">
								<h5>Этажность</h5>
								<select name="floors">
								<?php
									foreach (get_field_object("field_58ac1adaf603d")['choices'] as $key => $value) { ?>
										<option <?php if(getFilterSelect('floors')['get'] === $key) echo 'selected' ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php	} ?>
								</select>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="filterWrap">
								<h5>Размер дома</h5>
								<select name="size">
								<?php
									foreach (get_field_object("field_58ac1c46de2ce")['choices'] as $key => $value) { ?>
										<option <?php if(getFilterSelect('size')['get'] === $key) echo 'selected' ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php	} ?>
								</select>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="filterWrap">
								<h5>Тип крыши</h5>
								<select name="roof">
								<?php
									foreach (get_field_object("field_58ac1d60f86df")['choices'] as $key => $value) { ?>
										<option <?php if(getFilterSelect('roof')['get'] === $key) echo 'selected' ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
								<?php	} ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 filterCheckbox">
					<div class="row">
						<div class="col-xs-4">
							<div class="filterWrap">
								<h5>С терасой</h5>
								<label for="filterTerrace"></label>
								<input <?php if(getFilterCheckBox('terrace')['get'] === 'terrace') echo 'checked'; ?> type="checkbox" name="terrace" id="filterTerrace">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="filterWrap">
								<h5>С балконом</h5>
								<label for="filterBalcony"></label>
								<input <?php if(getFilterCheckBox('balcony')['get'] === 'balcony') echo 'checked'; ?> type="checkbox" name="balcony" id="filterBalcony">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="filterWrap">
								<h5>С эркером</h5>
								<label for="filterWindow"></label>
								<input <?php if(getFilterCheckBox('window')['get'] === 'window') echo 'checked'; ?> type="checkbox" name="window" id="filterWindow">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row filter-section">
				<div class="col-md-4 col-sm-5">
					<div class="filterWrap">
						<h5>Стоимость дома</h5>
						<div id="filterPrice"></div>
						<div class="filterSlideWrap">от<input type="text" name="priceMin" class="filterPriceValue form-control" id="priceMin" data-index="0" value="<?php echo getFilterSlider('price')['min']; ?>" /> <div class="pull-right">до<input type="text" name="priceMax" class="filterPriceValue form-control" id="priceMax" data-index="1" value="<?php echo getFilterSlider('price')['max']; ?>" />т.р.</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-5">
					<div class="filterWrap">
						<h5>Площадь дома</h5>
						<div id="filterArea"></div>
						<div class="filterSlideWrap">от<input type="text" name="areaMin" class="filterAreaValue form-control" id="areaMin" data-index="0" value="<?php echo getFilterSlider('area')['min']; ?>" /> <div class="pull-right">
							до<input type="text" name="areaMax" class="filterAreaValue form-control"  id="areaMax" data-index="1" value="<?php echo getFilterSlider('area')['max']; ?>" />м<sup>2</sup>
						</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-2">
					<div class="btnWrap">
					<script>
						function resetClick()
						{
							location.href = "<?php echo esc_url(home_url('/test-filtra/')); ?>";
						}
					</script>
						<button class="filterBtn reset" type="button" onclick="resetClick()">Сбросить</button>
						<button class="filterBtn" type="submit">Начать поиск</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>