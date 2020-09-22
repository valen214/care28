<?php
/**
 * Template Name: Edit Profile Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */




get_header();

$current_user = wp_get_current_user();
$user_display_name = $current_user->display_name;

$user_ID = get_current_user_id();
$usertype = $wpdb->get_var(
  "SELECT `usertype` FROM {$profile_table} WHERE `ID`={$user_ID}"
);
if(empty($usertype) || $usertype !== "agent"){
  $usertype = "client";
} 

?>

<style>


body{
    margin-top:20px;
    background:#f5f5f5;
}
/**
 * Panels
 */
/*** General styles ***/
.panel {
  box-shadow: none;
  padding: 15px 50px;
}
.panel-heading {
  border-bottom: 0;
}
.panel-title {
  font-size: 17px;
}
.panel-title > small {
  font-size: .75em;
  color: #999999;
}
.panel-body *:first-child {
  margin-top: 0;
}
.panel-footer {
  border-top: 0;
}

.panel-default > .panel-heading {
    color: #333333;
    background-color: transparent;
    border-color: rgba(0, 0, 0, 0.07);
}

form label {
    color: #999999;
    font-weight: 400;
}

@media (min-width: 768px) {
  .form-horizontal .control-label {
    text-align: right;
    margin-bottom: 0;
    padding-top: 7px;
  }
}

.profile__contact-info-icon {
    float: left;
    font-size: 18px;
    color: #999999;
}
.profile__contact-info-body {
    overflow: hidden;
    padding-left: 20px;
    color: #999999;
}
.profile-avatar {
  width: 200px;
  position: relative;
  margin: 0px auto;
  margin-top: 196px;
  border: 4px solid #f3f3f3;
}

.edit-profile-user-panel-body {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
}

.edit-profile-user-panel-body > .form-group {
  display: inline-block;
  width: 45%;
}


.action-button-container {
    margin-top: 30px;
}
.edit-profile-register-as-agent {
    display: inline-block;
    <?php if($usertype === "agent"){
      echo "display: none;";
      echo "visibility: hidden;";
    }
    ?>
    width: 45%;
    margin-top: 15px;
    padding: 15px;
    cursor: pointer;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 5px;
}
.edit-profile-register-as-agent:hover {
    background: rgba(0, 0, 0, 0.2);
}


.edit-profile-agent-panel {
  display: none;
  <?php if($usertype === "agent"){
    echo "display: block;";
  }
  ?>
}
.edit-profile-agent-panel-body {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
}
.edit-profile-agent-panel-body > .form-group {
  width: 45%;
  display: inline-block;
  margin-top: 15px;
}

</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets">
<div class="row">
  <div class="col-xs-12 col-sm-9">
    <form class="form-horizontal">
        <div class="panel panel-default">
          <div class="panel-body text-center">
            <img src="/wp-content/themes/twentytwenty/assets/images/2020-avatar.jpg" class="img-circle profile-avatar" alt="User avatar">
          
            <input type="file" />
          </div>
        </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">User info</h4>
        </div>
        <div class="edit-profile-user-panel-body panel-body">
          <div class="edit-profile-user-display-name form-group">
            <label class="col-sm-2 control-label">User Display Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control"
                    value="<?php echo $user_display_name ?? ""; ?>"/>
            </div>
          </div>

          <div class="edit-profile-phone form-group">
            <label class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control">
            </div>
          </div>
          
          <div class="edit-profile-email form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control">
            </div>
          </div>

          <div class="form-group edit-profile-register-as-agent">
            Register as Agent
          </div>
          <div class="form-group edit-profile-user-panel-space-filler">

          </div>
        </div>
      </div>
      <div class="panel panel-default edit-profile-agent-panel">
        <div class="panel-heading">
            <h4 class="panel-title">Agent Info</h4>
        </div>
        <div class="edit-profile-agent-panel-body panel-body">

          <div class="edit-profile-company-name form-group">
            <label class="col-sm-2 control-label">Company Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" />
            </div>
          </div>

          <div class="edit-profile-company form-group">
            <label class="col-sm-2 control-label">Company</label>
            <div class="col-sm-10">
              <input type="text" class="form-control">
            </div>
          </div>

          <div class="edit-profile-agent-license form-group">
            <label for="edit-profile-agent-license-input"
                class="col-sm-2 control-label">Agent License</label>
            <div class="col-sm-10">
              <input id="edit-profile-agent-license-input"
                  type="file" class="form-control">
            </div>
          </div>

          <div class="form-group">
            &nbsp;
          </div>

          
          <div class="edit-profile-company-license form-group">
            <label for="edit-profile-company-license-input"
                class="col-sm-2 control-label">Company License</label>
            <div class="col-sm-10">
              <input id="edit-profile-company-license-input"
                  type="file" class="form-control">
            </div>
          </div>

          <div class="form-group">
            &nbsp;
          </div>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">Security</h4>
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Current password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">New password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <div class="checkbox">
                <input type="checkbox" id="checkbox_1">
                <label for="checkbox_1">Visible</label>
              </div>
            </div>
          </div>
          <div class="action-button-container form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <button id="edit-profile-submit-button"
                  class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-default">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<style>


</style>
<div id="loading-screen"></div>
<script>

const register_as_agent_button = document.getElementsByClassName(
                "edit-profile-register-as-agent")[0];
const edit_profile_user_display_name_input = document.querySelector(
          ".edit-profile-user-display-name input");
const edit_profile_agent_panel = document.querySelector(
    ".edit-profile-agent-panel"
);
const edit_profile_submit_button = document.getElementById(
    "edit-profile-submit-button");

function doAPICall(payload){
  payload.token = localStorage.getItem("token");
  return fetch(location.origin + "/wp-json/api/v1/info", {
      method: "POST",
      headers: {
          "Content-Type": "application/json"
      },
      body: JSON.stringify(payload)
  });
}

doAPICall({
    "type": "query_user",
    "fields": [
      "display_name",
      "usertype",
    ],
}).then(res => res.json()).then(res => {

    console.log(res);
    if(res.usertype === "agent"){
      register_as_agent_button.style.display = "none";
    }
    if(res.display_name && !edit_profile_user_display_name_input.value){

      edit_profile_user_display_name_input.value = res.display_name;
    }
}).catch(e => {
  console.log("Error:", e);
});


register_as_agent_button.addEventListener("click", () => {
  edit_profile_agent_panel.style.display = "block";
  register_as_agent_button.style.display = "none";
});

edit_profile_submit_button.addEventListener("click", e => {
  e.preventDefault();
  doAPICall({
      "type": "edit_user",
      "fields": {
        "display_name": edit_profile_user_display_name_input.value,
      },
  }).then(res => res.text()).then(res => {
    console.log(res);
    location.reload();
  }).catch(e => {
    console.log("Error:", e);
  });

});

</script>