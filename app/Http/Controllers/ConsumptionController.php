<?php

namespace App\Http\Controllers;

use App\Models\Consumption;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsumptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {

        $columns = ['litros', 'kilometraje_anterior', 'kilometraje_actual', 'kilometro_recorrido', 'rendimiento', 'indicador'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $truckId = $request->input('truckId');

        $query = Consumption::select('*')->where('truck_id', '=', $truckId)->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('litros', 'like', '%' . $searchValue . '%')
                    ->orWhere('kilometraje_anterior', 'like', '%' . $searchValue . '%')
                    ->orWhere('kilometraje_actual', 'like', '%' . $searchValue . '%')
                    ->orWhere('kilometro_recorrido', 'like', '%' . $searchValue . '%')
                    ->orWhere('rendimiento', 'like', '%' . $searchValue . '%')
                    ->orWhere('indicador', 'like', '%' . $searchValue . '%');

            });
        }

        $consumption = $query->paginate($length);

        return ['data' => $consumption, 'draw' => $request->input('draw')];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "truckId" => ['required'],
            "truckRendimiento" => ['required'],
            "litros" => ['required', 'numeric'],
            "precio_litros" => ['required', 'numeric'],
            "kilometraje_actual" => ['required', 'numeric'],
        ])->validate();


        $consumptionLast = Consumption::all()->last();

        if ($consumptionLast == null) {
            $kilometraje_anterior = $request->kilometraje_actual;
        } else {
            $kilometraje_anterior = $consumptionLast->kilometraje_actual;
        }

        $kilometros_recorridos = $request->kilometraje_actual - $kilometraje_anterior;
        $rendimiento = $kilometros_recorridos / $request->litros;
        $indicador = $rendimiento > $request->truckRendimiento ? 'Bueno' : 'Bajo';

        $consumption = new  Consumption();

        $consumption->litros = $request->litros;
        $consumption->precio_litros = $request->precio_litros;
        $consumption->kilometraje_anterior = $kilometraje_anterior;
        $consumption->kilometraje_actual = $request->kilometraje_actual;
        $consumption->kilometro_recorrido = $kilometros_recorridos;
        $consumption->rendimiento = $rendimiento;
        $consumption->indicador = $indicador;
        $consumption->truck_id = $request->truckId;

        $consumption->save();

        return redirect()->back()
            ->with('message', 'Consumption Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {

        Validator::make($request->all(), [
            "truckId" => ['required'],
            "truckRendimiento" => ['required'],
            "litros" => ['required', 'numeric'],
            "precio_litros" => ['required', 'numeric'],
            "kilometraje_actual" => ['required', 'numeric'],
        ])->validate();

        $kilometros_recorridos = $request->kilometraje_actual - $request->kilometraje_anterior;
        $rendimiento = $kilometros_recorridos / $request->litros;
        $indicador = $rendimiento > $request->truckRendimiento ? 'Bueno' : 'Bajo';

        $consumption = Consumption::find($id);

        $consumption->litros = $request->litros;
        $consumption->kilometraje_anterior = $request->kilometraje_anterior;
        $consumption->kilometraje_actual = $request->kilometraje_actual;
        $consumption->kilometro_recorrido = $kilometros_recorridos;
        $consumption->rendimiento = $rendimiento;
        $consumption->indicador = $indicador;
        $consumption->truck_id = $request->truckId;

        $consumption->save();

        return redirect()->back()
            ->with('message', 'Consumption Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $this->hasPermission('delete');

        $consumption = Consumption::where('id', $id)->first();

        $consumption->delete();

        return redirect()->back()
            ->with('message', 'consumption destroyed Successfully.');
    }

    private function hasPermission($permission)
    {
        $team = Team::where('name', 'salem')
            ->first();

        $user = auth()->user();

        if (!$user->hasTeamPermission($team, $permission) || !$user->belongsToTeam($team)) {
            abort(401, 'You cannot ' . $permission);
        }
        //return response()->json($permission);

    }
}
