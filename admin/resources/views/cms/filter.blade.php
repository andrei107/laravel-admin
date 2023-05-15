@extends('admin')

@section('content')
<div class="container-receipt">
    <h2 class="heading"> Создание фильтров </h2>
    <div class="col-xs-6 text-left">
        <button type="button" class="btn btn-success createFilterModal" data-toggle="modal" data-target="#createFilterModal">Добавить фильтр</button>
    </div>
    <div class="table-block">
        <table class="table-receipt table" id="customers">
            <thead class="table-header">
                <th class="small-ceil">id</th>
                <th class="medium-ceil">Название</th>
                <th class="medium-ceil">Тип фильтра RU</th>
                <th class="medium-ceil">Тип фильтра EN</th>
                <th class="big-ceil rulang">Код типа</th>
                <th class="medium-ceil">Действия</th>
            </thead>
        </table>
    </div>
</div>

@include('cms.modals.create-filter-modal')
@include('blocks.messages')
<script src="{{asset('js/filter.js')}}"></script>
@endsection