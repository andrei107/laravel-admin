<div id="createFilterModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h3 class="name-modal"></h3>
            <div class="formPosition">
            <form id="create-filter-modal"  class="createForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="main-modal-info">
                    <h4>Описание</h4>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="rus">
                            <button class="nav-link active" id="rus-tab" data-bs-toggle="tab" data-bs-target="#rus" type="button" role="tab" aria-controls="rus" aria-selected="true">RU</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en" type="button" role="tab" aria-controls="en" aria-selected="false">EN</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="rus" role="tabpanel" aria-labelledby="rus-tab">
                            <div class="form-group">
                                <label>Название фильтра</label>
                                <input type="text" name="name" class="form-control name_ru-field">
                            </div>
                            <div class="form-group">
                                <label>Тип фильтра</label>
                                <select name="type_ru" class="selectpicker form-control for_menu-field" id="for_menu">
                                    @foreach($data as $key=>$value)
                                        <option value="{{$value->type code}}">{{$value->name_ru}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Превью значений</label>
                                <ul>
                                    @foreach($data as $key=>$value)
                                        <li>{{$value->value_ru}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                            <div class="form-group">
                                <label>Тип фильтра</label>
                                <select name="type_en" class="selectpicker form-control for_menu-field" id="for_menu">
                                    @foreach($data as $key=>$value)
                                        <option value="{{$value->type code}}">{{$value->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Превью значений</label>
                                <ul>
                                    @foreach($data as $key=>$value)
                                        <li>{{$value->value_en}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div>
        </div>
        <div class="modal-footer">
            <button name="insert" value='Save' type="button" class='btn btn-success actionButton'> Сохранить </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        </div>
    </div>
</div>





