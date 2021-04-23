//Global variable for starting page
var currentPageId = "page-home";
var currentSelectorId = "home";

//Function for getting the button ids
function getButtons() {
	//List of button ids
	var list = ["home", "feed", "create", "account"];
	return list;
}

//Make sure the window is loaded before we add listeners
window.onload = function () {
	var pageIdList = getButtons();
	//Add an event listener to each button
	pageIdList.forEach(function (page) {
		document.getElementById(page).addEventListener("click", changePage, false);
	});
};

function changePage() {
	var currentSelector = document.getElementById(currentSelectorId);
	var currentPage = document.getElementById(currentPageId);
	var pageId = "page-" + this.id;
	var page = document.getElementById(pageId);
	var pageSelector = document.getElementById(this.id);

	if (page.classList.contains("active")) {
		return;
	}

	currentSelector.classList.remove("button-active");
	currentSelector.classList.add("button-inactive");
	currentPage.classList.remove("active");
	currentPage.classList.add("inactive");

	pageSelector.classList.remove("button-inactive");
	pageSelector.classList.add("button-active");

	page.classList.remove("inactive");
	page.classList.add("active");

	//Need to reset the scroll
	window.scrollTo(0, 0);

	currentSelectorId = this.id;
	currentPageId = pageId;
}

document
	.querySelectorAll(".contact-card")
	.forEach(element => element.addEventListener("click", selectContact, false));

document
	.querySelectorAll(".contact-card-phonenumber")
	.forEach(element => element.addEventListener("click", selectContact, false));

function test() {
	var currentPage = document.getElementById(currentPageId);
	var pageId = "page-" + home.id;
	var page = document.getElementById(pageId);
	currentPage.classList.remove("active");
	currentPage.classList.add("inactive");
	page.classList.remove("inactive");
	page.classList.add("active");
	currentPageId = pageId;
}

function selectContact(event) {
	let target = this.querySelector(".card-contact-name").innerHTML;
	let target_phone = this.querySelector(".card-contact-phone").innerHTML;

	document.getElementById("create").innerHTML = `${target}`;
	document.getElementById("target-phone").innerHTML = `${target_phone}`;
}

document
	.getElementById("btn-send-payment")
	.addEventListener("click", sendPayment);

function sendPayment() {
	let paymentAmount = document.getElementById("code").value;
	let paymentTarget = document.getElementById("create").innerHTML;
	let paymentTargetPhone = document.getElementById("target-phone").innerHTML;

	if (paymentAmount == "" || paymentAmount == "0") {
		document.getElementById(
			"payment-status"
		).innerHTML = `Valitse lähetettävä summa`;
		document.getElementById("payment-comment").disabled = true;
		document.getElementById("btn-send-payment").disabled = true;
		document.getElementById("payment-status").style.color = "red";
	} else if (paymentTarget == "Vastaanottaja") {
		document.getElementById(
			"payment-status"
		).innerHTML = `Valitse vastaanottaja`;
		document.getElementById("payment-comment").disabled = true;
		document.getElementById("btn-send-payment").disabled = true;
		document.getElementById("payment-status").style.color = "red";
	} else if (paymentTargetPhone == "") {
		document.getElementById(
			"payment-status"
		).innerHTML = `Valitse vastaanottaja`;
		document.getElementById("code").disabled = true;
		document.getElementById("btn-send-payment").disabled = true;
		document.getElementById("payment-status").style.color = "red";
	} else {
		document.getElementById("btn-send-payment").disabled = false;

		const xhrObject = new XMLHttpRequest();
		let url = "index.php";
		xhrObject.open("POST", url, true);

		xhrObject.setRequestHeader(
			"Content-Type",
			"application/x-www-form-urlencoded"
		);

		xhrObject.onload = function () {
			if (xhrObject.status === 200) {
				window.location.replace("confirm-payment.php");
			}
		};
		xhrObject.onerror = function () {
			console.error("Virhe lisäyksessä " + url);
			document.getElementById("register-success").innerHTML =
				"Virhe lisäyksessä. Yritä myöhemmin uudelleen.";
		};
		console.log(paymentTarget, paymentAmount, paymentTargetPhone);
		xhrObject.send(
			"paymentTarget=" +
				paymentTarget +
				"&paymentAmount=" +
				paymentAmount +
				"&paymentTargetPhone=" +
				paymentTargetPhone
		);
	}
}
