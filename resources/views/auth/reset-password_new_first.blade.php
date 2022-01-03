@extends('layouts.guest_new')

@section('style')
<style>
    a{
        color: #a3a3a3;
    }
    .alert-danger {
    color: #e8c4a5;
    background-color: #548989;
    border-color: #ffd8b3;
}
</style>
@endsection

@section('content')

<div class="card auth-card">
    <div class="card-body">
        <div class="logo-wrap" onclick="gotoPassword()">
            <img class="img-fluid" src="/assets/images/logo.svg" alt="Kinntegra">
        </div>

        <form method="POST" id="reset_password-pin" action="{{ route('password.update.first') }}">
            @csrf
            <input type="hidden" name="username" value="{{ $user->username }}">

            <div id="reset1">
                <p id="message"></p>
                <h3 class="card-title text-center">Reset Password</h3>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="" required>
                    <span id="password_error" class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="" required>
                    <span id="password_confirmation_error" class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>
                </div>
                <button id="resetpassword" onclick="gotoPin()" class="btn btn-primary w-100 btn-lg text-uppercase" type="button">Proceed to Reset PIN</button>
            </div>
            <div id="reset2" class="d-none">
                <h3 class="card-title text-center">Reset PIN</h3>
                <div class="form-group">
                    <label for="pin">PIN</label>
                    <input type="password" id="pin" name="pin" class="form-control" placeholder="" required>
                    <span id="pin_error" class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="pin_confirmation">Confirm PIN</label>
                    <input type="password" id="pin_confirmation" name="pin_confirmation" class="form-control" placeholder="" required>
                    <span id="pin_confirmation_error" class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>
                </div>
                <button id="resetpin" class="btn btn-primary w-100 btn-lg text-uppercase" onclick="submitForm()" type="button">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    window.onload = function() {
  document.getElementById('reset2').style.display = 'none';
};

function gotoPin()
{
    password = document.getElementById('password').value;
    if(!password){
        document.getElementById('password').classList.add("is-invalid");
        document.getElementById('password_error').style.color = 'red';
        document.getElementById('password_error').style.fontWeight  = '600';
        document.getElementById('password_error').innerHTML = 'Enter new password';
        return false;
    }else{
        document.getElementById('password').classList.remove("is-invalid");
        document.getElementById('password_error').innerHTML = '';
    }

    password_confirmation = document.getElementById('password_confirmation').value;
    if(!password_confirmation){
        document.getElementById('password_confirmation').classList.add("is-invalid");
        document.getElementById('password_confirmation_error').style.color = 'red';
        document.getElementById('password_confirmation_error').style.fontWeight  = '600';
        document.getElementById('password_confirmation_error').innerHTML = 'Enter Confirm password';
        return false;
    }else{
        document.getElementById('password_confirmation').classList.remove("is-invalid");
        document.getElementById('password_confirmation_error').innerHTML = '';
    }

    if(password == password_confirmation){
        document.getElementById('password_confirmation').classList.remove("is-invalid");
        document.getElementById('password_confirmation_error').innerHTML = '';
        document.getElementById("reset2").classList.remove("d-none");
        document.getElementById("reset2").style.display = "block";
        document.getElementById("reset1").style.display = "none";
    }else{
        document.getElementById('password_confirmation').classList.add("is-invalid");
        document.getElementById('password_confirmation_error').style.color = 'red';
        document.getElementById('password_confirmation_error').style.fontWeight  = '600';
        document.getElementById('password_confirmation_error').innerHTML = 'Entered password not matched!';
    }


}

function gotoPassword()
{
    document.getElementById("reset2").classList.add("d-none");
    document.getElementById("reset2").style.display = "none";
    document.getElementById("reset1").style.display = "block";
}

function submitForm()
{
    pin = document.getElementById('pin').value;
    if(!pin){
        document.getElementById('pin').classList.add("is-invalid");
        document.getElementById('pin_error').style.color = 'red';
        document.getElementById('pin_error').style.fontWeight  = '600';
        document.getElementById('pin_error').innerHTML = 'Enter new pin';
        return false;
    }else{
        document.getElementById('pin').classList.remove("is-invalid");
        document.getElementById('pin_error').innerHTML = '';
    }

    pin_confirmation = document.getElementById('pin_confirmation').value;
    if(!pin_confirmation){
        document.getElementById('pin_confirmation').classList.add("is-invalid");
        document.getElementById('pin_confirmation_error').style.color = 'red';
        document.getElementById('pin_confirmation_error').style.fontWeight  = '600';
        document.getElementById('pin_confirmation_error').innerHTML = 'Enter Confirm pin';
        return false;
    }else{
        document.getElementById('pin_confirmation').classList.remove("is-invalid");
        document.getElementById('pin_confirmation_error').innerHTML = '';
    }

    if(pin == pin_confirmation){
        document.getElementById('pin_confirmation').classList.remove("is-invalid");
        document.getElementById('pin_confirmation_error').innerHTML = '';
        document.getElementById("reset_password-pin").submit();
    }else{
        document.getElementById('pin_confirmation').classList.add("is-invalid");
        document.getElementById('pin_confirmation_error').style.color = 'red';
        document.getElementById('pin_confirmation_error').style.fontWeight  = '600';
        document.getElementById('pin_confirmation_error').innerHTML = 'Entered pin not matched!';
    }

}
</script>
@endsection
