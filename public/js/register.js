$(document).ready(function() {
    $('#username').on('input', function() {
        var username = $(this).val();
        var feedback = $('#username-feedback');

        if (username.length < 3 || username.length > 18 || !/^[a-zA-Z0-9]+$/.test(username)) {
            feedback.text("Le nom d'utilisateur doit comporter entre 3 et 18 lettres ou chiffres.")
                    .removeClass('text-success').addClass('text-danger');
            return;
        }

        $.get('/check-username', { username: username }, function(data) {
            if (data.available) {
                feedback.text('Nom d\'utilisateur disponible')
                        .removeClass('text-danger').addClass('text-success');
            } else {
                feedback.text('Nom d\'utilisateur d\u00e9j\u00e0 pris')
                        .removeClass('text-success').addClass('text-danger');
            }
        }, 'json');
    });
});
