function Signup(){
    // Get the modal
    var modal = document.getElementById('SignupModal');


    // Get the button that opens the modal
    var btnSignup = document.getElementById("signupBtn");


    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal 
    btnSignup.onclick = function () {
        modal.style.display = "block";
    }

    btnSignup.onclick = function () {
        modal.style.display = "block";
    }



    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }

    }
}

function Login(){
    // Get the modal
    var modal = document.getElementById('LoginModal');


    // Get the button that opens the modal
    var btnLogin = document.getElementById("loginBtn");


    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal 
    btnLogin.onclick = function () {
        modal.style.display = "block";
    }

    btnLogin.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }

    }
}
