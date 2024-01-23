<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo site_url(ADMIN_SLUG) ?>" class="brand-link">
    <img src="<?php echo base_url("assets-admin/") ?>img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <?php

    $sidebarArr = [
      // ["link" => site_url(ADMIN_SLUG), "title" => "Dashboard", "icon" => '<i class="nav-icon fas fa-th"></i>'],
      ["link" => site_url(ADMIN_SLUG . "/satta-records"), "title" => "Satta Records", "icon" => '<i class="nav-icon fas fa-th"></i>'],
      ["link" => site_url(ADMIN_SLUG . "/change-password"), "title" => "Change Password", "icon" => '<i class="nav-icon fas fa-th"></i>'],

      // ["link" => "#", "title" => "Blogs", "icon" => '<i class="nav-icon fas fa-th"></i>', "sub" => [
      //   ["link" => site_url(ADMIN_SLUG . "/blogs"), "title" => "Blogs", "icon" => '<i class="nav-icon fas fa-th"></i>'],
      //   ["link" => site_url(ADMIN_SLUG . "/blogs/category"), "title" => "Blogs Category", "icon" => '<i class="nav-icon fas fa-th"></i>'],
      // ]],
      ["link" => site_url(ADMIN_SLUG . "/logout"), "title" => "Logout", "icon" => '<i class="nav-icon fas fa-th"></i>'],
    ];
    ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <?php if (isset($sidebarArr)) {
          foreach ($sidebarArr as $navKey1 => $navValue1) {
            $active_parent = $active_sub = false;
            if ($navValue1["link"] == current_url()) {
              $active_parent = true;
            }
            if (isset($navValue1["sub"]) && !empty($navValue1["sub"])) {
              foreach ($navValue1["sub"] as $navKey2 => $navValue2) {
                if ($navValue2["link"] == current_url()) {
                  $active_parent = true;
                  break;
                }
              }
            }
            echo '<li class="nav-item ' . ($active_parent ? "menu-open" : "") . '">
                          <a href="' . ($navValue1["link"]) . '" class="nav-link ' . ($active_parent ? "active" : "") . '">
                            ' . $navValue1["icon"] . '
                            <p>
                              ' . $navValue1["title"] . '
                              ' . (isset($navValue1["sub"]) && !empty($navValue1["sub"]) ? '<i class="right fas fa-angle-left"></i>' : '') . '
                            </p>
                          </a>';
            if (isset($navValue1["sub"]) && !empty($navValue1["sub"])) {
              echo '<ul class="nav nav-treeview">';
              foreach ($navValue1["sub"] as $navKey2 => $navValue2) {
                $active_sub = false;
                if ($navValue2["link"] == current_url()) {
                  $active_sub = true;
                }
                echo '<li class="nav-item">
                        <a href="' . ($navValue2["link"]) . '" class="nav-link ' . ($active_sub ? "active" : "") . '">
                        ' . $navValue2["icon"] . '
                          <p>' . $navValue2["title"] . '</p>
                        </a>
                      </li>';
              }
              echo '</ul>';
            }
            echo '</li>';
          }
        } ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>