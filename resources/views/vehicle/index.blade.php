@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vehicle List') }}</div>

                <div class="card-body">
                @if(Session::get('success', false))
                <div class="alert alert-success alert-notification">
                    <i class="fa fa-check"></i>
                    {{ Session::get('success') }}
                </div>
                @endif
                    <a href="{{ route('vehicle.create') }}" class="btn btn-primary">Create</a>
                    <br>
                    <table class="table table-striped">
                        <tr>
                            <td>Model</td>
                            <td>Brand</td>
                            <td>Year</td>
                            <td>Colour</td>
                            <td>Option</td>
                        </tr>
                        @foreach($vehicles as $row)
                        <tr>
                            <td>{{ $row->model }}</td>
                            <td>{{ $row->brand }}</td>
                            <td>{{ $row->year }}</td>
                            <td>{{ $row->colour }}</td>
                            <td>
                                @if($row->status == 1)
                                <a href="{{ route('vehicle.edit', Crypt::encrypt($row->id)) }}"
                            class="btn btn-primary">Edit</a>
                            <a href="{{ route('vehicle.delete', Crypt::encrypt($row->id)) }}"
                            class="btn btn-danger">Delete</a>
                            @else
                            <a href="{{ route('vehicle.activate', Crypt::encrypt($row->id)) }}"
                            class="btn btn-info">Activate!</a>
                            @endif
                        </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

