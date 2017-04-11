<?php include_once "template/header.php";?>
		<div class="row table">
			<?php include_once "template/aside.php";?>
			<div class="col-md-8 col-sm-8 col-xs-8 bg-white padding-content table-cell">
				<div class="col-md-8 col-sm-8 col-xs-8 bg-white padding-content table-cell">
				<main role="main" class="main">
                                    
                                    <div class="full-article">
                                        <h2 class="full-article__title" style="display:inline-block;"><?php echo $post['name']; ?></h2>
                                        <?php if( !empty($_SESSION) && $_SESSION['access'] == 2 ):  ?>
                                                
                                        <a href="<?php echo $url."&delete=".$post['id'];?>" style="font-size:10px;">Видалити новину</a>
                                        <?php endif;?>
					<div class="full-article__img">
                                            <img src="<?php echo $post['image']; ?>" class="img-responsive" alt="Картинка">
					</div>
                                        <div class="full-article__text">
                                            <?php echo $post['full_descr']; ?>
                                        </div>
                                    </div>
				</main>
			</div>
			</div>
		</div>
<?php include_once "template/footer.php";?>