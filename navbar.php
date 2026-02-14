<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-purple sticky-top">
		<div class="container">
			<a class="navbar-brand fw-bold text-purple" href="index.php">Rent Lion</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="menu">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item"><a class="nav-link" href="index.php#o-nas">O nas</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php#oferta">Oferta</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php#kontakt">Kontakt</a></li>
					<?php if (isset($_SESSION["email"])): ?>
						<li class="nav-item"><a class="nav-link" href="profile.php">Profil</a></li>
					<?php else: ?>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
					<?php endif; ?>

				</ul>
			</div>
		</div>
</nav>