@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Contacts') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-4 ">
                            <input type="search" class="form-control search-contact" placeholder="Search Contact" />
                        </div>
                        <div class="col-sm-4 col-sm-push-4">
                            <a href="{{ route('add_contact') }}" class="pull-right">
                                <input type="button" value="Add New Contact" class="btn btn-primary " />
                            </a>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-sm-12 list-result">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">Name</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->company }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td> 
                                            <a href="{{ route('edit_contact', ['id' => $contact->id ] ) }}">
                                                <input type="button" value="Edit" class="btn btn-success btn-sm " />
                                            </a>
                                            <input type="button" data-contact-id="{{ $contact->id }}" value="Delete" class="btn btn-danger btn-sm btn-delete" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $contacts->links() !!}
                            </div>        
                        </div>
                        <div class="col-sm-12 search-result d-none">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">Name</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="deleteConfirm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to DELETE?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-yes">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
@endsection
