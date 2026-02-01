<?php session_start();?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Projekt Bootstrap – Denys Pavlenko</title>

	<!-- Bootstrap 5 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<!-- NAVBAR -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
		<div class="container">
			<a class="navbar-brand" href="#">Web Page</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="menu">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="#o-nas">O nas</a></li>
					<li class="nav-item"><a class="nav-link" href="#oferta">Oferta</a></li>
					<li class="nav-item"><a class="nav-link" href="#kontakt">Kontakt</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- HEADER -->
	<header
		class="min-vh-100 d-flex flex-column justify-content-center align-items-center text-center bg-dark text-light">
		<img class="header-logo"
			src="https://png.pngtree.com/png-clipart/20190611/original/pngtree-wolf-logo-png-image_2306634.jpg"
			alt="logo">
		<h1 class="display-4">Lorem ipsum dolo</h1>
		<p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
		<a href="#o-nas" class="btn btn-primary mt-3">Dowiedz się więcej</a>
	</header>

	<!-- O NAS -->
	<section id="o-nas" class="py-5 bg-dark text-light">
		<div class="container">
			<div class="row align-items-center">

				<div class="col-md-6">
					<h2>O nas</h2>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, est laudantium quasi odio
						similique ex porro impedit sed inventore dignissimos.</p>
				</div>

				<div class="col-md-6">
					<ul class="list-group">
						<li class="list-group-item">Profesjonalne podejście</li>
						<li class="list-group-item">Doświadczony zespół</li>
						<li class="list-group-item">Najwyższa jakość usług</li>
					</ul>
				</div>

			</div>
		</div>
	</section>

	<!-- OFERTA -->
	<section id="oferta" class="py-5">
		<div class="container">
			<h2 class="text-center mb-4">Oferta</h2>
			<div class="row g-4">

				<div class="col-sm-12 col-md-6 col-lg-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title">Usługa 1</h5>
							<p class="card-text">Opis usługi 1...</p>
						</div>
					</div>
				</div>

				<div class="col-sm-12 col-md-6 col-lg-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title">Usługa 2</h5>
							<p class="card-text">Opis usługi 2...</p>
						</div>
					</div>
				</div>

				<div class="col-sm-12 col-md-6 col-lg-4">
					<div class="card h-100">
						<div class="card-body">
							<h5 class="card-title">Usługa 3</h5>
							<p class="card-text">Opis usługi 3...</p>
						</div>
					</div>
				</div>

			</div>
			<div class="mt-5">
				<h3>FAQ</h3>

				<div class="faq-item">
					<h5 class="faq-question">Jak długo trwa realizacja?</h5>
					<div class="faq-answer" style="display: none;">
						Zwykle od 3 do 7 dni roboczych.
					</div>
				</div>

				<div class="faq-item">
					<h5 class="faq-question">Czy oferujecie wsparcie techniczne?</h5>
					<div class="faq-answer" style="display: none;">
						Tak, zapewniamy pełne wsparcie po realizacji projektu.
					</div>
				</div>

				<div class="faq-item">
					<h5 class="faq-question">Czy mogę zamówić indywidualny projekt?</h5>
					<div class="faq-answer" style="display: none;">
						Oczywiście — tworzymy projekty na zamówienie.
					</div>
				</div>
			</div>

		</div>
	</section>
	<section id="aktualnosci" class="py-5 bg-secondary">
		<div class="container">
			<h2 class="mb-4 text-light">Aktualności</h2>

			<button id="loadNews" class="btn btn-dark mb-3">
				Wczytaj aktualności
			</button>

			<div id="newsContainer" class="row g-3"></div>
		</div>
	</section>

	<!-- KONTAKT -->
	<section id="kontakt" class="py-5 bg-dark text-light">
		<div class="container">
			<h2 class="text-center mb-4">Kontakt</h2>

			<form class="row g-3">

				<div class="col-md-6">
					<label class="form-label">Imię</label>
					<input type="text" class="form-control" placeholder="Wpisz imię">
				</div>

				<div class="col-md-6">
					<label class="form-label">Email</label>
					<input type="email" class="form-control" placeholder="Wpisz email">
				</div>

				<div class="col-md-6">
					<label class="form-label">Temat</label>
					<input type="text" class="form-control" placeholder="Temat wiadomości">
				</div>

				<div class="col-md-6">
					<label class="form-label">Treść</label>
					<input type="text" class="form-control" placeholder="Treść wiadomości">
				</div>

				<div class="col-12 text-center">
					<button type="submit" class="btn btn-primary">Wyślij</button>
				</div>

			</form>
		</div>
	</section>

	<!-- FOOTER -->
	<footer class="text-center py-3 bg-light text-dark">
		Stopka
	</footer>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="script.js"></script>
	
</body>

</html>