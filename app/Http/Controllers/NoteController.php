<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends BaseController
{
    public function index(){

        $notes=Note::where('create_by',Auth::user()->id)->latest()->paginate(10);
        $data=[
          'notes'=>$notes,
        ];
        return $this->responseAPI(true,'ok',$data,Response::HTTP_OK);
    }
    public function store(Request $request){
        try {
            DB::beginTransaction();
            $data=Note::create(array_merge($request->all(),['create_by'=>Auth::user()->id]));

            DB::commit();
            return $this->responseAPI(true, 'Success', $data, Response::HTTP_OK);
        }
        catch (\Exception $e){
            DB::rollBack();
            return \response()->json($e->getMessage());
        }
    }
    public function destroy($id){

        try {
            DB::beginTransaction();
            $note=Note::findOrFail($id);
            $note->delete();
            DB::commit();
            return $this->responseAPI(true,'delete success','',Response::HTTP_OK);

        }
        catch (\Exception $exception){
            return $this->responseAPI(true,'delete error','',Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
