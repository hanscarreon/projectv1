
<div class="row">
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <?php if($this->uri->segment("5") == 'positive'): ?>
        <?php 
          $case_num = $positive; 
          $class_value = 'bg-success'; 
          $case_text = "Total Positve";
          $case_emoji = "far fa-laugh";
          $case_link = "admin/dashboard/index/name/positive/con";
        ?>
      <?php elseif($this->uri->segment("5") == 'neutral'): ?>
        <?php 
          $case_num = $neutral; 
          $class_value = 'bg-warning'; 
          $case_text = "Total Neutral";
          $case_emoji = "far fa-meh";
          $case_link = "admin/dashboard/index/name/neutral/con";
        ?>
      <?php elseif($this->uri->segment("5") == 'negative'): ?>
        <?php 
          $case_num = $negative; 
          $class_value = 'bg-danger'; 
          $case_text = "Total Negative";
          $case_emoji = "far fa-angry";
          $case_link = "admin/dashboard/index/name/negative/con";
        ?>
      <?php else: ?>
        <?php 
          $case_num = $total; 
          $class_value = 'bg-info'; 
          $case_text = "Total Analysis";
          $case_emoji = "ion ion-clipboard";
          $case_link = "admin/dashboard/index/name/study/con";
        ?>
      <?php endif;?>

      <div class="small-box <?php echo $class_value ?>">
        <div class="inner">
          <h3><?php echo number_format($case_num); ?></h3>

          <p><?php echo $case_text ?> 
            <button type="button" class="btn <?php echo $class_value ?> dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
            <!-- <span class="sr-only">Toggle Dropdown</span> -->
            <div class="dropdown-menu" role="menu" style="">
              <a class="dropdown-item anal-dd" href="<?php echo base_url() ?>admin/dashboard/index/name/positive/con">Positive</a>
              <a class="dropdown-item anal-dd" href="<?php echo base_url() ?>admin/dashboard/index/name/neutral/con">Neutral</a>
              <a class="dropdown-item anal-dd" href="<?php echo base_url() ?>admin/dashboard/index/name/negative/con">Negative</a>
              <a class="dropdown-item anal-dd" href="<?php echo base_url() ?>admin/dashboard/index/name/study/con">All</a>
            </div>
            </button>
          </p>
        </div>
        <div class="icon">
          <i class="<?php echo $case_emoji ?>"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-white">
        <div class="inner">
          <h3><?php echo number_format($total_user) ?></h3>

          <p>User
            <button type="button" class="btn bg-white dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
            <div class="dropdown-menu" role="menu" style="">
              <a class="dropdown-item anal-dd" href="#">Admin</a>
              <a class="dropdown-item anal-dd" href="#">Student</a>
              <a class="dropdown-item anal-dd" href="#">All</a>
            </div>
            </button>
          </p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <!-- <div class="col-lg-3 col-6">
      <div class="small-box bg-dark">
        <div class="inner">
          <h3><?php echo number_format($negative); ?></h3>

          <p>Admins / Teachers</p>
        </div>
        <div class="icon">
          <i class="fas fa-lock"></i>
        </div>
      </div>
    </div> -->
    <!-- ./col -->
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
        
          <h3><?php echo number_format($total_meetings); ?></h3>

          <p>Meetings
            <button type="button" class="btn bg-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
            <div class="dropdown-menu" role="menu" style="">
              <a class="dropdown-item anal-dd" href="#">Meeting</a>
              <a class="dropdown-item anal-dd" href="#">Intervention Plan</a>
            </div>
            </button>
          </p>
        </div>
        <div class="icon">
          <i class="fas fa-calendar-day"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <!-- <div class="col-lg-3 col-6">
      <div class="small-box bg-secondary">
        <div class="inner">
          <h3><?php echo number_format($negative); ?></h3>

          <p>Intervention Plan</p>
        </div>
        <div class="icon">
          <i class="fas fa-file-medical"></i>
        </div>
        <a href="<?php echo base_url() ?>admin/dashboard/index/name/negative/con" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div> -->
    <!-- ./col -->
    

    
  </div>
<div class="row">
 <div class="col-12 col-sm-12 col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Sort By:</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button> -->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
              <li class="item">
                <div class="product-info">
                  <i class="far fa-laugh text-success"></i>
                  <a href="<?php echo base_url() ?>admin/dashboard/index/name/positive/con" class="product-title text-success"> Positive
                    <!-- <span class="badge badge-success float-right"><?php echo number_format($positive); ?></span></a> -->
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-info">
                  <i class="far fa-meh text-warning"></i>
                  <a href="<?php echo base_url() ?>admin/dashboard/index/name/neutral/con" class="product-title text-warning"> Neutral
                    <!-- <span class="badge badge-warning float-right"><?php echo number_format($neutral); ?></span></a> -->
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-info">
                  <i class="far fa-angry text-danger"></i>
                  <a href="<?php echo base_url() ?>admin/dashboard/index/name/negative/con" class="product-title text-danger"> Negative
                    <!-- <span class="badge badge-danger float-right"><?php echo number_format($negative); ?></span> -->
                  </a>
                </div>
              </li>
              <li class="item">
                <div class="product-info">
                  <i class="far fa-angry text-info"></i>
                  <a href="<?php echo base_url() ?>admin/dashboard/index/name/study/con" class="product-title text-info"> Total Analysis
                    <!-- <span class="badge badge-info float-right"><?php echo number_format($total); ?></span> -->
                  </a>
                </div>
              </li>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a href="<?php echo base_url() ?>admin/dashboard/index/name/study/con" class="uppercase">View All</a>
          </div>
          <!-- /.card-footer -->
        </div>
    
  </div>

          <div class="col-md-8 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pending Analysis</h3>

                <div class="card-tools">
                  <form method="POST">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search_name" value="<?php echo $this->uri->segment("4") != 'name' ? $this->uri->segment("4"): '' ?>" class="form-control float-right" placeholder="Search Name">

                    <div class="input-group-append">
                      <button type="submit" name="search_mode" value="search_mode" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>Case-ID No.</th>
                        <th>Name</th>
                        <th>Date created</th>
                        <th>Result</th>
                        <th>Sentiment</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php  if ( isset( $sentiments ) && count($sentiments) >= 1 ):?>
                      <?php $x=1; foreach($sentiments as $sentiment): ?>
                      <tr>
                      <td><?php echo $sentiment['case_id'] ?></td>
                        <td><?php echo ucfirst($sentiment['user_fname']); ?> <?php echo ucfirst($sentiment['user_mname']); ?> <?php echo ucfirst($sentiment['user_lname']); ?></td>
                        <td><?php echo date("F j, Y, g:i a",strtotime($sentiment['case_created'])) ?></td>
                        <td>
                            <?php  
                            if ($sentiment["case_study"] == 'positive') 
                              { 
                                echo '<span class="tag text-success">'.$sentiment["case_study"].'</span>';
                             }
                              if ($sentiment["case_study"] == 'neutral') 
                              { 
                                echo '<span class="tag text-warning">'.$sentiment["case_study"].'</span>';
                             }
                              if ($sentiment["case_study"] == 'negative') 
                              { 
                                echo '<span class="tag text-danger">'.$sentiment["case_study"].'</span>';
                             }
                          ?>
                          </span>
                        </td>
                         <td>
                          <p style="overflow: hidden;text-overflow: ellipsis; white-space: nowrap; width:150px; "><?php echo $sentiment["case_text"]; ?></p>
                        </td>

                        <td><a  href="<?php echo base_url()?>admin/schedule/set/<?php echo $sentiment['user_id'].'/'.$sentiment['case_id'] ?>/normal" class="btn btn-block btn-outline-info">Set Schedule</a></td>
                        <td><a href="<?php echo base_url()?>admin/dashboard/delete_case/<?php echo $sentiment['case_id'] ?>"  class="btn btn-block btn-outline-danger">Delete</a></td>
                      </tr>
                      <?php endforeach; ?>
                    
                   <?php else: ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>no data</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>

                  <?php endif;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php echo $this->pagination->create_links(); ?>

          </div>
        </div>

<script>
$(".anal-dd").click(function(){
  var myHref = $(this).attr("href");
  window.location = myHref;
})
</script>