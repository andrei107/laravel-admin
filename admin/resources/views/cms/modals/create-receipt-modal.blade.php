<div id="createReceiptModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h3 class="name-modal"></h3>
            <div class="formPosition">
            <form id="create-receipt-modal"  class="createForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="general-for-all-languages">
                    <h4>Общее для всех языков</h4>
                    <div class="number-data-modal">
                        <div class="form-group">
                            <label>Номер</label><br>
                            <input type="text" name="id" class="form-control id-field">
                        </div>
                        <div class="form-group">
                            <label>Калории</label><br>
                            <input type="text" name="calories" class="form-control calories-field">
                        </div>
                        <div class="form-group">
                            <label>Кол-во человек</label><br>
                            <input type="text" name="persons" class="form-control persons-field">
                        </div>
                        <div class="form-group">
                            <label>Время</label><br>
                            <input type="text" name="time" class="form-control time_prepare-field">
                        </div>
                    </div>
                    <div class="img-block-modal">
                        <div class="form-group">
                            <label>Фотография</label><br>
                            <input type="file" name="img" id="img" class="form-control-file img-field" >
                            <input type="hidden" id="banner_loaded_image_android" name="loaded_img" accept="">
                            <br>
                        </div>
                    </div>
                    <div class="check-box-block-modal">
                        <div class="check-box-part">
                            <div class="form-group">
                                <label class="lb1">Раздел лучших рецептов</label><br>
                                <input type="checkbox" class="js-switcher-field best-field" id="best" name="best" value="1" />
                            </div>
                            <div class="form-group">
                                <label>Раздел быстрых рецептов</label><br>
                                <input type="checkbox" class="js-switcher-field fast-field" name="fast" value="1" />
                            </div>
                        </div>
                        <div class="check-box-part">
                            <div class="form-group">
                                <label>Раздел главного рецепта</label><br>
                                <input type="checkbox" class="js-switcher-field day-field" name="day" value="1" />
                            </div>
                            <div class="form-group">
                                <label>Активность</label><br>
                                <input type="checkbox" class="js-switcher-field activity-field" name="activity" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="select-block-modal">
                        <div class="form-group">
                            <label>Раздел меню</label><br>
                            <select name="for_menu" class="selectpicker form-control for_menu-field" id="for_menu">
                                @foreach($menu as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
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
                                <label>Название</label>
                                <input type="text" name="name_ru" class="form-control name_ru-field">
                            </div>
                            <div class="form-group">
                                <label>Ингридиенты</label><br>
                                <textarea class="txt-ingridient ingridients_ru-field" name="ingridients_ru" rows="3" ></textarea><br>
                            </div>
                            <div class="form-group">
                                <label>Рецепт</label><br>
                                <textarea class="txt-receipt receipt_ru-field" name="receipt_ru" rows="20"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name_en" class="form-control name_en-field">
                            </div>
                            <div class="form-group">
                                <label>Ingridients</label><br>
                                <textarea class="txt-ingridient ingridients_en-field" name="ingridients_en" rows="3" ></textarea><br>
                            </div>
                            <div class="form-group">
                                <label>Receipt</label><br>
                                <textarea class="txt-receipt receipt_en-field" name="receipt_en" rows="20"></textarea>
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





