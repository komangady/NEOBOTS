<?php



class paging

{

	var $koneksi;

	var $p;

	var $page;

	var $q;

	var $query;

	var $next;

	var $prev;

	var $number;

	var $special;

	var $add_query;

	var $query_vars;

	var $page_vars;

	var $menu_display = 'show';

	var $div_id;

	

	function paging($special="",$baris=5, $langkah=5, $prev="Prev", $next="Next", $number="[%%number%%]",$loadfrom="")

	{

		$this->next=$next;

		$this->prev=$prev;

		$this->number=$number;

		$this->p["baris"]=$baris;

		$this->p["langkah"]=$langkah;

		$this->special = $special;

		$_SERVER["QUERY_STRING"]=preg_replace("/&".$this->menu_display."=[0-9]*/","",$_SERVER["QUERY_STRING"]);

		if( trim($loadfrom) !== '' ) {

			$this->page=$loadfrom;

		} else {

			if(empty($_GET[$this->menu_display])) {

				$this->page=1;

			} else {

				$this->page=$_GET[$this->menu_display];

			}

		} 

	}



	function db()

	{

	global $method,$DB,$dhost,$duser,$dpass,$dbase;

		//$this->koneksi=mysql_pconnect($dhost,$duser,$dpass) or die("Connection Error");

		//mysql_select_db($dbase);

		$this->koneksi = $DB;

		return $this->koneksi;

	}



	function query($query)

	{

	global $qcount;

		$kondisi=false;

		// only select

		if (!preg_match("/^[\s]*select*/i",$query)) {

			$query = "select ".$query;

		}

		

		if($this->special == 'best-seller' || $this->special == 'new-item') {

			$this->add_query =" LIMIT 0, 24 ";

		} 

		$querytemp = mysql_query($query.$this->add_query);

		if(!$querytemp) die('SQL ERROR: '.$query.' '.mysql_error().mysql_errno() );

		$this->p["count"]= mysql_num_rows($querytemp);



		// total display

		$this->p["total_page"]=ceil($this->p["count"]/$this->p["baris"]);



		// filter page

		if  ($this->page<=1)

			$this->page=1;

		elseif ($this->page>$this->p["total_page"])

			$this->page=$this->p["total_page"];



		// awal data yang diambil

		$this->p["mulai"]=$this->page*$this->p["baris"]-$this->p["baris"];

	

		$query=$query." limit ".$this->p["mulai"].",".$this->p["baris"];

		//echo $query;

		$query=mysql_query($query);

		if(!$query) die('SQL Error.'); //mysql_error().mysql_errno() );

		@$qcount++;

		$this->query=$query;

	}

	

	function result()

	{

		return $result=mysql_fetch_object($this->query);

	}



	function result_assoc()

	{

		return mysql_fetch_assoc($this->query);

	}

	function result_row()

	{

		return mysql_fetch_row($this->query);

	}

	function print_no()

	{

		$number=$this->p["mulai"]+=1;

		return $number;

	}

	

	function print_color($color1,$color2)

	{

		if (empty($this->p["count_color"]))

			$this->p["count_color"] = 0;

		if ( $this->p["count_color"]++ % 2 == 0 ) {

			return $color=$color1;

		} else {

			return $color=$color2;

		}

	}



	function print_info()

	{

		$page=array();

		$page["start"]=$this->p["mulai"]+1;

		$page["end"]=$this->p["mulai"]+$this->p["baris"];

		$page["total"]=$this->p["count"];

		$page["total_pages"]=$this->p["total_page"];

			if ($page["end"] > $page["total"]) {

				$page["end"]=$page["total"];

			}

			if (empty($this->p["count"])) {

				$page["start"]=0;

			}



		return $page;

	}



	function print_link($separator='',$mode='relative')

	{

		$this->div_id = $div_id;

		// generate query vars

		if($query_vars !== '') {

			if($mode == 'absolute') {

				$this->page_vars = $query_vars;

			} else {

				$this->page_vars = $query_vars.'&amp;'.$this->menu_display.'=';

			}

		} else {

			if($mode == 'absolute') {

				$this->page_vars = '';

			} else {

				$this->page_vars = '?'.$this->menu_display.'=';

			}

		}

		//generate template

		function number($i,$number)

		{

			return ereg_replace("^(.*)%%number%%(.*)$","$i",$number);

		}

		$print_link = false;



		if ($this->p["count"]>$this->p["baris"]) {



			// print prev

			if ($this->page>1)

			$print_link .= '<a rel="'.$this->div_id.'" href="javascript:;" id="'.$this->page_vars.'1" title="First :: Goto First Page 1">First</a>'.$separator.'<a href="javascript:;" id="'.$this->page_vars.($this->page-1).'" title="Prev :: Previous Page  '.($this->page-1).'">'.$this->prev.'</a>';



			// set number

			$this->p["bawah"]=$this->page-$this->p["langkah"];

				if ($this->p["bawah"]<1) $this->p["bawah"]=1;



			$this->p["atas"]=$this->page+$this->p["langkah"];

				if ($this->p["atas"]>$this->p["total_page"]) $this->p["atas"]=$this->p["total_page"];



			// print start

			if ($this->page<>1)

			{

				for ($i=$this->p["bawah"];$i<=$this->page-1;$i++)

					$print_link .= $separator.'<a rel="'.$this->div_id.'" href="javascript:;" id="'.$this->page_vars.$i.'" title="Page '.number($i,$this->number).'" >'.number($i,$this->number).'</a> ';

			}

			// print active

			if ($this->p["total_page"]>1)

				$print_link .= " <span class=\"active\">".number($this->page,$this->number)."</span> ";



			// print end

			for ($i=$this->page+1;$i<=$this->p["atas"];$i++)

			$print_link .= '<a rel="'.$this->div_id.'" href="javascript:;" id="'.$this->page_vars.$i.'" title="Page '.number($i,$this->number).'">'.number($i,$this->number).'</a>'.$separator;



			// print next

			if ($this->page<$this->p["total_page"])

			$print_link .= '<a rel="'.$this->div_id.'" href="javascript:;" id="'.$this->page_vars.($this->page+1).'" title="Next :: Next Page '.($this->page+1).'">'.$this->next.'</a>'.$separator.'<a rel="'.$this->div_id.'" href="javascript:;" id="'.$this->page_vars.$this->p["total_page"].'" title="Last :: Goto Last Page '.$this->p["total_page"].'">Last</a>';



			return $print_link;

		}

	}

}

?>