<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class ContactMessage extends Mailable
{
use Queueable, SerializesModels;
/**
* Create a new message instance.
*
* @return void
*/
public $first_name_to_send = "";
public $message_to_send = "";
public function __construct($message,$first_name)
{

$this->first_name_to_send = $first_name;
$this->message_to_send = $message;
}
/**
* Build the message.
*
* @return $this
*/
public function build()

{
    $first_name_to_send = $this->first_name_to_send;
    $message_to_send = $this->message_to_send;
return $this->view('email.contactmessageemail',compact('message_to_send','first_name_to_send'));
}
}