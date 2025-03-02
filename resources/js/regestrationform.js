
const stepMenuOne = document.querySelector('.step-menu1');
const stepMenuTwo = document.querySelector('.step-menu2');
const stepMenuThree = document.querySelector('.step-menu3');
const stepOne = document.querySelector('.form-step-1');
const stepTwo = document.querySelector('.form-step-2');
const stepThree = document.querySelector('.form-step-3');
const formSubmitBtn = document.querySelector('.btn');
const formBackBtn = document.querySelector('.back-btn');
const checkbox = document.querySelector("#checkbox");
// Forward Navigation
formSubmitBtn.addEventListener("click", function (event) {
  event.preventDefault();

 
const name = document.getElementById('firstname').value.trim();
const email = document.getElementById('email').value.trim();
const password = document.getElementById('dob').value.trim();
const passwordConfirmation = document.getElementById('lastname').value.trim();
const role = document.getElementById('role').value;
const ProfilePicture = document.getElementById('pfp');
const Balance = document.getElementById('balance');
const clientMaximumBid = document.getElementById('client_bid');
  if (stepMenuOne.classList.contains('active')) {
    document.getElementById('loginLink').style.display = 'none'; //disable the already have an account link


    if (!name) {
        alert("Full name is required.");
        return;
    }
    if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
        alert("Please enter a valid email address.");
        return;
    }
    if (!password) {
        alert("Password is required.");
        return;
    }
    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return;
    }
    if (password !== passwordConfirmation) {
        alert("Password confirmation does not match.");
        return;
    }
    if (role !== 'client' && role !== 'admin') {
        alert("Please select a role.");
        return;
    }
if(role == 'admin'){
document.getElementById('client_bid_div').style.display = 'none';
document.getElementById('balance').style.width = '100%';

}
    stepMenuOne.classList.remove('active');
    stepMenuTwo.classList.add('active');
    stepOne.classList.remove('active');
    stepTwo.classList.add('active');
    formBackBtn.classList.add('active');
  } else if (stepMenuTwo.classList.contains('active')) {
if(role == 'admin'){
  if (!ProfilePicture.files[0]) {
        alert("Please upload a profile picture.");
        return;
    }
    if (!Balance.value || isNaN(Balance.value) || Balance.value <= 0) {
        alert("Please enter a valid balance greater than 0.");
        return;
    }
}
if(role == 'client'){
  if (!ProfilePicture.files[0]) {
        alert("Please upload a profile picture.");
        return;
    }

    if (!Balance.value || isNaN(Balance.value) || Balance.value <= 0) {
        alert("Please enter a valid balance greater than 0.");
        return;
    }

    if (!clientMaximumBid.value || isNaN(clientMaximumBid.value) || clientMaximumBid.value <= 0) {
        alert("Please enter a valid maximum bid greater than 0.");
        return;
    }
    if (parseFloat(clientMaximumBid.value) >= parseFloat(Balance.value)) {
        alert("Maximum bid must be less than your balance.");
        return;
    }
}
    stepMenuTwo.classList.remove('active');
    stepMenuThree.classList.add('active');

    stepTwo.classList.remove('active');
    stepThree.classList.add('active');

    formSubmitBtn.textContent = 'Submit';
    

  } else if (stepMenuThree.classList.contains('active')) {

if(checkbox.checked){
  document.querySelector('form').submit();
}else {
  alert ('checkbox!')
}
  }
});

// Backward Navigation
formBackBtn.addEventListener("click", function (event) {
  event.preventDefault();

  if (stepMenuTwo.classList.contains('active')) {
    stepMenuTwo.classList.remove('active');
    stepMenuOne.classList.add('active');
    document.getElementById('loginLink').style.display = 'inline-block'; //enable the already have an account link
    stepTwo.classList.remove('active');
    stepOne.classList.add('active');

    formBackBtn.classList.remove('active');
  } else if (stepMenuThree.classList.contains('active')) {
    stepMenuThree.classList.remove('active');
    stepMenuTwo.classList.add('active');

    stepThree.classList.remove('active');
    stepTwo.classList.add('active');

    formSubmitBtn.innerHTML = ` Next Step
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1675_1807)">
                <path d="M10.7814 7.33312L7.20541 3.75712L8.14808 2.81445L13.3334 7.99979L8.14808 13.1851L7.20541 12.2425L10.7814 8.66645H2.66675V7.33312H10.7814Z" fill="white"/>
                </g>
                <defs>
                <clipPath id="clip0_1675_1807">
                <rect width="16" height="16" fill="white"/>
                </clipPath>
                </defs>
                </svg>`
  }
});

// dark mode toggle
const themeToggle = document.getElementById('themeToggle');
const htmlElement = document.documentElement;

const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    htmlElement.setAttribute('data-theme', savedTheme);
}

themeToggle.addEventListener('click', () => {
    const currentTheme = htmlElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    htmlElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
});

let file_input = document.getElementById('pfp');
  file_input.addEventListener('change', function() {
    let file = this.files[0];
    let reader = new FileReader();
    reader.onload = function() {
      let img = document.getElementById('output');
      img.src = reader.result;
    }
    reader.readAsDataURL(file);
  });