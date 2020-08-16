 <!-- <?php echo print_r($schedules); ?>  -->
<!-- <?php echo ($schedules); ?> -->
<div class="row">
          <div class="col-12 col-md-4 col-sm-12">
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
                      <i class="far fa-clock text-info"></i>
                      <a href="<?php echo base_url() ?>admin/schedule/index/name/waiting/status" class="product-title text-info">Meeting
                        <!-- <span class="badge badge-success float-right"><?php echo number_format($positive); ?></span></a> -->
                    </div>
                  </li>
                  <!-- <li class="item">
                    <div class="product-info">
                      <i class="fas fa-user-clock text-warning"></i>
                      <a href="<?php echo base_url() ?>admin/schedule/index/name/online/status" class="product-title text-warning">Ongoing
                    </div>
                  </li> -->
                  <!-- /.item -->
                  <li class="item">
                    <div class="product-info">
                      <i class="far fa-check-circle text-success"></i>
                      <a href="<?php echo base_url() ?>admin/schedule/index/name/done/status" class="product-title text-success"> Done
                        <!-- <span class="badge badge-danger float-right"><?php echo number_format($negative); ?></span> -->
                      </a>
                    </div>
                  </li>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="<?php echo base_url() ?>admin/schedule/index/name/case/status" class="uppercase">View All</a>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
          <div class="col-12 col-md-8 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Meeting Schedule </h3>

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
                      <th>Meeting date</th>
                      <th>Sentiment text</th>
                      <th>Mark</th>
                      <th>Action</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php  if ( isset( $schedules ) && count($schedules) >= 1 ):?> 
                      <?php foreach($schedules as $schedule): ?>
                       <tr>
                        <td><?php echo $schedule['meet_id']; ?></td>
                        <td><?php echo ucfirst($schedule['user_fname']) .' '.ucfirst($schedule['user_mname']).'. '. ucfirst($schedule['user_lname']); ?></td>
                          <?php if( date("Y-m-d") > date("Y-m-d",strtotime($schedule['meet_date'])) && $schedule['meet_case'] == 'waiting' ): ?>
                            <td><span class="text-danger"><?php echo date("F j, Y, g:i a",strtotime($schedule['meet_date'])) ?> </span></td>
                             <?php elseif(date("Y-m-d") == date("Y-m-d",strtotime($schedule['meet_date'])) && $schedule['meet_case'] == 'waiting' ): ?>
                            <td><span class="text-warning"><?php echo date("F j, Y, g:i a",strtotime($schedule['meet_date'])) ?> </span></td>
                            <?php elseif($schedule['meet_case'] == 'done'): ?>
                            <td><span class="text-success"><?php echo date("F j, Y, g:i a",strtotime($schedule['meet_date'])) ?> </span></td>
                          <?php else: ?>
                            <td><span class="text-info"><?php echo date("F j, Y, g:i a",strtotime($schedule['meet_date'])) ?> </span></td>

                          <?php endif; ?>

                         <!-- <td><?php echo date("F j, Y, g:i a",strtotime($schedule['meet_date'])) ?></td>  -->


                        <td><p><?php echo $schedule['case_text']; ?></p></td>
                        <td>
                          <?php  if($schedule['meet_mark'] == 'plan'): ?>
                            <span class="text-warning">Under Intervention Plan</span>
                             <?php elseif($schedule['meet_mark'] == 'follow'): ?>
                            <span class="text-success">Follow up check-up</span>
                             <?php else: ?>
                          <?php endif; ?>
                          

                        </td>

                          <?php if( $schedule['meet_case'] == 'waiting'): ?>
                          <td><a  href="<?php echo base_url() ?>admin/schedule/ongoing/<?php echo $schedule['meet_id']  ?>" class="btn btn-block btn-outline-info">Proceed to meeting</a></td>
                          <td><a  href="" class="btn btn-block btn-outline-warning">Reschedule</a></td>
                          <td><a  href="" class="btn btn-block btn-outline-danger">Delete</a></td>
                          <?php endif; ?>
                          <!-- /. waiting -->
                          <?php if( $schedule['meet_case'] == 'done'): ?>
                         <!--  <td><a  href="<?php echo base_url() ?>admin/schedule/ongoing/<?php echo $schedule['meet_id']  ?>" class="btn btn-block btn-outline-info">Proceed to meeting</a></td>
                          <td><a  href="" class="btn btn-block btn-outline-warning">Reschedule</a></td>
                          <td><a  href="" class="btn btn-block btn-outline-danger">Delete</a></td> -->
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          <?php endif; ?>
                          <!-- /. done -->

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
                      <td></td>

                    </tr>

                   <?php endif; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php echo $this->pagination->create_links(); ?>

          </div>
        </div>