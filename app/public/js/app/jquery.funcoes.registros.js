$(function ($) {
    $('div#novo-registro').on('shown.bs.modal', function (event) {
        $(this).find('.modal-header h5.modal-title').html('Novo registro');

        $.ajax({
            type: "POST",
            url: "/registro/novo",
            beforeSend: function () {
                $('div#novo-registro').find('.preload').fadeIn('slow');
            },
            success: function (response) {
                $('div#novo-registro').find('div.modal-content .form').html(response);
            },
            error: function () {

            },
            complete: function () {
                $('div#novo-registro').find('.preload').fadeOut('slow');
            },
        });
    });

    $('div#novo-registro').on('hidden.bs.modal', function (event) {
        $(this).find('.modal-header h5.modal-title').html('');
        $(this).find('div.modal-content .form').html('');
    });

    $('div#novo-registro').on('click', 'button.save', function (event) {
        var form = $('form[name=registro]');

        $.ajax({
            type: "POST",
            url: "/registro/inserir",
            data: form.serialize(),
            beforeSend: function () {
                $('div#update-registro').find('.preload').fadeIn('slow');
            },
            success: function (response) {
                Swal.fire(response.title, response.msg, response.type).then(function () {
                    if (response.reload) {
                        window.location.reload();
                    }
                });
            },
            error: function () {

            },
            complete: function () {
                $('.preload').fadeOut('slow');
            }
        });
    });

    $('div#update-registro').on('shown.bs.modal', function (event) {
        let id = $(event.relatedTarget).data('idregistro');
        let data = $(event.relatedTarget).data('dtregistro');

        $(this).find('.modal-header h5.modal-title').html('Atualizar registro ' + data);

        if (id) {
            $.ajax({
                type: "POST",
                url: "/registro/detalhe",
                data: {'id': id},
                beforeSend: function () {
                    $('div#update-registro').find('.preload').fadeIn('slow');
                },
                success: function (response) {
                    $('div#update-registro').find('div.modal-content .form').html(response);
                },
                error: function () {

                },
                complete: function () {
                    $('div#update-registro').find('.preload').fadeOut('slow');
                },
            });
        }
    });

    $('div#update-registro').on('hidden.bs.modal', function (event) {
        $(this).find('.modal-header h5.modal-title').html('');
        $(this).find('div.modal-content .form').html('');
    });

    $('div#update-registro').on('click', 'button.save', function (event) {
        var form = $('form[name=registro]');

        $.ajax({
            type: "POST",
            url: "/registro/update",
            data: form.serialize(),
            beforeSend: function () {
                $('div#update-registro').find('.preload').fadeIn('slow');
            },
            success: function (response) {
                Swal.fire(response.title, response.msg, response.type).then(function () {
                    if (response.reload) {
                        window.location.reload();
                    }
                });
            },
            error: function () {

            },
            complete: function () {
                $('.preload').fadeOut('slow');
            }
        });
    });

    $('.delete-registro').on('click', function (event) {
        event.preventDefault();

        let id = $(this).data('idregistro');

        Swal.fire({
            title: 'Você tem certeza?',
            text: "Você deseja excluir o registro?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/registro/delete",
                    data: {'id': id},
                    beforeSend: function () {
                        $('.preload').fadeIn('slow');
                    },
                    success: function (response) {
                        Swal.fire(response.title, response.msg, response.type).then(function () {
                            if (response.reload) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function () {

                    },
                    complete: function () {
                        $('.preload').fadeOut('slow');
                    }
                });
            }
        });
    });
});