

function checkRegister() {
		const username = document.getElementById("username");
		const email = document.getElementById("email");
		const password = document.getElementById("password");
		const password2 = document.getElementById("password2");
		const usernameError = document.getElementById("username-error");
		const emailError = document.getElementById("email-error");
		const passwordError = document.getElementById("password-error");
		const password2Error = document.getElementById("password2-error");

    if (username.value === "") {
        usernameError.innerText = "Please fill in your username!";
        username.focus();
        return false;
    }

    if (email.value === "") {
        emailError.innerText = "Please fill in your email!";
        email.focus();
        return false;
    } else if (!isEmail(email.value)) {
				emailError.innerText = "Invalid Email";
				email.focus();
				return false;
		}

    if (password.value === "") {
        passwordError.innerText = "Please choose your password!";
        password.focus();
        return false;
    }

    if (password2.value === "") {
        password2Error.innerText = "Please confirm your password!";
        password2.focus();
        return false;
    }

    if (password.value !== password2.value) {
        password2Error.innerText = "Passwords do not match!"
        password2.focus();
        return false;
    } else {
			password2Error.innerText = "";
		}


		if (!checkUsername()) {
			username.focus();
			return false;
		}

		if (!checkEmail()) {
			email.focus();
			return false;
		}
}

function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function checkUsername() {
	const username = document.getElementById("username");
	const usernameError = document.getElementById("username-error");

	var isMatch = false;
	var http = new XMLHttpRequest();
	var url = "helpers/signup.helper.php";
	var params = "username="+username.value;
	http.open("POST", url, false);

	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText) {
				usernameError.innerText = "Username already exits!";
				username.focus();
				isMatch = true;
			} else {
				usernameError.innerText = "";
			}
		}

	}
	http.send(params);
	if (isMatch) {
		return false;
	} else {
		usernameError.innerText = "";
		return true;
	}
}

function checkEmail() {
	const email = document.getElementById("email");
	const emailError = document.getElementById("email-error");

	var isMatch = false;
	var http = new XMLHttpRequest();
	var url = "helpers/signup.helper.php";
	var params = "email="+email.value;
	http.open("POST", url, false);

	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText) {
				emailError.innerText = "Email already exits!";
				email.focus();
				isMatch = true;
			} else {
				emailError.innerText = "";
			}
		}

	}
	http.send(params);
	if (isMatch) {
		return false;
	} else {
		emailError.innerText = "";
		return true;
	}
}

function checkSignIn() {
	const username = document.getElementById("username");
	const usernameError = document.getElementById("username-error");

	const password = document.getElementById("password");
	const passwordError = document.getElementById("password-error");

	var isValidUsername = true;
	var isValidPassword = true;

	if (username.value == "") {
		usernameError.innerText = "Please fill in your username";
		username.focus();
		return false;
	} else {
		usernameError.innerText = "";
	}

	if (password.value == "") {
		passwordError.innerText = "Please choose your password";
		password.focus();
		return false;
	} else {
		passwordError.innerText = "";
	}

	var http = new XMLHttpRequest();
	var url = "helpers/signin.helper.php";
	var params = "username=" + username.value+"&password=" + password.value;
	http.open("POST", url, false);

	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText == "username") {
				usernameError.innerText = "This username has not been registered. Please sign up!";
				username.focus();
				isValidUsername = false;
			} else if (this.responseText == "password") {
				passwordError.innerText = "Password does not match";
				password.focus();
				isValidPassword = false;
			} else {
				usernameError.innerText = "";
			}
		}
	}
	http.send(params);

	if (!isValidPassword || !isValidUsername) {
		return false;
	}
}
