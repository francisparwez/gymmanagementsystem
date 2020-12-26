$('input[name="txtContactNo"]').keydown(function () {    
    
    if (event.keyCode == 8 || event.keyCode == 9
        || event.keyCode == 27 || event.keyCode == 13
        || (event.keyCode == 65 && event.ctrlKey === true))
        return;
    if ((event.keyCode < 48 || event.keyCode > 57))
        event.preventDefault();
    
    var length = $(this).val().length;

    if (length == 2)
        $(this).val($(this).val() + '-');

});

$('input[name="txtCNIC"]').keydown(function () {    
    
    if (event.keyCode == 8 || event.keyCode == 9
        || event.keyCode == 27 || event.keyCode == 13
        || (event.keyCode == 65 && event.ctrlKey === true))
        return;
    if ((event.keyCode < 48 || event.keyCode > 57))
        event.preventDefault();

    var length = $(this).val().length;

    if (length == 5 || length == 13)
        $(this).val($(this).val() + '-');

});

