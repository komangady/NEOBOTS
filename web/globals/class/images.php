<?php
/**
	Author: Budi Hariyanto - budi[at]flextramedia[dot]com
***/

// IMAGES FUNCTION
class ximg {
var $verbose;
var $ext;

	function initialize($tmp_name,$name,$imgDir,$type,$update=0) {
	global $max_images_allowed,$imgwidth,$imgheight;
	$this->name = $name;
	$this->tmp_name = $tmp_name;
	
		switch($type) {
			case 'image/gif': $this->ext = '.gif'; break;
			case 'image/jpeg': $this->ext = '.jpg'; break;
			case 'image/pjpeg': $this->ext = '.jpg'; break;
			case 'image/png': $this->ext = '.png'; break;
		}
		//$this->new_name = $this->name.$this->ext;
		if($update == 0) {
			$this->new_name = $this->name.$this->generate_name($this->tmp_name).$this->ext;
		} else {
			if(file_exists($imgDir.$this->name)) unlink($imgDir.$this->name);
			$this->name = substr($this->name, 0, -4); 
			$this->new_name = $this->name.$this->ext;
		}
		
			if(file_exists($imgDir.$this->new_name)) {
				//$this->new_name = $this->generate_name($this->tmp_name).$this->ext;
				unlink($imgDir.$this->new_name);
			}
			$this->dest = $imgDir.$this->new_name;
			$this->move_uploaded($this->tmp_name,$this->dest);
		$output = $this->new_name;
		return $output;
		
	}
	
	function make_seed() {
		list($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
	}
	
	function generate_name($tmp_name='') {
		$Alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			$a = rand(0,25);
			$b = rand(0,25);
			$c = $Alpha[$a];
			$d = $Alpha[$b];
			$e = rand(0,9);
			$f = rand(0,9);
			$g = rand(0,9);
			$h = rand(0,9);
			$seed = $c.$d.$e.$f.$g.$h;
			mt_srand($this->make_seed());
			$randval = mt_rand();
			$randResult = $seed.$randval;
			return $randResult;
	}
	
	function move_uploaded($tmp_name,$dest) {
			move_uploaded_file($tmp_name, $dest);
			@chmod($dest, 0644);
	}
	
	function gc_img_name($name,$type) {
	$this->name = $name;
	
		switch($type) {
			case 'image/gif': $this->ext = '.gif'; break;
			case 'image/jpeg': $this->ext = '.jpg'; break;
			case 'image/pjpeg': $this->ext = '.jpg'; break;
			case 'image/png': $this->ext = '.png'; break;
		}
		$this->new_name = $this->name.$this->generate_name().$this->ext;
		return $this->new_name;
	}
	
}
?>