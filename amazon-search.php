<?php

class Amazon_Search
{

	private $access_key_id = 'AKIAJG6TAO6WJQ2NRHBA';
	private $secret_access_key = 'jrxgdbOrGQjcHIhDHcZcrMcGZvOzN0sLjjSDAlT0';
	private $associateTag = 'nyarlatlo-22';

	private function urlencode_rfc3986($str)
	{
		return str_replace('%7E', '~', rawurlencode($str));
	}

	public function get_request_url($name,$category)
	{
		//require_once('./common.php');
		$baseurl = 'http://ecs.amazonaws.jp/onca/xml';
		$params = array();
		$params['Service'] = 'AWSECommerceService';
		$params['AWSAccessKeyId'] = $this->access_key_id;
		$params['Version'] = '2009-03-31';
		$params['Operation'] = 'ItemSearch';
		$params['SearchIndex'] = $category;
		$params['Keywords'] = $name;
		$params['ResponseGroup']='ItemAttributes,Images';
		$params['AssociateTag'] = $this->associateTag;

		$params['Timestamp'] = gmdate('Y-m-d\TH:i:s\Z');

		ksort($params);

		$canonical_string = '';
		foreach ($params as $k => $v) {
			$canonical_string .= '&'.$this->urlencode_rfc3986($k).'='.$this->urlencode_rfc3986($v);
		}
		$canonical_string = substr($canonical_string, 1);

		$parsed_url = parse_url($baseurl);
		$string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$canonical_string}";
		$signature = base64_encode(hash_hmac('sha256', $string_to_sign, $this->secret_access_key, true));

		$url = $baseurl.'?'.$canonical_string.'&Signature='.$this->urlencode_rfc3986($signature);
		return $url;
	}

	private function get_contents($name,$category)
	{
		return file_get_contents($this->get_request_url($name,$category),false);
	}

	public function get_Item_name_array($xml){
		//print_r($xml->Items->Item[0]->ItemAttributes->Title);
		$return_array = Array();
		foreach ($xml->Items->Item as $item) {
			array_push($return_array,(String)$item->ItemAttributes->Title);
		}
		return $return_array;
	}

	public function get_Item_link_array($xml){
		$return_array = Array();
		foreach ($xml->Items->Item as $item) {
			array_push($return_array,(String)$item->DetailPageURL);
		}
		return $return_array;
	}

	public function get_view($name,$category){
		$xml = simplexml_load_string($this->get_contents($name,$category));

		foreach($xml->Items->Item as $item){
			$item_name=$item->ItemAttributes->Title;
			$item_url=$item->DetailPageURL;
			$item_image=$item->MediumImage->URL;
			$item_add_wish = $item->ItemLinks->ItemLink->URL;
			print '<div style = "margin:40px"><a href="'.$item_url.'" target="_blank"><img src="'.$item_image.'"/>'.$item_name.'</a><br>';
			print '<a href="'.$item_add_wish.'">'."ウィッシュリストに追加".'</a></div>';
			unset($item);
		}
	}
}


$a = new Amazon_search();
$a->get_view("wifi","All");