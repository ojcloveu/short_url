@extends('layouts.app')

@section('content')
<div class="container">
    <h1>How to create url shortener using Laravel?</h1>
   
    <div class="card">
      <div class="card-header">
        <form method="POST" action="{{ route('generate.shorten.link.post') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-success" type="submit">Generate Shorten Link</button>
              </div>
            </div>
        </form>
      </div>
      <div class="card-body">
   
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
   
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                        <th>Counter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>
                                @guest
                                <a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a>
                                @else
                                <a href="{{ route('shorten.link', $row->code) }}?k={{ Auth::user()->code }}" target="_blank">{{ route('shorten.link', $row->code) }}?k={{ Auth::user()->code }}</a>
                                @endguest

                            </td>
                            <td>{{ $row->url }}</td>
                            <td><a href="{{ route('show', $row->id) }}" target="_blank">{{ $row->counter }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
   
</div>
@endsection