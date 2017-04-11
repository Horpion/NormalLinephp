<aside class="col-md-4 col-sm-4 col-xs-4 bg-black padding-menu table-cell">
				<div class="panel">
                                    
                                    <?php if(empty($authorization->authorStatus)):?>
					<form action="/" id="autorization" method="post" class="autorization">
                                            
                                                <?php if(isset($authorization->messageError)):?>
                                                    <span class="autorization__error"><?php echo $authorization->messageError?></span>
                                                <?php endif;?>
						<input type="text" class="autorization__login" name="autor-login" placeholder="Логін" required>
						<input type="password" class="autorization__pass" name="autor-pass" placeholder="Пароль" required>
					</form>
					<input type="submit" name="Submit" form="autorization" class="autorization__submit" value="Зайти">
                                        <a href="?registration"> <button class="registration__button">Реєстрація</button> </a>
						
				
                                        <?php else:?>
                                            Вітаю , <?php echo $_SESSION['login']?> !
                                                <ul>
                                                <?php if($_SESSION['access'] == 2):?>
                                                    <li><a href="?admin=add-news" style="color:#fff;">Добавити новину</a></li>
                                                <?php endif;?>
                                                    <li><a href="?logOut" style="color:#fff;">Вийти</a></li>
                                                </ul>
                                        <?php endif;?>
				</div>


				<div class="block">
					<h2 class="block__title">Категорії</h2>
					<ul class="block-list">
                                            
                                            <?php for($i=0;$i<count($listCategory);$i++):?>
						<li class="block-list__item">
                                                    <a href="<?php echo '?category='.$listCategory[$i]['category']?>" class="block-list__href"> <?php echo $listCategory[$i]['category']?> </a>
						</li>
                                            <?php endfor;?>
                                                
					</ul>
				</div>
				<div class="block">
					<h2 class="block__title">Популярні новини</h2>
					<ul class="block-list block-list--padding">
                                            <?php for( $i=0;$i < count($popularArticle);$i++ ) : ?>
                                            <li class="block-list__item">
						<a href="<?php echo "?article=".$popularArticle[$i]['id'];?>" class="block-list__href ico-pulse"><?php echo $popularArticle[$i]['name']; ?></a>
                                            </li>
                                            <?php endfor;?>
					</ul>
				</div>
			</aside>