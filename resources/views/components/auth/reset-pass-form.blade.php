<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>SET NEW PASSWORD</h4>
                    <br/>
                    <label>New Password</label>
                    <input id="password" placeholder="New Password" class="form-control" type="password"/>
                    <br/>
                    <label>Confirm Password</label>
                    <input id="confirmPassword" placeholder="Confirm Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="ResetPassword()" class="btn w-100 bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- <script>
    async function ResetPassword(){
        const password=document.getElementById('password').value;
        const confirmPassword=document.getElementById('confirmPassword').value;

        if(password.length===0){
            errorToast('Password field is required');
        }else if(confirmPassword.length === 0){
            errorToast('Confirm Password is required');
        }else if(password !== confirmPassword){
            errorToast('Password and Confirm Password should be Equal');
        }        
        
        else{
            showLoader();
            let res=await axios.post('reset-password', {
                password:password
            })
            hideLoader();

            if(res.status==200 && res.data['status']==='success'){
                successToast(res.data['message']);
                debugger;
                setTimeout(()=>{
                    window.location.href="/login-page";
                },1000)
            }else{
                errorToast(res.data['message']);
            }
        }
    }
</script> -->




<script>
  async function ResetPassword() {
        let password = document.getElementById('password').value;
        let confirmPassword = document.getElementById('confirmPassword').value;

        if(password.length===0){
            errorToast('Password is required')
        }
        else if(confirmPassword.length===0){
            errorToast('Confirm Password is required')
        }
        else if(password!==confirmPassword){
            errorToast('Password and Confirm Password must be same')
        }
        else{
          showLoader()
          let res=await axios.post("/reset-password",{password:password});
          hideLoader();

          if(res.status===200 && res.data['status']==='success'){
              successToast(res.data['message']);
              debugger;
              setTimeout(function () {
                  window.location.href="/login-page";
              },1000);
          }
          else{
            errorToast(res.data['message'])
          }
        }

    }
</script>


