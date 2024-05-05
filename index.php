<!DOCTYPE html>
<html lang="pt-br">

<head>
	<!-- Meta tags Obrigatórias -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Paulo Vitor Guedes">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<title>App Mail Send</title>

</head>

<body>

	<div class="container">

		<div class="py-3 text-center">
			<img class="d-block mx-auto mb-2" src="./_img/logo.png" alt="" width="72" height="72">
			<h2>Send Mail</h2>
			<p class="lead">Seu app de envio de e-mails particular!</p>
		</div>

		<div class="row">
			<div class="col-md-12">

				<div class="card-body font-weight-bold">
					<form action="./_module/processMailing.php" method="post">
						<div class="form-group">
							<label for="para">Para</label>
							<input type="text" name="email" class="form-control" id="para" placeholder="@dominio.com.br">
						</div>

						<div class="form-group">
							<label for="assunto">Assunto</label>
							<input type="text" name="subject" class="form-control" id="assunto" placeholder="Assundo do e-mail">
						</div>

						<div class="form-group">
							<label for="mensagem">Mensagem</label>
							<textarea name="message" class="form-control" id="mensagem"></textarea>
						</div>

						<button type="submit" class="btn btn-primary btn-lg">Enviar Mensagem</button>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>