<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatRepository extends Model
{
    protected $table      = 'chat_messages';
   
    protected $primaryKey = 'id';


    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = [
        "senderID",
        "recieverID",
        "chatMessages",
        "chatMessageStatus",
        "chatDateTime",
     
       
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];

    protected $skipValidation     = false;


    {
     function search_user($id, $query)
     {
      $where = "id != '".$id."' AND (FirstName LIKE '%".$query."%' OR Surname LIKE '%".$query."%')";
    
      $this->db->where($where);
    
      return $this->db->get('user');
     }
    
     function Check_request_status($senderID, $receiverID)
     {
      $this->db->where('(senderID = "'.$senderID.'" OR senderID = "'.$receiverID.'")');
      $this->db->where('(receiverID = "'.$receiverID.'" OR receiverID = "'.$senderID.'")');
      $this->db->order_by('chatRequestID', 'DESC');
      $this->db->limit(1);
      $query = $this->db->get('chatRequestID');
      if($query->num_rows() > 0)
      {
       foreach($query->result() as $row)
       {
        return $row->chatRequestStatus;
       }
      }
     }
    
     function Insert_chat_request($data)
     {
      $this->db->insert('chatRequestID', $data);
     }
    
     function Fetch_notification_data($receiverID)
     {
      $this->db->where('receiverID', $receiverID);
      $this->db->where('chatRequestStatus', 'Pending');
      return $this->db->get('chatRequestID');
     }
    
     function Get_user($Id)
     {
      $this->db->where('Id', $Id);
      $data = $this->db->get('user');
      $output = array();
      foreach($data->result() as $row)
      {
       $output['FirstName'] = $row->FirstName;
       $output['Surname'] = $row->Surname;
       $output['email'] = $row->email;
    
      }
      return $output;
     }
    
     function Update_chat_request($chatRequestID, $data)
     {
      $this->db->where('chatRequestID', $chatRequestID);
      $this->db->update('chat_request', $data);
     }
    
     function Fetch_chat_user($Id)
     {
      $this->db->where('chatRequestStatus', 'Accept');
      $this->db->where('(senderID = "'.$Id.'" OR recieverID = "'.$Id.'")');
      $this->db->order_by('chatRequestID', 'DESC');
      return $this->db->get('chat_request');
     }
    
     function Insert_chatMessages($data)
     {
      $this->db->insert('chatMessages', $data);
     }
    
     function Update_chatMessageStatus($Id)
     {
      $data = array(
       'chatMessageStatus'  => 'yes'
      );
      $this->db->where('recieverID', $Id);
      $this->db->where('chatMessageStatus', 'no');
      $this->db->update('chatMessages', $data);
     }
    
     function Fetch_chat_data($sender_id, $receiver_id)
     {
      $this->db->where('(senderID = "'.$senderID.'" OR senderID = "'.$recieverID.'")');
      $this->db->where('(recieverID = "'.$recieverID.'" OR recieverID = "'.$senderID.'")');
      $this->db->order_by('ID', 'ASC');
      return $this->db->get('chatMessages');
     }
    
     function Count_chat_notification($senderID, $recieverID)
     {
      $this->db->where('senderID', $senderID);
      $this->db->where('recieverID', $recieverID);
      $this->db->where('chatMessageStatus', 'no');
      $query = $this->db->get('chatMessages');
      return $query->num_rows();
     }
    
     
    
     function Check_type_notification($senderID, $recieverID, $current_timestamp)
     {
      $this->db->where('receiver_user_id', $recieverID);
      $this->db->where('user_id', $sender_id);
      $this->db->where('last_activity >', $current_timestamp);
      $this->db->limit(1);
      $query = $this->db->get('login_data');
      foreach($query->result() as $row)
      {
       return $row->is_type;
      }
     }
    }
   



?>