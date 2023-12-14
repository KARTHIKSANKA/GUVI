<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["email"]))
{

}
else{
header("Location:index.html");
die();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       
    </script>
      
    </script>
</head>
<body>
  <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
      
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                <div id="username"><input type="text" class="form-control" id="name" ></div>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                 <div id="age"><input type="text" class="form-control" id="age" ></div>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                  <div id="dob">  <input type="text" class="form-control" id="dob" ></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                  <div id="contact"><input type="text" class="form-control" id="contact" ></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div id="email"><input type="email" class="form-control" id="email" >
                </div>
            </div>
        </div><!-- Add this button to your profile.html -->
<button id="logout-button" style="color: white;background-color:green ;opacity: 0.8;padding: 10px 20px; "  >Logout</button>

    </div>

    <!-- Include Bootstrap JS (optional) -->
	<!-- <script src="fun.js"></script>-->
	<!--<script src="fun1.js"></script>-->
	<!--<script src="fun.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="profile.js"></script>
</body>
</html
