<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::get();

        return view('vehicle.index', compact('vehicles'));
    }

    public function create()
    {
        $edit = false;
        return view('vehicle.form', compact('edit'));

    }

    public function store(Request $request)
    {
        $validator = $this->validateForm($request);

        if($validator->fails()){
            return redirect()
                ->route('vehicle.create')
                ->withErrors($validator)
                ->withInput();
        }else{
            $input = [];
            $input['brand'] = $request->brand;
            $input['model'] = $request->model;
            $input['year'] = $request->year;
            $input['colour'] = $request->colour;
            $input['status'] = 1;
            $input['created_at'] = now();

            DB::beginTransaction();
                try {
                    Vehicle::insert($input);
                    DB::commit();
                } catch (\Exception $ex) {
                    DB::rollBack();
                }


            return redirect(route('vehicle.index'))->withSuccess('Vehicle Data Successfully Saved!');
        }
    }

    public function edit($id)
    {
        $vehicle = Vehicle::where('id', Crypt::decrypt($id))->first();
        $edit = true;

        return view('vehicle.form', compact('vehicle','edit'));

    }
    public function update(Request $request, $id)
    {
        $validator = $this->validateForm($request);

        if($validator->fails()){
            return redirect()
                ->route('vehicle.create')
                ->withErrors($validator)
                ->withInput();
        }else{
            $input = [];
            $input['brand'] = $request->brand;
            $input['model'] = $request->model;
            $input['year'] = $request->year;
            $input['colour'] = $request->colour;
            $input['updated_at'] = now();

            DB::beginTransaction();
                try {
                    Vehicle::where('id', $id)->update($input);
                    DB::commit();
                } catch (\Exception $ex) {
                    DB::rollBack();
                }


            return redirect(route('vehicle.index'))->withSuccess('Vehicle Data Successfully Updated!');
        }



    }
    public function delete($id)
    {
        $input = [];
        $input['status'] = 0;
        $input['deleted_at'] = now();

        Vehicle::where('id', Crypt::decrypt($id))->update($input);

        return redirect(route('vehicle.index'));

    }
    public function activate($id)
    {
        $input = [];
        $input['status'] = 1;
        $input['deleted_at'] = null;
        $input['updated_at'] = now();

        Vehicle::where('id', Crypt::decrypt($id))->update($input);

        return redirect(route('vehicle.index'));

    }
    public function validateForm(Request $request)
    {
        $validate = array(
            'brand' => 'required|string',
            'model' => 'required|string',
            'colour' => 'required|string',
            'year' => 'required|string',
        );

        $validator = Validator::make($request->all(), $validate);

        return $validator;
    }
}
