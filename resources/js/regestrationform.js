
// const stepMenuOne = document.querySelector('.step-menu1');
// const stepMenuTwo = document.querySelector('.step-menu2');
// const stepMenuThree = document.querySelector('.step-menu3');
// const stepOne = document.querySelector('.form-step-1');
// const stepTwo = document.querySelector('.form-step-2');
// const stepThree = document.querySelector('.form-step-3');
// const formSubmitBtn = document.querySelector('.btn');
// const formBackBtn = document.querySelector('.back-btn');
// const checkbox = document.querySelector("#checkbox");
// // Forward Navigation
// formSubmitBtn.addEventListener("click", function (event) {
//   event.preventDefault();

 
// const name = document.getElementById('firstname').value.trim();
// const email = document.getElementById('email').value.trim();
// const password = document.getElementById('dob').value.trim();
// const passwordConfirmation = document.getElementById('lastname').value.trim();
// const role = document.getElementById('role').value;
// const ProfilePicture = document.getElementById('pfp');
// const Balance = document.getElementById('balance');
// const clientMaximumBid = document.getElementById('client_bid');
//   if (stepMenuOne.classList.contains('active')) {
//     document.getElementById('loginLink').style.display = 'none'; //disable the already have an account link


//     if (!name) {
//         alert("Full name is required.");
//         return;
//     }
//     if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
//         alert("Please enter a valid email address.");
//         return;
//     }
//     if (!password) {
//         alert("Password is required.");
//         return;
//     }
//     if (password.length < 6) {
//         alert("Password must be at least 6 characters long.");
//         return;
//     }
//     if (password !== passwordConfirmation) {
//         alert("Password confirmation does not match.");
//         return;
//     }
//     if (role !== 'client' && role !== 'admin') {
//         alert("Please select a role.");
//         return;
//     }
// if(role == 'admin'){
// document.getElementById('client_bid_div').style.display = 'none';
// document.getElementById('balance').style.width = '100%';

// }
//     stepMenuOne.classList.remove('active');
//     stepMenuTwo.classList.add('active');
//     stepOne.classList.remove('active');
//     stepTwo.classList.add('active');
//     formBackBtn.classList.add('active');
//   } else if (stepMenuTwo.classList.contains('active')) {
// if(role == 'admin'){
//   if (!ProfilePicture.files[0]) {
//         alert("Please upload a profile picture.");
//         return;
//     }
//     if (!Balance.value || isNaN(Balance.value) || Balance.value <= 0) {
//         alert("Please enter a valid balance greater than 0.");
//         return;
//     }
// }
// if(role == 'client'){
//   if (!ProfilePicture.files[0]) {
//         alert("Please upload a profile picture.");
//         return;
//     }

//     if (!Balance.value || isNaN(Balance.value) || Balance.value <= 0) {
//         alert("Please enter a valid balance greater than 0.");
//         return;
//     }

//     if (!clientMaximumBid.value || isNaN(clientMaximumBid.value) || clientMaximumBid.value <= 0) {
//         alert("Please enter a valid maximum bid greater than 0.");
//         return;
//     }
//     if (parseFloat(clientMaximumBid.value) >= parseFloat(Balance.value)) {
//         alert("Maximum bid must be less than your balance.");
//         return;
//     }
// }
//     stepMenuTwo.classList.remove('active');
//     stepMenuThree.classList.add('active');

//     stepTwo.classList.remove('active');
//     stepThree.classList.add('active');

//     formSubmitBtn.textContent = 'Submit';
    

//   } else if (stepMenuThree.classList.contains('active')) {

// if(checkbox.checked){
//   document.querySelector('form').submit();
// }else {
//   alert ('checkbox!')
// }
//   }
// });

// // Backward Navigation
// formBackBtn.addEventListener("click", function (event) {
//   event.preventDefault();

//   if (stepMenuTwo.classList.contains('active')) {
//     stepMenuTwo.classList.remove('active');
//     stepMenuOne.classList.add('active');
//     document.getElementById('loginLink').style.display = 'inline-block'; //enable the already have an account link
//     stepTwo.classList.remove('active');
//     stepOne.classList.add('active');

//     formBackBtn.classList.remove('active');
//   } else if (stepMenuThree.classList.contains('active')) {
//     stepMenuThree.classList.remove('active');
//     stepMenuTwo.classList.add('active');

//     stepThree.classList.remove('active');
//     stepTwo.classList.add('active');

//     formSubmitBtn.innerHTML = ` Next Step
//                 <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
//                 <g clip-path="url(#clip0_1675_1807)">
//                 <path d="M10.7814 7.33312L7.20541 3.75712L8.14808 2.81445L13.3334 7.99979L8.14808 13.1851L7.20541 12.2425L10.7814 8.66645H2.66675V7.33312H10.7814Z" fill="white"/>
//                 </g>
//                 <defs>
//                 <clipPath id="clip0_1675_1807">
//                 <rect width="16" height="16" fill="white"/>
//                 </clipPath>
//                 </defs>
//                 </svg>`
//   }
// });

// // dark mode toggle
// const themeToggle = document.getElementById('themeToggle');
// const htmlElement = document.documentElement;

// const savedTheme = localStorage.getItem('theme');
// if (savedTheme) {
//     htmlElement.setAttribute('data-theme', savedTheme);
// }

// themeToggle.addEventListener('click', () => {
//     const currentTheme = htmlElement.getAttribute('data-theme');
//     const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
//     htmlElement.setAttribute('data-theme', newTheme);
//     localStorage.setItem('theme', newTheme);
// });

// let file_input = document.getElementById('pfp');
//   file_input.addEventListener('change', function() {
//     let file = this.files[0];
//     let reader = new FileReader();
//     reader.onload = function() {
//       let img = document.getElementById('output');
//       img.src = reader.result;
//     }
//     reader.readAsDataURL(file);
//   });



const errorModal = document.getElementById('errorModal');
const errorMessage = document.getElementById('errorMessage');
const modalConfirmBtn = document.getElementById('modalConfirmBtn');

function showError(message) {
  errorMessage.textContent = message;
  errorModal.style.display = 'block';
}

modalConfirmBtn.addEventListener('click', () => {
  errorModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
  if (event.target === errorModal) {
    errorModal.style.display = 'none';
  }
});

// Modified validation checks with better messages
formSubmitBtn.addEventListener("click", function (event) {
  event.preventDefault();

  
const stepMenuOne = document.querySelector('.step-menu1');
const stepMenuTwo = document.querySelector('.step-menu2');
const stepMenuThree = document.querySelector('.step-menu3');
const stepOne = document.querySelector('.form-step-1');
const stepTwo = document.querySelector('.form-step-2');
const stepThree = document.querySelector('.form-step-3');
const formSubmitBtn = document.querySelector('.btn');
const formBackBtn = document.querySelector('.back-btn');
const checkbox = document.querySelector("#checkbox");

  if (stepMenuOne.classList.contains('active')) {
    document.getElementById('loginLink').style.display = 'none';

    if (!name) {
      showError("Please enter your full name to continue.");
      return;
    }
    if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
      showError("The email address you entered is invalid. Please check the format (e.g. user@example.com).");
      return;
    }
    if (!password) {
      showError("A password is required for your account security.");
      return;
    }
    if (password.length < 6) {
      showError("Password must be at least 6 characters long for better security.");
      return;
    }
    if (password !== passwordConfirmation) {
      showError("The passwords you entered do not match. Please try again.");
      return;
    }
    if (role !== 'client' && role !== 'admin') {
      showError("Please select your account type (Client or Admin) from the dropdown menu.");
      return;
    }

    // ... [rest of your existing step navigation code] ...

  } else if (stepMenuTwo.classList.contains('active')) {
    if(role == 'admin'){
      if (!ProfilePicture.files[0]) {
        showError("Please upload a profile picture for your admin account.");
        return;
      }
      if (!Balance.value || isNaN(Balance.value) || Balance.value <= 0) {
        showError("Please enter a valid starting balance greater than $0 for your admin account.");
        return;
      }
    }
    if(role == 'client'){
      if (!ProfilePicture.files[0]) {
        showError("Please upload a profile picture for your client account.");
        return;
      }
      if (!Balance.value || isNaN(Balance.value) || Balance.value <= 0) {
        showError("Please enter a valid account balance greater than $0.");
        return;
      }
      if (!clientMaximumBid.value || isNaN(clientMaximumBid.value) || clientMaximumBid.value <= 0) {
        showError("Please enter a valid maximum bid amount greater than $0.");
        return;
      }
      if (parseFloat(clientMaximumBid.value) >= parseFloat(Balance.value)) {
        showError("Maximum bid cannot exceed your available balance. Please enter a bid amount lower than your balance.");
        return;
      }
    }

    // ... [rest of your existing step navigation code] ...

  } else if (stepMenuThree.classList.contains('active')) {
    if(checkbox.checked){
      document.querySelector('form').submit();
    } else {
      showError("You must agree to the terms and conditions before submitting your registration.");
    }
  }
});

