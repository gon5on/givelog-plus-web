$('#logout').click(function(e) {
    firebase.auth().signOut().then(function() {
        location.href = '/logout';
    }).catch(function(error) {
        //TODO
    });
});