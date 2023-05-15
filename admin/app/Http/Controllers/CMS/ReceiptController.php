<?php

namespace App\Http\Controllers\CMS;

use Facade\FlareClient\View;
use App\Http\Controllers\Controller;
use App\Models\CMS\ReceiptModel;
use App\Models\CMS\MenuModel;
use Illuminate\Http\Request;
use App\Http\Requests\ReceiptRequest;
use App\Services\PhpExcelService;

class ReceiptController extends Controller
{
    public function index()
    {
        $menu = MenuModel::getMenu();
        $allReceipts = ReceiptModel::all();

        return view('cms.receipt', [
            'data' => ReceiptModel::all(),
            'menu' => $menu
        ]);
    }

    public function load()
    {
        $menu = MenuModel::getMenu();
        $allReceipts = ReceiptModel::all();

        return response()->json([
            'status' => 'success',
            'allReceipts' => $allReceipts,
            'menu' => $menu
        ]);
    }

    public function add(ReceiptRequest $request)
    {
        $file = $request->file('img');
        $completeFileName = $file->getClientOriginalName();
        $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $file->storeAs("docs/".$completeFileName, $completeFileName);

        $query = $request->all();
        $query['img'] = $completeFileName;
        $entity = new ReceiptModel();
        $entity->fill($query)->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function read(Request $request)
    {
        $entity = ReceiptModel::find($request->id);
        return response()->json([
            'status' => 'success',
            'data' => $entity,
        ]);
    }

    public function delete(Request $request)
    {
        if (ReceiptModel::find($request->id)->delete()) {
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

    public function edit(ReceiptRequest $request )
    {
        $query = $request->all();
        $entity = ReceiptModel::find($request->id);

        $file = $request->file('img');
        $completeFileName = $file->getClientOriginalName();
        $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $file->storeAs("docs/".$completeFileName, $completeFileName);

        $entity->update($query);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function getDoc(Request $request)
    {
        $headers = [
            [   'name' => 'ID', 'width' => 10   ],
            [   'name' => 'Название', 'width' => 30   ],
            [   'name' => 'Активность', 'width' => 15   ],
            [   'name' => 'Блок лучших', 'width' => 15   ],
            [   'name' => 'Блок главного', 'width' => 15   ],
            [   'name' => 'Блок быстрых', 'width' => 15   ],
            [   'name' => 'Пункт меню', 'width' => 40   ],
        ];

        $filename = 'текущие рецепты';

        $format = $request->get('format', 'xls');
        $phpExcelService = new PhpExcelService($format);
        $phpExcelService->setColumnsWidth(array_column($headers, 'width'));
        $phpExcelService->setHeaderRow(array_column($headers, 'name'));

       ReceiptModel::docs(
        function ($data) use($phpExcelService) {
            dd($data);
            $phpExcelService->insertData($data);
        } ,1);

        $currentRowLevel = $phpExcelService->getRowLevel();

        $phpExcelService->setStyleByArray('A0:G' . ($currentRowLevel - 1), $this->tableBorderStyle);
        $phpExcelService->returnDocument($filename);

    }
}
