<div id="createFilterFinalModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <h3 class="name-modalFinal"></h3>
            <div class="formPosition">
            <form id="create-filter-types-modal"  class="createForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="general-for-all-languages">
                    <h4>Общее для всех языков</h4>
                    <div class="number-data-modal">
                        <div class="form-group">
                            <label>Код</label><br>
                            <input type="text" name="type_code" class="form-control type_code-field">
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
                                <input type="text" name="name_ru" class="form-control name_ru-field">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                            <div class="form-group">
                                <label>Название Eng</label>
                                <input type="text" name="name_en" class="form-control name_en-field">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div>
        </div>
        <div class="modal-footer">
            <button name="insert" value='Save' type="button" class='btn btn-success actionButtonTypes'> Сохранить </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        </div>
    </div>
</div>





