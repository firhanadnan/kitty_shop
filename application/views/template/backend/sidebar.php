<body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index-2.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= base_url();?>uploads/logo/logo.png" alt="" height="15">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url();?>uploads/logo/logo.png" alt="" height="10">
                                </span>
                            </a>

                            <a href="index-2.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= base_url();?>uploads/logo/logo.png" alt="" height="15">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= base_url();?>uploads/logo/logo.png" alt="" width="40%">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form>

                    
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-none d-lg-inline-block ml-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?= base_url();?>assets/admin/assets/images/users/avatar-1.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ml-1"><?= $user['nama_lengkap'];?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?= base_url()?>auth/logout"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                            </div>
                        </div>           
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu" class="mm-active">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <?php
                                //tampil main menu
                              $role_id = $this->session->userdata('role_id');

                              $sqlgroup = "SELECT * FROM menu_group WHERE group_id IN(SELECT group_id FROM menu_access WHERE role_id = $role_id)";
                              $groupmenu = $this->db->query($sqlgroup)->result();

                              foreach($groupmenu as $gm){
                                  echo '<li class="menu-title">'.$gm->group_name.'</li>';

                                  $sqlmenu = "SELECT * FROM menu WHERE group_id = $gm->group_id AND menu_type = 0";
                                  $mainmenu = $this->db->query($sqlmenu)->result();

                                  foreach($mainmenu as $mm){
                                    $checksub = $this->db->query("SELECT menu_type FROM menu WHERE menu_link = '".$this->uri->segment(1)."'")->result();
                                    $submenu = $this->db->query("SELECT * FROM menu WHERE menu_type = '$mm->menu_id'");

                                    if($submenu->num_rows() > 0 ){
                                      $active = "";
                                      foreach ($checksub as $ck) {
                                          if($ck->menu_type == $mm->menu_id){
                                              $active = "mm-active";
                                          } else {
                                              $active = "";
                                          }
                                      }
                                      echo '<li class="'.$active.'">
                                              <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                  <i class="'.$mm->menu_icon.'"></i>
                                                  <span>'.ucwords($mm->menu_title).'</span>
                                              </a>
                                              <ul class="sub-menu" aria-expanded="false">';
                                              foreach ($submenu->result() as $sm) {
                                                echo'<li class="'.$active.'">'.anchor($sm->menu_link, '<i class="'.$sm->menu_icon.'"></i><span>'.ucwords($sm->menu_title)).'</span></a></li>';
                                              }
                                       echo '</ul>
                                             </li>';
                                    } else {
                                      if($mm->menu_link == $this->uri->segment(1)){
                                          $activeli = "mm-active";
                                          $activeclass = "active";
                                      } else {
                                          $activeli ="";
                                          $activeclass = "";
                                      }
                                      echo'<li class="'.$activeli.'">'.anchor($mm->menu_link,'<i class="'.$mm->menu_icon.'"></i><span>'.ucwords($mm->menu_title), array('class'=>'waves-effect '.$activeclass)).'</span></a></li>';
                                    }
                                  }
                                }
                              ?>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->