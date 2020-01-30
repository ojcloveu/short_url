@extends('layouts.app')

@section('content')
<div class="container">
  
   
    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <p>{{ $single->url }}</p>
                <p><a href="{{ route('shorten.link', $single->code) }}" target="_blank">{{ route('shorten.link', $single->code) }}</a></p>
                <p>Total Counter: {{$single->counter}}</p>
            </div>
            <div class="col-md-6">
                @foreach ($options as $option)
                    {{ $option->name }}:
                    @guest
                    <strong>{{ route('shorten.link', $single->code) }}?o={{ $option->code }}</strong>
                    @else
                    <strong>{{ route('shorten.link', $single->code) }}?k={{ Auth::user()->code }}&o={{ $option->code }}</strong>
                    @endguest
                    <br/>
                @endforeach
            </div>
        </div>
      </div>
      <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Refer By</th>
                        <th>Refer from</th>
                        <th>Counter</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($single->referers as $row)
                        <tr>
                            <td>{{ optional($row->user)->name }}</td>
                            <td> {{$row->refer_name}} </td>
                            <td>{{ $row->counter }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
   
</div>
@endsection