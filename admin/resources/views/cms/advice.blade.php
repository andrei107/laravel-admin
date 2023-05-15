@extends('admin')

@section('content')
<div class="container-receipt">
    <h2 class="heading"> Управление советами </h2>
    <div class="col-xs-6 text-left">
        <button type="button" class="btn btn-success createAdviceModal" data-toggle="modal" data-target="#createAdviceModal">Добавить совет</button>
    </div>
    <div class="table-block">
        <table class="table-receipt table" id="customers">
            <thead class="table-header">
                <th class="small-ceil">id</th>
                <th class="medium-ceil">Название</th>
                <th class="big-ceil">Краткое описание</th>
                <th class="medium-ceil">Действия</th>
            </thead>
        </table>
    </div>

</div>

@include('cms.modals.create-advice-modal')
@include('blocks.messages')
<script src="{{asset('js/advice.js')}}"></script>
@endsection
