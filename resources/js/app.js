require('./bootstrap');

window.Echo.channel('notificacion')
.listen('IniciarSesion', (e) => {
    console.log('pippo');
});
