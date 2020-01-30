@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Options...</h1>
   
    <div class="card">
      <div class="card-header">
        <form method="POST" action="{{ route('option.post') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="name" class="form-control" placeholder="Enter option name" aria-label="Recipient's username" aria-describedby="basic-addon2">
              {{-- <input type="text" name="code" class="form-control" placeholder="Enter option code" aria-label="Recipient's username" aria-describedby="basic-addon2"> --}}
              <div class="input-group-append">
                <button class="btn btn-success" type="submit">Save</button>
              </div>
            </div>
        </form>
      </div>
      <div class="card-body">
   
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p style="margin-bottom:0">{{ Session::get('success') }}</p>
                </div>
            @endif
   
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($options as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }} </td>
                            <td>{{ $row->code }} </td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
   
</div>
@endsection