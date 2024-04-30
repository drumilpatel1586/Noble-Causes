// 189 M+ COUNT
document.addEventListener("DOMContentLoaded", function () {
    const countElement = document.getElementById("count-food");
    const targetCount = 189;
    const duration = 1000;
    const interval = Math.ceil(duration / targetCount);
    let currentCount = 0;
  
    const increaseCount = () => {
      currentCount++;
      countElement.textContent = currentCount + "M+";
      if (currentCount < targetCount) {
        setTimeout(increaseCount, interval);
      }
    };
  
    increaseCount();
  });
  
  // Show the toast when the document is ready
  
  document.addEventListener("DOMContentLoaded", function () {
    var loginSuccessToast = new bootstrap.Toast(
      document.getElementById("loginSuccessToast")
    );
    loginSuccessToast.show();
  
    // Close the toast after 3 seconds
    setTimeout(function () {
      loginSuccessToast.hide();
    }, 3000);
  });
  