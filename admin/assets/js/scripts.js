(function($) {
	$(document).ready(function() {
		$("#texto_noticia").ckeditor();

		$(".deletar_noticia").on("click", function(e) {
			var confirmacao = confirm("Deseja realmente deletar esta notícia ?");
			return confirmacao; // impede de continuar caso usuario cancele 
		});

	});

})(jQuery);