$(document).ready(function(){
    $(".draggable").draggable({
        containment: "#canvas"
    });

    $("#saveBtn").click(function(){
        html2canvas($("#canvas")[0]).then(function(canvas) {
            var img = canvas.toDataURL("image/png");
            var link = document.createElement('a');
            link.href = img;
            link.download = 'problem1_potatohead.png';
            link.click();
        });
    });
    $('#eyesSelection').change(function() {
        $('#eyes').attr('src', $(this).val());
    });
    $('#noseSelection').change(function() {
        $('#nose').attr('src', $(this).val());
    });
    $('#mouthSelection').change(function() {
        $('#mouth').attr('src', $(this).val());
    });
    $('#hatSelection').change(function() {
        $('#hat').attr('src', $(this).val());
    });
    
    $('.gallery-image').hover(function() {
        $(this).addClass('fullscreen');
        $('.close-icon').show();
    });
    $('.close-icon').click(function() {
        $('.gallery-image.fullscreen').removeClass('fullscreen');
        $(this).hide();
    });
});
