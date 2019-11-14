  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo Session::get('name'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
         $path = $_SERVER['SCRIPT_FILENAME'];
         $currentpage = basename($path, '.php');
       ?>

      <ul class="sidebar-menu" data-widget="tree">
       <li class="header">MAIN NAVIGATION</li>
       <li <?php if ($currentpage == 'index') { echo 'class="active"'; } ?> >
          <a href="index.php"><i class="fa fa-dashboard"></i> <span> Dashboard</span></a>
        </li>
        <li <?php if ($currentpage == 'admin_contact') { echo 'class="active"';} ?> >
          <a href="admin_contact.php"><i class="fa fa-comment"></i><span> Contact Us </span></a>
        </li>
        <li <?php if ($currentpage == 'admin') { echo 'class="active"';} ?>>
         <a href="admin.php"><i class="fa fa-user"></i><span> Admin Account </span></a>
        </li> 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>