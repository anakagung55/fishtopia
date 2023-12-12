<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\fish;
use Illuminate\Http\Request;

class ikan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=fish::paginate(10);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi=$request->validate([
            'nama'=>'required',
            'jenis'=>'required',
            'foto'=>'required|file|mimes:png,jpg,jpeg|max:2048',
            'deskripsi'=>'required'
        ]);
        try {
            $fileName = time().$request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('public/images',$fileName);
            $validasi['foto']=$path;
            $response = fish::create($validasi);
            return response()->json([
                'success'=>true,
                'message'=>'success',
                'data'=>$response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>"Err",
                'errors'=>$e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Fish::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
                'data' => $data
            ], 404);
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi=$request->validate([
            'nama'=>'required',
            'jenis'=>'required',
            'foto'=>'',
            'deskripsi'=>'required'
        ]);
        try {
            if ($request->file('foto')){
                $fileName = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('public/images',$fileName);
                $validasi['foto']=$path;
            }
            $response = fish::find($id);
            $response->update($validasi);
            return response()->json([
                'success'=>true,
                'message'=>'success',
                'data'=>$response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>"Err",
                'errors'=>$e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $data=fish::find($id);
            $data->delete();
            return response()->json([
                'success'=>true,
                'message'=>'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'=>"Err",
                'errors'=>$e->getMessage()
            ]);
        }  
    }
}