$('#login').click(function(e) {
    let email = $('#email').val();
    let password = $('#password').val();

    doLogin(email, password);
});

$('#start').click(function(e) {
    $('#loginForm').attr('action', '/login?redirect=/gift/add');

    doLogin(email, password);
});

function doLogin(email, password) {
    firebase.auth().signInWithEmailAndPassword(email, password)
    .then(function() {
        //ログイン成功
        firebase.auth().currentUser.getIdToken(false).then(function(idToken) {
            $('#token').val(idToken);
            $('#loginForm').submit();
        })
        .catch(function(error) {
            //TODO エラー処理
        });
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