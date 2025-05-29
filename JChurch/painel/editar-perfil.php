<?php
require_once('../config/conect.php');
@session_start();
$sql = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$_SESSION[id]'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
	$nome = $res[0]['nome_mem'];
	$nasc = $res[0]['nasc_mem'];
	$sexo = $res[0]['sexo_mem'];
	$cargo = $res[0]['cargo_mem'];
	$emprego = $res[0]['emprego_mem'];
	$telefone = $res[0]['telefone_mem'];
	$endereco = $res[0]['endereco'];
	$foto = $res[0]['foto_mem'];
	$banner = $res[0]['banner'];
}
?>
<div class="d-flex flex-wrap">
	<div class="w-50">
		<form action="#" method="POST" id="formDados">
			<div>
				<h3>
					Editar Dados
				</h3>
				<a href="index.php?pag=membros">Visualizar Perfil</a>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" name="nome" id="nome" class="form-control" value="<?php echo $nome ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nasc">Data de Nascimento</label>
						<input type="date" name="nasc" id="nasc" class="form-control" value="<?php echo $nasc ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="sexo">Sexo:</label>
						<select class="form-select" id="sexo">
							<option value="M">Homem</option>
							<option value="F">Mulher</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="cargo">Cargo na igreja:</label>
						<input type="text" name="cargo" id="cargo" class="form-control" value="<?php echo $cargo ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="emprego">Emprego:</label>
						<input type="text" name="emprego" id="emprego" class="form-control" value="<?php echo $emprego ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="telefone">Telefone</label>
						<input type="tel" name="telefone" id="telefone" class="form-control" value="<?php echo $telefone ?>">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for='endereco'>Endereço</label>
						<input type="text" name="endereco" id="endereco" class="form-control" value="<?php echo $endereco ?>">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<button type="button" class="btn btn-success" id="btnDados">Enviar</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="w-50">
		<form enctype="multipart/form-data" id="formFotos">
			<div class="text-center">
				<div>
					<div class="d-flex">
						<div class="w-50">
							<p>Banner:</p>
						</div>
						<div class="w-50">
							<input type="file" class="form-control" name="banner" id="banner" onchange="carregarImg('#banner', 'mostrarBanner')">
						</div>
					</div>
					<img src="imagens/banners/<?= $banner ?>" alt="" width="400" id="mostrarBanner">
				</div>
				<div class="mt-2">
					<div class="d-flex">
						<div class="w-50">
							<p>Foto de Perfil (500x500):</p>
						</div>
						<div class="w-50">
							<input type="file" name="foto" id="foto" class="form-control" onchange="carregarImg('#foto', 'mostrarFoto')">
						</div>
					</div>
					<img src="imagens/<?= $foto ?>" alt="" width="150" id="mostrarFoto">
				</div>
			</div>
			<input type="submit" value="" id="btnFotos" class="d-none">
		</form>
	</div>
</div>

<script type="text/javascript">
	function carregarImg(id, dest) {
		var target = document.getElementById(dest);
		var file = document.querySelector(id).files[0];
		var reader = new FileReader();
		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);
		} else {
			target.src = "";
		}
		$('#btnFotos').click();
	}
</script>

<script>
	$(document).ready(function() {
		$('#btnDados').click(function() {
			var nome = $('#nome').val();
			var nasc = $('#nasc').val();
			var sexo = $('#sexo').val();
			var cargo = $('#cargo').val();
			var emprego = $('#emprego').val();
			var telefone = $('#telefone').val();
			var endereco = $('#endereco').val();
			$.ajax({
				url: 'membros/atualizarPerfil.php',
				method: "post",
				data: {
					nome,
					nasc,
					sexo,
					cargo,
					emprego,
					telefone,
					endereco
				},
				dataType: 'text',
				success: function(msg) {
					alert(msg);
				}
			})
		})
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#formFotos').submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: "membros/atualizarFotos.php",
				type: 'POST',
				data: formData,
				success: function(mensagem) {
					alert(mensagem)
				},
				cache: false,
				contentType: false,
				processData: false,
				xhr: function() { // Custom XMLHttpRequest
					var myXhr = $.ajaxSettings.xhr();
					if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
						myXhr.upload.addEventListener('progress', function() {
							/* faz alguma coisa durante o progresso do upload */
						}, false);
					}
					return myXhr;
				}
			});
		})
	})
</script>