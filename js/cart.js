setInterval(() => {
  let xls = new XMLHttpRequest();
  xls.open("GET", "getcart.php", true);
  xls.onload = () => {
    if (xls.readyState === XMLHttpRequest.DONE) {
      if (xls.status === 200) {
        let data = xls.response;
        let notify = document.querySelector(".cart-notify");
        if (data == 0) {
          notify.style.display = "none";
        }

        notify.innerHTML = data;
        //console.log(data);
      }
    }
  };
  xls.send();
}, 100);
