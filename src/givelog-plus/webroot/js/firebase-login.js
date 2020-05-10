$('#login').click(function(e) {
    let email = $('#email').val();
    let password = $('#password').val();

    doFirebaseLogin(email, password);
});

$('#start').click(function(e) {
    $('#loginForm').attr('action', '/login?redirect=/gift/add');

    doFirebaseLogin(email, password);
});

function doFirebaseLogin(email, password) {
    firebase.auth().signInWithEmailAndPassword(email, password)
    .then(function() {
        getIdTokenAndAppLogin(false);
    })
    .catch(function(error) {
        //ログイン失敗
        let errorCode = error.code;
        let errorMessage = error.message;

        //TODO エラー表示
        console.log(errorCode);
        console.log(errorMessage);
    });
}

$('#ssoGoogle').click(function(e) {
    let provider = new firebase.auth.GoogleAuthProvider();

    firebase.auth().languageCode = 'ja';
    firebase.auth().signInWithPopup(provider).then(function(result) {
        getIdTokenAndAppLogin(result.additionalUserInfo.isNewUser);
    }).catch(function(error) {
        //TODO エラー処理
        var errorCode = error.code;
        var errorMessage = error.message;
        var email = error.email;
        var credential = error.credential;
    });
});

function getIdTokenAndAppLogin(registerFlg) {
    firebase.auth().currentUser.getIdToken(false).then(function(idToken) {
        $('input[name="token"]').val(idToken);
        $('input[name="registerFlg"]').val(registerFlg ? 1 : 0);
        $('#loginForm').submit();
    })
    .catch(function(error) {
        //TODO エラー処理
        console.log(error);
    });
}