<div class="row">
    <div class="col-md-4 ">
      <!-- DIRECT CHAT PRIMARY -->
      <div class="card card-prirary cardutline direct-chat direct-chat-primary">
        <div class="card-header">
          <h3 class="card-title"><?php echo ucfirst($student[0]['user_fname']).' '.ucfirst($student[0]['user_mname']).'. '.ucfirst($student[0]['user_lname']); ?> </h3>

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

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <form action="#" method="post">
            <div class="input-group">
              <input type="text" autocomplete="off"  name="chat_text" id="chat_text" placeholder="Type Message ..." class="form-control">
              <span class="input-group-append">
                <button  id="send_chat" type="submit" class="btn btn-primary">Send</button>
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

<!-- chat ajax code -->
<script>
var sender_id =  <?php echo $this->session->userdata('user_id'); ?>;
var reciever_id =  <?php echo $student[0]['user_id'] ?>;
$("#send_chat").click(function(event){
  event.preventDefault();
  var msg = $("#chat_text").val()
  if(isBlank(msg) == true){
    return;
  }
  $.ajax({
    type: "POST",
    url: '<?php echo base_url() ?>api/chat/send',
   
    // data: JSON.stringify(data_arr),
    data: JSON.stringify({
      sender_id: sender_id,
    reciever_id: reciever_id,
    chat_text: msg
    }),
    success:function(res)
        {
          console.log(res);
        },
    fail:function(err){
      console.log(err);
      console.log("wew");
    }
  });

});

function isBlank(str) {
    return (!str || /^\s*$/.test(str));
}

$(document).ready(function(){
  
});
</script>