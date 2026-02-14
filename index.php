<?php session_start();
require("db.php");
$stmt = $pdo->query("SELECT * FROM plans ORDER BY price ASC");
$plans = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rent Lion</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="profile.css">
</head>

<body>

	<?php include "navbar.php"; ?>

	<!-- HEADER -->
	<header
		class="min-vh-50 d-flex flex-column justify-content-center align-items-center text-center container py-5">
		<img class="header-logo" src="images\toppng.com-red-lion-clip-art-at-clker-red-lion-logo-600x366.png"
			alt="logo">
		<h1 class="display-4">VPS Serwery</h1>
		<a href="#oferta" class="btn btn-primary mt-3">Dowiedz się więcej</a>
	</header>

	<!-- O NAS -->
	<section id="o-nas" class="container py-5">
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
	<section id="oferta" class="container py-5">
		<h1 class="text-center mb-5">Wybierz swój VPS</h1>
		<div class="row g-4"> 
			<?php foreach ($plans as $p): ?>
				<div class="col-md-4">
					<div class="vps-card">
						<h3 class="plan-title"><?= htmlspecialchars($p["name"]) ?></h3>
						<p class="plan-price"><?= $p["price"] ?> zł / mies</p>
						<ul class="plan-features">
							<li><strong>CPU:</strong> <?= htmlspecialchars($p["cpu"]) ?></li>
							<li><strong>RAM:</strong> <?= htmlspecialchars($p["ram"]) ?></li>
							<li><strong>Dysk:</strong> <?= htmlspecialchars($p["storage"]) ?></li>
							<li><strong>Transfer:</strong> <?= htmlspecialchars($p["bandwidth"]) ?></li>
						</ul> <a href="vps_details.php?id=<?= $p["id"] ?>" class="btn btn-warning text-light w-100">Zobacz szczegóły</a>
					</div>
				</div> 
			<?php endforeach; ?>
		</div>
		</section>
	<!-- AKTUALNOSCI -->
	<section id="aktualnosci" class="container py-5">
		<div class="container">
			<h2 class="mb-4 text-light">Aktualności</h2>

			<button id="loadNews" class="btn btn-dark mb-3">
				Wczytaj aktualności
			</button>

			<div id="newsContainer" class="row g-3"></div>
		</div>
	</section>

	<!-- KONTAKT -->
	<section id="kontakt" class="container py-5">
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