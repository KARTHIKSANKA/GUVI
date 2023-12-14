 $(document).ready(function () {
        $("#signin-button").click(function (e) {
          e.preventDefault();
          $("#message").empty(); // Clear any previous error messages

          var email = $("#email").val();
          var password = $("#password").val();

          $.ajax({
            type: "POST",
            url: "PHP/login.php",
            data: { email: email, password: password },
            dataType: "json",
            success: function (response) {
              if (response.success) {
                window.location.href ="PHP/profile.php"; // Redirect to a dashboard page on successful login
             
			 } else {
                $("#message").html(response.message);
              }
            }
          });
        });
      });
  function regis() {
    var pass = document.getElementById("password").value;
    var cpass = document.getElementById("confirm_password").value;
    if (cpass === pass) {
      var nam = document.getElementById("username").value;
      var dob = document.getElementById("dob").value;
      var age = document.getElementById("age").value;
      var cont = document.getElementById("contact").value;
      var email = document.getElementById("email").value;
      var pass = document.getElementById("password").value;
      var a; // Create the XMLHttpRequest object
      if (window.XMLHttpRequest) {
        a = new XMLHttpRequest();
      } else {
        a = new ActiveXObject("Microsoft.XMLHTTP");
      }
      a.onreadystatechange = function () {
        if (a.readyState === 4) {
          if (a.status === 200) {
            alert(a.responseText);
			
            // You can perform additional actions here after a successful registration	
          } else {
            alert("Error: Registration failed");
          }
        }
      };
      var url = "PHP/get.php"; // Update this URL to the correct endpoint
      var val = "username=" + nam + "&dob=" + dob + "&age=" + age + "&contact=" + cont + "&email=" + email + "&password=" + pass;
      a.open("POST", url, true);
      a.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      a.send(val);
    } else {
      alert('Password mismatch');
    }
  }