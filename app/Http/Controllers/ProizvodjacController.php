<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProizvodjacResurs;
use App\Models\Proizvodjac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProizvodjacController extends HandleController
{
    public function index()
    {
        $svi = Proizvodjac::all();
        return $this->success(ProizvodjacResurs::collection($svi), 'Vraceni su svi proizvodjaci.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'proizvodjac' => 'required'
        ]);
        if($validator->fails()){
            return $this->error($validator->errors());
        }

        $proizvodjac = Proizvodjac::create($input);

        return $this->success(new ProizvodjacResurs($proizvodjac), 'Novi proizvodjac je kreiran.');
    }


    public function show($id)
    {
        $proizvodjac = Proizvodjac::find($id);
        if (is_null($proizvodjac)) {
            return $this->error('Proizvodjac sa zadatim id-em ne postoji.');
        }
        return $this->success(new ProizvodjacResurs($proizvodjac), 'Proizvodjac sa zadatim id-em je vracen.');
    }


    public function update(Request $request, $id)
    {
        $proizvodjac = Proizvodjac::find($id);
        if (is_null($proizvodjac)) {
            return $this->error('Proizvodjac sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'proizvodjac' => 'required'
        ]);

        if($validator->fails()){
            return $this->error($validator->errors());
        }

        $proizvodjac->proizvodjac = $input['proizvodjac'];
        $proizvodjac->save();

        return $this->success(new ProizvodjacResurs($proizvodjac), 'Proizvodjac je azuriran.');
    }

    public function destroy($id)
    {
        $proizvodjac = Proizvodjac::find($id);
        if (is_null($proizvodjac)) {
            return $this->error('Proizvodjac sa zadatim id-em ne postoji.');
        }

        $proizvodjac->delete();
        return $this->success([], 'Proizvodjac je obrisan.');
    }
}
