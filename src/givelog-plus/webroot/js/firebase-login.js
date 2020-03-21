$('#login').click(function(e) {
    var email = $('#email').val();
    var password = $('#password').val();

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
        var errorCode = error.code;
        var errorMessage = error.message;

        //TODO エラー表示
        console.log(errorCode);
        console.log(errorMessage);
    });
});