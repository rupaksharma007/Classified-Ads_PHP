	<!--NAVBAR HERE-->
	<nav>
		<div class="nav-container">
			<a href="/"><div class="logo"><?php echo $ob->sitename; ?></div></a>
			<div class="nav-wrapper">
				<ul>
					<li><a href="/" <?php echo ($index=='')? 'class="active"' :'';?>>Home</a></li>
					<?php
					if(isset($_SESSION['email'])){
						?>
					<li><a href="/dashboard" <?php echo ($index=='dashboard')? 'class="active"' :'';?>>My Account</a></li>
					<li><a href="/?logout=1">Logout</a></li>
					<?php
					}else{
					?>
					<li><a href="/register" <?php echo ($index=='register')? 'class="active"' :'';?>>Register</a></li>
					<li><a href="/login" <?php echo ($index=='login')? 'class="active"' :'';?>>Login</a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
