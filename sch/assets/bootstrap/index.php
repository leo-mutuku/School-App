<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Kaliini Secondary Schoo</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/dogs/classroom.jfif&quot;);"></div>
                            </div>
                            <div class="col-lg-6" id="loginDiv">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                        <span id="response" style="color:red"> </span>
                                    </div>
                                    <form class="user"  >
                                        <div class="form-group"><input class="form-control form-control-user" type="email"  aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" id="email"> <span id="responseEmail" style="color:red;"></span></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password"  placeholder="Password" name="password" id="password"></div>
                                        <div class="form-group">
                                            
                                        </div><button class="btn btn-primary btn-block text-white btn-user" type="submit" id="loginBtn">Login </button><span id="serverResponse"></span>
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" id="forgotpassword" >Forgot Password?</a></div><span id="forgetPasswordMessage"></span>
                                </div>
                            </div>
                            <!-- Reset password -->
                            <div class="col-lg-6" id="resetPasswordDiv" style="display:none">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Enter your email!</h4>
                                        <span id="response" style="color:red"> </span>
                                    </div>
                                    <form class="user">
                                        <div class="form-group"><input class="form-control form-control-user" type="email"  aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" id="resetemail"> <span id="resetResponseEmail" style="color:red;"></span></div>
                                        <div class="form-group">
                                            
                                        </div><button class="btn btn-primary btn-block text-white btn-user" type="submit" id="resetPasswordBtn">Reset</button> <span id="resetPasswordServerResponse"></span>
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" id="backToLogin" >Back to login</a><br><span id="forgetPasswordMessage"></span></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
       const loginBtn = document.getElementById("loginBtn")
       const email = document.getElementById('email')
       const password = document.getElementById('password')
       const response =document.getElementById("response")
       const responseEmail = document.getElementById("responseEmail")
       const forgotpassword = document.getElementById("forgotpassword")
       const forgetPasswordMessage = document.getElementById("forgetPasswordMessage")
       const emailIsValid = email => {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
       }

       loginBtn.addEventListener('click',(e)=>
       {
        
           if(email.value ==="" || email.value ==='NULL' || password.value ==="" || password.value ==="NULL"){
            e.preventDefault()
                console.log("all fields are required and must not be empty")
                response.innerHTML ="All fields are required and must not be empty!";
                setTimeout(function(){ response.innerHTML = ""; }, 2000);
           }
           else{
               if(!emailIsValid(email.value)){
                e.preventDefault()
                   console.log("The email you entered is not valid - check if you type your email well or conduct your administrator")
                   responseEmail.innerHTML = "The email you entered is not valid!."
                   setTimeout(function(){ responseEmail.innerHTML = ""; }, 2000);
               }
               else{
                e.preventDefault();
                let useremail = email.value;
                let userpassword = password.value;
                const xhr = new XMLHttpRequest();
                 xhr.onload = function(){
                       const serverResponse = document.getElementById("serverResponse");
                       let response = this.responseText.replace(/\s/g, "")

                       if($.trim(response)==='success'){
                        window.location.href='home.php'
                        let session_user = sessionStorage.setItem('user',useremail)
                        
                       }else{
                        serverResponse.innerHTML =response
                        setTimeout(function(){ responseEmail.innerHTML = ""; }, 2000);

                       }
                       
                    
                   }
                   
                   xhr.open('POST', 'php/login/login.php');
                   xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                   xhr.send("email="+useremail+"&password="+userpassword)
                
                   
               }
           }
          
       })


     // reset password
       forgotpassword.addEventListener('click', (e)=>
       {
        const loginDiv = document.getElementById("loginDiv")
        const resetPasswordDiv = document.getElementById("resetPasswordDiv")
        loginDiv.style.display = "none"
        resetPasswordDiv.style.display = "block"
        
       })

       // back to login
       const backToLogin = document.getElementById("backToLogin")
       backToLogin.addEventListener('click', (e)=>{
        const loginDiv = document.getElementById("loginDiv")
        const resetPasswordDiv = document.getElementById("resetPasswordDiv")
        loginDiv.style.display = "block"
        resetPasswordDiv.style.display = "none"

       })


       // 
       const resetPasswordBtn = document.getElementById("resetPasswordBtn")
       const resetemail = document.getElementById("resetemail")
       const resetPasswordServerResponse = document.getElementById("resetPasswordServerResponse")
       resetPasswordBtn.addEventListener('click', (e)=>
       {
           e.preventDefault()
           if(resetemail.value==="" || resetemail.value===null){
            resetPasswordServerResponse.innerHTML ="email should not be empty"
            setTimeout(function(){ resetPasswordServerResponse.innerHTML = ""; }, 2000);
           }
           else{
           if(!emailIsValid(resetemail.value)){
                   console.log("The email you entered is not valid - check if you type your email well or conduct your administrator")
                   resetPasswordServerResponse.innerHTML = "The email you entered is not valid!."
                   setTimeout(function(){ responseEmail.innerHTML = ""; }, 2000);
               }
               else
               {
                let useremail = email.value;
                const reset = new XMLHttpRequest();
                 reset.onload = function(){
                       const resetPasswordServerResponse = document.getElementById("resetPasswordServerResponse");
                       resetPasswordServerResponse.innerHTML = this.responseText;
                       setTimeout(function(){ resetPasswordServerResponse.innerHTML = ""; }, 7000);
                    
                   }
                   reset.open('POST', 'php/login/reset.password.php');
                   reset.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
                   reset.send("email="+useremail)
               }
           }
          
       })
    </script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>