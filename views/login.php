<?php require 'header.php'; ?>

	<div class="landing-page"></div>
	<div id="container" style="margin-top:150px">
		<div class="table">
			<div class="table-cell w-50 v-align-m">
				<div class="top-form-wrapper">
					<?php
						if(isset($_GET['forget'])){
							?>
					<div class="heading">Forgot Password</div>
					<form action="" method="POST">
						<?php
							if(isset($ob->data['error']) && !empty($ob->data['error'])){
								foreach ($ob->data['error'] as $error) {
									echo '<div style="color:#FFF;padding:5px">'.$error.'</div>';
								}
							}
						?>
						<input class="input" type="email" name="email" value="" placeholder="Email">
						<button type="submit" name="forget"> Reset Password </button>
					</form>
							<?php
						}
						else{
							?>
					<div class="heading">Login</div>
					<form action="" method="POST">
						<?php
							if(isset($ob->data['error']) && !empty($ob->data['error'])){
								foreach ($ob->data['error'] as $error) {
									echo '<div style="color:#FFF;padding:5px">ERROR: '.$error.'</div>';
								}
							}
						?>
						<input class="input" type="text" name="email" value="" placeholder="Email">
						<input class="input" type="password" name="password" value="" placeholder="Password" required>
						<a href="/login/?forget=1"> Forgot Password ? </a> <br><br>
						<button type="submit" name="login"> LOGIN </button>

						Don't have account ?? <a href="/register"> Create now </a>
					</form>
							<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>