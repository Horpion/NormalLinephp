<?php include_once "template/header.php";?>
		<!-- Content -->
		<div class="row table">
			<?php include_once "template/aside.php";?>
                    
			<div class="col-md-8 col-sm-8 col-xs-8 bg-white padding-content table-cell">
				<main role="main" class="main">
					<h2 class="main__title">Останні публікації</h2>
                                        
                                        <?php for( $i=0;$i < count($article);$i++ ) : ?>
                                                
                                            <div class="article">
                                                <h3 class="article__title"><a href="<?php echo "?article=".$article[$i]['id'];?>" class="article__href"><?php echo $article[$i]['name']; ?></a></h3>
						<div class="article__img">
							<img src="<?php echo $article[$i]['image'];?>" class="img-responsive" alt="Картинка">
						</div>
						<div class="article__text"><?php echo $article[$i]['short_descr'];?></div>
                                                <a href="<?php echo "?article=".$article[$i]['id'];?>" class="article__read">Читати далі</a>
                                            </div>
                                        
                                        <?php endfor; ?>
				</main>
			</div>
		</div>
<?php include_once "template/footer.php";?>