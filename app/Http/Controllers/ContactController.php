<?php

namespace App\Http\Controllers;
use App\Contact;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function index(Request $request, Contact $contact)
    {
        $validator = Validator::make ($request->all(),[
           "firstName" => "required",
            "lastName" => "required",
            "mail" => "required",
            "subject" => "required",
            "message" => "required"
        ]);
        if (!$validator->fails()) {
            $contact->message = $request->message;
            $contact->subject = $request->subject;
            $contact->mail = $request->mail;
            $contact->lastName = $request->lastName;
            $contact->firstName = $request->firstName;

            Mail::to('heavens-shoes@gmail.com')->send(new ContactMessage($contact));
            return response()->json('Message envoyé avec succès !');
        }
        else{
            return response()->json('Tous les champs sont obligatoire');
        }
    }
}
