<div class="row">
    <div class="col-md-4 ">
      <!-- DIRECT CHAT PRIMARY -->
      <div class="card card-prirary cardutline direct-chat direct-chat-primary">
        <div class="card-header">
          <h3 class="card-title">name</h3>

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
      <h3 class="card-title">Meeting Note</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" >
      <div class="card-body">
        <div class="form-group row">
          <label for="user_name" class="col-sm-2 col-form-label">Note</label>
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
                <option value="recommend">Recommended to SDO or Pyschologist</option>
                <option value="plan">Intervention plan</option>
              </select>
            </div>
          </div>
          <!-- select ./. -->
           <input type="hidden" class="form-control"  id="user_id" name="user_id"  value="">
           <input type="hidden" class="form-control" id="case_id" name="senti_id" value="">
           <input type="hidden" class="form-control" id="meet_id" name="meet_id"  value="">
      </div>
     
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" value="create_case" name="create_case" class="btn btn-info">Submit</button>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>

</div>
<!-- /. col note -->

</div>