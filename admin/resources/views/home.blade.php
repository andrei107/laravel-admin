@extends('admin')

@section('content')
<div class="container">
    <h2 class="heading">Общая статистика </h2>
    <div class="main-info">
        <div class="main-info-item receipt-num">
            <h3> {{$receiptCount}} </h3>
            <p> рецептов </p>
        </div>
        <div class="main-info-item menu-num">
            <h3> {{$menuCount}} </h3>
            <p> разделов меню  </p>
        </div>
        <div class="main-info-item advice-num">
            <h3> {{$adviceCount}} </h3>
            <p> советов </p>
        </div>
    </div>
</div>
@endsection
