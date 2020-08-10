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
            <textarea class="form-control" id="inter_note" name="inter_note" rows="5" placeholder="Counseling note"></textarea>
          </div>
         
        </div>
         <div class="form-group row">
            <label for="user_role" class="col-sm-2 col-form-label">Case</label>
            <div class="col-sm-10">
              <select class="form-control select2 select2-hidden-accessible" name="inter_case" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option selected="selected" >Select Case</option>
                <option value="close">Close case</option>
                <option value="recommend">Recommend to SDO or Pyschologist</option>
                <option value="plan">Intervention plan</option>

              </select>
            </div>
          </div>
          <!-- select ./. -->
           <input type="hidden" class="form-control" value="<?php echo $this->uri->segment("4") ?>" id="user_id" name="user_id" placeholder="Username" value="">
            <input type="hidden" class="form-control" id="senti_id" value="<?php echo $this->uri->segment("5") ?>" name="senti_id" placeholder="Username" value="">
            <input type="hidden" class="form-control" id="sched_id" value="<?php echo $this->uri->segment("7") ?>" name="sched_id" placeholder="Username" value="">
      </div>
     
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" value="set_date" name="set_date" class="btn btn-info">Save</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div>

</div>