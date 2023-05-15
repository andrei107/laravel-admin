import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function() {

    //общая загрузка
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        method: "GET",
        url: '/home/creating-filter/load',
        contentType: false,
        processData: false,
        success: function (response) {
            var rowsTypes = [],
                rowsValues = [],
                type_code = [];

            $.each(response.types, function (index, value) {
                value.activity = value.activity ? 'Да' : 'Нет';
                type_code[value.type_code] = value.name_ru;
                rowsTypes.push(`
                        <tr style="text-align:center">
                            <td>${value.id}</td>
                            <td>${value.type_code}</td>
                            <td>${value.name_ru}</td>

                            <td>${value.activity}</td>
                            <td>
                                <i style="cursor:pointer" class="fa fa-pencil editFilterTypes fa-lg"  aria-hidden="true" data-id="${value.id}"></i>
                                <i style="cursor:pointer" class="fa fa-trash removeFilterTypes fa-lg" aria-hidden="true" data-id="${value.id}"></i>
                            </td>
                        </tr>
                    `)
            });
            $('.filterTypesHead').append(rowsTypes)

            $.each(response.values, function (index, value) {
                rowsValues.push(`
                        <tr style="text-align:center">
                            <td>${value.id}</td>
                            <td>${type_code[value.type_code]}</td>
                            <td>${value.value_ru}</td>

                            <td>
                                <i style="cursor:pointer" class="fa fa-pencil editFilterValues fa-lg"  aria-hidden="true" data-id="${value.id}"></i>
                                <i style="cursor:pointer" class="fa fa-trash removeFilterValues fa-lg" aria-hidden="true" data-id="${value.id}"></i>
                            </td>
                        </tr>
                    `)
            });
            $('.filterValuesHead').append(rowsValues)
        }
    });



    //создание типа
    $('.createFilterTypesModal').on('click', function(){
        correctModalTypes('create');
    })

    function correctModalTypes(code){
        if( code === 'create'){
            $('.name-modalTypes').text('Создание типа фильтра');
            $('.actionButtonTypes').addClass('create-filter-types-button').removeClass('edit-filter-types-button');
        }
        if( code == 'edit'){
            $('.name-modalTypes').text('Редактирование типа фильтра');
            $('.actionButtonTypes').addClass('edit-filter-types-button').removeClass('create-filter-types-button');
        }
    }

    function getParamsForTypes(){
        var typesDataObj;

        return typesDataObj = {
            id: $('.id-field').val(),
            type_code: $('.type_code-field').val(),
            name_ru: $('.name_ru-field').val(),
            name_en: $('.name_en-field').val(),
            activity: $('.activity-field:checked').val(),
        }
    }

    $(document).on('click', '.create-filter-types-button', function(){
        var typesDataObj = getParamsForTypes(),
             formData = new FormData();

        for(var typesVariable in typesDataObj){
            formData.append(typesVariable, typesDataObj[typesVariable]);
        }

        showSuccess('Сохранение типа фильтра');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/creating-filter/addType',
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				hideSuccess();

				if (response.status === 'success') {
                    location.reload();
				} else {
					showError('Ошибка сохранения');
                    setTimeout(hideError, 2000);
				}
			}
		});
    })


//создание значения
    $('.createFilterValuesModal').on('click', function(){
        correctModalValues('create');
    })

    function correctModalValues(code){
        if( code === 'create'){
            $('.name-modalValues').text('Создание значения фильтра');
            $('.actionButtonValues').addClass('create-filter-values-button').removeClass('edit-filter-values-button');
        }
        if( code == 'edit'){
            $('.name-modalValues').text('Редактирование значения фильтра');
            $('.actionButtonValues').addClass('edit-filter-values-button').removeClass('create-filter-values-button');
        }
    }

    function getParamsForValues(){
        var valuesDataObj;

        return valuesDataObj = {
            id: $('.id-field').val(),
            type_code: $('.type_code-field').val(),
            value: $('.value-field').val(),
            name_en: $('.value_en-field').val(),
            value_ru: $('.value_ru-field').val(),
            operation: $('.operation-field').val(),
        }
    }

    $(document).on('click', '.create-filter-values-button', function(){
        var valuesDataObj = getParamsForValues(),
             formData = new FormData();

        for(var valuesVariable in valuesDataObj){
            formData.append(valuesVariable, valuesDataObj[valuesVariable]);
        }

        showSuccess('Сохранение значения фильтра');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/creating-filter/addValue',
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				hideSuccess();
				if (response.status === 'success') {
                    location.reload();
				} else {
					showError('Ошибка сохранения');
                    setTimeout(hideError, 2000);
				}
			}
		});
    })


    //удаление типа
    $(document).on('click', '.removeFilterTypes', function(){
        var elem = $(this).data('id');

        showSuccess('Удаление');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/creating-filter/deleteType',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
               hideSuccess();

				if (response.status === 'success') {
                    location.reload();
				} else {
					showError('Ошибка удаления');
                    setTimeout(hideError, 2000);
				}
			}
		});
    })


     //удаление значения
     $(document).on('click', '.removeFilterValues', function(){
        var elem = $(this).data('id');

        showSuccess('Удаление');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/creating-filter/deleteValue',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
               hideSuccess();

				if (response.status === 'success') {
                    location.reload();
				} else {
					showError('Ошибка удаления');

                    setTimeout(hideError, 2000);
				}
			}
		});
    })

    //чтение типов
    $(document).on('click', '.editFilterTypes', function(){
        var elem = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/creating-filter/readTypes',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
                $('.createFilterTypesModal').trigger('click');
                correctModalTypes('edit');
                for (var param in response.data) {
                    var field = $('#create-filter-types-modal').find('[name="' + param + '"]'),
                    value = response.data[param];

                    if(field.attr('type') === 'checkbox' && value == 1){
                        field.prop('checked', true);
                    } else {
                        field.val(value);
                    }

                    $('.actionButtonTypes').attr('data-id', elem)
                }
            }
		});
    })

    //чтение значений
    $(document).on('click', '.editFilterValues', function(){
        var elem = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/creating-filter/readValues',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
                $('.createFilterValuesModal').trigger('click');
                correctModalValues('edit');
                for (var param in response.data) {
                    var field = $('#create-filter-values-modal').find('[name="' + param + '"]'),
                    value = response.data[param];

                    field.val(value);
                    $('.actionButtonValues').attr('data-id', elem)
                }
            }
		});
    })

    //редактирование типов
    $(document).on('click', '.edit-filter-types-button', function(){
        var formData = new FormData();
        var typesDataObj = getParamsForTypes();
            typesDataObj.id = $('.actionButtonTypes').data('id');

        for(var typesVariable in typesDataObj){
            formData.append(typesVariable, typesDataObj[typesVariable]);
        }

        showSuccess('Сохранение типа');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/creating-filter/editTypes',
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				hideSuccess();

				if (response.status === 'success') {
                    location.reload();
				} else {
					showError('Ошибка сохранения');
                    setTimeout(hideError, 2000);
				}
			}
		});
    })

    //редактирование значений
    $(document).on('click', '.edit-filter-values-button', function(){
        var formData = new FormData();
        var valuesDataObj = getParamsForTypes();
            valuesDataObj.id = $('.actionButtonValues').data('id');

        for(var valuesVariable in valuesDataObj){
            formData.append(valuesVariable, valuesDataObj[valuesVariable]);
        }

        showSuccess('Сохранение значения');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/creating-filter/editValues',
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				hideSuccess();

				if (response.status === 'success') {
                    location.reload();
				} else {
					showError('Ошибка сохранения');
                    setTimeout(hideError, 2000);
				}
			}
		});
    })

function showError(message) {
    var $alertWrapper = $(".alert-wrapper"),
        $errorWrapper = $(".alert--error"),
        $messageWrapper = $errorWrapper.find('.alert-message');

    $messageWrapper.text(message);

    $alertWrapper.show();
    $errorWrapper.show(500);
}

function hideError() {
    var  $alertWrapper = $(".alert-wrapper"),
    $errorWrapper = $(".alert--error");

    $errorWrapper.hide(500);
	$alertWrapper.hide();
}


function showSuccess(message) {
    var $alertWrapper = $(".alert-wrapper"),
        $successWrapper = $(".alert--success"),
        $messageWrapper = $successWrapper.find('.alert-message');

    $messageWrapper.text(message);

    $alertWrapper.show();
    $successWrapper.show(500);
}

function hideSuccess() {
    var $alertWrapper = $(".alert-wrapper"),
        $successWrapper = $(".alert--success");

    $successWrapper.hide(500);
	$alertWrapper.hide();
}


})
