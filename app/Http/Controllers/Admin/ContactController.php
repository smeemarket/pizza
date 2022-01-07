<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactList()
    {
        $data = Contact::orderBy('contact_id', 'desc')
            ->paginate(9);
        return view('admin.contact.list')->with('contact', $data);
    }

    public function contactSearch(Request $request)
    {
        $data = Contact::where('name', 'like', '%' . $request->searchData . '%')
            ->orWhere('email', 'like', '%' . $request->searchData . '%')
            ->orWhere('message', 'like', '%' . $request->searchData . '%')
            ->paginate(9);
        $data->appends($request->all(0));
        return view('admin.contact.list')->with('contact', $data);
    }
}