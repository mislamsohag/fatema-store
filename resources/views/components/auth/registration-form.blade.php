<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>

                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>

                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>

                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100  bg-gradient-primary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function onRegistration(){
        const firstName=document.getElementById('firstName').value;
        const lastName=document.getElementById('lastName').value;
        const mobile=document.getElementById('mobile').value;
        const email=document.getElementById('email').value;
        const password=document.getElementById('password').value;

        if(firstName.length===0){
            errorToast('First name is required');
        }else if(lastName.length===0){
            errorToast('Last name is required');
        }else if(mobile.length===0){
            errorToast('Mobile number is required');
        }else if(email.length===0){
            errorToast('Email is required');
        }else if(password.length===0){
            errorToast('Password is required');
        }
        else{
            showLoader();
            let res=await axios.post("/user-registration", {
                firstName:firstName,
                lastName:lastName,
                mobile:mobile,
                email:email,
                password:password
            });
            hideLoader();

            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                setTimeout(function(){
                    window.location.href="/login-page";
                }, 2000);
            }else{
                errorToast(res.data['message']);
            }
        }
    }
</script>

