var passwordInput = document.querySelector("#password");
var passwordInput2 = document.querySelector("#password2");
var toggleBtn = document.querySelector(".password i");
var toggleBtn2 = document.querySelector(".password2 i");

toggleBtn.onclick = () => {
  if (passwordInput.type == "password") {
    passwordInput.type = "text";
    toggleBtn.classList = "ri-eye-line";
  } else {
    passwordInput.type = "password";
    toggleBtn.classList = "ri-eye-off-line";
  }
};

toggleBtn2.onclick = () => {
  if (passwordInput2.type == "password") {
    passwordInput2.type = "text";
    toggleBtn2.classList = "ri-eye-line";
  } else {
    passwordInput2.type = "password";
    toggleBtn2.classList = "ri-eye-off-line";
  }
};
