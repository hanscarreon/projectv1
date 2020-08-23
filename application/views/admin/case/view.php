<div class="container-fluid">
<div class="row ">
<div class="col-md-12">
  <!-- Widget: user widget style 1 -->
  <div class="card card-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-info">
      <h3 class="widget-user-username"><?php echo ucwords($meets[0]['user_fname']).' '.ucwords($meets[0]['user_mname']).'. '. ucwords($meets[0]['user_lname']) ?></h3>
      <h5 class="widget-user-desc">
      <?php if($meets[0]['user_pos'] == 'col'): ?>
      <span> College Student </span>
      <?php elseif($meets[0]['user_pos'] == 'elem'): ?>
        <span> Elementary Student </span>
      <?php elseif($meets[0]['user_pos'] == 'hs'): ?>
        <span> High School Student </span>
      <?php endif; ?>
      </h5>
    </div>
   
  </div>
  <!-- /.widget-user -->
</div>
  <!-- /.col -->
</div>
<!-- end of profile -->

        
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
            <?php if(count($meets) >= 1): ?>
              <?php foreach ($meets as $meet): ?>
              <!-- timeline-label -->
                <div class="time-label">
                    <span class="bg-green">
                    <?php echo date("F j, Y, g:i a",strtotime($meet['meet_date']))  ?>
                    </span>
                </div>
              <!-- /.timeline-label -->

               <!-- timeline item -->
               <div>
                <i class="fas fa-comments bg-yellow"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> <?php echo $this->time_elapsed_string(date("F j, Y, g:i a",strtotime($meet['meet_date']))); ?></span>
                  <h3 class="timeline-header">Meeting Info</h3>
                  <div class="timeline-body">
                   <?php echo $meet['meet_note'] ?>
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-sm">Read more</a>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <?php endforeach; ?>
              <?php else: ?>
                <div>
                    <i class="fas fa-comments bg-yellow"></i>
                    <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> </span>
                    <h3 class="timeline-header">Meeting Info</h3>

                    <div class="timeline-body">
                    No Data Found
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-primary btn-sm">Read more</a>
                    </div>
                    </div>
              </div>

              <?php endif; ?>
              <?php if(count($plans) >= 1): ?>
                <?php foreach ($plans as $plan): ?>
                 <!-- timeline-label -->
                    <div class="time-label">
                        <span class="bg-yellow">
                        <?php if(empty($plan['plan_created'])): ?>
                            <?php echo date("F j, Y, g:i a",strtotime($plan['plan_created']))  ?>
                        <?php else:?>
                            <?php echo date("F j, Y, g:i a",strtotime($plan['plan_update']))  ?>
                        <?php endif; ?>
                        </span>
                    </div>
                <!-- /.timeline-label -->

                <div>
                    <i class="fas fa-info bg-danger"></i>
                    <div class="timeline-item">
                    <span class="time">
                    <i class="fas fa-clock"></i>
                    <?php if(empty($plan['plan_created'])): ?>
                            <?php echo $this->time_elapsed_string(date("F j, Y, g:i a",strtotime($plan['plan_created']))); ?>
                    <?php else:?>
                        <?php echo $this->time_elapsed_string(date("F j, Y, g:i a",strtotime($plan['plan_update']))); ?>
                    <?php endif; ?>
                    </span>
                    
                    </span>
                    <h3 class="timeline-header">Intervention plan Info</h3>

                    <div class="timeline-body">
                         <?php if(empty($plan['plan_file']) || $plan['plan_file']== null): ?>
                           No file available
                          <?php else: ?>
                          <a href="<?php echo base_url().$plan['plan_file'] ?>" download="" > Download Module </a>
                          <?php endif; ?>
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-primary btn-sm">Read more</a>
                    </div>
                    </div>
                </div>
                
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="time-label">
                    <span class="bg-red">
                    No intervention plan
                    </span>
                </div>
                <div>
                <i class="fas fa-info bg-danger"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> </span>
                  <h3 class="timeline-header">Meeting Info</h3>

                  <div class="timeline-body">
                  No Data Found
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-sm">Read more</a>
                  </div>
                </div>
              </div>
              
              <?php endif; ?>
              
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>