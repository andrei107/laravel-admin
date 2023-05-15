import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function() {


function update(response){
    var rows = [];
    $.each(response.menu, function (index, value) {
        rows.push(`
            <tr style="text-align:center">
                <td>${value.id}</td>
                <td>${value.menu_id}</td>
                <td>${value.name_ru}</td>
                <td>
                    <i style="cursor:pointer" class="fa fa-pencil editMenu fa-lg"  aria-hidden="true" data-id="${value.id}"></i>
                    <i style="cursor:pointer" class="fa fa-trash removeMenu fa-lg" aria-hidden="true" data-id="${value.id}"></i>
                </td>
            </tr>
        `)
});

$('thead').append(rows)
}


$.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    method: "GET",
    url: '/home/menu/load',
    contentType: false,
    processData: false,
    success: function (response) {
        update(response);
    }
});


    $('.createMenuModal').on('click', function(){
        correctModal('create');
    })

    function correctModal(code){
        if( code === 'create'){
            $('.name-modal').text('Создание меню');
            $('.actionButton').addClass('create-menu-button').removeClass('edit-menu-button');
        }
        if( code == 'edit'){
            $('.name-modal').text('Редактирование меню');
            $('.actionButton').addClass('edit-menu-button').removeClass('create-menu-button');
        }
    }

    function getParams(){
        var menuDataObj;

        return menuDataObj = {
            id: $('.id-field').val(),
            menu_id: $('.menu_id-field').val(),
            name_ru: $('.name_ru-field').val(),
            name_en: $('.name_en-field').val(),
        }
    }


    $(document).on('click', '.create-menu-button', function(){
        var menuDataObj = getParams(),
             formData = new FormData();

        for(var menuVariable in menuDataObj){
            formData.append(menuVariable, menuDataObj[menuVariable]);
        }

        showSuccess('Сохранение меню');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/menu/add',
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				setTimeout(hideSuccess, 2000);
				if (response.status === 'success') {
                    update(response);
				} else {
					showError(response.message);
                    setTimeout(hideError, 2000);
				}
			}
		});
    })

    $(document).on('click', '.editMenu', function(){
        var elem = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/menu/read',
            data: {id: elem},
            dataType: "json",
			success: function (response) {
                $('.createMenuModal').trigger('click');
                correctModal('edit');
                for (var param in response.data) {
                    var field = $('.createForm').find('[name="' + param + '"]'),
                    value = response.data[param];

                    field.val(value);
                    $('.actionButton').attr('data-id', elem)
                }
            }
		});
    })

    $(document).on('click', '.removeMenu', function(){
        var elem = $(this).data('id');

        showSuccess('Удаление');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/menu/delete',
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

    $(document).on('click', '.edit-menu-button', function(){
        var formData = new FormData();
        var menuDataObj = getParams();
            menuDataObj.id = $('.actionButton').data('id');

        for(var menuVariable in menuDataObj){
            formData.append(menuVariable, menuDataObj[menuVariable]);
        }

        showSuccess('Сохранение меню');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
			method: "POST",
			url: '/home/menu/edit',
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
                setTimeout(hideSuccess, 2000);

				if (response.status === 'success') {
                    //location.reload();
                    update(response);
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
        $successWrapper = $(".alert--success"),
        $messageWrapper = $errorWrapper.find('.alert-message');

    $messageWrapper.text(message);
    $successWrapper.hide();
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
