
<!-- Main -->
<main id="contact-us-main">

    <form action="" method="post" id="contactForm">
        <fieldset>
            <legend>Contact Us</legend>

            <!-- First Name -->
            <label for="firstName">First Name
                <span id="firstNameSpan" class="errorSpanHidden">Enter your first name</span>
                <span id="firstNameCheckmarkSpan" class="checkmarkSpanHidden"></span>
            </label>
            <input type="text" name="firstName" id="firstName">
            <span id="firstNameTooltipSpan" class="tooltipHidden">Name cannot contain any special characters</span>
            <br><br>

            <!-- Last Name -->
            <label for="lastName">Last Name
                <span id="lastNameSpan" class="errorSpanHidden">Enter your last name</span>
                <span id="lastNameCheckmarkSpan" class="checkmarkSpanHidden"></span>
            </label>
            <input type="text" name="lastName" id="lastName">
            <span id="lastNameTooltipSpan" class="tooltipHidden">Name cannot contain any special characters</span>
            <br><br>

            <!-- Email -->
            <label for="email">Email Address
                <span id="emailAddressSpan" class="errorSpanHidden">Enter your email address</span>
                <span id="emailAddressCheckmarkSpan" class="checkmarkSpanHidden"></span>
            </label>
            <input type="text" name="email" id="email">
            <span id="emailAddressTooltipSpan" class="tooltipHidden">Your email must be in the format: email@domain.com</span>
            <br><br>

            <!-- Message Area -->
            <label for="textArea">Message
                <span id="messageSpan" class="errorSpanHidden">Enter your message</span>
                <span id="messageCheckmarkSpan" class="checkmarkSpanHidden"></span>
            </label>
            <textarea name="textArea" id="textArea" placeholder="Enter your message here"></textarea>
            <br>

            <p>All fields are required</p>

            <!-- Terms Button -->
            <label for="termsCheckbox">I agree to the <a href="terms-and-conditions.php">terms and conditions</a></label>
            <input type="checkbox" name="termsCheckbox" id="termsCheckbox">
            <br>

            <!-- Submit Button -->
            <input type="hidden" name="action" value="upload">
            <input type="submit" value="Submit" id="submit" name="submitButton">
            <br>
        </fieldset>
    </form>

</main>
