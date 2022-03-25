<?php

namespace App\Repositories;

use App\Message;
use Auth;

class MessageRepository
{
    public function all()
    {
        $messages = Message::where('user_to_id', Auth::user()->id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return $messages;
    }

    public function StoreUpdate(array $data, $id=0)
    {
        if( $id==0 ) :
            $saveData['user_from_id'] = $data['user_from_id'];
            $saveData['user_to_id'] = $data['user_to_id'];
            $saveData['subject']  = $data['subject'];
            $saveData['message'] = $data['message'];

            $message = Message::create($saveData);
        else :
            $message = $this->getByID($id);

            Message::where('id', $message->id)
                ->update([
                    'user_from_id' =>$data['user_from_id'],
                    'user_to_id' => $data['user_to_id'],
                    'subject' => $data['subject'],
                    'message' => $data['message'],
                ]);
        endif;
        
        return $message->id;
    }

    public function getByID($id)
    {
        return Message::findOrFail($id);
    }

    public function getByFromToID($fromID, $toID, $fields="*")
    {
        return Message::select($fields)
                ->where('user_from_id', $fromID)
                ->where('user_to_id', $toID)
                ->first();
    }
}
