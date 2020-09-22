<?php
/**
 * Template Name: Profile Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */


$current_user = wp_get_current_user();

$usertype = get_user_meta(get_current_user_id(), "usertype", true);
if(empty($usertype) || $usertype !== "agent"){
    $usertype = "client";
}

$DEV = 1;
if($DEV){
  $result = array();
  parse_str($_SERVER['QUERY_STRING'], $result);
  // seriously
  // https://stackoverflow.com/questions/34571330/php-ternary-operator-vs-null-coalescing-operator
  if($result["usertype"] ?? "" === "agent"){
  // if the above line doesn't work:
  // if(isset($result["usertype"]) && $result["usertype"] === "agent"){
    $usertype = "agent";
  }
}



/*

print_r($current_user->ID);
echo "<pre>";
echo "usertype: " . $usertype;
echo "</pre>";

*/
?>


<style>

* {
    box-sizing: border-box;
}

body, #page-root {
    width: 100%;
    height: 100%;
    margin: 0;
    border: 0;
    position: absolute;
}

#page-root {
    padding: 15px;
    display: grid;
    grid-template-areas:
            "b f"
            "g f"
            "c f";
    grid-template-rows: 150px auto 1fr;
    grid-template-columns: 70% 1fr;
}

#page-root > .user-bio {
    grid-area: b;
}
#page-root > .profile-tabs-group {
    grid-area: g;
}
#page-root > .profile-tab-content-container {
    grid-area: c;
}
#page-root > .profile-functionals-container {
    grid-area: f;
}


</style>
<!-- PAGE ROOT
------------------------------------------------>
<div id="page-root">




<style>
.user-bio {
    display: flex;
    flex-direction: "row";
    margin-bottom: 30px;
}

.user-bio-avatar {
    display: inline-block;
    height: 80px;
    width: 80px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    float: left;
    margin: 5px 20px 13px 0;
}

.user-bio-text-container,
.user-bio-name,
.user-bio-usertype {
    display: inline-block;
}

.user-bio-text-container {
    display: inline-flex;
    flex-direction: column;
}

</style>

<div class="user-bio">
    <div class="user-bio-avatar"></div>
    <div class="user-bio-text-container">
        <h2 class="user-bio-name">
            <?php print_r(esc_html($current_user->display_name)); ?>
        </h2>
        <div class="user-bio-usertype">
            <?php echo $usertype; ?>
        </div>
    </div>
</div>


<!-- PROFILE CONTENT CONTAINER
------------------------------------------>
<style>
.profile-tabs-group {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
}

.profile-tab {
    flex-grow: 1;

    padding: 8px;
    display: flex;
    justify-content: center;
    cursor: pointer;
    user-select: none;
}
.profile-tab:not(.active) {
    border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0;
}
.profile-tab.active {
    background: rgba(0, 0, 0, 0.05);
    
    border-top: 1px solid rgba(0, 0, 0, 0.2);
    border-left: 1px solid rgba(0, 0, 0, 0.2);
    border-right: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 5px 5px 0 0;
}
.profile-tab:hover {
    background: rgba(0, 0, 0, 0.1);
}
.profile-tab-content-container > .profile-tab-content {
    display: none;
    padding: 15px;
}
.profile-tab-content-container > .profile-tab-content.active {
    display: block;
}
</style>
<div class="profile-tabs-group">
    <?php

      if($usertype === "agent"){
        $tabs = array(
          "Pending Appointments",
          "Upcoming Appointments",
          "Ongoing Conversations",
          "Connections"
        );
      } else{
        $tabs = array(
          "Recently Browsed",
          "Appointments",
          "Conversations",
          "Connections"
        );
      }
      for($i = 0; $i < count($tabs); ++$i){
        echo "<div class='profile-tab {i === 0 ? 'active' : '' }'>
          {$tabs[$i]}
        </div>";
      }

    ?>
</div>
<div class="profile-tab-content-container">
    <?php
    /**
     * AGENT PROFILE CONTENT
     */

    function pendingAppointmentButtons(){
      echo '
      <div class="profile-tab-content-pending-appointment-buttons">
        <div class="profile-tab-content-pending-appointment-approve-button">
          Approve
        </div>
        <div class="profile-tab-content-pending-appointment-reject-button">
          Reject
        </div>
        <div class="profile-tab-content-pending-appointment-contact-button">
          Contact
        </div>
      </div>';
    }
    if($usertype === "agent"): ?>
    <div class="profile-tab-content profile-tab-content-0">
      <style>
        .profile-tab-content-pending-appointment {
          width: 360px;
          padding: 15px;
          border: 1px solid rgba(0, 0, 0, 0.2);
        }
        
        .profile-tab-content-pending-appointment:not(:last-child) {
          border-bottom: none;
        }

        .profile-tab-content-pending-appointment-buttons {
          margin-top: 15px;
        }
        .profile-tab-content-pending-appointment-approve-button,
        .profile-tab-content-pending-appointment-reject-button,
        .profile-tab-content-pending-appointment-contact-button {
          cursor: pointer;
          border: 1px solid rgba(0, 0, 0, 0.1);
          border-radius: 10px;
          display: inline-block;
          padding: 10px;
          margin-right: 15px;
        }
        .profile-tab-content-pending-appointment-approve-button {
          background: #93F988;
        }
        .profile-tab-content-pending-appointment-reject-button {
          background: #FFAEAE;
        }
        .profile-tab-content-pending-appointment-contact-button {
          background: #F6FF6F;
        }
      </style>
      <div class="profile-tab-content-pending-appointment">
          Appointment <span> from user1425 </span> <br />
          of Product #5231 <i>date undecided</i>
          <?php pendingAppointmentButtons(); ?>
      </div>
      <div class="profile-tab-content-pending-appointment">
          Appointment <span> from user6262 </span> <br />
          of Product #1252 on <i>02 May 1012 (2 days later)</i>
          <?php pendingAppointmentButtons(); ?>
      </div>
    </div>
    <div class="profile-tab-content profile-tab-content-1">
        Tab 2
    </div>
    <div class="profile-tab-content profile-tab-content-2">
        Tab 3
    </div>
    <div class="profile-tab-content profile-tab-content-3">
        Tab 4
    </div>


    <?php /* END OF AGENT PROFILE CONTENT */
    else:
    /**
     * CLIENT PROFILE CONTENT
     */ ?>
    <div class="profile-tab-content profile-tab-content-0">
        <style>
          .profile-tab-content-product {
            width: 360px;
            padding: 15px;
            border: 1px solid rgba(0, 0, 0, 0.2);
          }
          
          .profile-tab-content-product:not(:last-child) {
            border-bottom: none;
          }

          .buttons-container {
            padding: 15px;
            margin-top: 15px;
          }
          .button {
            padding: 15px;
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0.2);
            display: inline-block;
            margin-right: 15px;
            margin-top: 15px;
          }
        </style>
        <div class="profile-tab-content-product">
            Product 1 <span> from shop 1 </span><br />
            Price: NIL <br />
            <div class="buttons-container">

              <div class="button">
                Mention in conversation
              </div>
              <a class="button">
                Make Appointment
              </a>
            </div>
        </div>
        <div class="profile-tab-content-product">
            Product 2 <span> from shop 1 </span><br />
            Price: NIL<br />
            Appointment with agent5253 on <i> 23 May 1023 (3 days after)</i>
            <div class="buttons-container">
              
              <a class="button">
                Change Appointment Date
              </a>
              <div class="button">
                Mention in conversation
              </div>
            </div>
        </div>
    </div>
    <div class="profile-tab-content profile-tab-content-1">
        <style>
          .profile-tab-content-appointment {
            width: 360px;
            padding: 15px;
            border: 1px solid rgba(0, 0, 0, 0.2);
          }
          
          .profile-tab-content-appointment:not(:last-child) {
            border-bottom: none;
          }
        </style>
        <div class="profile-tab-content-appointment">
          Appointment to agent5132 (Pending for agent approval) <br />
          <i>date undecided</i> <br />
          Topic: <i>to be discussed</i>
        </div>
    </div>
    <div class="profile-tab-content profile-tab-content-2">
        Tab 3
    </div>
    <div class="profile-tab-content profile-tab-content-3">
        Tab 4
    </div>
    <?php endif; /* END OF CLIENT PROFILE CONTENT */ ?>
</div><!-- END OF PROFILE CONTENT CONTAINER -->

<script>
    let tabs = document.querySelectorAll(".profile-tab");
    let tabContentContainer = document.querySelector(
            ".profile-tab-content-container");
    let tabContents = tabContentContainer.children;
    console.log(tabContents);
    
    let activeTabIndex = 0;
    for(let [ i, tab ] of tabs.entries()){
        if(tab.classList.contains("active")){
            activeTabIndex = i;
            break;
        }
    }


    tabs[activeTabIndex].classList.add("active");
    tabContents[activeTabIndex].classList.add("active");


    for(let [ i, tab ] of tabs.entries()){
        tab.addEventListener("click", () => {
            if(i === activeTabIndex) return;
            try{
              tabs[activeTabIndex].classList.remove("active");
              tabContents[activeTabIndex].classList.remove("active");

              tab.classList.add("active");
              tabContents[i].classList.add("active");

            } catch(e){

            }
            
            activeTabIndex = i;
        });
    }
</script>


<style>

.profile-functionals-container {
    padding: 50px 10px 0 15px;
}

.profile-functionals-buttons > a {
    display: inline-block;
    width: 100%;
    height: auto;
    padding: 15px;
    border: 1px solid rgba(0, 0, 0, 0.5);
    cursor: pointer;
    user-select: none;
}
.profile-functionals-buttons > a:not(:last-child) {
    border-bottom: none;
}
.profile-functionals-buttons > a:hover {
    background: rgba(0, 0, 0, 0.2);
}
.profile-functionals-buttons > a:active {
    background: rgba(0, 0, 0, 0.3);
}
</style>
<div class="profile-functionals-container">
    <div class="profile-functionals-buttons">
        <a>Edit User Profile</a>
        <?php if($usertype === "agent"){ ?>
            <a>Edit Shop & Products</a>
        <?php } ?>
    </div>
</div>









</div><!-- END OF PAGE ROOT -->