@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@if($edit) Edit @else Create @endif Vehicle</div>

                <div class="card-body">
                    <form action="@if($edit) {{ route('vehicle.update',$vehicle->id) }} @else {{ route('vehicle.store') }} @endif" method="post">
                        @csrf
                        @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                <strong>{{ $error }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                        @endif

                        Brand : <input type="text" name="brand" value="@if($edit) {{ $vehicle->brand }} @else {{ old('brand') }} @endif" > <br>
                        Model : <input type="text" name="model" value="@if($edit) {{ $vehicle->model }} @else {{ old('model') }}  @endif" > <br>
                        Year : <input type="text" name="year" value="@if($edit) {{ $vehicle->year }} @else {{ old('year') }}  @endif" > <br>
                        Colour : <input type="text" name="colour" value="@if($edit) {{ $vehicle->colour }} @else {{ old('colour') }}  @endif" > <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

