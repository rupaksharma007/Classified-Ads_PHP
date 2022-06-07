<?php
class Install{
	private $conn,$db_name='ogma_db';
	private $tables = array();
	private $sql = array();
	function __construct(){
		//parent::__construct();
		$this->index();
	}

	function __destruct(){
		//$conn->close();
	}


	private function loadTableStructure(){
		$tables = array();
		$tables[]="
		CREATE TABLE IF NOT EXISTS `users` (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		email VARCHAR(30) NOT NULL,
		name VARCHAR(30) NOT NULL,
		password VARCHAR(50) NOT NULL,
		dp VARCHAR(100) NOT NULL DEFAULT '/assets/dp.png',
		admin tinyint(1) NOT NULL DEFAULT '0'
		) ENGINE = InnoDB;
		";

		$this->sql['users'] = "INSERT INTO `users` (`email`, `name`, `password`, `dp`, `admin`) VALUES
		('admin', 'Admin', 'admin', '/assets/dp.png', 1),
		('asifakramsk@gmail.com', 'Asif Akram', 'password', '/images/2_dp1529473232.jpg', 0);";

		$tables[]="
		CREATE TABLE IF NOT EXISTS `category` (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50) NOT NULL,
		icon VARCHAR(100) NOT NULL
		) ENGINE = InnoDB;
		";

		$this->sql['category'] = "INSERT INTO `category` (name, icon) VALUES ('Electronics', '/assets/icons/electronics.svg'), ('Fashion', '/assets/icons/fashion.svg'), ('Furniture', '/assets/icons/furniture.svg'), ('Mobiles', '/assets/icons/mobiles.svg'), ('Real Estate', '/assets/icons/realestate.svg'), ('Vehicles', '/assets/icons/vehicles.svg')";

		$tables[]="
		CREATE TABLE IF NOT EXISTS `ads` (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(50) NOT NULL,
		cat_id INT(6) UNSIGNED,
		user_id INT(6) UNSIGNED,
		location VARCHAR(30) NOT NULL,
		price DECIMAL(20,2) NOT NULL,
		specification TEXT(5000) NOT NULL,
		feature TEXT(5000) NOT NULL,
		images TEXT(5000) NOT NULL,
		description TEXT(5000) NOT NULL,
		mobile VARCHAR(30) NOT NULL,
		address VARCHAR(100) NOT NULL,
		views INT(6) UNSIGNED NOT NULL DEFAULT '0',
		status tinyint(1) NOT NULL DEFAULT '0',
		dt DATE,
		FOREIGN KEY (`cat_id`) REFERENCES `category`(`id`),
		FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
		) ENGINE = InnoDB;
		";

		$this->sql['ads'] = "INSERT INTO `ads` (`id`, `title`, `cat_id`, `user_id`, `location`, `price`, `specification`, `feature`, `images`, `description`, `mobile`, `address`, `views`, `status`, `dt`) VALUES
(1, 'Audi A5 1.8 TFSI 2014', 6, 2, 'Kolkata', '5000000.00', '{\"Color\":\"Black\",\"Condition\":\"Used\",\"Type\":\"4 Wheeler\",\"Model\":\"A5 1.8 TFSI\"}', '[\"Air Bags\",\"Power Window\",\"Power Stering\"]', '[\"\\/images\\/2_ad0_1529776002.jpg\",\"\\/images\\/2_ad1_1529776002.jpg\",\"\\/images\\/2_ad2_1529776002.jpg\",\"\\/images\\/2_ad3_1529776002.jpg\"]', 'The big sellers in the facelifted Audi A5 range will definitely be the diesels, but the entry-level 1.8-litre TFSI petrol car looks like great value, too.\r\nEven though itâ€™s the cheapest model in the line-up, this four-cylinder turbo produces 168bhp â€“ and this is all the power youâ€™ll ever need out on the road.\r\nThatâ€™s because peak torque arrives at anywhere between 1,400rpm and 3,700rpm, ensuring a surge of acceleration every time you press the throttle pedal. Itâ€™s enough for a 0-62mph time of 7.9 seconds â€“ virtually identical to that of the higher-powered 2.0-litre TDI engine.\r\nStep out of a diesel and into this car, and youâ€™ll be amazed at how refined it is. At idle you can barely hear â€“ or feel â€“ the engine running, and it revs so quietly that pulling away smoothly requires a bit of practice as you have to base the amount of revs used on what you see on the rev counter, rather than the noise.', '9903614705', '81 Nilgunj Road Kolkata 700009', 0, 1, '2018-06-20'),
(2, 'Audi A6 1.8 TFSI 2016', 6, 2, 'Tarakeswar', '6000000.00', '{\"Color\":\"White\",\"Condition\":\"Used\",\"Type\":\"4 Wheeler\",\"Model\":\"Audi A6\"}', '[\"Air Bags\",\"Power Window\",\"Power Stering\"]', '[\"/images/2_ad0_1529776180.jpg\",\"/images/2_ad1_1529776180.jpg\",\"/images/2_ad2_1529776180.jpg\",\"/images/2_ad3_1529776180.jpg\"]', 'The big sellers in the facelifted Audi A5 range will definitely be the diesels, but the entry-level 1.8-litre TFSI petrol car looks like great value, too.\r\nEven though itâ€™s the cheapest model in the line-up, this four-cylinder turbo produces 168bhp â€“ and this is all the power youâ€™ll ever need out on the road.\r\nThatâ€™s because peak torque arrives at anywhere between 1,400rpm and 3,700rpm, ensuring a surge of acceleration every time you press the throttle pedal. Itâ€™s enough for a 0-62mph time of 7.9 seconds â€“ virtually identical to that of the higher-powered 2.0-litre TDI engine.\r\nStep out of a diesel and into this car, and youâ€™ll be amazed at how refined it is. At idle you can barely hear â€“ or feel â€“ the engine running, and it revs so quietly that pulling away smoothly requires a bit of practice as you have to base the amount of revs used on what you see on the rev counter, rather than the noise.', '9903614705', '81 Nilgunj Road Kolkata 700009', 0, 1, '2018-06-23'),
(3, 'BMW X1 sDrive18i 2017', 6, 2, 'Kolkata', '3000000.00', '{\"Color\":\"White\",\"Condition\":\"Used\",\"Type\":\"4 Wheeler\",\"Model\":\"sDrive18i\"}', '[\"Air Bags\",\"Power Window\",\"Power Stering\"]', '[\"/images/2_ad0_1529776390.jpg\",\"/images/2_ad1_1529776390.jpg\",\"/images/2_ad2_1529776390.jpg\"]', 'The 2018 BMW X1 range will be bolstered by the arrival of a new sDrive18i entry-level model in February, starting at $45,900 before on-road costs â€“ $4000 more affordable than the sDrive18d variant.\r\n\r\nPowering the new price leader will be the 1.5-litre three-cylinder turbo petrol used in various Mini models, developing 100kW of power and 220Nm of torque.\r\n\r\nUnlike the Mini range, however, the X1 sDrive18i sends drive to the front wheels through a seven-speed dual-clutch transmission, with fuel use rated at 5.4L/100km on the combined cycle. BMW also claims a 9.6-second sprint from 0-100km/h.', '9903614705', '81 Nilgunj Road Kolkata 700009', 1, 1, '2018-06-22'),
(4, 'Samsung Galaxy S9', 4, 2, 'Kolkata', '4000.00', '{\"Condition\":\"Used\",\"Model\":\"Galaxy S9\",\"Brand\":\"Samsung\",\"Memory\":\"4GB , 64GB \",\"Camera\":\"12mp\"}', '[\"Touchscreen\",\"3G \\/4G LTE\",\"Memory card\",\"Built-in camera\",\"Built-in flash\",\"Video recorder\",\"Bluetooth\",\"Wi-Fi\",\"Dual SIM\",\"USB\"]', '[\"\\/images\\/2_ad0_1529777120.jpg\",\"\\/images\\/2_ad1_1529777120.jpg\",\"\\/images\\/2_ad2_1529777120.jpg\",\"\\/images\\/2_ad3_1529777120.jpg\",\"\\/images\\/2_ad4_1529777120.jpg\"]', 'Samsung fans getting excited about Galaxy S9 but they don\'t know that Plus version is also coming to make it more excited for the lovers of this brand. S8 was the celebrity of the last year but the upcoming siblings are even better. Samsung Galaxy S9 Plus got aluminum frame on its side while the front and back is covered with solid and thick layer of Corning Gorilla Glass 5 to make it scratch proof and save Samsung\'s Galaxy S9 Plus from shattering. This device also got an IP68 certificate which means that this smartphone can stay underwater for almost 30 minutes. Samsung Galaxy S9\'s design is quite alike to this version but there is a difference between the display sizes of both devices. This phone is coming with massive 6.2 inch touchscreen.', '9903614705', '81 Nilgunj Road Kolkata 700009', 0, 1, '2018-06-23')";

		$this->tables = $tables;
	}

	function index(){
		if(isset($_POST) && !empty($_POST)){
			if(!file_exists('class/init.php')){
				//Creating table and generate default admin
				$this->createDb();
				//Creating init file
				$this->init();
			}
			else{
				$this->redirect('/',true);
			}
		}
	}








	private function init(){
		echo 'Initializing.....<br>';
$content = '<?php
$db_host = \'localhost\';
$db_username = \''.$_POST['mysql_username'].'\';
$db_password = \''.$_POST['mysql_password'].'\';
$db_name = \''.$this->db_name.'\';
$sitename = \''.$_POST['sitename'].'\';
?>';
		file_put_contents('class/init.php', $content);

		echo 'Successfully Installed .....<br>';
		echo 'Loading Please Wait.....<br>';
		$this->redirect();
	}

	private function createDb(){
		echo 'Creating DB.....<br>';
		$db_host = 'localhost';
		$db_username = $_POST['mysql_username'];
		$db_password = $_POST['mysql_password'];
		$conn = new mysqli($db_host, $db_username, $db_password);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$sql = 'CREATE DATABASE IF NOT EXISTS '.$this->db_name;
		if ($conn->query($sql) === TRUE) {
		    echo 'DB created Successfully ... <br>';
		}
		else{
			die("Failed to create database ! ");
		}
		mysqli_select_db($conn,$this->db_name);
		$this->conn = $conn;
		$this->createTable();
	}

	private function createTable(){
		$this->loadTableStructure();
		echo 'Creating Tables.....<br>';
		foreach ($this->tables as $table) {
			if($this->conn->query($table) === false){
				die("Error running sql $table : " . $this->conn->error);			}
		}
		echo 'Inserting data.....<br>';
		foreach ($this->sql as $key => $sql) {
			if($this->conn->query("SELECT * FROM `$key`")->num_rows < 1)
			if($this->conn->query($sql) === false){
				die("Error running sql $table : " . $this->conn->error);			}
		}
		$this->addDefaultAdmin();
	}

	private function addDefaultAdmin(){
		echo 'Creating Default admin.....<br>';
		$email = $_POST['admin_email'];
		$name = $_POST['admin_name'];
		$password = $_POST['admin_password'];
		$sql=null;
		$sql = "INSERT INTO `users` SET `email`='$email',`name`='$name',`password`='$password',`admin`='1'";
		if($this->conn->query("SELECT * FROM `users` WHERE `email`='admin'")->num_rows < 1)
			if($this->conn->query($sql) === false)
				die("Error : " . $this->conn->error);
	}

	private function redirect(){
		?>
		<script type="text/javascript">
			window.location = "/";
		</script>
		<?php
	}
}
?>