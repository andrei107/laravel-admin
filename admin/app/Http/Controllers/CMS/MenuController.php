<?php

namespace App\Http\Controllers\CMS;

use Facade\FlareClient\View;
use App\Http\Controllers\Controller;
use App\Models\CMS\MenuModel;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;

class MenuController extends Controller
{
    public function index()
    {
        return view('cms.menu');
    }

    public function load()
    {
        return response()->json([
            'status' => 'success',
            'menu' => MenuModel::all()
        ]);
    }

    public function add(MenuRequest $request)
    {
        $query = $request->all();
        $entity = new MenuModel();
        $entity->fill($query)->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function read(Request $request)
    {
        $entity = MenuModel::find($request->id);
        return response()->json([
            'status' => 'success',
            'data' => $entity,
        ]);
    }

    public function delete(Request $request)
    {
        if (MenuModel::find($request->id)->delete()) {
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

    public function edit(MenuRequest $request )
    {
        $query = $request->all();
        $entity = MenuModel::find($request->id);
        $entity->update($query);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
