<?php

$xml = new SimpleXMLElement(get_data("http://clulasdenotcias.disqus.com/latest.rss"));

?>

<div class="row-fluid">
	<div class='painel span4'>
		<h4>Últimos Comentários</h4>
		
		<?php foreach ($xml->channel->item as $comentario): ?> 
			<div class="comentario">
				<h5><?php echo $comentario->title ?></h5>
				<p>Escreveu:</p>
				<?php echo $comentario->description ?>
			</div>
			
		<?php endforeach; ?>
	</div>
</div>