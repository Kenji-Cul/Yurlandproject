var passwordInput = document.querySelector("#password");
var toggleBtn = document.querySelector(".password i");

toggleBtn.onclick = () => {
  if (passwordInput.type == "password") {
    passwordInput.type = "text";
    toggleBtn.classList = "ri-eye-line";
  } else {
    passwordInput.type = "password";
    toggleBtn.classList = "ri-eye-off-line";
  }
};
