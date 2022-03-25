<?php

namespace App\Repositories;

use App\ContactMember;
use Auth;

class ContactMemberRepository
{
    public function all()
    {
        $contactMembers = ContactMember::orderBy('updated_at', 'DESC')->get();

        return $contactMembers;
    }

    public function StoreUpdate(array $data, $id=0)
    {
        if( $id==0 ) :
            $saveData['user_from_id'] = $data['user_from_id'];
            $saveData['user_to_id_number'] = $data['user_to_id_number'];
            $saveData['choose_message']  = $data['choose_message'];
            $saveData['description'] = $data['description'];

            $contactMember = ContactMember::create($saveData);
        else :
            $contactMember = $this->getByID($id);

            ContactMember::where('id', $contactMember->id)
                ->update([
                    'user_from_id' =>$data['user_from_id'],
                    'user_to_id_number' => $data['user_to_id_number'],
                    'choose_message' => $data['choose_message'],
                    'description' => $data['description'],
                ]);
        endif;
        
        return $contactMember->id;
    }

    public function getByID($id)
    {
        return ContactMember::findOrFail($id);
    }
}
