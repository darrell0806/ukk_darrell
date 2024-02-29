<script src="<?=base_url('assets/static/js/initTheme.js')?>"></script>
<div id="auth">
	<div class="row h-100">
		<div class="col-lg-5 col-12">
			<div id="auth-left">
				<div class="auth-logo">
				<img src="<?=base_url('assets/compiled/svg/T&T Supermarket.svg')?>"> 
				</div>

				<h1 class="auth-title">Log in.</h1>
				<p class="auth-subtitle mb-5">
					Masuk dengan kredensial yang telah terdaftar sebelumnya.
				</p>

				<?php if (session()->has('error')): ?>
				<div class="alert alert-danger"><i class="bi bi-exclamation-circle"></i>
					<?= session('error') ?></div>
				<?php endif; ?>

				<form action="<?= base_url('/login/aksi_login/')?>"method="post">

					<div class="form-group position-relative mb-4">
						<div class="input-group">
							<span class="input-group-text"><i class="fa-solid fa-user"></i></span>
							<input type="text" class="form-control form-control-xl" placeholder="Username" name="username"/>
						</div>
					</div>

					<div class="form-group position-relative mb-4">
						<div class="input-group">
							<span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
							<input type="password" class="form-control form-control-xl" placeholder="Password" name="password" id="password-input">
							<button type="button" class="btn btn-outline-primary" id="show-password-btn">
								<i class="fa-solid fa-eye"></i>
							</button>
						</div>
					</div>

					<div class="form-check form-check-lg d-flex align-items-end mb-4">
						<input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault"/>
						<label class="form-check-label text-gray-600" for="flexCheckDefault">
							Ingat Saya
						</label>
					</div>

					<!-- <div class="g-recaptcha" data-sitekey="6LcEfuojAAAAANG5m1V5uLxuVdX1L9ZXYA9XUM9v" data-callback="onCaptchaVerified"></div> -->

					<button type="submit" class="btn btn-primary btn-block shadow-lg btn-lg mt-5">Log in</button>
				</form>

				
			</div>
		</div>
		<div class="col-lg-7 d-none d-lg-block">
			<div id="auth-right"></div>
		</div>
	</div>
</div>
</body>
</html>

<script>
	// Saat halaman dimuat
	document.addEventListener("DOMContentLoaded", function() {
  // Cek apakah ada cookie dengan nama "remember_me"
		if (getCookie("remember_me")) {
    // Jika ada, tandai checkbox "Ingat Saya"
			document.getElementById("flexCheckDefault").checked = true;
    // Dan isi field username dan password dengan nilai cookie
			var cookie = JSON.parse(getCookie("remember_me"));
			if (cookie && cookie.username && cookie.password) {
				document.getElementsByName("username")[0].value = cookie.username;
				document.getElementsByName("password")[0].value = cookie.password;
			}
		}
	});

// Saat form login disubmit
	document.querySelector("form").addEventListener("submit", function() {
  // Cek apakah checkbox "Ingat Saya" di-tick
		if (document.getElementById("flexCheckDefault").checked) {
    // Jika iya, buat cookie dengan nama "remember_me" yang berisi nilai username dan password
			var username = document.getElementsByName("username")[0].value;
			var password = document.getElementsByName("password")[0].value;
			if (username && password) {
				var cookie = {
					username: username,
					password: password
				};
				setCookie("remember_me", JSON.stringify(cookie), 30);
			}
		} else {
    // Jika tidak, hapus cookie dengan nama "remember_me" (jika ada)
			deleteCookie("remember_me");
		}
	});

// Fungsi untuk membuat cookie
	function setCookie(name, value, days) {
		var expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "") + expires + "; path=/";
	}

// Fungsi untuk membaca nilai cookie
	function getCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

// Fungsi untuk menghapus cookie
	function deleteCookie(name) {
		document.cookie = name + '=; Max-Age=-99999999;';
	}


	$(document).ready(function() {
		$('#show-password-btn').click(function() {
			var passwordInput = $('#password-input');
			var passwordInputType = passwordInput.attr('type');
			var showPasswordBtn = $('#show-password-btn');
			if (passwordInputType === 'password') {
				passwordInput.attr('type', 'text');
				showPasswordBtn.html('<i class="fa-solid fa-eye-slash"></i>');
			} else {
				passwordInput.attr('type', 'password');
				showPasswordBtn.html('<i class="fa-solid fa-eye"></i>');
			}
		});
	});

</script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    // Callback function saat CAPTCHA berhasil diverifikasi
	function onCaptchaVerified(token) {
        // Enable tombol login
		document.getElementById("login-button").disabled = false;
	}
</script>