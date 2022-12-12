<?php

namespace App\Services\Email;

use App\Mail\TicketInfoMail;

class TicketMailService {

    public function sendMail($email,$data)
    {
        \Mail::to($email)->send(new TicketInfoMail($data));

        \Log::info('TicketMailService(sendMail) | email has been sent to '.$email);
    }

    public function ticketResponseMail($data)
    {
        $data['title']= 'Inquiry Informations';
        $data['body']= $data->reference_no . ' - is your reference for the inquiry you requested.
         You can use this reference number to check the updates.
         Thank you for getting in touch with us.';

        $this->sendMail($data->email,$data);

        return true;
    }

    public function ticketReplyMail($reply)
    {
        $data['title']= $reply->ticket->reference_no.' - Inquiry Informations';
        $data['body']= 'Reply: '. $reply->reply .'.Thank you for getting in touch with us.';

        $this->sendMail($reply->ticket->email,$data);

        return true;
    }
}
