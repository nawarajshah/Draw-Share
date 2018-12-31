<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <a class="navbar-brand text-capitalize" href="draw.php"><i class="icon fa-pencil"></i> Draw</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="figure.php"><i class="icon fa-image"></i> Figure</a>
    </li>  
    <li class="nav-item">
      <a class="nav-link" href="friend.php"><i class="icon fa-users"></i> Friend</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="msg.php"><i class="icon fa-envelope-o"></i> Message</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-capitalize" href="profile.php"><i class="icon fa-user"></i> <?php echo $session_username; ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="loginRegister/logout.php"><i class="icon fa-sign-out"></i> Log Out</a>
    </li>
    </ul>
  </div>
</nav>