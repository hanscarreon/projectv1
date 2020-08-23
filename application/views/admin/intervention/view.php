<div class="row ">
<div class="col-md-12">
  <!-- Widget: user widget style 1 -->
  <div class="card card-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-info">
      <h3 class="widget-user-username"><?php echo ucwords($plan[0]['user_fname']).' '.ucwords($plan[0]['user_mname']).'. '. ucwords($plan[0]['user_lname']) ?></h3>
      <h5 class="widget-user-desc">
      <?php if($plan[0]['user_pos'] == 'col'): ?>
      <span> College Student </span>
      <?php elseif($plan[0]['user_pos'] == 'elem'): ?>
        <span> Elementary Student </span>
      <?php elseif($plan[0]['user_pos'] == 'hs'): ?>
        <span> High School Student </span>
      <?php endif; ?>
      </h5>
    </div>
   
  </div>
  <!-- /.widget-user -->
</div>
  <!-- /.col -->

<!-- end of profile -->
  


</div>

<div class="row">
          <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                
                  <h3 class="card-title"><i class="fas fa-info"></i> Intervention Info</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Note</label>
                      <div class="col-sm-9">
                        <div class="text-left col-form-label"> <?php echo ucwords($plan[0]['meet_note']) ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Last updated</label>
                      <div class="col-sm-9">
                        <div class="text-left col-form-label"> 
                          <?php if(empty($plan[0]['plan_update'])):?>
                            <?php echo date("F j, Y, g:i a",strtotime($plan[0]['plan_update'])) ?>
                          <?php else: ?>
                            <?php echo date("F j, Y, g:i a",strtotime($plan[0]['plan_created'])) ?>

                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <form  method="post" enctype="multipart/form-data" >
                      <div class="form-group row">
                      <label for="plan_file" class="col-sm-3 col-form-label">Module</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                            <div class="custom-file">
                              <input type="hidden" class="custom-file-input" id="plan_id" name="plan_id" value="<?php echo $this->uri->segment("4") ?>">
                              <input type="file" class="custom-file-input" id="plan_file" name="plan_file">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <button class="input-group-text" name="upload_file" value="upload_file" id="upload_file">Upload</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">File</label>
                      <div class="col-sm-9">
                        <div class="text-left col-form-label">
                          <?php if(empty($plan[0]['plan_file']) || $plan[0]['plan_file']== null): ?>
                            No file available
                            <?php else: ?>
                            <a href="<?php echo base_url().$plan[0]['plan_file'] ?>" download="" > Download Module </a>
                            <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                  </div>
                  <!-- /.card-footer -->
              </div>
          </div>
          <!-- /.col -->

          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-info"></i>
                   Meeting / Case Info
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
                   <?php if($plan[0]['case_study'] == 'negative'): ?>
                  <div class="callout callout-danger">
                    <h5>
                     <span class="text-danger"> <?php echo $plan[0]['case_study'] ?></span>
                     <?php elseif($plan[0]['case_study'] == 'positive'): ?>
                  <div class="callout callout-success">
                    <h5>
                      <span class="text-success"> <?php echo $plan[0]['case_study'] ?></span>
                     <?php elseif($plan[0]['case_study'] == 'neutral'): ?>
                  <div class="callout callout-info">
                    <h5>
                      <span class="text-info"> <?php echo $plan[0]['case_study'] ?></span>
                   <?php else: ?>
                      <span class="text-primary">study not found</span>
                   <?php endif; ?>
                  </h5>

                  <p><?php echo $plan[0]['case_text'] ?></p>
                </div>
                <div class="callout callout-warning">
                  <h5>Meeting Date</h5>

                  <p> <?php echo date("F j, Y, g:i a",strtotime($plan[0]['meet_date'])) ?></p>
                </div>
                <div class="callout callout-primary">
                  <h5>Note</h5>

                  <p> <?php echo $plan[0]['meet_note'] ?></p>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

