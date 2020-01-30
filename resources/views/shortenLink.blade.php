@extends('layouts.app')

@section('content')
<div class="container">
    <h1>How to create url shortener?</h1>
   
    <div class="card">
      <div class="card-header">
        <form method="POST" action="{{ route('generate.shorten.link.post') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="title" class="form-control" placeholder="Title" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                    <p style="margin-bottom:0">{{ Session::get('success') }}</p>
                </div>
            @endif
   
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                   
                        <th>Link</th>
                        <th>Share</th>
                        <th>Counter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            
                            <td>
                                <a href="{{ $row->url }}">{{$row->title}}</a>
                               
                            </td>
                            <td>
                                @foreach ($options as $option)
                                    {{ $option->name }}:
                                    @guest
                                    <strong>{{ route('shorten.link', $row->code) }}?o={{ $option->code }}</strong>
                                    @else
                                    <strong>{{ route('shorten.link', $row->code) }}?k={{ Auth::user()->code }}&o={{ $option->code }}</strong>
                                    @endguest
                                    <br/>
                                @endforeach
                            </td>
                            <td><a href="{{ route('show', $row->id) }}" >{{ $row->counter }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
   
</div>
@endsection