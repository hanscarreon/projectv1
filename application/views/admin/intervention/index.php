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
                  <a href="<?php echo base_url() ?>admin/intervention/index/all/close/status" class="product-title text-success"> Close Case
                    <!-- <span class="badge badge-success float-right"><?php echo number_format($positive); ?></span></a> -->
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-info">
                  <i class="far fa-meh text-warning"></i>
                  <a href="<?php echo base_url() ?>admin/intervention/index/all/recommend/status" class="product-title text-warning"> Recommended to SDO or Pyschologist
                    <!-- <span class="badge badge-warning float-right"><?php echo number_format($neutral); ?></span></a> -->
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-info">
                  <i class="far fa-angry text-danger"></i>
                  <a href="<?php echo base_url() ?>admin/intervention/index/all/plan/status" class="product-title text-danger"> Intervention planning
                    <!-- <span class="badge badge-danger float-right"><?php echo number_format($negative); ?></span> -->
                  </a>
                </div>
              </li>
              <li class="item">
                <div class="product-info">
                  <i class="far fa-angry text-info"></i>
                  <a href="<?php echo base_url() ?>admin/intervention/index/all/all/status" class="product-title text-info"> Total Analysis
                    <!-- <span class="badge badge-danger float-right"><?php echo number_format($total); ?></span> -->
                  </a>
                </div>
              </li>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a href="<?php echo base_url() ?>admin/intervention/index/all/all/all" class="uppercase">View All</a>
          </div>
          <!-- /.card-footer -->
        </div>
    
  </div>

<!-- <?php echo print_r($plans); ?> -->
       <div class="col-md-8 col-sm-12 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sentiment case</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Meeting note</th>
                        <th>Plan Module</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php  if ( isset( $plans ) && count($plans) >= 1 ):?>
                      <?php foreach($plans as $plan): ?>
                      <tr>
                        <td><?php echo $plan['plan_id']; ?></td>
                        <td><?php echo ucfirst($plan['user_fname']); ?> <?php echo ucfirst($plan['user_mname']); ?> <?php echo ucfirst($plan['user_lname']); ?></td>
                        <td><?php echo date("F j, Y, g:i a",strtotime($plan['plan_created'])) ?></td>
                        <td>
                          <?php echo $plan['meet_note'] ?>
                        </td>
                        <td>
                          <form method="post" enctype="multipart/form-data">
                            <div class="form-group" style="width:300px">
                              <label for="exampleInputFile">File input</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="plan_file" name="plan_file">
                                  <input type="number" class="custom-file-input" id="plan_id" name="plan_id" value="<?php echo $plan['plan_id'] ?>">
                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                  <button type="submit" name="upload_file" value="upload_file" class="input-group-text" id="">Upload</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </td>
                        <td></td>
                      <!--   <td><a  href="<?php echo base_url()?>admin/schedule/set/<?php echo $plan['user_id'].'/'.$plan['senti_id'] ?>" class="btn btn-block btn-outline-info">Set Schedule</a></td> -->
                        <!-- <td><a  class="btn btn-block btn-outline-danger">Delete</a></td> -->
                      </tr>
                      <?php endforeach; ?>
                    
                   <?php else: ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>no data</td>
                      <td></td>
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

