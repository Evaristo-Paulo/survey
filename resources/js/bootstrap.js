window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the 'XSRF' token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js')

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

var user_id = $('#logado').attr("data-logado");
console.log(user_id)

window.Echo.private(`enquete.${user_id}`).listen('VotoRegistado', (data) => {
    var dados = data.dado

    console.log(dados)

    $('.feeds_widget').empty();

    $('#alerta_notificacao').hide();
    $('.notificacao').append("<span class='badge badge-danger nav-unread'></span>");

    for (let i = 0; i < dados.length; i++) {
        var parametro = Array();

        var enquete_id = dados[i]['enquete_id']
        var alternativa_id = dados[i]['alternativa_id']

        $('.feeds_widget').append(
            "<li><div class='feeds-left'><i class='fa fa-thumbs-o-up'></i></div><a href='enquetes/" + enquete_id+ "/notificacao/" +alternativa_id + "/leitura' class='feeds-body'><h4 class='title text-danger'>" + dados[i]['titulo'] + "<small class='float-right text-muted'>+1</small></h4><small>" + dados[i]['descricao']  + "</small></a></li>"
        );
    }

});
