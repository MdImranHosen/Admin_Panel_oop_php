<?php include "inc/header.php"; ?>
<?php
 # Add New Admin Action get Code....
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_data_save'])) {
    $msg = $admin->addAdminData($_POST);
}
# Admin by Id Delete Action get Code....
 if (isset($_GET['deleteAdmin']) && $_GET['deleteAdmin']) {
    $adId = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['deleteAdmin']);
    $adId = (int)$adId;
    $msg  = $admin->supperAdminDeleted($adId);
 }
 # Edit Admin Action get Code....
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_data_update'])) {
    $msg = $admin->updateAdminByIdData($_POST);
}
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "inc/header_bottom.php"; ?>
  <!-- Left side column. contains the logo and sidebar -->
<!--SideBar Start-->
  <?php include "inc/sidebar.php"; ?>
<!--SideBar End-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Admin </strong></h4>
      </div>
      <div class="modal-body">
         <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
          <label class="control-label col-sm-2" for="name">Name:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="admin_name" id="name" placeholder="Enter name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email:</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="admin_email" placeholder="Enter email">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="admin_password">Password:</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="admin_password" id="admin_password" placeholder="Enter password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="admin_data_save" class="btn btn-danger btn-lg">Save</button>
          </div>
        </div>
      </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Super Admin
        <small>Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Admin Panel</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-users"></i>

              <h3 class="box-title">Admin</h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" title="Add Admin">
                  <i class="fa fa-plus"></i> Add Admin</button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
                
                <?php if(isset($msg)){ echo $msg; } ?>
                
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Admin Name</th>
                  <th>Email</th>
                  <th>Create Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 <?php 

                  $adminData = $admin->superAdminDataGet();
                  if(!empty($adminData)){
                    $i = 0;
                    while ($showData = $adminData->fetch_assoc()) {
                      $i++;
                 ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $showData['name']; ?></td>
                   <td><?php echo $showData['email']; ?></td>
                   <td><?php echo $showData['create_date']; ?></td>
                   <td><a class="btn btn-danger" href="?deleteAdmin=<?php echo $showData['id']; ?>"><i class="fa fa-trash"></i> Delete </a> <a data-toggle="modal" data-target="#editadminModal_<?php echo $showData['id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i> Edit </a></td>
                 </tr>
                  
                 <?php } } ?>
                </tbody>
              </table>
            </div>
          </div>

        </section>
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include "inc/footer.php"; ?>
<?php 
$adminData = $admin->superAdminDataGet();
  if(!empty($adminData)){
    while ($showData = $adminData->fetch_assoc()) {

?>
  <!-- Modal -->
<div id="editadminModal_<?php echo $showData['id']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Update Admin </strong></h4>
      </div>
     <?php 
            $adminId = $showData['id'];
            $adminUp = $admin->adminDataShowById($adminId);
            if($adminUp){
              $resultEdit = $adminUp->fetch_assoc();
      ?>
      <div class="modal-body">
         <form class="form-horizontal" method="post" action="">
          <input type="hidden" name="admin_Id" value="<?php echo $resultEdit['id']; ?>">
        <div class="form-group">
          <label class="control-label col-sm-2" for="name">Name:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="admin_name" id="name" value="<?php echo $resultEdit['name']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email:</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="admin_email" value="<?php echo $resultEdit['email']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="admin_new_password">New Password:</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="admin_new_password" id="admin_password" placeholder="Enter New password">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="admin_confirm_password">Confirm Password:</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="admin_confirm_password" id="admin_confirm_password" placeholder="Enter Confirm password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="admin_data_update" class="btn btn-danger btn-lg">Update</button>
          </div>
        </div>
      </form> 
      </div>
       <?php  } ?>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php }} ?>