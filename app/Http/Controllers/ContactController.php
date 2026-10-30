<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function store(StoreContactMessageRequest $request)
    {
        $data = $request->validated();

        if ($request->user()) {
            $data['user_id'] = $request->user()->id;
        }

        ContactMessage::create($data);

        return redirect()->route('contacto')->with('status', 'Mensaje enviado. Te respondemos pronto.');
    }
}
