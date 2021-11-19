$(function(){
$('#btn').click(function() {
	$(this).css("position", "fixed;");
    $(this).css("background", "none");
    $('*').css("background-color", "yellow");
    $(this).css("color", "black");
    $(this).css("box-shadow", "none");
    $(this).css("text-shadow", "none");
});
});