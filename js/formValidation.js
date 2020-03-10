const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

username.addEventListener('keyup', nameVerify, true);
email.addEventListener('keyup', emailVerify, true);
password.addEventListener('keyup', passwordVerify, true);
password2.addEventListener('keyup', password2Verify, true);

function validateSignUp() {

	if (username.value === '') {
		setErrorFor(username, 'Please fill in your username!');
		username.focus();
		return false;
	} else {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if (this.responseText == 'match') {
					setErrorFor(username, "This username has already exists!")
					username.focus();
					return false;
				}
			}
		};
		xmlhttp.open("GET", "validation.php?usrname="+username.value, true);
		xmlhttp.send();
	}


	if (email.value === '') {
		setErrorFor(email, 'Email should not be blank');
		email.focus();
		return false;
	} else if (!isEmail(email.value)) {
		setErrorFor(email, 'Email is invalid!')
		email.focus();
		return false;
	}

	if (password.value === '') {
		setErrorFor(password, 'Please choose a password');
		password.focus();
		return false;
	}

	if (password2.value === '') {
		setErrorFor(password2, 'Please confirm your password');
		password2.focus();
		return false;
	} else if (password2.value !== password.value) {
		setErrorFor(password2, 'Passwords do not match');
		password2.focus();
		return false;
	}
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function nameVerify() {
	if (username.value !== '') {
		setSuccessFor(username);
		return true;
	}
}

function emailVerify() {
	if (email.value !== '' && isEmail(email.value)) {
		setSuccessFor(email);
		return true;
	}
}

function passwordVerify() {
	if (password.value !== '') {
		setSuccessFor(password);
		return true;
	}
}

function password2Verify() {
	if (password.value !== '' && password.value === password2.value) {
		setSuccessFor(password2);
		return true;
	}
}

// Validate Login Page
function validateLogin() {
	if (username.value === '') {
		setErrorFor(username, 'Please fill in your username!');
		username.focus();
		return false;
	}

	if (password.value === '') {
		setErrorFor(password, 'Please choose a password');
		password.focus();
		return false;
	}
}

function checkForm(form) {
	if (this.username.value == "") {
		setErrorFor(username, "Please fill in your form");
		this.username.focus();
		return false;
	}

	if (this.email.value == "") {
		setErrorFor(email, "Please fill in your email");
		return false;
	}

	if (this.password.value == "") {
		setErrorFor(password, "Please fill in your password");
		return false;
	}

	if (this.password2.value == "") {
		setErrorFor(password2, "Please confirm your password");
		return false;
	}

	if (this.password.value != this.password2.value) {
		setErrorFor(password2, "Passwords do not match");
		return false;
	}
}
