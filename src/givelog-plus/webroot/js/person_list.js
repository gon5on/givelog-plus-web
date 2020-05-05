$("tbody tr").on("click",function(e) {
    window.location.href = "/person/view/" + $(this).data('id');
});