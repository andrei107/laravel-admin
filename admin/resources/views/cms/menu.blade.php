@extends('admin')

@section('content')
<div class="container-receipt">
    <h2 class="heading"> Управление меню </h2>
    <div class="col-xs-6 text-left">
        <button type="button" class="btn btn-success createMenuModal" data-toggle="modal" data-target="#createMenuModal">Добавить меню</button>
    </div>
    <div class="table-block" style="width: 70%; margin:10px 0 0 0px">
        <table class="table-receipt table" id="customers">
            <thead class="table-header">
                <th class="small-ceil">id</th>
                <th class="medium-ceil">Атрибут</th>
                <th class="medium-ceil">Название</th>
                <th class="medium-ceil">Действия</th>
            </thead>
        </table>
    </div>

</div>

@include('cms.modals.create-menu-modal')
@include('blocks.messages')
<script src="{{asset('js/menu.js')}}"></script>
@endsection
