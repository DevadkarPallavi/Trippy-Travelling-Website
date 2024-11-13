$(document).ready(function () {
  var userEmail = localStorage.getItem('userEmail');

  $('#userEmailID').val(userEmail);

  // login button
  $('#loginButton').on('click', function (event) {
    event.preventDefault();
    if ($('#userEmail').val().trim() === '') {
      toastr.error("Please enter Email");
    } else if ($('#userPassword').val().trim() === '') {
      toastr.error("Please enter Password.");
    } else {

      loginUser();
    }
  });

  // Logout button
  $('#logoutButton').on('click', function (event) {
    logout(userEmail);
    toastr.success("Logged out Successfully!");
  });


  // New user registarion button
  $('#registernewuser').on('click', function () {
    if ($('#firstname').val().trim() === '') {
      toastr.error("Please enter First Name");
    }
    else if ($('#lastname').val().trim() === '') {
      toastr.error("Please enter Last Name");
    }
    else if ($('#username').val().trim() === '') {
      toastr.error("Please enter Username");
    }
    else if ($('#email').val().trim() === '') {
      toastr.error("Please enter Email");
    }
    else if ($('#phone').val().trim() === '') {
      toastr.error("Please enter Phone");
    }
    else if ($('#password').val().trim() === '') {
      toastr.error("Please enter Password");
    }
    else {
      registerUser();

    }

  });

  // password eye button
  $('#password-eye').on('click', function () {
    var passwordField = $('#userPassword');
    var passwordFieldType = passwordField.attr('type');
    if (passwordFieldType === 'password') {
      passwordField.attr('type', 'text');
      $(this).find('i').removeClass('ri-eye-off-line').addClass('ri-eye-line');
    } else {
      passwordField.attr('type', 'password');
      $(this).find('i').removeClass('ri-eye-line').addClass('ri-eye-off-line');
    }
  });

  //Forget Password
  $('#forgetpasswordbtn').on('click', function (event) {
    event.preventDefault();
    // alert("forgetpassword");
    forgetpassword();
  });

});


// Login Function
function loginUser() {
  var loginDetails = {
    email: $('#userEmail').val(),
    password: $('#userPassword').val()
  };

  $.ajax({
    type: "POST",
    url: 'loginUser.php',
    data: loginDetails,
    success: function (resultstring, textStatus, jqXHR) {
      var ok = true;
      var records;
      try {
        records = $.parseJSON(resultstring);
      } catch (e) {
        ok = false;
      }
      if (!ok) {
        alert(resultstring);
        return;
      }

      localStorage.setItem('userEmail', loginDetails.email);
      window.location.href = "home.html";
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("AJAX request failed: " + textStatus + ", " + errorThrown);
    }
  });
}


// new user registration
function registerUser() {
  var registrationDetails = {
    firstName: $('#firstname').val(),
    lastName: $('#lastname').val(),
    userName: $('#username').val(),
    email: $('#email').val(),
    phoneNumber: $('#phone').val(),
    password: $('#password').val()
  };

  $.ajax({
    type: "POST",
    url: 'registerUser.php',
    data: registrationDetails,
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
      else {
        alert("Successfully Registered.");
        window.location.href = "index.html";
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error registering user");
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
      alert(resultstring);
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
    url: 'userlogout.php',
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
      $('#userEmail').val('');
      $('#userPassword').val('');

      window.location.replace("index.html");

    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error registering user");
    }
  });
}
