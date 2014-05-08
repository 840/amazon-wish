<?php


class Amazon_wish{

	// public $query ='4DXR1E475D8';
	private $query;
	private $file ='http://133.208.22.43/amazon-wish/amazon-wish-lister/src/wishlist.php?id=';

	function __construct($id){
		$this->query = $id;
	}

	private function get_request_url(){
		return $this->file.$this->query;
	}

	private function get_json($url){
		$json = file_get_contents($url,false);
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
		return $json;
	}

	function get_view(){
		$url = $this->get_request_url();
		$json = $this->get_json($url);
		$wish_array = json_decode($json,true);

		foreach ($wish_array as $item) {
			$item_image = $item['picture'];
			$item_url = $item['link'];
			$item_name = $item['name'];
			print '<div style = "margin:40px"><a href="'.$item_url.'" target="_blank" align="left"><img src="'.$item_image.'"/>'.$item_name.'</a></div>';
		}


	}
}

$w = new Amazon_wish('4DXR1E475D8');
echo $w->get_view();