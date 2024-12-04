<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-7 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-12 p-2">
                                <label>Full Name</label>
                                <input id="fullName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-12 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-12 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-12 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-12 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100  bg-gradient-primary">Complete</button>
                            </div>
                        </div>
                    </div>

                    <hr/>
                    <div class="float-end">
                        <span>
                            <a class="text-center ms-3 h6" href="{{url('/userLogin')}}">Sign In </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{url('/sendOtp')}}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


  async function onRegistration() {

        let email = document.getElementById('email').value;
        let fullName = document.getElementById('fullName').value;
        let mobile = document.getElementById('mobile').value;
        let password = document.getElementById('password').value;

        if(email.length===0){
            errorToast('Email is required')
        }
        else if(fullName.length===0){
            errorToast('Full Name is required')
        }
        else if(mobile.length===0){
            errorToast('Mobile is required')
        }
        else if(password.length===0){
            errorToast('Password is required')
        }
        else{
            showLoader();
            let res=await axios.post("/user-registration",{
                email:email,
                name:fullName,
                mobile:mobile,
                password:password
            })
            hideLoader();
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                setTimeout(function (){
                    window.location.href='/userLogin'
                },2000)
            }
            else{
                errorToast(res.data['message'])
            }
        }
    }
</script>
