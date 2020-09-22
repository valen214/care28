<?php
/**
 * Template Name: Login Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

global $wpdb;
get_header();

?>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="/css/style.css" type="text/css" />
<link rel="stylesheet" href="/css/dark.css" type="text/css" />
<link rel="stylesheet" href="/css/font-icons.css" type="text/css" />
<link rel="stylesheet" href="/css/animate.css" type="text/css" />
<link rel="stylesheet" href="/css/magnific-popup.css" type="text/css" />

<link rel="stylesheet" href="/css/custom.css" type="text/css" />
<style>
.form-container {
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
}

.button-group {
	margin-top: 15px;
}

#login-form-submit {
	margin-right: 15px;
}

.form-control {

}

#login-form-wrong-info-message {
	color: red;
	display: none;
	margin-bottom: 10px;
}
</style>


<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">
<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap py-0">

		<div class="section dark p-0 m-0 h-100 position-absolute"></div>

		<div class="section bg-transparent min-vh-100 p-0 m-0 d-flex">
			<div class="vertical-middle">
				<div class="container py-5">


					<div class="card mx-auto rounded-0 border-0" style="max-width: 400px;">
						<div class="card-body" style="padding: 40px;">
							<form id="login-form" name="login-form" class="mb-0" action="#" method="post">
								<h3>Login to your Account</h3>

								<div class="row">
									<div class="col-12 form-group">
										<label for="login-form-username">Username:</label>
										<input type="text" id="login-form-username" name="login-form-username" value="" class="form-control not-dark" />
									</div>

									<div class="col-12 form-group">
										<label for="login-form-password">Password:</label>
										<input type="password" id="login-form-password" name="login-form-password" value="" class="form-control not-dark" />
									</div>


									<div id="login-form-wrong-info-message"
											class="col-12">
										Wrong username or password
									</div>
									<div class="col-12 form-group mb-0">
										<button class="button button-3d button-black m-0" id="login-form-submit" name="login-form-submit" value="login">Login</button>
										<a href="#" class="float-right">Forgot Password?</a><br/>
										<a href="/register" class="float-right">register</a>
									</div>
								</div>
							</form>

							<div class="line line-sm"></div>

						</div>
					</div>

					<div class="text-center text-muted mt-3"><small>Copyrights &copy; All Rights Reserved by Canvas Inc.</small></div>

				</div>
			</div>
		</div>

	</div>
</section><!-- #content end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>



<script>
(function(){

const USER_API_URL = document.location.origin + "/wp-json/api/v1/user";
const TOKEN_API_URL = document.location.origin + "/wp-json/jwt-auth/v1/token";

let loginWrongInfoMessage = document.getElementById("login-form-wrong-info-message");
let loginUsernameInput = document.getElementById("login-form-username");
let loginPasswordInput = document.getElementById("login-form-password");
let loginButton = document.getElementById("login-form-submit");

async function loginAttempt(){
	let token = fetch(TOKEN_API_URL, {
		method: "POST",
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			username: loginUsernameInput.value,
			password: loginPasswordInput.value,
		})
	});

	let out = await fetch(USER_API_URL, {
		method: "POST",
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			action: "login",
			username: loginUsernameInput.value,
			password: loginPasswordInput.value,
		}),
	});
	if(out.status !== 200){
		loginWrongInfoMessage.style.display = "block";
		loginUsernameInput.style.borderColor = "red";
		loginPasswordInput.style.borderColor = "red";
		
		let hideMessage = () => {
			loginWrongInfoMessage.style.display = null;
			loginUsernameInput.style.borderColor = null;
			loginPasswordInput.style.borderColor = null;

			loginUsernameInput.removeEventListener("input", hideMessage);
			loginPasswordInput.removeEventListener("input", hideMessage);			
		};
		loginUsernameInput.addEventListener("input", hideMessage);
		loginPasswordInput.addEventListener("input", hideMessage);

		console.error("user login failed:", await out.json());
		return;
	}
	out = await out.json();
	console.log(out);
	if(out.body !== "ok"){
		console.error("unexpected api response")
		return;
	}
	token = await token;
	if(token.status !== 200){
		console.error("retrieve JWT failed:", token, await token.json());
		return;
	}
	token = await token.json();
	console.log("retrieved JWT token:", token);

	localStorage.setItem("token", token.token);
	document.location.replace(document.location.origin + "/profile");
}

loginPasswordInput.addEventListener("keyup", e => {
	if(e.keyCode === 13 || e.code === "Enter"){
		loginAttempt();
	}
})

loginButton.addEventListener('click', (e) => {
	e.preventDefault();
	loginAttempt();
});


})();
</script>

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>

