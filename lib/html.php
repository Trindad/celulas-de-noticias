<?php	

function Select($name,$opcoes, $selecionado = null)
{
	$html = "<select name = \"{$name}\">";
	foreach ($opcoes as $id => $descricao) {
		$html .= "<option value = '{$id}' " . ($id == $selecionado ? "selected='selected'" : '') . " >{$descricao}</option>";

	}
	$html .= "</select>";
	return $html;
}
function trecho($string,$limite_palavras) {

	$palavras = explode(' ', strip_tags($string), ($limite_palavras + 1));
	if(count($palavras) > $limite_palavras)
		array_pop($palavras);
	return implode(' ', $palavras);

}