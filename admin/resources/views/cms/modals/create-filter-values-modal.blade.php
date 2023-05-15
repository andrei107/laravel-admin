<div id="createFilterValuesModal" class="modal fade" tabindex="1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h3 class="name-modalValues"></h3>
            <div class="formPosition">
            <form id="create-filter-values-modal"  class="createForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="general-for-all-languages">
                    <h4>Общее для всех языков</h4>
                    <div class="select-block-modal">
                        <div class="form-group">
                            <label>Тип меню</label><br>
                            <select name="type_code" class="selectpicker form-control type_code-field" id="for_menu">
                                @foreach($types as $key=>$value)
                                    <option value="{{$value->type_code}}">{{$value->name_ru}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Операция</label><br>
                            <select name="operation" class="selectpicker form-control operation-field" id="operation">
                                <option value=">">Больше</option>
                                <option value="<">Меньше</option>
                                <option value="=">Равно</option>
                            </select>
                        </div>
                    </div>
                    <div class="img-block-modal">
                        <div class="form-group">
                            <label>Параметр</label><br>
                            <input type="text" name="value" class="form-control value-field">
                        </div>
                    </div>

                </div>
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
                                <label>Название Rus</label>
                                <input type="text" name="value_ru" class="form-control value_ru-field">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                            <div class="form-group">
                                <label>Название Eng</label>
                                <input type="text" name="value_en" class="form-control value_en-field">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div>
        </div>
        <div class="modal-footer">
            <button name="insert" value='Save' type="button" class='btn btn-success actionButtonValues'> Сохранить </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        </div>
    </div>
</div>





