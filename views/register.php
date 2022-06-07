<?php require 'header.php'; ?>

	<div class="landing-page"></div>
	<div id="container" style="margin-top:150px">
		<div class="table">
			<div class="table-cell v-align-m">
				<div class="top-form-wrapper signupform">
					<div class="heading">Registration</div>
					<form action="" method="POST">
						<?php
							if(isset($ob->data['error']) && !empty($ob->data['error'])){
								foreach ($ob->data['error'] as $error) {
									echo '<div style="color:#FFF;padding:5px">ERROR: '.$error.'</div>';
								}
							}
						?>
					<table>
						<tr>
							<td>
								<input class="input" type="email" name="email" value="<?php echo $ob->formValue('email');?>" placeholder="Email" required>
							</td>
							<td>
								<input class="input" type="text" name="name" value="<?php echo $ob->formValue('name');?>" placeholder="Name" required>
							</td>
						</tr>

						<tr>
							<td>
								<input class="input" type="password" name="password" value="<?php echo $ob->formValue('password');?>" placeholder="Password">
							</td>
							<td>
								<input class="input" type="password" name="cpassword" value="<?php echo $ob->formValue('cpassword');?>" placeholder="Confirm Password">
							</td>
						</tr>
					</table>
						<button type="submit" name="signup"> REGISTER </button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>