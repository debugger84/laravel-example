$(document).ready(function () {
    var form = null;
    var modal = $('#clientEditModal');
    loadClients();

    modal.on('show.bs.modal', function (event) {
        form = onShowModal(event, $(this));
    });

    $('.js-save-client').click(function () {
        onSaveButtonClick(form);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});


function onShowModal(event, modal) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var client = button.data('client');
    var formElement = modal.find('.js-client-form');
    var messageContainer = formElement.find('.js-message-container');
    var form;
    messageContainer.html('');

    modal.find('.modal-title').text(title);
    formElement.on('clientSaved', function (event) {
        modal.modal('hide');
        loadClients();
    });

    form = new ClientForm(formElement);
    form.fillFormWithClient(client);

    return form;
}

function onSaveButtonClick(form) {
    if (form instanceof ClientForm) {
        form.saveClient();
    }
}

function onRemoveClientClick(button) {
    var id = button.data('client_id'),
        surname = button.data('client_surname'),
        confirmation;

    if (id) {
        confirmation = confirm('Are you sure to delete the client ' + surname);

        if (confirmation) {
            $.ajax({
                url: '/clients/' + id,
                type: 'DELETE',
                success: function(result) {
                    loadClients();
                }
            });
        }
    }
}

function loadClients() {
    $.get('/clients', function (html) {
        $('.js-clients-list-container').html(html);
        $('.js-remove-client').click(function () {
            onRemoveClientClick($(this));
        });
    });
}

function ClientForm(formElement)
{
    var form = formElement;
    
    this.fillFormWithClient = function (client) {
        form.find('input').val(function (index, value) {
            if (client[this.id] === undefined) {
                return value;
            }
            return client[this.id];
        });
    };

    this.saveClient = function () {
        var client = form.serialize();
        var action = form.prop('action');
        var inputId = form.find('input#id');
        var messageContainer = form.find('.js-message-container');

        // If the validation fails, return true and the form is processed as standard
        if(form.valid() === false) {
            return;
        }

        if (inputId.length > 0 && inputId.val() != '') {
            action += '/' + inputId.val();
        }

        messageContainer.html('');
        
        $.post(
            action,
            client,
            function(data) {
                onSaveSuccess(data, messageContainer);
            },
            "json"
        ).fail(function(data) {
            onSaveFail(data, messageContainer);
        });
    };

    var onSaveSuccess = function (data, messageContainer) {
        var html = '<div class="alert alert-success">The client has been saved successfully</div>';
        messageContainer.html(html);
        form.trigger('clientSaved')
    };

    var onSaveFail = function (data, messageContainer) {
        var html = '<div class="alert alert-danger">';
        var errors = [];

        if (data) {
            if (data.errors) {
                errors = data.errors;
            } else {
                $.each(data, function (key, value) {
                    errors.push(value)
                });
            }
        }

        if (errors.length > 0) {
            html += errors.join('<br>');
        } else {
            html += 'Unhandled error has been raised.';
        }

        html += '</div>';

        messageContainer.html(html);
    }
}