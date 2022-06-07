<?php
class View extends Core{
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
		if(!empty($this->param))
			$this->viewAd(explode('/',$this->param));
		else
			$this->redirect('/error404',true);
	}

	public function getCat($id){
		$query = $this->query("SELECT `name` FROM `category` WHERE `id`='$id'")->fetch_assoc();
		return $query['name'];
	}

	public function incView($id){
		if(!isset($_SESSION['view'.$id])){
			if($this->query("SELECT `id` FROM `ads` WHERE `status`='1' AND `id`='$id'")->num_rows > 0){
				$_SESSION['view'.$id] = 'v'.$id;
				$this->query("UPDATE `ads` SET `views`=`views`+1 WHERE `id`='$id'");
			}
		}
	}

	private function viewAd($params = array()){
			$id = $this->escape($params[0]);
			$query = $this->query("SELECT * FROM `ads` WHERE `id`='$id'");
			if($query->num_rows>0)
				$this->data['ad'] = $query->fetch_assoc();
			else
				$this->redirect('/',true);
	}

}
?>