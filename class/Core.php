<?php
class Core{
	private $conn;
	public $sitename;
	function __construct(){
		require_once('init.php');
		$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
		if($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$this->conn = $conn;
		$this->sitename = $sitename;
	}

	function __destruct(){
		$this->conn->close();
	}

	public function query($query){
		return $this->conn->query($query);
	}
	public function sqlError(){
		return $this->conn->error;
	}

	public function loadCities(){
		$json = json_decode(file_get_contents('assets/cities.json'));
		foreach ($json as $key => $value) {
			echo '<optgroup label="'.$key.'" value="'.$key.'">';
				foreach ($value as $city) {
					if(isset($this->data['ad']['location']) && $this->data['ad']['location']==$city)
						echo '<option value="'.$city.'" selected>'.$city.'</option>';
					else
						echo '<option value="'.$city.'">'.$city.'</option>';
				}
			echo '</optgroup>';
		}
	}

	public function latestAd(){
		$query = $this->query("SELECT * FROM `ads` WHERE `status`='1' ORDER BY `id` DESC LIMIT 20");
		return ($query->num_rows>0)?$query:'';
	}

	public function getCategories(){
		$cat = $this->query("SELECT * FROM `category`");
		return $cat;
	}

	public function getAdCount($id){
		$id = $this->escape($id);
		$cat = $this->query("SELECT `id` FROM `ads` WHERE `cat_id`='$id' AND `status`='1'");
			return $cat->num_rows;
	}

	public function cat_id2name($id){
		$id = $this->escape($id);
		$cat = $this->query("SELECT `name` FROM `category` WHERE `id`='$id'");
		if($cat->num_rows > 0){
			$cat = $cat->fetch_assoc();
			return $cat['name'];
		}
	}

	public function user_id2name($id){
		$id = $this->escape($id);
		$cat = $this->query("SELECT `name` FROM `users` WHERE `id`='$id'");
		if($cat->num_rows > 0){
			$cat = $cat->fetch_assoc();
			return $cat['name'];
		}
	}

	public function user2dp($id){
		$id = $this->escape($id);
		$user = $this->query("SELECT `dp` FROM `users` WHERE `id`='$id'");
		if($user->num_rows > 0){
			$user = $user->fetch_assoc();
			return $user['dp'];
		}
	}

	public function escape($str){
		return $this->conn->real_escape_string($str);
	}

	public function auth(){
		if(!isset($_SESSION['email']))
			$this->redirect('/',true);
	}

	public static function formSubmit($type = 'post') {
        switch($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            default:
            	return (isset($_POST[$type])) ? true : false;
                break;
        }
    }

    public function formValue($item,$escape=false) {
        if(isset($_POST[$item])) {
            return ($escape) ? $this->escape($_POST[$item]) : $_POST[$item];
        } else if(isset($_GET[$item])) {
            return ($escape) ? $this->escape($_GET[$item]) : $_GET[$item];
        }
        return '';
    }

    public static function redirect($url,$php=false){
    	if($php){
    		header("location: $url");
    		exit();
    	}
    	else{
		?>
		<script type="text/javascript">
			window.location = "<?php echo $url;?>";
		</script>
		<?php
		}
	}
}
?>