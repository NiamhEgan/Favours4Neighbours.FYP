<?php

namespace App\Controllers;

class Chat extends BaseController {

 public function __construct()
 {
	$this->ChatRepository = new ChatRepository();
 
  
  if(!$this->session->user('id'))
  {
	return redirect()->to("/login");
  }
 

 function index()
 {
  $this->load->view('ChatView');
 }

 function search_user()
 {
  sleep(2);
  if($this->input->post('search_query'))
  {
   $data = $this->ChatRepository->search_user_data($this->session->user('id'), $this->input->post('search_query'));
   $output = array();
   if($data->num_rows() > 0)
   {
    foreach($data->result() as $row)
    {
     $request_status = $this->ChatRepository->Check_request_status($this->session->user('id'), $row->id);
     $is_request_sent = 'yes';
     if($request_status == '')
     {
      $is_request_sent = 'no';
     } 
     else
     {
      if($request_status == 'pending')
      {
       $is_request_sent = 'yes';
      }
     }
     if($request_status != 'Accept')
     {
      $output[] = array(
       'id'  => $row->id,
       'FirstName' => $row->FirstName,
       'Surname'  => $row->Surname,
       'is_request_sent'=> $is_request_sent
      );
     } 
    }
   }
   echo json_encode($output);
  }
 }

 function send_request()
 {
  sleep(2);
  if($this->input->post('send_userid'))
  {
   $data = array(
    'sender_id'  => $this->input->post('send_userid'),
    'receiver_id' => $this->input->post('receiver_userid')
   );
   $this->ChatRepository->Insert_chat_request($data);
  }
 }

 function load_notification()
 {
  sleep(2);
  if($this->input->post('action'))
  {
   $data = $this->ChatRepository->Fetch_notification_data($this->session->user('id'));
   $output = array();
   if($data->num_rows() > 0)
   {
    foreach($data->result() as $row)
    {
     $user = $this->ChatRepository->Get_user($row->sender_id);

     $output[] = array(
      'user_id'  => $row->sender_id,
      'FirstName' => $row->FirstName,
       'Surname'  => $row->Surname,
      'chat_request_id' => $row->chat_request_id
     );
    }
   }
   echo json_encode($output);
  }
 }

 function accept_request()
 {
  if($this->input->post('chat_request_id'))
  {
   $update_data = array(
    'chat_request_status' => 'Accept'
   );
   $this->ChatRepository->Update_chat_request($this->input->post('chat_request_id'), $update_data);
  }
 }

 function load_chat_user()
 {
  sleep(2);
  if($this->input->post('action'))
  {
   $sender_id = $this->session->user('user_id');
   $receiver_id = '';
   $data = $this->chat_model->Fetch_chat_user($sender_id);
   if($data->num_rows() > 0)
   {
    foreach($data->result() as $row)
    {
     if($row->sender_id == $sender_id)
     {
      $receiver_id = $row->receiver_id;
     }
     else
     {
      $receiver_id = $row->sender_id;
     }
     $userdata = $this->ChatRepository->Get_user($receiver_id);
     $output[] = array(
      'receiver_id'  => $receiver_id,
      'first_name'  => $user['first_name'],
      'last_name'   => $user['last_name'],
      'profile_picture' => $user['profile_picture']
     );
    }
   }
   echo json_encode($output);
  }
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

   $this->ChatRepository->Insert_chat_message($data);
  }
 }

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

 function check_chat_notification()
 {
  if($this->input->post('Idarray'))
  {
   $receiver_id = $this->session->user('Id');

   $this->chat_model->Update_login_data();

   $Idarray = explode(",", $this->input->post('Idarray'));

   $output = array();

   foreach($Idarray as $sender_id)
   {
    if($sender_id != '')
    {
     $status = "offline";
     $last_activity = $this->chat_model->User_last_activity($sender_id);

     $is_type = '';

     if($last_activity != '')
     {
      $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');

      $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);

      if($last_activity > $current_timestamp)
      {
       $status = 'online';
       $is_type = $this->chat_model->Check_type_notification($sender_id, $receiver_id, $current_timestamp);
      }
     }

     $output[] = array(
      'Id'  => $sender_id,
      'total_notification' => $this->chat_model->Count_chat_notification($sender_id, $receiver_id),
      'status'  => $status,
      'is_type'  => $is_type
     );
    }
   }
   echo json_encode($output);
  }
 }
}
}




