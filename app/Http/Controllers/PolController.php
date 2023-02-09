<?php

namespace App\Http\Controllers;

use App\Http\Resources\PolResurs;
use App\Models\Pol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PolController extends HandleController
{
    public function index()
    {
        $svi = Pol::all();
        return $this->success(PolResurs::collection($svi), 'Vraceni su svi polovi.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'pol' => 'required',
        ]);
        if($validator->fails()){
            return $this->error($validator->errors());
        }

        $pol = Pol::create($input);

        return $this->success(new PolResurs($pol), 'Novi pol je kreiran.');
    }


    public function show($id)
    {
        $pol = Pol::find($id);
        if (is_null($pol)) {
            return $this->error('Pol sa zadatim id-em ne postoji.');
        }
        return $this->success(new PolResurs($pol), 'Pol sa zadatim id-em je vracen.');
    }


    public function update(Request $request, $id)
    {
        $pol = Pol::find($id);
        if (is_null($pol)) {
            return $this->error('Pol sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'pol' => 'required',
        ]);

        if($validator->fails()){
            return $this->error($validator->errors());
        }

        $pol->pol = $input['pol'];
        $pol->save();

        return $this->success(new PolResurs($pol), 'Pol je azuriran.');
    }

    public function destroy($id)
    {
        $pol = Pol::find($id);
        if (is_null($pol)) {
            return $this->error('Pol sa zadatim id-em ne postoji.');
        }

        $pol->delete();
        return $this->success([], 'Pol je obrisan.');
    }
}
