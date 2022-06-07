<?php
class Lists extends Core{
	public $data = array();
	private $param = '';

	function __construct($param = null){
		parent::__construct();
		if(!empty($param)){
			$this->param = $param;
		}
		$this->index();
	}

	function __destruct(){
		parent::__destruct();
	}

	function index(){
		if(empty($this->param))
			$this->redirect('/error404',true);
		$this->setSearch();
	}

	public function display(){
		$type = $this->getType();
		if($type == 'list')
			return $this->databycat();
		else if($type == 'all-ads')
			return $this->databyseller();
		else if($type == 'search')
			return $this->databysearch();

	}

	public function setTitle(){
		$url = $this->getType();
		$params = explode('/',$this->param);
		$title ='';
		if($url == 'list')
			$title = $this->cat_id2name($params[0]).' ADs';
		else if($url == 'all-ads')
			$title = $this->user_id2name($params[0]).'\'s ADs';
		else if($url == 'search')
			$title = 'Search Result';
		return $title;
	}

	private function setSearch(){
		if($this->formSubmit('post')){
			$_SESSION['category'] = $this->formValue('category');
			$_SESSION['location'] = $this->formValue('location');
			$_SESSION['search'] = $this->formValue('query');
		}
	}

	private function databycat(){
		$param = explode('/',$this->param);
		$cat = $this->escape($param[0]);
		if(isset($_GET['orderby']) && $this->formValue('orderby')=='title')
			$sql = "SELECT * FROM `ads` WHERE `cat_id`='$cat' AND `status`='1' ORDER BY `title`";
		else if(isset($_GET['orderby']) && $this->formValue('orderby')=='price')
			$sql = "SELECT * FROM `ads` WHERE `cat_id`='$cat' AND `status`='1' ORDER BY `price`";
		else
			$sql = "SELECT * FROM `ads` WHERE `cat_id`='$cat' AND `status`='1' ORDER BY `dt`";
		$query = $this->query($sql);
		return ($query->num_rows > 0)? $query : '';
	}

	private function databyseller(){
		$param = explode('/',$this->param);
		$cat = $this->escape($param[0]);
		if(isset($_GET['orderby']) && $this->formValue('orderby')=='title')
			$sql = "SELECT * FROM `ads` WHERE `user_id`='$cat' AND `status`='1' ORDER BY `title`";
		else if(isset($_GET['orderby']) && $this->formValue('orderby')=='price')
			$sql = "SELECT * FROM `ads` WHERE `user_id`='$cat' AND `status`='1' ORDER BY `price`";
		else
			$sql = "SELECT * FROM `ads` WHERE `user_id`='$cat' AND `status`='1' ORDER BY `dt`";
		$query = $this->query($sql);
		return ($query->num_rows > 0)? $query : '';
	}

	private function databysearch(){
		$category = $_SESSION['category'];
		$location = $_SESSION['location'];
		if(!empty($_SESSION['search'])){
			$search = explode(' ',$_SESSION['search']);
			$sql = '';
			foreach ($search as $value) {
				$sql.="`title` LIKE '%$value%' OR ";
			}
			$sql = substr($sql, 0, -4);
			$sql.= ' AND';
		}
		else
			$sql = '';

		if(isset($_GET['orderby']) && $this->formValue('orderby')=='title')
			$sql = "SELECT * FROM `ads` WHERE $sql `cat_id`='$category' AND `location`='$location' AND `status`='1' ORDER BY `title`";
		else if(isset($_GET['orderby']) && $this->formValue('orderby')=='price')
			$sql = "SELECT * FROM `ads` WHERE $sql `cat_id`='$category' AND `location`='$location' AND `status`='1' ORDER BY `price`";
		else
			$sql = "SELECT * FROM `ads` WHERE $sql `cat_id`='$category' AND `location`='$location' AND `status`='1' ORDER BY `dt` DESC";

		$query = $this->query($sql);
		return ($query->num_rows > 0)? $query : '';
	}

	private function getType(){
		$url = explode('/',ltrim($_SERVER['REQUEST_URI'], '/'));
		$url = $url[0];
		return $url;
	}

}
?>