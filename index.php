<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=	, initial-scale=1.0">
	<title>	Générateur PDF</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>
<body>
		
				<div class="container mt-5">

					<form method="post">

					<h1>Générateur d'attestation mutuelle</h1>

							<div class = "row mb-2">

								<div class = "col-md-6">
									<input type='text' name="prenom" placeholder="Prénom (requis)" class="form-control" required>
								</div>

								<div class = "col-md-6"> 
									<input type='text' name="nom" placeholder="Nom (requis)" class="form-control" required>
								</div>

							</div>

							<div class="mb-2">
									<input type='text' name="mutuelle" placeholder="Mutuelle" class="form-control">
							</div>

							<div class="mb-2">
									<input type='text' name="numade" placeholder="Numéro Adhérent" class="form-control">
							</div>

							<div class="mb-2">
									<input type='text' name="secu" placeholder="Sécurité sociale" class="form-control">
							</div>


							<div class="mb-2">
									<input type='text' name="somme" placeholder="Somme (55 euros si vide)" class="form-control">
							</div>

							<div class="mb-2">
									<input type='text' name="nbconsult" placeholder="Nombre de consultations (1 si vide)" class="form-control">
							</div>

							<div class="mb-2">
									<input type='date' name="dateconsult" placeholder="Date de la consultation (aujourd'hui si vide)" class="form-control">
							</div>


							<div class="mb-2">
							<input type="submit" class="btn	btn-success btn-lg btn-block" value="Générer PDF" formaction="makepdf.php">
							</div>

							<div class="mb-2">
									<input type='email' name="email" placeholder="E-mail" class="form-control">
							</div>

							<div class="mb-2">
							<input type="submit" class="btn	btn-success btn-lg btn-block" value="Envoyer mail" formaction="sendpdf.php">
							</div>


						</form>




				</div>
</body>
</html>						

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
</body>
</html>