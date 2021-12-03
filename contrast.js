$(function(){
$('#btn').find("button").click(function() {
	$(this).css("position", "fixed;");
    $(this).css("background", "none");
    $('*').css("background-color", "black");
    $('*').css("color", "white");
    $(this).css("box-shadow", "none");
    $(this).css("text-shadow", "none");
});
});
$(function(){
$('#undo').find("button").click(function() {
	$(this).css("position", "fixed;");
    $(this).css("background", "none");
    $('*').css("background-color", "");
    $('*').css("color", "");
    $(this).css("box-shadow", "none");
    $(this).css("text-shadow", "none");
});
});