<?php
/**
 * Template Name: Register Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

global $wpdb;
get_header();

?>
<style>
.form-container {
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
}

.button-group {
	margin-top: 15px;
}

#login-form-submit {
	margin-right: 15px;
}

.form-control {

}

.agent-only {
    display: none;
}

#register-form-password-unmatch {
    color: red;
}

.register-form-empty-message {
    display: none;
    color: red;
}

#register-form-usertype-client,
#register-form-usertype-agent {
    margin-left: 15px;
}

.col-6 {
  width: 50%;
}
.w-100 {
  width: 100%;
}

</style>

<h3>Don't have an Account? Register Now.</h3>

<p>* are required fiedls</p>

<div class="col-6 form-group">
  <label for="register-form-name">* Name:</label>
  <input type="text" id="register-form-name" name="register-form-name" value="" class="form-control" />
    <div class="register-form-empty-message">
        Empty Required Field
    </div>
</div>

<div class="col-6 form-group">
  <label for="register-form-email">* Email Address:</label>
  <input type="text" id="register-form-email" name="register-form-email" value="" class="form-control" />
    <div class="register-form-empty-message">
        Empty Required Field
    </div>
</div>

<div class="w-100"></div>

<div class="col-6 form-group">
  <label for="register-form-username">* Choose a Username:</label>
  <input type="text" id="register-form-username"
        name="register-form-username"
        value="" class="form-control" />
    <div class="register-form-empty-message">
        Empty Required Field
    </div>
</div>

<div class="col-6 form-group">
  <label for="register-form-phone">Phone (Optional):</label>
  <input type="text"
      id="register-form-phone"
      name="register-form-phone" value=""
      class="form-control" />
</div>

<div class="w-100"></div>

<div class="col-6 form-group">
  <label for="register-form-password">* Choose Password:</label>
  <input type="password"
      id="register-form-password"
      name="register-form-password" value=""
      class="form-control" />
                        
  <div
      id="register-form-password-unmatch"
      style="display: none">
    password not match
  </div>
  
  <div class="register-form-empty-message">
    Empty Required Field
  </div>

</div>

<div class="col-6 form-group">
  <label for="register-form-repassword">* Re-enter Password:</label>
  <input type="password"
      id="register-form-repassword"
      name="register-form-repassword" value=""
      class="form-control" />
  <div class="invalid-feedback register-form-empty-message">
      Empty Required Field
  </div>
</div>

                        
						<div class="col-6 form-group">
							<label for="register-form-user-type">You are:</label>
                            <input type="radio" checked="true"
                                    id="register-form-usertype-client" name="usertype" value="client" />
                            <label for="register-form-usertype-client">
                                Normal User
                            </label>
                            <input type="radio"
                                    id="register-form-usertype-agent" 
                                    name="usertype" value="agent" />
                            <label for="register-form-usertype-agent">Agent</label>
						</div>

<div class="w-100"></div>

<div class="col-6 form-group agent-only">
  <label for="register-form-company">Company</label>
  <input type="text"
          id="register-form-company"
          name="register-form-company" value=""
          class="form-control" />
</div>


<div class="col-12 form-group">
  <button class="btn btn-dark m-0"
      id="register-form-submit"
      name="register-form-submit"
      value="submit">Register Now</button>
</div>

<script>
(function(){

const USER_API_URL = document.location.origin + "/wp-json/api/v1/user";

let registerNameInput = document.getElementById("register-form-name");
let registerEmailInput = document.getElementById("register-form-email");
let registerUsernameInput = document.getElementById("register-form-username");
let registerPhoneInput = document.getElementById("register-form-phone")
let registerPasswordInput = document.getElementById("register-form-password");
let registerRepasswordInput = document.getElementById("register-form-repassword");

let registerUserTypeClient = document.getElementById("register-form-usertype-client");
let registerUserTypeAgent = document.getElementById("register-form-usertype-agent");

let registerPasswordUnmatchMessage = document.getElementById("register-form-password-unmatch");
let registerButton = document.getElementById("register-form-submit");


function initPasswordCheck(){
    let event_listener = (e) => {
        
        if(registerPasswordInput.value &&
                registerRepasswordInput.value && (
                registerPasswordInput.value !==
                registerRepasswordInput.value)){
            e.target.style.borderColor = "red";
            e.target.parentElement.appendChild(registerPasswordUnmatchMessage);
            registerPasswordUnmatchMessage.style.display = "block";
        } else{
            registerPasswordInput.style.borderColor = null;
            registerRepasswordInput.style.borderColor = null;
            registerPasswordUnmatchMessage.style.display = "none";
        }
    };
    registerPasswordInput.addEventListener("input",  event_listener)
    registerRepasswordInput.addEventListener("input",  event_listener)
}
function initAgentForm(){
    let agentTypeInputListener = () => {
        let usertype = registerUserTypeAgent.checked ? "agent" : "client";


        let registerFormAgentFields = document.getElementsByClassName("agent-only");
        for(let field of registerFormAgentFields){
            field.style.display = (
                    usertype === "agent" ? "block" : null
            );
        };
    };

    registerUserTypeClient.addEventListener("input", agentTypeInputListener);
    registerUserTypeAgent.addEventListener("input", agentTypeInputListener);
}


initPasswordCheck();
initAgentForm();

function checkInputNonNull(input){
    if(input && input.value){
        return true;
    } else if(!input){
        return false;
    } else{
        let emptyMessage = input.parentElement.getElementsByClassName(
                "register-form-empty-message");
        if(emptyMessage && emptyMessage[0]){
            emptyMessage = emptyMessage[0];
            emptyMessage.style.display = "block";
        } else{
            emptyMessage = { style: {} };
        }
        input.addEventListener("input", () => {
            console.log("HI");
            input.style.borderColor = null;
            emptyMessage.style.display = null;
        }, {
            once: true,
        });

        input.style.borderColor = "red";
        return false;
    }
}

function verifyRegisterInfo(){
    let ok = true;
	for(let input of [
        registerNameInput,
        registerEmailInput,
        registerUsernameInput,
        registerPasswordInput,
        registerRepasswordInput,
    ]){
        ok = checkInputNonNull(input) && ok;
    }

    if(!ok){
        return false;
    }

    if(registerPasswordInput.value
    !== registerRepasswordInput.value){
        

        return false;
    }




    return true;
}

registerButton.addEventListener("click", async (e) => {
    e.preventDefault();
	let ok = verifyRegisterInfo();
    if(!ok){
        console.log("register information verfication failed")
        return;
    }

    let usertype = registerUserTypeAgent.checked ? "agent" : "client";

	let out = await fetch(USER_API_URL, {
		method: "POST",
		body: JSON.stringify({
			action: "register",
            usertype,
			username: registerUsernameInput.value,
			email: registerEmailInput.value,
			password: registerPasswordInput.value,
		}),
	});
	if(out.status !== 200){
		console.error("user register failed:", out);
		return;
	}
	out = await out.json();
	console.log(out);
	if(out.body === "ok"){
		document.location.replace(document.location.origin + "/user");
	}
})

})();
</script>

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>

