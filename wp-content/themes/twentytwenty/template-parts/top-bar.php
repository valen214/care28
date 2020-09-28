<?php






function getTopBar(){


$user_ID = get_current_user_id();

?>


<style>
  .top-bar {
    height: 80px;
    background: #aaf;
    display: flex;
    width: 100%;
    align-items: center;
  }


  .nav-left {
    height: 100%;
    display: flex;
    align-items: center;
  }

  .logo {
    margin-left: 30px;
    text-decoration: none;
    user-select: none;
  }
  .logo:link,
  .logo:active,
  .logo:visited {
    color: inherit;
  }



  .nav-center {
    margin: auto;
    height: 100%;
  }

  .search-bar {
    height: 100%;
    padding: 15px;
  }
  .search-bar > input {
    height: 100%;
    width: 35vw;
    font-size: 28px;
  }



  .nav-right {
    margin-left: auto;
  }

  .sign-in-button,
  .profile-button {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;
    height: 100%;
    cursor: pointer;
    text-decoration: inherit;
    color: inherit;
  }

</style>

<div class="top-bar">
  

  <div class="nav-left">
    <a href="/" class="logo"><h2>Care 28</h2></a>
  </div>
  <div class="nav-center">
    <div class="search-bar">
      <input type="text" />
    </div>
  </div>
  <div class="nav-right">
    <a class="profile-button"
        href="/profile">
      Profile
    </a>
    <?php if(is_user_logged_in()): ?>
      <a class="sign-in-button">
        Log Out
      </a>
    <?php else: ?>
      <a class="sign-in-button"
          href="/login">
        Sign In
      </a>
    <?php endif; ?>
  </div>
</div>



<?php





}