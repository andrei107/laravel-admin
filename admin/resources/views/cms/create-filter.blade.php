@extends('admin')

@section('content')
<div class="container-receipt">
    <h2 class="heading"> Создание фильтров </h2>

    <div class="filterWrapper">

        <div class="filter-types">

            <div class="col-xs-6 text-left">
                <button type="button" class="btn btn-success createFilterTypesModal" data-toggle="modal" data-target="#createFilterTypesModal">Добавить тип фильтра</button>
            </div>
            <div class="table-block">
                <table class="table-receipt table" id="customers">
                    <thead class="table-header filterTypesHead">
                        <th class="small-ceil">id</th>
                        <th class="medium-ceil">Код</th>
                        <th class="medium-ceil">Название</th>
                        <th class="medium-ceil">Активность</th>
                        <th class="medium-ceil">Действия</th>
                    </thead>
                </table>
            </div>
        </div>


        <div class="filter-values">
            <div class="col-xs-6 text-left">
                <button type="button" class="btn btn-success createFilterValuesModal" data-toggle="modal" data-target="#createFilterValuesModal">Добавить значение фильтра</button>
            </div>
            <div class="table-block">
                <table class="table-receipt table" id="customers">
                    <thead class="table-header filterValuesHead">
                        <th class="small-ceil">id</th>
                        <th class="medium-ceil">Код</th>
                        <th class="medium-ceil">Значение </th>

                        <th class="medium-ceil">Действия</th>
                    </thead>
                </table>
            </div>
        </div>

    </div>



</div>


@include('cms.modals.create-filter-values-modal')
@include('blocks.messages')
<script src="{{asset('js/create-filter.js')}}"></script>
@endsection
