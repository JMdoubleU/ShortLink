$(document).ready(function() {
    var baseURL = location.protocol + "//" + location.host + "/";
    $("#create").click(function(){
        $.post("create.php", {
            url: $("#url").val(),
        },
        function(data, status){
            if (data['status'] == 0) {
                $("#message").css('color', 'red');
                $("#message").text(data['message']);
                $("#url").val("");
                $("#identifier").attr("href", "");
                $("#identifier").css("visibility", "hidden");
            } else {
                $("#message").css('color', 'blue');
                $("#message").text("URL Created!");
                $("#identifier").attr("href", baseURL + data['message']);
                $("#identifier").text(baseURL + data['message']);
                $("#identifier").css("visibility", "visible");
            }
        });
    });
});
