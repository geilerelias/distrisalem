<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\Truck;
use Illuminate\Support\Facades\Validator;


class TruckController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $this->hasPermission('read');
        $data = Truck::all();
        return Inertia::render('Trucks/index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->hasPermission('create');
        return Inertia::render('Trucks/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->hasPermission('create');

        Validator::make($request->all(), [
            'placa' => ['required', 'unique:trucks'],
            'color' => ['required'],
            'modelo' => ['required'],
            'tipoCombustible' => ['required'],
            'rendimientoEstipulado' => ['required', 'numeric'],
            'photo' => ['required', 'image'],
        ])->validate();

        $fileName = '';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            // Generate a file name with extension
            $fileName = 'truck-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $path = $file->storeAs('trucks', $fileName);
        }

        $truck = new  Truck();

        $truck->placa = $request->placa;
        $truck->color = $request->color;
        $truck->modelo = $request->modelo;
        $truck->tipo_combustible = $request->tipoCombustible;
        $truck->rendimiento_estipulado = $request->rendimientoEstipulado;
        $truck->photo_path = $path;

        if ($message = $truck->save()) {
            return redirect()->back()
                ->with('message', 'Truck Created Successfully.');
        }
        {
            return redirect()->back()
                ->with('message', 'Truck not Created.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->hasPermission('delete');

        $data = Truck::where('id', $id)
            ->first();
        //return response($data, 200);
        //return response()->json($data);
        return Inertia::render('Trucks/show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $this->hasPermission('update');

        $data = Truck::where('id', $id)
            ->first();
        //return response($data, 200);
        //return response()->json($data);
        return Inertia::render('Trucks/edit', ['data' => $data]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->hasPermission('update');

        Validator::make($request->all(), [
            'placa' => ['required', Rule::unique('trucks')->ignore($id)],
            'color' => ['required'],
            'modelo' => ['required'],
            'tipoCombustible' => ['required'],
            'rendimientoEstipulado' => ['required'],
            'photo' => ['required'],
        ])->validate();

        $truck = Truck::find($id);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            // Generate a file name with extension
            $fileName = 'truck-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $path = $file->storeAs('trucks', $fileName);

            Storage::delete($truck->image);
            $truck->photo_path = $path;
        } else {
            $truck->photo_path = $request->photo;
        }

        $truck->placa = $request->placa;
        $truck->color = $request->color;
        $truck->modelo = $request->modelo;
        $truck->tipo_combustible = $request->tipoCombustible;
        $truck->rendimiento_estipulado = $request->rendimientoEstipulado;

        $truck->save();

        return redirect()->back()
            ->with('message', 'Post Updated Successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function datatable(Request $request)
    {

        $columns = ['placa', 'color', 'modelo', 'tipo_combustible', 'rendimiento_estipulado', 'photo_path'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Truck::select('id', 'placa', 'color', 'modelo', 'tipo_combustible', 'rendimiento_estipulado', 'photo_path')->orderBy($columns[$column], $dir);


        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('placa', 'like', '%' . $searchValue . '%')
                    ->orWhere('color', 'like', '%' . $searchValue . '%')
                    ->orWhere('modelo', 'like', '%' . $searchValue . '%')
                    ->orWhere('tipo_combustible', 'like', '%' . $searchValue . '%')
                    ->orWhere('rendimiento_estipulado', 'like', '%' . $searchValue . '%');

            });
        }

        $trucks = $query->paginate($length);
        return ['data' => $trucks, 'draw' => $request->input('draw')];
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
        $this->hasPermission('delete');

        $data = Truck::where('id', $id)
            ->first();
        //return response($data, 200);
        //return response()->json($data);
        return Inertia::render('Trucks/destroy', ['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->hasPermission('delete');
        try {
            $truck = Truck::where('id', $id)->first();

            if ($truck->Consumptions()->get()->count() > 0) {
                //return response($data, 200);
                //return response()->json($data);

                return response(
                    ["error" => "No es posible eliminar este elemento, tiene elementos que dependen de el"],
                    403
                );

            } else {
                $truck->delete();
                return response(
                    ["success" => "Buen trabajo, eliminado correctamente."],
                    202
                );
            }

        } catch (\Illuminate\Database\QueryException $e) {
            var_dump($e->errorInfo);
            return response(
                ["error" => $e->errorInfo],
                403
            );
        }


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
