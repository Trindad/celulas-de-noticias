
<legend>Listagem de Categorias</legend>

<p>
	<a href="<?php echo ROOT ?>admin/categorias/adicionar" title="Adicionar Categoria" class='btn btn-primary'>Adicionar Categoria</a>
</p>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<td>ID</td>
			<td>Descrição</td>
			<td>Ações</td>
		</tr>
	</thead>
	<tbody>
		<?php if ($categorias): ?>
			<?php foreach ($categorias as $categoria): ?>
				<tr>
					<td><?php echo $categoria->id ?></td>
					<td><?php echo $categoria->descricao ?></td>
					<td>
						<a href="<?php echo ROOT."admin/categorias/editar/{$categoria->id}"; ?>" class='btn'><i class='icon-edit'></i></a>
						<a href="<?php echo ROOT."admin/categorias/deletar/{$categoria->id}"; ?>" class='btn btn-danger deletar_categoria'><i class='icon-white icon-trash'></i></a>
					</td>
				</tr>
			<?php endforeach ?>
		<?php else: ?>
			<tr>
				<td colspan="4">Nenhuma categoria cadastrada...</td>
			</tr>
		<?php endif ?>
	</tbody>
</table>
<?php echo $paginacao ?>