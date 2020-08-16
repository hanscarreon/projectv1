<div class="row">
    <div class="col-md-4 ">
      <!-- DIRECT CHAT PRIMARY -->
      <div class="card card-prirary cardutline direct-chat direct-chat-primary">
        <div class="card-header">
          <h3 class="card-title"><?php echo ucfirst($student[0]['user_fname']).' '.ucfirst($student[0]['user_mname']).'. '.ucfirst($student[0]['user_lname']); ?> </h3>

          <div class="card-tools">
            <span data-toggle="tooltip" title="3 New Messages" class="badge bg-primary">3</span>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
              <i class="fas fa-comments"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages">
            <!-- Message. Default to the left -->
            <div class="direct-chat-msg">
              <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">Alexander Pierce</span>
                <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
              </div>
              <!-- /.direct-chat-infos -->
              <img class="direct-chat-img" src="<?php echo base_url() ?>/dist/img/user1-128x128.jpg" alt="Message User Image">
              <!-- /.direct-chat-img -->
              <div class="direct-chat-text">
                Is this template really for free? That's unbelievable!
              </div>
              <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->

            <!-- Message to the right -->
            <div class="direct-chat-msg right">
              <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-right">Sarah Bullock</span>
                <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
              </div>
              <!-- /.direct-chat-infos -->
              <img class="direct-chat-img" src="<?php echo base_url() ?>/dist/img/user3-128x128.jpg" alt="Message User Image">
              <!-- /.direct-chat-img -->
              <div class="direct-chat-text">
                You better believe it!
              </div>
              <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
          </div>
          <!--/.direct-chat-messages-->

          <!-- Contacts are loaded here -->
          <div class="direct-chat-contacts">
            <ul class="contacts-list">
              <li>
                <a href="#">
                  <img class="contacts-list-img" src="<?php echo base_url() ?>/dist/img/user1-128x128.jpg">

                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                      Count pepe
                      <small class="contacts-list-date float-right">2/28/2015</small>
                    </span>
                    <span class="contacts-list-msg">maypepe kaba?...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
            </ul>
            <!-- /.contatcts-list -->
          </div>
          <!-- /.direct-chat-pane -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <form action="#" method="post">
            <div class="input-group">
              <input type="text" name="message" placeholder="Type Message ..." class="form-control">
              <span class="input-group-append">
                <button type="submit" class="btn btn-primary">Send</button>
              </span>
            </div>
          </form>
        </div>
        <!-- /.card-footer-->
      </div>
      <!--/.direct-chat -->
    </div>
      <!--/.col-chat -->
<div class="col-md-8 col-sm-12 col-12">
    
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Meeting Note </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

          <div class="card-footer card-comments">
            <div class="card-comment">
              <!-- User image -->
              <div class="comment-text" style="margin-left: 0">
                <span class="username">
                  <?php echo ucfirst($student[0]['user_fname']).' '.ucfirst($student[0]['user_mname']).'. '.ucfirst($student[0]['user_lname']); ?>
                  <span class="text-muted float-right"><?php echo date("F j, Y, g:i a",strtotime($case[0]['case_created'])) ?></span>
                </span><!-- /.username -->
                  <span class="text-muted float-right">case created</span>

                  <?php  echo $case[0]['case_text']; ?>
              </div>
              <!-- /.comment-text -->
            </div>
          </div>
     <!-- /.card-sentiment -->

    <form class="form-horizontal" method="post" >
      <div class="card-body">
        <div class="form-group row">
          <label for="user_name" class="col-sm-2 col-form-label">Note</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="inter_note" name="meet_note" rows="5" placeholder="Counseling note"></textarea>
          </div>
         
        </div>
         <div class="form-group row">
            <label for="user_role" class="col-sm-2 col-form-label">Case</label>
            <div class="col-sm-10">
              <select class="form-control select2 select2-hidden-accessible" name="case_con" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option selected="selected" value="">Select Case</option>
                <option value="closed">Close case</option>
                <option value="recommended">Recommended to SDO or Pyschologist</option>
                <option value="plan">Intervention plan</option>
              </select>
            </div>
          </div>
          <!-- /. select  -->
          <div class="hidden-inputs">
           <input type="hidden" class="form-control"  id="stud_id" name="stud_id"  value="<?php echo $meeting[0]['stud_id'] ?>">
           <input type="hidden" class="form-control" id="case_id" name="case_id" value="<?php echo $meeting[0]['case_id'] ?>">
           <input type="hidden" class="form-control" id="meet_id" name="meet_id"  value="<?php echo $meeting[0]['meet_id'] ?>">
           </div>
      </div>
     
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" value="case_review" name="case_review" class="btn btn-info">Submit</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div>
<!-- /. col note -->

</div>