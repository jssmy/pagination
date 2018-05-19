<?php
namespace model;

/**
* 
*/
class Pagination
{
	
	private $nextPageUrl;
	private $path;
	private $all;
	private $current;
	private $paginate_html;
	private $show;
	private $size;
	private $context;
	function __construct($all=0,$current=1,$show=15)
	{
		$this->all=$all;
		$this->show=$show;
		$this->current=$current;
		$this->size=$all/$show;
		if($this->size>(int)$this->size) $this->size++;

		$this->context='?';
	}

	public function setPath($value){
		if(strpos($value,'?')) $this->context="&";
		$this->path=$value;

	}
	public function nextPageUrl(){
		$next = $this->current+1;
		if($next>$this->size) return "#";
		$next = $this->path.$this->context."page=$next";
		return $next;
	}

	public function beforePageUrl(){
		$before = $this->current-1;
		if($before<1) return "#";
		$before=$this->path.$this->context."page=$before";
		return $before;
	}


	public function paginate(){
		if($this->all<=$this->show) return;
		$this->paginate_html ='<ul class="pagination">';
		$beforeUrl = $this->beforePageUrl();
		$this->paginate_html.="<li class='page-item'><a class='page-link' href='$beforeUrl'>Previous</a></li>";

		for($page=1;$page<=$this->size; $page++)
		{
			$url = ($page==$this->current)? "#" : $this->path.$this->context."page=$page";
			$disabled = ($page==$this->current)? "disabled='true'" : "";
			$active = ($page==$this->current)?"active":"";
			$this->paginate_html.="<li $disabled class='page-item $active'><a class='page-link' href='$url'>$page</a></li>";
		}
		$nextUrl=$this->nextPageUrl();
		$this->paginate_html.="<li class='page-item'><a class='page-link' href='$nextUrl'>Next</a></li>";
		$this->paginate_html.='</ul>';
  		return $this->paginate_html;	
	}

	/*
	<ul class="pagination">
  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
  <li class="page-item"><a class="page-link" href="#">1</a></li>
  <li class="page-item"><a class="page-link" href="#">2</a></li>
  <li class="page-item"><a class="page-link" href="#">3</a></li>
  <li class="page-item"><a class="page-link" href="#">Next</a></li>
</ul>

	*/
}

?>