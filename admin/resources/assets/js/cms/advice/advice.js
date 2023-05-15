import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function() {

$.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    method: "GET",
    url: '/home/advice/load',
    contentType: false,
    processData: false,
    success: function (response) {
        var rows = [];

        $.each(response.data, function (index, value) {
                rows.push(`
                    <tr style="text-align:center">
                        <td>${value.id}</td>
                        <td>${value.name_ru}</td>
                        <td>${value.short_ru}</td>
                        <td>
                            <i style="cursor:pointer" class="fa fa-pencil editAdvice fa-lg"  aria-hidden="true" data-id="${value.id}"></i>
                            <i style="cursor:pointer" class="fa fa-trash removeAdvice fa-lg" aria-hidden="true" data-id="${value.id}"></i>
                        </td>
                    </tr>
                `)
        });

        $('thead').append(rows)
    }
});

    $('.createAdviceModal').on('click', function(){
        correctModal('create');
    })

    function correctModal(code){
        if( code === 'create'){
            $('.name-modal').text('Создание совета');
            $('.actionButton').addClass('create-advice-button').removeClass('edit-advice-button');
        }
        if( code == 'edit'){
            $('.name-modal').text('Редактирование совета');
            $('.actionButton').addClass('edit-advice-button').removeClass('create-advice-button');
        }
    }

    function getParams(){
        var adviceDataObj;

        return adviceDataObj = {
            id: $('.id-field').val(),
            img:$('.img-field').val(),
            name_ru: $('.name_ru-field').val(),
            short_ru: $('.short_ru-field').val(),
            full_description_ru: $('.full_description_ru-field').val(),
            name_en: $('.name_en-field').val(),
            short_en: $('.short_en-field').val(),
            full_description_en: $('.full_description_en-field').val()
        }
    }

    $(document).on('click', '.create-advice-button', function(){
        var adviceDataObj = getParams(),
             formData = new FormData();

        for(var adviceVariable in adviceDataObj){
            formData.append(adviceVariable, adviceDataObj[adviceVariable]);
        }

        showSuccess('Сохранение совета');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/advice/add',
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


    $(document).on('click', '.editAdvice', function(){
        var elem = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/advice/read',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
                $('.createAdviceModal').trigger('click');
                correctModal('edit');
                for (var param in response.data) {
                    var field = $('.createForm').find('[name="' + param + '"]'),
                    value = response.data[param];
                    if(param != 'img'){
                        field.val(value);
                    }
                }
            }
		});
    })

    $(document).on('click', '.removeAdvice', function(){
        var elem = $(this).data('id');

        showSuccess('Удаление');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/advice/delete',
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

    $(document).on('click', '.edit-advice-button', function(){
        var formData = new FormData();
        var adviceDataObj = getParams();

        for(var adviceVariable in adviceDataObj){
            formData.append(adviceVariable, adviceDataObj[adviceVariable]);
        }

        showSuccess('Сохранение рецепта');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/advice/edit',
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

