<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PokéHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <nav class="navbar navbar-expand-md bg-dark-subtle justify-content-start">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="PokeHub_FinalLogo2.png" alt="Logo" width="75" height="26.25" class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link" href="register.php">Register</a>
          <a class="nav-link" href="login.php">Login</a>
        </div>
        <div style="padding:5px"></div>
        <button class="btn btn-outline-dark" id="btnSwitch">
          <i class="bi bi-sun-fill"></i>
        </button>
      </div>
    </div>
  </nav>
  <div class="container-fluid col-lg-4 offset-lg-4">
    <h1 style="padding-top:10px;">Register</h1>
    <form onsubmit="return validate(this)" method="POST">
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email" required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" name="username" required maxlength="30" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="firstname">First Name</label>
            <input  class="form-control" type="text" name="firstname" required maxlength="30" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="lastname">Last Name</label>
            <input  class="form-control" type="text" name="lastname" required maxlength="30" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="pw">Password</label>
            <input class="form-control" type="password" id="pw" name="password" required minlength="8" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="confirm">Confirm</label>
            <input class="form-control" type="password" name="confirm" required minlength="8" />
        </div>
        <input type="submit" class="mt-3 btn btn-primary" value="Register" />
    </form>
</div>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        // email and username
        // Regex from: https://digitalfortress.tech/js/top-15-commonly-used-regex/ (linked on Canvas)
        const emailRegex = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})*$/;
        const usernameRegex = /^[a-z0-9_-]{3,16}$/;

        let isValid = true;

        // Check if email input is valid
        let emailInput = document.getElementById("email").value;
        if (emailInput.includes("@")) {
            if (!emailRegex.test(emailInput)) {
                isValid = false;
            }
        }

        // Check if username input is invalid (matching regex provided (length and characters))
        let usernameInput = document.getElementById("username").value;
        if (!usernameRegex.test(usernameInput)) {
            isValid = false;
        }

        // Check if password and confirm password are valid (matching and length)
        let passwordInput = document.getElementById("pw").value;
        let confirmPWInput = document.getElementById("confirm").value;

        if (passwordInput.length > 0 && passwordInput !== confirmPWInput) {
            document.getElementById("pw").value = "";
            document.getElementById("confirm").value = "";
            isValid = false;
        }

        if (isValid) {
            // Send POST request to regStep1.php if form is valid
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "regStep1.php", true);
            xhr.send();
            // Check if regStep5.php received $isValid = true and redirect to successfulRegister.php
            let checkStatus = setInterval(function() {
                let xhr2 = new XMLHttpRequest();
                xhr2.onreadystatechange = function() {
                    if (xhr2.readyState === 4 && xhr2.status === 200) {
                        if (xhr2.responseText === "true") {
                            clearInterval(checkStatus);
                            window.location.href = "successfulRegister.php";
                        }
                    }
                };
                xhr2.open("GET", "regStep5.php", true);
                xhr2.send();
            }, 1000);
        }

        return isValid;
    }
</script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
