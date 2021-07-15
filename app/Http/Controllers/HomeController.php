<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = request()->user();

        // print_r( $user->id );
        $contacts = Contact::where( 'user_id', $user->id )->paginate( 20 ); 

        return view('home', compact( 'contacts' ));
    }

    public function thankyou()
    {
        return view('auth/thankyou');
    }

    public function contact_form( $id = 0 )
    {
        $contact = new Contact();
        if ( $id != 0 ) {
            $contact = Contact::find( $id );

            if ( $contact->user_id != request()->user()->id ) {
                return redirect()->route('home');
            }
        }

        return view('contact_form', compact( 'contact' ));
    }

    public function save_contact( Request $request, $id = 0 )
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $contact = $id == 0 ? new Contact() : Contact::find( $id );
        $contact->user_id = request()->user()->id;
        $contact->name    = $request->name;
        $contact->company = $request->company;
        $contact->email   = $request->email;
        $contact->phone   = $request->phone;

        $contact->save();
    
        return redirect()->route('home');
    }

    public function search_contact( Request $request )
    {
        $contact = Contact::where( 'name', 'LIKE', '%' . $request->term . '%' )
                        ->OrWhere( 'company', 'LIKE', '%' . $request->term . '%' )
                        ->OrWhere( 'phone', 'LIKE', '%' . $request->term . '%' )
                        ->OrWhere( 'email', 'LIKE', '%' . $request->term . '%' )->get();

        echo json_encode( $contact );
    }

    public function delete_contact( $id )
    {
        $contact = Contact::find( $id );
        $contact->delete();
        
        return redirect()->route('home');
    }
}
