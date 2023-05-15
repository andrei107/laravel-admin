import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function() {


$.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    method: "GET",
    url: '/home/creating-filter/load',
    contentType: false,
    processData: false,
    success: function (response) {
        var rows = [];

        $.each(response.data, function (index, value) {
                rows.push(`
                    <tr style="text-align:center">
                        <td>${value.id}</td>
                        <td>${value.code_ru}</td>
                        <td>${value.code_en}</td>
                        <td>${value.name_ru}</td>
                        <td>${value.name_en}</td>
                        <td>${value.type_ru}</td>
                        <td>${value.type_en}</td>
                        <td>
                            <i style="cursor:pointer" class="fa fa-pencil editFilter fa-lg"  aria-hidden="true" data-id="${value.id}"></i>
                            <i style="cursor:pointer" class="fa fa-trash removeFilter fa-lg" aria-hidden="true" data-id="${value.id}"></i>
                        </td>
                    </tr>
                `)
        });

        $('thead').append(rows)
    }
});

    $('.createFilterModal').on('click', function(){
        correctModal('create');
    })

    function correctModal(code){
        if( code === 'create'){
            $('.name-modal').text('Создание фильтра');
            $('.actionButton').addClass('create-filter-button').removeClass('edit-filter-button');
        }
        if( code == 'edit'){
            $('.name-modal').text('Редактирование фильтра');
            $('.actionButton').addClass('edit-filter-button').removeClass('create-filter-button');
        }
    }

    function getParams(){
        var filterDataObj = {
            name_ru: $('.name_ru-field').val(),
            type_ru: $('.type_ru-field').val(),
            code_ru: $('.code_ru-field').val(),
            name_en: $('.name_en-field').val(),
            type_en: $('.type_en-field').val(),
            code_en: $('.code_en-field').val(),
        },
        arr = [];

        //additional
        $('.filterValueInput').each(function(index, element){
            filterDataObj['value_ru'] = arr.push($(element).val())
            filterDataObj['value_en'] = arr.push($(element).val())
        })

        return filterDataObj;
    }

    $(document).on('click', '.addValue', function(){
        var elem,
            id;

        if($('.addedElem').length){

            $('.filterValueInput').each(function(){
                currentIndex = $(this).val() * 1;
                max = max < currentIndex ? currentIndex : max;

                id = max + 1;
            })
        } else {
            id = 1;
        }

        elem = `<div style="display:flex">
                    <input type="text" name="value_ru" class="form-control filterValueInput" data-id="${id}">
                    <i style="cursor:pointer; padding-left:10px;" class="fa fa-trash removeElementValue fa-lg" aria-hidden="true" data-id="${id}"></i>
                </div>`

        $('.addedValuesRu').append(elem);
        $('.addedValuesEn').append(elem);
    })

    $(document).on('click', '.removeElementValue', function(){
        $(this).remove();
    })



    $(document).on('click', '.create-filter-button', function(){
        var filterDataObj = getParams(),
             formData = new FormData();

        for(var filterVariable in filterDataObj){
            formData.append(filterVariable, filterDataObj[filterVariable]);
        }

        showSuccess('Сохранение фильтра', {setTimer: false});

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/filter/add',
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				hideSuccess();

				if (response.status === 'success') {
                    location.reload();
				} else {
					showError('Ошибка сохранения');
				}
			}
		});
    })

    $(document).on('click', '.removeFilter', function(){
        var elem = $(this).data('id');

        showSuccess('Удаление', {setTimer: false});

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/receipt/delete',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
               hideSuccess();

				if (response.status === 'success') {
                    location.reload();
				} else {
					showError('Ошибка удаления');
				}
			}
		});
    })


    $(document).on('click', '.removeElementValue', function(){
        var elem = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/filter/deleteValue',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
               hideSuccess();

				if (response.status === 'success') {

				} else {
					showError('Ошибка удаления');
				}
			}
		});
    })


    $(document).on('click', '.edit-filter-button', function(){
        var formData = new FormData();
        var filterDataObj = getParams();

        for(var filterVariable in filterDataObj){
            formData.append(filterVariable, filterDataObj[filterVariable]);
        }

        showSuccess('Сохранение фильтра', {setTimer: false});

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/filter/edit',
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				hideSuccess();

				if (response.status === 'success') {
                    location.reload();
				} else {
					showError('Ошибка сохранения');
				}
			}
		});
    })


    $(document).on('click', '.editFilter', function(){
        var elem = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/filter/read',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
                $('.createFilterModal').trigger('click');
                correctModal('edit');
                for (var param in response.data) {




                    var field = $('.createForm').find('[name="' + param + '"]'),
                    value = response.data[param];
                    if(param != 'img'){
                        field.val(value);

                        if(field.attr('type') === 'checkbox' && value == 1){
                            field.prop('checked', true);
                        }
                    }
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
