<?php include_once "template/header.php";?>
		<div class="row table">
			<?php include_once "template/aside.php";?>
				<div class="col-md-8 col-sm-8 col-xs-8 bg-white padding-content table-cell">
				<main role="main" class="main">
                                    
				<div class="registration">
                                        <form action="" method="post" class="registration__form">
                                            <?php if(!empty($registration->regAlarm)):?>
                                                <span class="registration__inform"><?php echo $registration->regAlarm; ?></span>
                                            <?php  endif;?>
                                            
                                            <label>Логін:</label>
                                            <input type="text" class="registration__login" name="regLogin" placeholder="Логін" required="" value="<?php if(isset($_POST['regLogin'])){echo $_POST['regLogin'];}?>"><br>
                                            
                                            <label>Пароль:</label>
                                            <input type="password" class="registration__pass" name="regPass" placeholder="Пароль" required=""><br>
                                            
                                            <label>Підтвердіть пароль:</label>
                                            <input type="password" class="registration__pass" name="regPass-confirm" placeholder="Пароль" required=""><br>
                                            <input type="submit" name="registr-submit" class="registration__submit" value="Відправити">
                                            <input type="reset" class="registration__reset" value="Очистити">
                                        </form>
                                </div>


				</main>
			</div>
		</div>
<?php include_once "template/footer.php";?>