<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
  <div class="sb-sidenav-menu">
    <div class="nav">
      <div class="sb-sidenav-menu-heading">Menu</div>
      <a class="nav-link" href="dashboard.php">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
      </a>
      <a class="nav-link" href="products.php">
        <div class="sb-nav-link-icon"><i class="fas fa-boxes-stacked"></i></div>
        Products
      </a>
      <a class="nav-link" href="sellers.php">
        <div class="sb-nav-link-icon"><i class="fas fa-people-group"></i></div>
        Sellers
      </a>
      <?php if ($_SESSION['role_id'] == 1 ) { ?>
      <a class="nav-link" href="users.php">
        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
        Users
      </a>
      <?php } ?>
    </div>
  </div>
  <div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
    <?= $_SESSION['username'] ?>
  </div>
</nav>