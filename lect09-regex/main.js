// let example = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

// Two ways to create regex in JS
let pattern = "pattern";
let regExpObj = new RegExp(pattern,"ig");

regExpObj = /pattern/ig;

// RegExObj.test(text) returns TRUE or FALSE
let longText = document.querySelector("#sample-str").innerHTML.trim();
console.log(longText);

// Does this text have the pattern in it?
regExpObj = /\d\d\d\d/ig;
console.log( regExpObj.test(longText) );

// String.match(regexpobj) returns an array of all the matches
console.log( longText.match(regExpObj)  );



document.querySelector("#replace-form").onsubmit = function() {

	let findInput = document.querySelector("#find").value.trim();

	let replaceInput = document.querySelector("#replace").value.trim();

	let oldString = document.querySelector("#sample-str").innerHTML.trim();

	// Use REGEX 
	let regex = new RegExp(findInput, 'gi'); 

	// .replace() returns the string that is replaced 
	let newString = oldString.replace(regex,replaceInput);

	console.log(oldString);
	console.log(newString);

	// Set where oldString used to be to the newString
	document.querySelector("#sample-str").innerHTML = newString;

	return false;
}

document.querySelector("#username-form").onsubmit = function() {
	let usernameInput = document.querySelector("#username").value.trim();
	// Username cannot be empty
	// Username cannot contain uppercase letters
	if(/^$/.test(usernameInput) == true) {
		// username is empty
		document.querySelector("#username-error").innerHTML = "Cannot be empty";
	}
	else if(/[A-Z]/.test(usernameInput) == true) {
		// Contains an uppercase letter
		document.querySelector("#username-error").innerHTML = "Cannot contain uppercase letters";
	}
	else {
		document.querySelector("#username-error").innerHTML = "Valid username"
	}

	return false;
}

document.querySelector("#phone-form").onsubmit = function() {
	let phoneInput = document.querySelector("#phone").value.trim();
	
	if(/^$/.test(phoneInput) == true) {
		// username is empty
		document.querySelector("#phone-error").innerHTML = "Cannot be empty";
	}
	else if(/^(\d{10}|\d{3}-\d{3}-\d{4}|\(\d{3}\)\s?\d{3}-\d{4})$/.test(phoneInput) == false) {
		document.querySelector("#phone-error").innerHTML = "Invalid format";
	}
	else {
		document.querySelector("#phone-error").innerHTML = "Valid phone number";
	}

	return false;
}

document.querySelector("#email-form").onsubmit = function() {
	let emailInput = document.querySelector("#email").value.trim();
	
	if(/^$/.test(emailInput) == true) {
		// email is empty
		document.querySelector("#email-error").innerHTML = "Cannot be empty";
	}
	//else if(/\w{3,}@\w+\.(net|com|edu)/.test(emailInput) == false) {
	else if(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(emailInput) == false) {
		document.querySelector("#email-error").innerHTML = "Invalid email";

	}
	else {
		document.querySelector("#email-error").innerHTML = "Valid emali";
	}

	return false;
}