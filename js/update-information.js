document
	.getElementById("btn-update-information")
	.addEventListener("click", checkUpdate);

document.getElementById("btn-modal").addEventListener("click", refreshPage);

function refreshPage() {
	location.reload();
}

function updateUser() {
	// Ajax-kutsu kohdistuu ohjelmaan post.php ja lähettää htun -tiedon php-koodille send-metodilla
	const xhrObject = new XMLHttpRequest();
	let url = "update-information.php";
	xhrObject.open("POST", url, true);

	xhrObject.setRequestHeader(
		"Content-Type",
		"application/x-www-form-urlencoded"
	);

	xhrObject.onload = function () {
		if (xhrObject.status === 200) {
			// php-koodi on suoritettu ja nyt on palattu takaisin app.js-koodiin
			// käsitellään php-koodin palauttama tieto onnistuiko lisäys
			document.getElementById("modal-text").innerHTML = "Tiedot päivitetty!";
		}
	};
	xhrObject.onerror = function () {
		document.getElementById("modal-text").innerHTML =
			"Virhe lisäyksessä. Yritä myöhemmin uudelleen.";
	};

	// lähetetään tiedot Ajax requestin datassa post.php:lle
	let firstname = document.getElementById("firstname").value;
	let lastname = document.getElementById("lastname").value;
	let address = document.getElementById("address").value;
	let postalcode = document.getElementById("postalcode").value;
	let email = document.getElementById("email").value;
	let phonenumber = document.getElementById("phonenumber").value;
	let postarea = document.getElementById("postarea").value;
	console.log(
		firstname,
		lastname,
		address,
		postalcode,
		postarea,
		email,
		phonenumber
	);
	xhrObject.send(
		"firstname=" +
			firstname +
			"&lastname=" +
			lastname +
			"&address=" +
			address +
			"&postalcode=" +
			postalcode +
			"&email=" +
			email +
			"&phonenumber=" +
			phonenumber +
			"&postarea=" +
			postarea
	);
}

function checkUpdate() {
	let postalcodeCheck,
		addressCheck,
		firstnameCheck,
		lastnameCheck,
		firstname,
		lastname,
		address,
		postalcode,
		email,
		emailCheck,
		postarea,
		postareaCheck,
		phonenumber,
		phonenumberCheck;

	// Get the value of the input field with different IDs
	firstname = document.getElementById("firstname").value;
	lastname = document.getElementById("lastname").value;
	address = document.getElementById("address").value;
	postarea = document.getElementById("postarea").value;
	postalcode = document.getElementById("postalcode").value;
	email = document.getElementById("email").value;
	phonenumber = document.getElementById("phonenumber").value;

	// funktiokutsu tarkistaa syötteen
	if (checkInputEtunimi(firstname) === false) {
		document.getElementById("modal-text").innerHTML =
			"Syöte ei saa sisältää numeroita tai erikoismerkkejä.";
	} else if (checkInputEtunimi(firstname) === true) {
		firstnameCheck = true;
	}

	// funktiokutsu tarkistaa onko syötteessä muita kun numeroita ja 5-merkkinen
	if (checkInputSukunimi(lastname) === false) {
		document.getElementById("modal-text").innerHTML =
			"Syöte saa sisältää ainoastaan kirjaimia ja joitain erikoismerkkejä.";
	} else if (checkInputSukunimi(lastname) === true) {
		lastnameCheck = true;
	}

	// funktiokutsu tarkistaa onko syötteessä muita kun numeroita ja 5-merkkinen
	if (checkInputPostinro(postalcode) === false) {
		document.getElementById("modal-text").innerHTML =
			"Syötteen täytyy olla 5-merkkinen numerosarja.";
	} else if (checkInputPostinro(postalcode) === true) {
		postalcodeCheck = true;
	}

	// funktiokutsu tarkistaa seuraako osoite suomen osoitemuotoa
	if (checkInputOsoite(address) === false) {
		document.getElementById("modal-text").innerHTML =
			"Syötteen täytyy seurata suomen osoitekäytäntöä.";
	} else if (checkInputOsoite(address) === true) {
		addressCheck = true;
	}

	// funktiokutsu tarkistaa seuraako osoite suomen osoitemuotoa
	if (checkInputSposti(email) === false) {
		document.getElementById("modal-text").innerHTML =
			"Syötteen täytyy seurata suomen osoitekäytäntöä.";
	} else if (checkInputSposti(email) === true) {
		emailCheck = true;
	}

	// funktiokutsu tarkistaa seuraako osoite suomen osoitemuotoa
	if (checkInputPostipaikka(postarea) === false) {
		document.getElementById("modal-text").innerHTML =
			"Syötteen täytyy seurata suomen osoitekäytäntöä.";
	} else if (checkInputPostipaikka(postarea) === true) {
		postareaCheck = true;
	}

	// funktiokutsu tarkistaa seuraako osoite suomen osoitemuotoa
	if (checkInputPuhnro(phonenumber) === false) {
		document.getElementById("modal-text").innerHTML =
			"Syötteen täytyy seurata suomen osoitekäytäntöä.";
	} else if (checkInputPuhnro(phonenumber) === true) {
		phonenumberCheck = true;
	}

	//jos kaikki kentat ovat oikein niin siirrytään lisaaKayttaja()-metodiin
	if (
		postalcodeCheck === true &&
		addressCheck === true &&
		firstnameCheck === true &&
		lastnameCheck === true
	) {
		document.getElementById("modal-text").innerHTML =
			"Lisätään tietokantaan...";
		updateUser();
	}
}

////////////////////////////////
/// Tarkistusfunktiot alkaa ///
//////////////////////////////
function checkInputEtunimi(x) {
	let regex = /^[ÖÄA-Z]+[öäa-z]+([-][ÄÖA-Z]+[öäa-z]+)*$/;
	if (x.match(regex) && x.length <= 30) {
		return true;
	} else return false;
}

function checkInputSukunimi(x) {
	let regex = /^[ÖÄA-Z]+[öäa-z]+([-][ÄÖA-Z]+[öäa-z]+)*$/;

	// korjaa muut myöhemmin samanlaisiksi
	if (x.match(regex) && x.length <= 50) {
		return true;
	} else return false;
}

// tarkistaa onko syötteessä muita kun numeroita ja pituus 5 merkkiä
function checkInputPostinro(x) {
	let regex = /^[0-9]{5}$/;
	if (x.match(regex) && x.length === 5) {
		return true;
	} else return false;
}

// tarkistaa puhelinnumerosyötteen oikeellisuuden ( https://regex101.com/r/DsaRfI/1 )
function checkInputPuhnro(x) {
	let regex = /^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/;
	if (x.match(regex)) {
		return true;
	} else return false;
}

// tarkistaa puhelinnumerosyötteen oikeellisuuden ( https://www.regexpal.com/93592 )
function checkInputPostipaikka(x) {
	let regex = /^[A-ZÖÄÅa-zäöå][A-ZÖÄÅa-zöäå]+$/;
	if (x.match(regex)) {
		return true;
	} else return false;
}

// tarkistaa puhelinnumerosyötteen oikeellisuuden ( https://www.regexpal.com/93592 )
function checkInputOsoite(x) {
	let regex = /^[ÄÅÖA-Za-zäåö]+\s+\d+\d?$/;
	if (x.match(regex)) {
		return true;
	} else return false;
}

function checkInputSalasana(x) {
	let regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
	if (x.match(regex)) {
		return true;
	} else return false;
}

function checkInputSposti(x) {
	let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if (x.match(regex)) {
		return true;
	} else return false;
}
