<div id="createAdviceModal" class="modal fade" tabindex="-1" role="dialog">
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
                    </div>
                    <div class="img-block-modal">
                        <div class="form-group">
                            <label>Фотография</label><br>
                            <input type="file" name="img" id="img" class="form-control-file img-field" ><br>
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
                                <label>Краткое описание </label><br>
                                <textarea class="txt-ingridient short_ru-field" name="short_ru" rows="3" ></textarea><br>
                            </div>
                            <div class="form-group">
                                <label>Совет</label><br>
                                <textarea class="txt-receipt full_description_ru-field" name="full-description_ru" rows="20"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name_en" class="form-control name_en-field">
                            </div>
                            <div class="form-group">
                                <label>Short description</label><br>
                                <textarea class="txt-ingridient short_en-field" name="short_en" rows="3" ></textarea><br>
                            </div>
                            <div class="form-group">
                                <label>Advice</label><br>
                                <textarea class="txt-receipt  full_description_en-field" name="full-description_en" rows="20"></textarea>
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





