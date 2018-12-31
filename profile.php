<?php
include('session.php');
$_SESSION['pageStore'] = "profile.php";

if(!isset($_SESSION['login_id'])){
header("location: index.php"); // Redirecting To Home Page
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Home Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/w3.css"> 
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>

 <?php include 'menuHead.php'; ?>
<?php include 'setting/fetch.php'; ?>
<?php include 'setting/saveChange.php'; ?>
<!Body Div>
<form class="needs-validation offset-1 mt-3" action="" method="POST" oninput='validatePassword();' novalidate>
  <div class="form-row">
    <div class="col-md-4 mb-2">
      <label for="fName">First name</label>
      <input type="text" class="form-control text-capitalize" name="fName" id="fName" placeholder="First name" value="<?php  echo $fName; ?>" required>
      <div class="valid-feedback">
        Looks good!
      </div>
      <div class="invalid-feedback">
        Please provide your first name.
      </div>
    </div>
    <div class="col-md-4 mb-2">
      <label for="lName">Last name</label>
      <input type="text" class="form-control text-capitalize" name="lName" id="lName" placeholder="Last name" value="<?php echo $lName;?>" required>
      <div class="valid-feedback">
        Looks good!
      </div>
      <div class="invalid-feedback">
        Please provide your last name.
      </div>      
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-2">
      <label for="validEmail">Email address</label>
      <input type="email" class="form-control" id="validEmail" name="email" value="<?php echo $email;?>" placeholder="Email address" required>
      <div class="valid-feedback">
        Looks good!
      </div>
      <div class="invalid-feedback">
        Please provide a valid email address.
      </div>
    </div>
    <div class="col-md-4 mb-2">
      <label for="validAddress">Country</label>
      <select class="custom-select" name="countryList" required>
  <option selected value="<?php if($country) 
  echo $country.'">'.$country; 
  else  echo '">Select your country';
  ?></option>
<?php
include('countryList.php');
for ($i = 0; $i < count($countries); $i++) {  
echo "<option value='$countries[$i]'>$countries[$i]</option>";
}
?>
</select>
      <div class="invalid-feedback">
        Please provide a valid address.
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-2">
      <label for="newPass">New Password</label>
      <input type="password" class="form-control" name="newPass" id="newPass" placeholder="New Password" readonly pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" required>
      <div class="valid-feedback">
        Looks good!
      </div>
      <div class="invalid-feedback">
        Password should contain atleast 8 characters with uppercase, lowercase and number.
      </div>
    </div>
    <div class="col-md-4 mb-2">
      <label for="conformPass">Conform Password</label>
      <input type="password" class="form-control" name="conformPass" id="conformPass" readonly placeholder="Conform Password" required>
      <div class="valid-feedback">
        Looks good!
      </div>
      <div class="invalid-feedback">
        Password does not match.
      </div>      
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-4 mb-2">
      <label for="validPhone">Phone</label>
      <input type="tel" class="form-control" name="phone" id="validPhone" value="<?php echo $phone;?>" placeholder="Phone" pattern="[0-9\d]{10,}$" required>
      <div class="invalid-feedback">
        Please provide a valid phone.
      </div>
    </div>
    <div class="col-md-4 mb-2">
      <label for="validBirth">Date of birth</label>
      <input type="date" class="form-control" name="DOB" value="<?php echo $DOB;?>" id="validBirth" required>
      <div class="invalid-feedback">
        Please provide a date of birth.
      </div>
    </div>
  </div>
  <div class="form-row">
  <div class="custom-control custom-radio custom-control-inline mb-2">
  <input type="radio" id="male" name="gender" class="custom-control-input" value="Male" <?php if($gender == 'Male') echo "checked";?> required>
  <label class="custom-control-label" for="male">Male</label>
</div>
<div class="custom-control custom-radio custom-control-inline mb-2">
  <input type="radio" id="Female" name="gender" class="custom-control-input" value="Female" <?php if($gender == "Female") echo "checked";?> required>
  <label class="custom-control-label" for="Female">Female</label>
</div>  
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-2">
      <input type="password" class="form-control" autocomplete="new-password" name="currentPassword" id="currentPassword" placeholder="Current Password" required>      
    </div>
    <div class="col-md-4 mb-2">  
  <button class="btn btn-primary" name="submit" type="submit">Save</button>
</div>
  </div>
</form>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

function validatePassword(){
  if(newPass.value != conformPass.value) {
    conformPass.setCustomValidity('Passwords do not match.');
  } else {
    conformPass.setCustomValidity('');
  }
}

document.getElementById('newPass').onclick = function() {
    document.getElementById('newPass').readOnly = false;
    document.getElementById('conformPass').readOnly = false;
};

</script>
</body>
</html>