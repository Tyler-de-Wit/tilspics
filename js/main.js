// Toggles hamburger menu
function toggleHamburgerMenu () {
	var hamburgerButton = document.querySelector('.hamburger-button');
	var nav = document.querySelector('nav');

	hamburgerButton.classList.toggle('active');
	nav.classList.toggle('hamburgerNav');
}

// Toggles the submit button with the terms checkbox
function toggleSubmitButton () {
    'use strict';

    // Get a reference to the submit button:
	var submitButton = document.getElementById('submit');
	
	// Toggle its disabled property:
	if (document.getElementById('termsCheckbox').checked) {
		submitButton.disabled = false;
	} else {
		submitButton.disabled = true;
	}
}

// Toggle tooltip for first name input box
function firstNameTooltipShow () {
	'use strict';
	document.getElementById('firstNameTooltipSpan').className = 'tooltipVisible';
}
function firstNameTooltipHide () {
	'use strict';
	document.getElementById('firstNameTooltipSpan').className = 'tooltipHidden';
}

// Adds tooltip for last name input box
function lastNameTooltipShow () {
	'use strict';
	document.getElementById('lastNameTooltipSpan').className = 'tooltipVisible';
}
function lastNameTooltipHide () {
	'use strict';
	document.getElementById('lastNameTooltipSpan').className = 'tooltipHidden';
}

// Adds tooltip for email input box
function emailTooltipShow () {
	'use strict';
	document.getElementById('emailAddressTooltipSpan').className = 'tooltipVisible';
}
function emailTooltipHide () {
	'use strict';
	document.getElementById('emailAddressTooltipSpan').className = 'tooltipHidden';
}

// Validates the form input data
function validateForm () {
	'use strict';

	// Variables
	var error;
	var firstName = document.getElementById('firstName').value;
	var lastName = document.getElementById('lastName').value;
	var email = document.getElementById('email').value;
	var textArea = document.getElementById('textArea').value;

	// Validate the first name
	if (/^[A-Za-z \.\-']{2,20}$/.test(firstName)) {
		document.getElementById('firstNameSpan').className = 'errorSpanHidden';
		document.getElementById('firstNameCheckmarkSpan').className = 'checkmarkSpanVisible';
	} else {
		document.getElementById('firstNameSpan').className = 'errorSpanVisible';
		document.getElementById('firstNameCheckmarkSpan').className = 'checkmarkSpanHidden';
		error = true;
	}

	// Validate the last name
	if (/^[A-Za-z \.\-']{2,20}$/.test(lastName)) {
		document.getElementById('lastNameSpan').className = 'errorSpanHidden';
		document.getElementById('lastNameCheckmarkSpan').className = 'checkmarkSpanVisible';
	} else {
		document.getElementById('lastNameSpan').className = 'errorSpanVisible';
		document.getElementById('lastNameCheckmarkSpan').className = 'checkmarkSpanHidden';
		error = true;
	}

	// Validate the email address
	if (/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/.test(email)) {
		document.getElementById('emailAddressSpan').className = 'errorSpanHidden';
		document.getElementById('emailAddressCheckmarkSpan').className = 'checkmarkSpanVisible';
	} else {
		document.getElementById('emailAddressSpan').className = 'errorSpanVisible';
		document.getElementById('emailAddressCheckmarkSpan').className = 'checkmarkSpanHidden';
		error = true;
	}

	// Validate the text area
	if (textArea != '') {
		document.getElementById('messageSpan').className = 'errorSpanHidden';
		document.getElementById('messageCheckmarkSpan').className = 'checkmarkSpanVisible';
	} else {
		document.getElementById('messageSpan').className = 'errorSpanVisible';
		document.getElementById('messageCheckmarkSpan').className = 'checkmarkSpanHidden';
		error = true;
	}

    // If an error occurred, prevent the default behavior
	if (error) {
		event.preventDefault();
		alert("Form was not submitted. Please check errors.");
	} else {
		alert("Form Submitted Successfully!");
		return true;
	}
}


// Event listeners 
function init() {
    'use strict';

	// Runs toggle hamburger menu function
	document.querySelector('.hamburger-button').addEventListener('click', toggleHamburgerMenu);

    // Disable submit button to start
    document.getElementById('submit').disabled = true;

    // Runs toggleSubmitButton function when checkbox is toggled
    document.getElementById('termsCheckbox').addEventListener('click', toggleSubmitButton);

	// Hide the error message spans by default
	document.getElementById('firstNameSpan').className = 'errorSpanHidden';
	document.getElementById('lastNameSpan').className = 'errorSpanHidden';
	document.getElementById('emailAddressSpan').className = 'errorSpanHidden';
	document.getElementById('messageSpan').className = 'errorSpanHidden';

	// Hide the checkmark spans by default
	document.getElementById('firstNameCheckmarkSpan').className = 'checkmarkSpanHidden';
	document.getElementById('lastNameCheckmarkSpan').className = 'checkmarkSpanHidden';
	document.getElementById('emailAddressCheckmarkSpan').className = 'checkmarkSpanHidden';
	document.getElementById('messageCheckmarkSpan').className = 'checkmarkSpanHidden';

	// Hide the tooltip spans by default
	document.getElementById('firstNameTooltipSpan').className = 'tooltipHidden';
	document.getElementById('lastNameTooltipSpan').className = 'tooltipHidden';
	document.getElementById('emailAddressTooltipSpan').className = 'tooltipHidden';

	// Runs tooltips functions for respective elements
	document.getElementById('firstName').addEventListener('focus', firstNameTooltipShow);
	document.getElementById('firstName').addEventListener('blur', firstNameTooltipHide);

	document.getElementById('lastName').addEventListener('focus', lastNameTooltipShow);
	document.getElementById('lastName').addEventListener('blur', lastNameTooltipHide);

	document.getElementById('email').addEventListener('focus', emailTooltipShow);
	document.getElementById('email').addEventListener('blur', emailTooltipHide);
	
    // Runs validateForm function when form is submitted
    document.getElementById('contactForm').addEventListener('submit', validateForm);
}


// Runs init function
window.onload = init;