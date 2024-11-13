$(document).ready(function () {
  var userEmail = localStorage.getItem('adminEmail');
  // login button
  $('#loginButton').on('click', function (event) {
    event.preventDefault();
    if ($('#adminEmail').val().trim() === '') {
      toastr.error("Please enter Email");
    } else if ($('#adminPassword').val().trim() === '') {
      toastr.error("Please enter Password.1");
    } else {
      loginUser();
    }
  });

  $('#logoutButton').on('click', function (event) {
    logout(userEmail);
    toastr.success("Logged out Successfully!");
  });


});


// Login Function
function loginUser() {
  var loginDetails = {
    email: $('#adminEmail').val(),
    password: $('#adminPassword').val()
  };
  $.ajax({
    type: "POST",
    url: 'loginUser.php',
    data: loginDetails,
    success:
      function (resultstring, textStatus, jqXHR) {
        var ok = true;
        try {
          var records = $.parseJSON(resultstring);
        } catch (e) {
          ok = false;
        }
        if (!ok) {
          alert(resultstring);
          return;
        }
        localStorage.setItem('adminEmail', loginDetails.email);
        window.location.href = "home.html";
      },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error js");
    }
  });
}


// Forget password
function forgetpassword() {
  var forgetpassworddetails = {
    email: $('#forgetpassuserEmail').val(),
    mobileno: $('#forgetpassuserMobNo').val()
  };

  $.ajax({
    type: "POST",
    url: 'forgetpassword.php',
    data: forgetpassworddetails,
    success: function (resultstring, textStatus, jqXHR) {
      var ok = true;
      try {
        var records = $.parseJSON(resultstring);
      } catch (e) {
        ok = false;
      }
      if (!ok) {
        alert(resultstring);
        return;
      }

      window.location.href = "index.html";
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error registering user");
    }
  });
}

// user loout

function logout(userEmail) {

  var logoutdata = {
    email: userEmail
  };

  $.ajax({
    type: "POST",
    url: 'adminlogout.php',
    data: logoutdata,
    success: function (resultstring, textStatus, jqXHR) {
      var ok = true;
      try {
        var records = $.parseJSON(resultstring);
      } catch (e) {
        ok = false;
      }
      if (!ok) {
        alert(resultstring);
        return;
      }
      window.location.replace("index.html");

    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error registering user");
    }
  });
}
