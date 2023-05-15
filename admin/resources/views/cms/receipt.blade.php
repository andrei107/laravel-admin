@extends('admin')

@section('content')
<div class="container-receipt">
    <h2 class="heading"> Управление рецептами </h2>
    <div class="col-xs-6 text-left">
        <button type="button" class="btn btn-success createModal" data-toggle="modal" data-target="#createReceiptModal">Добавить рецепт</button>
    </div>
    <div class="pull-right js-get-report-panel">

        <a href="/home/receipt-doc?format=xls">
           Xls
        </a>


        <a href="/home/receipt-doc?format=pdf">
           pdf
        </a>


        <a href="/home/receipt-doc?format=html">
           html
        </a>

    </div>
    <div class="table-block">
        <table class="table-receipt table" id="customers">
            <thead class="table-header">
                <th class="small-ceil">id</th>
                <th class="medium-ceil">Название</th>
                <th class="small-ceil">Активность</th>
                <th class="small-ceil">Лучшие рецепты</th>
                <th class="small-ceil">Главный рецепт</th>
                <th class="small-ceil">Быстрые рецепты</th>
                <th class="medium-ceil">Пункт меню</th>
                <th class="medium-ceil">Действия</th>
            </thead>
        </table>
    </div>

</div>

@include('cms.modals.create-receipt-modal')
@include('blocks.messages')
<script src="{{asset('js/receipt.js')}}"></script>
@endsection
