document
	.getElementById("btn-change-password")
	.addEventListener("click", checkUpdate);

function updateUser() {
	// Ajax-kutsu kohdistuu ohjelmaan post.php ja lähettää htun -tiedon php-koodille send-metodilla
	const xhrObject = new XMLHttpRequest();
	let url = "change-password.php";
	xhrObject.open("POST", url, true);

	xhrObject.setRequestHeader(
		"Content-Type",
		"application/x-www-form-urlencoded"
	);

	xhrObject.onload = function () {
		if (xhrObject.status === 200) {
			// php-koodi on suoritettu ja nyt on palattu takaisin app.js-koodiin
			// käsitellään php-koodin palauttama tieto onnistuiko lisäys

			window.location.replace("login.php");
		}
	};
	xhrObject.onerror = function () {
		document.getElementById("modal-text").innerHTML =
			"Virhe lisäyksessä. Yritä myöhemmin uudelleen.";
	};

	// lähetetään tiedot Ajax requestin datassa post.php:lle
	let current_password = document.getElementById("current-password").value;
	let new_password = document.getElementById("new-password").value;
	let confirm_password = document.getElementById("new-password-again").value;
	console.log(confirm_password, new_password, current_password);
	xhrObject.send(
		"current_password" +
			current_password +
			"&new_password=" +
			new_password +
			"&confirm_password=" +
			confirm_password
	);
}

function checkUpdate() {
	let current_passwordCheck, new_passwordCheck, new_password_againCheck;
	// Get the value of the input field with different IDs
	let current_password = document.getElementById("current-password").value;
	let new_password = document.getElementById("new-password").value;
	let new_password_again = document.getElementById("new-password-again").value;

	// funktiokutsu tarkistaa syötteen
	if (checkInputSalasana(current_password) === false) {
		document.getElementById("modal-text").innerHTML =
			"Salasanan tulee sisältää 8 merkkiä, jossa mukana 1 iso kirjain ja 1 erikoismerkki.";
	} else if (checkInputSalasana(current_password) === true) {
		current_passwordCheck = true;
	}

	// funktiokutsu tarkistaa syötteen
	if (checkInputSalasana(new_password) === false) {
		document.getElementById("modal-text").innerHTML =
			"Salasanan tulee sisältää 8 merkkiä, jossa mukana 1 iso kirjain ja 1 erikoismerkki.";
	} else if (checkInputSalasana(new_password) === true) {
		new_passwordCheck = true;
	}

	// funktiokutsu tarkistaa onko syötteessä muita kun numeroita ja 5-merkkinen
	if (checkInputSalasana(new_password_again) === false) {
		document.getElementById("modal-text").innerHTML =
			"Salasanan tulee sisältää 8 merkkiä, jossa mukana 1 iso kirjain ja 1 erikoismerkki.";
	} else if (new_password_again != new_password) {
		new_passwordCheck = false;
		new_password_againCheck = false;
	} else if (checkInputSalasana(new_password_again) === true) {
		new_password_againCheck = true;
	}

	//jos kaikki kentat ovat oikein niin siirrytään lisaaKayttaja()-metodiin
	if (
		new_password_againCheck === true &&
		new_passwordCheck === true &&
		current_passwordCheck === true
	) {
		document.getElementById("modal-text").innerHTML =
			"Lisätään tietokantaan...";
		updateUser();
	}
}

// Tarkistusfunktio

function checkInputSalasana(x) {
	let regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
	if (x.match(regex)) {
		return true;
	} else return false;
}
