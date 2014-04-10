<?php

class Paginador{

	public $total;
	public $url;
	public $limite;
	public $pagina;

	public function __construct($total,$limite,$pagina, $url)
	{
		$this->total = $total;
		$this->limite = $limite;
		$this->url = $url;
		$this->pagina = $pagina;
	}

	public function renderiza()
	{
		$html = "<div class=\"pagination\"><ul>";

		if ($this->pagina > 1) {
			$html .= "<li><a href=\"" . sprintf($this->url, $this->pagina - 1) . "\">Página Anterior</a></li>";
		}
    	
    	$total_paginas = ceil($this->total / $this->limite);

    	for ($i=1; $i <= $total_paginas; $i++) { 
			$html .= "<li><a href=\"" . sprintf($this->url, $i) . "\">{$i}</a></li>";
		}	
    	
    	if ($this->pagina < $total_paginas)
    		$html .= "<li><a href=\"" . sprintf($this->url, $this->pagina + 1) . "\">Pŕoxima Página</a></li>";
    
    	$html .= "</ul></div>";

    	return $html;
	}
}