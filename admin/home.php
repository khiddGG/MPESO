    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $sql = "SELECT COUNT(*) as total FROM tblcompany";
                $mydb->setQuery($sql);
                $result = $mydb->loadSingleResult();
                echo '<h3>'.$result->total.'</h3>';
              ?>
              <p>Companies</p>
            </div>
            <div class="icon">
              <i class="fa fa-building"></i>
            </div>
            <a href="index.php?view=company" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT COUNT(*) as total FROM tbljob WHERE JOBSTATUS='Active'";
                $mydb->setQuery($sql);
                $result = $mydb->loadSingleResult();
                echo '<h3>'.$result->total.'</h3>';
              ?>
              <p>Active Vacancies</p>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="index.php?view=vacancy" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                $sql = "SELECT COUNT(*) as total FROM tblusers";
                $mydb->setQuery($sql);
                $result = $mydb->loadSingleResult();
                echo '<h3>'.$result->total.'</h3>';
              ?>
              <p>Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="index.php?view=users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT COUNT(*) as total FROM tblapplicants";
                $mydb->setQuery($sql);
                $result = $mydb->loadSingleResult();
                echo '<h3>'.$result->total.'</h3>';
              ?>
              <p>Applicants</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <a href="<?php echo web_root; ?>admin/applicants/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  