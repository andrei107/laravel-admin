<?php

namespace App\Http\Controllers\CMS;

use Facade\FlareClient\View;
use App\Http\Controllers\Controller;
use App\Models\CMS\AdviceModel;
use Illuminate\Http\Request;
use App\Http\Requests\AdviceRequest;

class AdviceController extends Controller
{
    public function index()
    {
        return view('cms.advice');
    }

    public function load()
    {
        return response()->json([
            'status' => 'success',
            'data' => AdviceModel::all()
        ]);
    }

    public function add(AdviceRequest $request)
    {
        $query = $request->all();
        $entity = new AdviceModel();
        $entity->fill($query)->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function read(Request $request)
    {
        $entity = AdviceModel::find($request->id);
        return response()->json([
            'status' => 'success',
            'data' => $entity,
        ]);
    }

    public function delete(Request $request)
    {
        if (AdviceModel::find($request->id)->delete()) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'При удалении произошла ошибка'
            ]);
        }
    }

    public function edit(AdviceRequest $request )
    {
        $query = $request->all();
        $entity = AdviceModel::find($request->id);
        $entity->update($query);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
