<div class="alert alert-danger alert-signup-usedemail" role="alert" hidden>Email is already taken.</div>
<div class="alert alert-danger alert-signup-error" role="alert" hidden>Sorry, there was an issue creating your account. Please try again later.</div>
<div class="alert alert-danger alert-login-noemail" role="alert" hidden>Sorry, we had trouble find your account. Check your spelling and try again.</div>
<div class="alert alert-danger alert-login-wrongpassword" role="alert" hidden>Sorry, your password didn't match that account.</div>
<div class="d-flex justify-content-between mt-40 mb-40 ml-40 mr-40 forms-out" hidden>
    <div>
        <h2 class="text-first">Sign up</h2>
        <form class="mt-24 signupform">
            <div class="form-group">          
                <div class="input-group-prepend">
                    <div class="input-group-text bg-first text-white">FULL NAME</div>
                </div>
                <input class="form-control text-first" name="fullname" type="text" placeholder="Full Name">
                <div class="invalid-feedback">Please provide your full name.</div>
            </div>
            <div class="form-group">          
                <div class="input-group-prepend">
                    <div class="input-group-text bg-first text-white">EMAIL</div>
                </div>
                <input class="form-control text-first" name="email" type="email" placeholder="Email">
                <div class="invalid-feedback">Please provide your email address.</div>
            </div>
            <div class="form-group">          
                <div class="input-group-prepend">
                    <div class="input-group-text bg-first text-white">PASSWORD</div>
                </div>
                <input class="form-control text-first" name="password" type="password" placeholder="Password">
                <div class="invalid-feedback">Passwords must be at least 5 characters long and include at least 1 letter and number.</div>
            </div>
            <div class="form-group">          
                <div class="input-group-prepend">
                    <div class="input-group-text bg-first text-white">VERIFY</div>
                </div>
                <input class="form-control text-first" name="verify" type="password" placeholder="Verify Password">
                <div class="invalid-feedback">Passwords do not match.</div>
            </div>
            <div class="form-group">          
                <div class="input-group-prepend">
                    <div class="input-group-text bg-first text-white">BIRTH DATE</div>
                </div>
                <input class="form-control text-first signupform__birthdate" name="birthdate" type="date">
                <div class="invalid-feedback">Sorry, you must be 18+ to join our site.</div>
            </div>
            <input class="btn btn-first" type="submit" value="SUBMIT">
            <a class="togivenpage" href="<?=site_url()?>/Neighbors/given" hidden></a>
        </form>
    </div>
    <div>
        <h2 class="text-first">Login</h2>
        <form class="mt-24 loginform">
            <div class="form-group">          
                <div class="input-group-prepend">
                    <div class="input-group-text bg-first text-white">EMAIL</div>
                </div>
                <input class="form-control text-first" name="email" type="email" placeholder="Email">
                <div class="invalid-feedback">Invalid email address.</div>
            </div>
            <div class="form-group">          
                <div class="input-group-prepend">
                    <div class="input-group-text bg-first text-white">PASSWORD</div>
                </div>
                <input class="form-control text-first" name="password" type="password" placeholder="Password">
                <div class="invalid-feedback">Incorrect Password.</div>
            </div>
            <input class="btn btn-first" type="submit" value="SUBMIT">
            <span>Forgot Password?</span>
            <a href="<?=site_url()?>/Auth/login" hidden></a>
        </form>
    </div>
    
</div>
<div class="flex-column mt-40 mb-40 ml-40 mr-40 forms-in" hidden>
    <h1>You successfuly logged in!</h1>
    <div>
        <a class="btn btn-first ml-3" href="<?=site_url()?>/neighbors_quests/explore">Explore</a>
        <a class="btn btn-first ml-3" href="<?=site_url()?>/neighbors_quests/myquests">Created Quests</a>
        <a class="btn btn-first" href="<?=site_url()?>/neighbors_quests/adventures">Accepted Quests</a>
    </div>
</div>


<script src="<?=base_url()?>assets/js/login.js"></script>