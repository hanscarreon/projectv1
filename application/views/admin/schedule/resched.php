<div class="row ">
  
<div class="col-md-4 col-sm-4 col-4">
  <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Stunde info</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-user mr-1"></i> Name</strong>

                <p class="text-muted">
                 <?php echo ucfirst($data[0]['user_fname']) .' '.ucfirst($data[0]['user_mname']).'. '.ucfirst($data[0]['user_lname']); ?>
                </p>

                <hr>

                <strong><i class="fas fa-comments mr-1"></i> Analysis Text</strong>

                <p class="text-muted"><?php echo $data[0]['case_text']; ?></p>

                <hr>

                <strong><i class="fas fa-info-circle mr-1"></i> Sentiment State</strong>

                <p class="text-muted"><?php echo $data[0]['case_study']; ?></p>

                <!-- <hr> -->

               <!--  <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
              </div>
              <!-- /.card-body -->
            </div>
  
</div>
<!-- end of profile -->
<div class="col-md-8 col-sm-12 col-12">
    
  <div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Reschedule Meeting</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" >
      <div class="card-body">
        <div class="form-group row">
          <label for="user_name" class="col-sm-2 col-form-label">Calendar</label>
          <div class="col-sm-10">
            <input type="datetime-local" class="form-control" id="meet_date" value="" name="meet_date" placeholder="" >
          </div>
        </div>
     
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" value="resched_date" name="resched_date" class="btn btn-warning">Save</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div>

</div>