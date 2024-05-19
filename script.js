function togglePasswordVisibility() {
  var passwordInput = document.getElementById("password");
  var eyeButton = document.getElementById("eye-button");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeButton.innerHTML =
      '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="humbleicons hi-eye-off h-6 w-6"><path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5l16 16M11.148 9.123a3 3 0 013.722 3.752M8.41 6.878C12.674 4.762 17.267 6.47 21 12c-1.027 1.521-2.119 2.753-3.251 3.696m-2.509 1.59C11.076 19.142 6.631 17.38 3 12c1.01-1.496 2.083-2.713 3.196-3.65"/></svg>';
  } else {
    passwordInput.type = "password";
    eyeButton.innerHTML =
      '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="humbleicons hi-eye h-6 w-6"><path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M3 12c5.4-8 12.6-8 18 0-5.4 8-12.6 8-18 0z" /><path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>';
  }
}

function convertToUppercase(input) {
  input.value = input.value.toUpperCase();
}
