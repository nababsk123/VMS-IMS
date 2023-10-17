<?php
//require/load the authentication file script
require_once('auth.php');
require_once('DBConnection.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
// Generate Login Form Token
$_SESSION['formToken']['login'] = password_hash(uniqid(),PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN |IMS VMS</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="icon" href="https://imsplgroup.com/wp-content/uploads/2022/08/IMS_Group_fevicon_32x32.png" sizes="32x32" />
<link rel="icon" href="https://imsplgroup.com/wp-content/uploads/2022/08/IMS_Group_fevicon_32x32.png" sizes="192x192" />
<link rel="apple-touch-icon" href="https://imsplgroup.com/wp-content/uploads/2022/08/IMS_Group_fevicon_32x32.png" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/custom.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
</head>
<body class="bg-dark bg-gradient">
<style>
    body{
      background-image: url("");
      background-size:cover;
      background-repeat:no-repeat;
      
    }
    .login-title{
        text-shadow: 2px 2px black;
        backdrop-filter: invert(.3);
    }
  </style>
   <div class="h-100 d-flex jsutify-content-center align-items-center">
       <div class='w-100'>
        <h3 class="py-5 text-center text-light"><img src="imgs/IMS_group-1-90x90-1.png"></h3>
        <div class="card my-3 col-md-4 offset-md-4">
            <div class="card-body">
                <!-- Login Form Wrapper -->
                <form action="" id="login-form">
                    <input type="hidden" name="formToken" value="<?= $_SESSION['formToken']['login'] ?>">
                    <center><small>Please enter your credentials.</small></center>
                    <div class="mb-3">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" id="username" autofocus name="username" class="form-control rounded-0" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control rounded-0" required>
                    </div>
                    <div class="mb-3 floorselection">
                        <div class="staffcheck">
                        <label for="Floor">Select Floor :</label><select id="floor" name="floor" class="form-select" required>  <option value="">Select Floor</option> <option value="1">1</option><option value="2">2</option><option value="4">4</option><option value="5">5</option></select>
                       </div>
                    </div>

                    <div class="mb-3 d-flex w-100 justify-content-center  align-items-end">
                        <!-- <a href="registration.php">Does not have an Account? Signup Here</a> -->
                        <button class="btn btn-outline-primary ">Login</button>
                    </div>
                </form>
                <!-- Login Form Wrapper -->
            </div>
        </div>
       </div>
   </div>
</body>
<script>
    $(function(){

        $('#username').bind("keyup focusout", function () {
            var username ="admin";
            var typeuser = $(this).val();
            if(typeuser == username){
                jQuery(".staffcheck").remove();
            }else{
                jQuery(".floorselection").html(' <div class="staffcheck"><label for="Floor">Select Floor :</label><select id="floor" name="floor" class="form-select" required> <option value="">Select Floor</option> <option value="1">1</option><option value="2">2</option><option value="4">4</option><option value="5">5</option></select></div>');
            }
        });



        $('#login-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled',true)
            _this.find('button[type="submit"]').text('Loging in...')
            $.ajax({
                url:'./LoginRegistration.php?a=login',
                method:'POST',
                data:$(this).serialize(),
                dataType:'JSON',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        setTimeout(() => {
                           // window.sessionStorage.setItem("floornumberlogin",resp.loginfloor );
                            location.replace('./');
                        }, 2000);
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>
</html>