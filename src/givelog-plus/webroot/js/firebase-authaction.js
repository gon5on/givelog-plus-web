var email;
var newPassword;

$('#save').click(function(e) {
    let mode = getParameterByName('mode');
    let actionCode = getParameterByName('oobCode');
    let continueUrl = getParameterByName('continueUrl');
    let lang = getParameterByName('lang') || 'ja';

    var auth = firebase.auth();

    switch (mode) {
        case 'resetPassword':
            handleResetPassword(auth, actionCode, continueUrl, lang);
            break;
        default:
            location.href = '/';
    }
});

function handleResetPassword(auth, actionCode, continueUrl, lang) {
    var newPassword = $('#password').val();
    var passwordConfirm = $('#passwordconfirm').val();

    if (newPassword != passwordConfirm) {
        console.log('PWが一致しない');
        return;
    }

    auth.verifyPasswordResetCode(actionCode).then(function(email) {
        auth.confirmPasswordReset(actionCode, newPassword).then(function(resp) {
            $('#input').hide();
            $('#finish').show();

            window.email = email;
            window.newPassword = newPassword;

        }).catch(function(error) {
            //TODO エラー処理
            console.log(error);
        });
    }).catch(function(error) {
        //TODO エラー処理
        console.log(error);
    });
}

$('#newPasswordLogin').click(function(e) {
    $('#loginForm').attr('action', '/login');

    doFirebaseLogin(email, newPassword);
});

function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}