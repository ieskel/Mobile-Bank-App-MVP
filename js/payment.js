document
	.getElementById("btn-accept-payment")
	.addEventListener("click", insertPayment);

window.onload = function checkPayment() {
	let paymentComment = document.getElementById("payment-comment").value;
	let paymentTarget = document.getElementById("payment-target").innerHTML;
	let paymentAmount = document.getElementById("payment-amount").innerHTML;
	let paymentTargetPhone = document.getElementById("payment-target-phone")
		.innerHTML;
	console.log(paymentTargetPhone, paymentTarget, paymentComment, paymentAmount);
	if (paymentAmount == "") {
		document.getElementById(
			"payment-status"
		).innerHTML = `Palaa takaisin ja valitse lähetettävä summa!`;
		document.getElementById("payment-comment").disabled = true;
		document.getElementById("btn-accept-payment").disabled = true;
		document.getElementById("payment-status").style.color = "red";
	} else if (paymentTarget == "Vastaanottaja") {
		document.getElementById(
			"payment-status"
		).innerHTML = `Palaa takaisin ja valitse kontakti!`;
		document.getElementById("payment-comment").disabled = true;
		document.getElementById("btn-accept-payment").disabled = true;
		document.getElementById("payment-status").style.color = "red";
	} else if (paymentTargetPhone == "") {
		document.getElementById(
			"payment-status"
		).innerHTML = `Palaa takaisin ja valitse kontakti!`;
		document.getElementById("payment-comment").disabled = true;
		document.getElementById("btn-accept-payment").disabled = true;
		document.getElementById("payment-status").style.color = "red";
	}
};

function insertPayment() {
	// lähetetään tiedot Ajax requestin datassa post.php:lle
	let paymentComment = document.getElementById("payment-comment").value;
	let paymentTarget = document.getElementById("payment-target").innerHTML;
	let paymentAmount = document.getElementById("payment-amount").innerHTML;
	let paymentTargetPhone = document.getElementById("payment-target-phone")
		.innerHTML;

	if (paymentAmount == " €") {
		document.getElementById(
			"payment-status"
		).innerHTML = `Palaa takaisin ja valitse lähetettävä summa!`;
		document.getElementById("payment-comment").disabled = true;
		document.getElementById("btn-accept-payment").disabled = true;
		document.getElementById("payment-status").style.color = "red";
	} else if (paymentTarget == "Vastaanottaja" || paymentTarget == "") {
		document.getElementById(
			"payment-status"
		).innerHTML = `Palaa takaisin ja valitse vastaanottaja!`;
		document.getElementById("payment-comment").disabled = true;
		document.getElementById("btn-accept-payment").disabled = true;
		document.getElementById("payment-status").style.color = "red";
	} else if (
		paymentTargetPhone == "" ||
		paymentTargetPhone == "[object HTMLHeadingElement]"
	) {
		document.getElementById(
			"payment-status"
		).innerHTML = `Palaa takaisin ja valitse vastaanottaja!`;
		document.getElementById("payment-comment").disabled = true;
		document.getElementById("btn-accept-payment").disabled = true;
		document.getElementById("payment-status").style.color = "red";
	} else {
		// Ajax-kutsu kohdistuu ohjelmaan post.php ja lähettää htun -tiedon php-koodille send-metodilla
		const xhrObject = new XMLHttpRequest();
		let url = "insert-payment.php";
		xhrObject.open("POST", url, true);

		xhrObject.setRequestHeader(
			"Content-Type",
			"application/x-www-form-urlencoded"
		);

		xhrObject.onload = function () {
			if (xhrObject.status === 200) {
				document.getElementById("payment-comment").disabled = true;
				document.getElementById("btn-accept-payment").disabled = true;
				document.getElementById(
					"payment-status"
				).innerHTML = `Maksu suoritettu`;
				document.getElementById("payment-status").style.color = "green";
			}
		};
		xhrObject.onerror = function () {
			document.getElementById("modal-text").innerHTML =
				"Virhe siirrossa. Yritä myöhemmin uudelleen.";
		};

		console.log(
			`"paymentAmount="${paymentAmount}"&paymentComment="${paymentComment}"&paymentTarget="${paymentTarget}"&paymentTargetPhone="${paymentTargetPhone}`
		);
		xhrObject.send(
			"paymentAmount=" +
				paymentAmount +
				"&paymentComment=" +
				paymentComment +
				"&paymentTarget=" +
				paymentTarget +
				"&paymentTargetPhone=" +
				paymentTargetPhone
		);
	}
}
