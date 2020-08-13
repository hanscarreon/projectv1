<div class="row ">
  

<div class="col-md-4 col-sm-4 col-4">
  <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Stunde info</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-user mr-1"></i> Name</strong>

                <p class="text-muted">
                 <?php echo ucfirst($user[0]['user_fname']) .' '.ucfirst($user[0]['user_mname']).'. '.ucfirst($user[0]['user_lname']); ?>
                </p>

                <hr>

                <strong><i class="fas fa-comments mr-1"></i> Analysis Text</strong>

                <p class="text-muted"><?php echo $senti[0]['senti_text']; ?></p>

                <hr>

                <strong><i class="fas fa-info-circle mr-1"></i> Sentiment State</strong>

                <p class="text-muted"><?php echo $senti[0]['senti_mood']; ?></p>

                <!-- <hr> -->

               <!--  <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
              </div>
              <!-- /.card-body -->
            </div>
  
</div>
<!-- end of profile -->
<div class="col-md-8 col-sm-12 col-12">
    
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Date Schedule</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" >
      <div class="card-body">
        <div class="form-group row">
          <label for="user_name" class="col-sm-2 col-form-label">Calendar</label>
          <div class="col-sm-10">
            <input type="datetime-local" class="form-control" id="sched_date" name="sched_date" placeholder="" value="">
          </div>
        </div>
        <div class="form-group row">
	        <label class="col-sm-2 col-form-label" for="exampleInputFile">File input</label>
	        <div class="input-group col-sm-10">
	          <div class="custom-file ">
	            <input type="file" class="custom-file-input" id="exampleInputFile">
	            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
	          </div>
	          <div class="input-group-append">
	            <span class="input-group-text" id="">Upload</span>
	          </div>
	        </div>
	      </div>
        <div class="form-group row">
          <label for="user_name" class="col-sm-2 col-form-label">Calendar</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="sched_date" name="sched_date" placeholder="" value="">
          </div>
        </div>
        <!-- hidden fields -->
        <input type="hidden" class="form-control" value="<?php echo $this->uri->segment("4") ?>" id="user_id" name="user_id" placeholder="user id" >
        <input type="hidden" class="form-control" id="senti_id" value="<?php echo $this->uri->segment("5") ?>" name="senti_id" placeholder="senti id" >
        <input type="hidden" class="form-control" id="inter_id" value="<?php echo $this->uri->segment("6") ?>" name="inter_id" placeholder="inter id" >
        <!-- ./ hidden fields ./ -->

     
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" value="set_date" name="set_date" class="btn btn-info">Save</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div>

</div>