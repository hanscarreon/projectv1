<?php

 function load_chat_data()
 {
  if($this->input->post('receiver_id'))
  {
   $receiver_id = $this->input->post('receiver_id');
   $sender_id = $this->session->userdata('user_id');
   if($this->input->post('update_data') == 'yes')
   {
    $this->chat_model->Update_chat_message_status($sender_id);
   }
   $chat_data = $this->chat_model->Fetch_chat_data($sender_id, $receiver_id);
   if($chat_data->num_rows() > 0)
   {
    foreach($chat_data->result() as $row)
    {
     $message_direction = '';
     if($row->sender_id == $sender_id)
     {
      $message_direction = 'right';
     }
     else
     {
      $message_direction = 'left';
     }
     $date = date('D M Y H:i', strtotime($row->chat_messages_datetime));
     $output[] = array(
      'chat_messages_text' => $row->chat_messages_text,
      'chat_messages_datetime'=> $date,
      'message_direction'  => $message_direction
     );
    }
   }
   echo json_encode($output);
  }
 }


 function Fetch_chat_data($sender_id, $receiver_id)
 {
  $this->db->where('(sender_id = "'.$sender_id.'" OR sender_id = "'.$receiver_id.'")');
  $this->db->where('(receiver_id = "'.$receiver_id.'" OR receiver_id = "'.$sender_id.'")');
  $this->db->order_by('chat_messages_id', 'ASC');
  return $this->db->get('chat_messages');
 }


 function send_chat()
 {
  if($this->input->post('receiver_id'))
  {
   $data = array(
    'sender_id'  => $this->session->userdata('user_id'),
    'receiver_id' => $this->input->post('receiver_id'),
    'chat_messages_text' => $this->input->post('chat_message'),
    'chat_messages_status' => 'no',
    'chat_messages_datetime'=> date('Y-m-d H:i:s')
   );

   $this->chat_model->Insert_chat_message($data);
  }
 }

 function Insert_chat_message($data)
 {
  $this->db->insert('chat_messages', $data);
 }





?>

<script type="text/javascript">

  var receiver_id;

 $(document).on('click', '.user_chat_list', function(){
  $('#send_chat').attr('disabled', false);
  receiver_id = $(this).data('receiver_id');
  var receiver_name = $(this).text();
  $('#dynamic_title').text('You Chat with ' + receiver_name);
  load_chat_data(receiver_id, 'yes');
 });

 $(document).on('click', '#send_chat', function(){
  var chat_message = $.trim($('#chat_message_area').html());
  if(chat_message != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>chat/send_chat",
    method:"POST",
    data:{receiver_id:receiver_id, chat_message:chat_message},
    beforeSend:function()
    {
     $('#send_chat').attr('disabled','disabled');
    },
    success:function(data)
    {
     $('#send_chat').attr('disabled', false);
     $('#chat_message_area').html('');
     var html = '<div class="col-md-10 alert alert-warning">';
     html += chat_message;
     html += '</div>';
     $('#chat_body').append(html);
     $('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
    }
   });
  }
  else
  {
   alert('Type Something in chat box');
  }
 });

 function load_chat_data(receiver_id, update_data)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>chat/load_chat_data",
   method:"POST",
   data:{receiver_id:receiver_id, update_data:update_data},
   dataType:"array",
   success:function(data)
   {
    var html = '';
    for(var count = 0; count < data.length; count++)
    {
     html += '<div class="row" style="margin-left:0; margin-right:0">';
     if(data[count].message_direction == 'right')
     {
      html += '<div align="left"><span class="text-muted"><small><b>'+data[count].chat_messages_datetime+'</b></small></span></div>';

      html += '<div class="col-md-10 alert alert-warning">';
     }
     else
     {
      html += '<div align="right"><span class="text-muted"><small><b>'+data[count].chat_messages_datetime+'</b></small></span></div>';
      html += '<div class="col-md-2">&nbsp;</div>';
      html += '<div class="col-md-10 alert alert-info">';
     }
     html += data[count].chat_messages_text + '</div></div>';
    }
    $('#chat_body').html(html);
    $('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
   }
  })
 }

 setInterval(function(){
  if(receiver_id > 0)
  {
   load_chat_data(receiver_id, 'yes');
  }
 }, 5000);
});
</script>





