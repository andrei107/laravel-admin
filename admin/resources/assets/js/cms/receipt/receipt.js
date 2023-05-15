import $ from 'jquery';
import { toInteger } from 'lodash';
window.$ = window.jQuery = $;

$(document).ready(function() {


$.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    method: "GET",
    url: '/home/receipt/load',
    contentType: false,
    processData: false,
    success: function (response) {
        var rows = [],
            menuArray = response.menu;

        $.each(response.allReceipts, function (index, value) {

            value.fast = value.fast ? 'Да' : 'Нет';
            value.best = value.best ? 'Да' : 'Нет';
            value.day = value.day ? 'Да' : 'Нет';
            value.activity = value.activity ? 'Да' : 'Нет';

                rows.push(`
                    <tr style="text-align:center">
                        <td>${value.id}</td>
                        <td>${value.name_ru}</td>
                        <td>${value.activity}</td>
                        <td>${value.best}</td>
                        <td>${value.day}</td>
                        <td>${value.fast}</td>
                        <td>${menuArray[parseInt(value.for_menu.match(/\d+/))-1]}</td>
                        <td>
                            <i style="cursor:pointer" class="fa fa-pencil editReceipt fa-lg"  aria-hidden="true" data-id="${value.id}"></i>
                            <i style="cursor:pointer" class="fa fa-trash removeReceipt fa-lg" aria-hidden="true" data-id="${value.id}"></i>
                        </td>
                    </tr>
                `)
        });

        $('thead').append(rows)
    }
});

    $('.createModal').on('click', function(){
        correctModal('create');
    })

    function correctModal(code){
        if( code === 'create'){
            $('.name-modal').text('Создание рецепта');
            $('.actionButton').addClass('create-receipt-button').removeClass('edit-receipt-button');
        }
        if( code == 'edit'){
            $('.name-modal').text('Редактирование рецепта');
            $('.actionButton').addClass('edit-receipt-button').removeClass('create-receipt-button');
        }
    }

    function getParams(){
        var receiptDataObj;

        return receiptDataObj = {
            id: $('.id-field').val(),
            calories: $('.calories-field').val(),
            persons: $('.persons-field').val(),
            time: $('.time_prepare-field').val(),
            img:$('.img-field').val(),
            best: $('.best-field:checked').val(),
            fast: $('.fast-field:checked').val(),
            day: $('.day-field:checked').val(),
            activity: $('.activity-field:checked').val(),
            for_menu: $('.for_menu-field').val(),
            name_ru: $('.name_ru-field').val(),
            ingridients_ru: $('.ingridients_ru-field').val(),
            receipt_ru: $('.receipt_ru-field').val(),
            name_en: $('.name_en-field').val(),
            ingridients_en: $('.ingridients_en-field').val(),
            receipt_en: $('.receipt_en-field').val()
        }
    }


    $(document).on('click', '.create-receipt-button', function(){
        var receiptDataObj = getParams(),
             formData = new FormData();

        for(var receiptVariable in receiptDataObj){
            formData.append(receiptVariable, receiptDataObj[receiptVariable]);
        }

        $.each(
            $('.img-block-modal'),
            function(fileWrapperIndex, fileWrapperNode) {
                var fileWrapper = $(fileWrapperNode),
                    fileInput = fileWrapper.find('input[type="file"]'),
                    hiddenInput = fileWrapper.find('input[type="hidden"]'),
                    file = fileInput.get(0).files[0],
                    fileName = hiddenInput.val();

                if (file) {
                    formData.append(fileInput.attr('name'), file);
                } else {
                    formData.append(hiddenInput.attr('name'), fileName);
                }
            }
        );

        showSuccess('Сохранение рецепта');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/receipt/add',
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


    $(document).on('click', '.editReceipt', function(){
        var elem = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/receipt/read',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
                $('.createModal').trigger('click');
                correctModal('edit');
                for (var param in response.data) {
                    var field = $('.createForm').find('[name="' + param + '"]'),
                    value = response.data[param];
                    if(param != 'img'){
                        field.val(value);

                        if(field.attr('type') === 'checkbox' && value == 1){
                            field.prop('checked', true);
                        }
                    } else {
                        var smallImg = '<img src="' + response.data['img']+'" style="width:50px; height:50px;">';
                        $('.img-block-modal').append(smallImg)
                    }
                }
            }
		});
    })

    $(document).on('click', '.removeReceipt', function(){
        var elem = $(this).data('id');

        showSuccess('Удаление');

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
                    setTimeout(hideError, 2000);
				}
			}
		});
    })

    $(document).on('click', '.edit-receipt-button', function(){
        var formData = new FormData();
        var receiptDataObj = getParams();

        for(var receiptVariable in receiptDataObj){
            formData.append(receiptVariable, receiptDataObj[receiptVariable]);
        }

        showSuccess('Сохранение рецепта', {setTimer: false});

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/receipt/edit',
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
