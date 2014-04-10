
<legend>Listagem de Notícias</legend>

<p>
	<a href="<?php echo ROOT ?>admin/noticias/adicionar" title="Adicionar Notícia" class='btn btn-primary'>Adicionar Notícia</a>
</p>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Data</th>
			<th>Título</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($noticias): ?>
			<?php foreach ($noticias as $noticia): ?>
				<tr>
					<td><?php echo $noticia->id ?></td>
					<td><?php echo date("d/m/Y à\s H:i:s", strtotime($noticia->data)) ?></td>
					<td><?php echo $noticia->titulo ?></td>
					<td>
						<a href="<?php echo ROOT."admin/noticias/midia/{$noticia->id}"; ?>" class='btn'><i class='icon-film'></i></a>
						<a href="<?php echo ROOT."admin/noticias/editar/{$noticia->id}"; ?>" class='btn'><i class='icon-edit'></i></a>
						<a href="<?php echo ROOT."admin/noticias/deletar/{$noticia->id}"; ?>" class='btn btn-danger deletar_noticia'><i class='icon-white icon-trash'></i></a>
					</td>
				</tr>
			<?php endforeach ?>
		<?php else: ?>
			<tr>
				<td colspan="4">Nenhuma notícia cadastrada...</td>
			</tr>
		<?php endif ?>
	</tbody>
</table>

<?php echo $paginacao ?>