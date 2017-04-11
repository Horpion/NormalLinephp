<?php include_once "template/header.php";?>
		<div class="row table">
			<?php include_once "template/aside.php";?>
			<div class="col-md-8 col-sm-8 col-xs-8 bg-white padding-content table-cell">
				<main role="main" class="main">
					<h2 class="main__title">Додавання матеріалу</h2>

					<form action="" method="POST" class="add-content" enctype="multipart/form-data">
                                            
                                                <?php if(isset($addNews->newsAlarm)):?>
                                                    <div class="add-content__error"> <?php echo $addNews->newsAlarm; ?> </div>
                                                <?php endif;?>

						<!-- Заголовок статті -->
						<label for="add-content__art-title-label" class="add-content__art-title">Заголовок статті: </label> <br>
						<input id="add-content__art-title-label" name="article-title" class="add-content__art-title-label" type="text" required=""> <br>
						
						<!-- Мініатюра -->
						<label for="add-content__art-img-label" class="add-content__art-img">Мініатюра: </label> <br>
						<input id="add-content__art-img-label" name="article-img" class="add-content__art-img-label" type="file" > <br>

                                                <label for="add-content__art-cat-select" class="add-content__art-cat">Оберіть категорію: </label> <br>
						<select id="add-content__art-cat-select" name="article-category">
                                                    
                                                    <?php for($i=0;$i<count($categoryList);$i++):?>
                                                    
                                                    <option name="<?php echo $categoryList[$i]['category']?>"> <?php echo $categoryList[$i]['category']?> </option>
                                                    
                                                    <?php endfor;?>
                                                    
                                                </select>  <br>
                                                
						<!-- Короткий опис -->
						<label for="add-content__art-shortShort-label" class="add-content__art-shortShort">Короткий опис: </label> <br>
						<textarea id="add-content__art-shortShort-label" name="article-shortDescr" class="add-content__art-shortShort-label" required=""></textarea> <br>
						<script type="text/javascript"> CKEDITOR.replace( 'article-shortDescr' ); </script>

						<!-- Повний опис -->
						<label for="add-content__art-fullDescr-label" class="add-content__art-fullDescr">Повний опис: </label> <br>
						<textarea id="add-content__art-fullDescr-label" name="article-fullDescr" class="add-content__art-fullDescr-label" required=""></textarea> <br>
						<script type="text/javascript"> CKEDITOR.replace( 'article-fullDescr' ); </script>

						<input type="submit" class="add-content__submit" value="Відправити">
						


					</form>

				</main>
			</div>
			</div>
		</div>
<?php include_once "template/footer.php";?>