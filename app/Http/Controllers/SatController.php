<?php

namespace App\Http\Controllers;

use App\Http\Resources\SatResurs;
use App\Models\Sat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatController extends HandleController
{
    public function index()
    {
        $kolekcija = Sat::all();
        return $this->success(SatResurs::collection($kolekcija), 'Vraceni su svi satovi.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'proizvodjacID' => 'required',
            'model' => 'required',
            'polID' => 'required',
            'cena' => 'required'
        ]);
        if($validator->fails()){
            return $this->error($validator->errors());
        }

        $sat = Sat::create($input);

        return $this->success(new SatResurs($sat), 'Sat je kreiran.');
    }


    public function show($id)
    {
        $sat = Sat::find($id);
        if (is_null($sat)) {
            return $this->error('Sat sa zadatim id-em ne postoji.');
        }
        return $this->success(new SatResurs($sat), 'Sat sa zadatim id-em je vracen.');
    }


    public function update(Request $request, $id)
    {
        $sat = Sat::find($id);
        if (is_null($sat)) {
            return $this->error('Sat sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'proizvodjacID' => 'required',
            'model' => 'required',
            'polID' => 'required',
            'cena' => 'required'
        ]);

        if($validator->fails()){
            return $this->error($validator->errors());
        }

        $sat->proizvodjacID = $input['proizvodjacID'];
        $sat->model = $input['model'];
        $sat->polID = $input['polID'];
        $sat->cena = $input['cena'];
        $sat->save();

        return $this->success(new SatResurs($sat), 'Sat je azuriran.');
    }

    public function destroy($id)
    {
        $sat = Sat::find($id);
        if (is_null($sat)) {
            return $this->error('Sat sa zadatim id-em ne postoji.');
        }

        $sat->delete();
        return $this->success([], 'Sat je obrisan.');
    }
}
