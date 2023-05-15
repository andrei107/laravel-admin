<?php

namespace App\Http\Controllers\CMS;

use Facade\FlareClient\View;
use App\Http\Controllers\Controller;
use App\Models\CMS\FilterValue;
use App\Models\CMS\FilterTypes;
use Illuminate\Http\Request;
use App\Http\Requests\FilterTypesRequest;
use App\Http\Requests\FilterValuesRequest;

class CreateFilterController extends Controller
{
    public function index()
    {
        return view('cms.create-filter', [
            'types' => FilterTypes::all(),
        ]);
    }

    public function load()
    {
        return response()->json([
            'status' => 'success',
            'types' => FilterTypes::all(),
            'values' => FilterValue::all()
        ]);
    }

    public function addType(FilterTypesRequest $request)
    {
        $query = $request->all();
        $entity = new FilterTypes();
        $entity->fill($query)->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function addValue(FilterValuesRequest $request)
    {
        $query = $request->all();
        $entity = new FilterValue();
        $entity->fill($query)->save();

        return response()->json([
            'status' => 'success'
        ]);
    }


    public function deleteType(Request $request)
    {
        if (FilterTypes::find($request->id)->delete()) {
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

    public function deleteValue(Request $request)
    {
        if (FilterValue::find($request->id)->delete()) {
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


    public function readTypes(Request $request)
    {
        $entity = FilterTypes::find($request->id);
        return response()->json([
            'status' => 'success',
            'data' => $entity,
        ]);
    }

    public function readValues(Request $request)
    {
        $entity = FilterValue::find($request->id);
        return response()->json([
            'status' => 'success',
            'data' => $entity,
        ]);
    }

    public function editTypes(FilterTypesRequest $request )
    {
        $query = $request->all();
        $entity = FilterTypes::find($request->id);
        $entity->update($query);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function editValues(FilterValuesRequest $request )
    {
        $query = $request->all();
        $entity = FilterValue::find($request->id);
        $entity->update($query);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
