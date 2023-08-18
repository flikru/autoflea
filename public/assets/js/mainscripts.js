$(window).on('load',function (){
    $('#change-city').on('change', function (){
        if($(this).val() == 'none' || $(this).val() == ''){
            return false;
        }
        $('.link_city').attr('href', "/"+$(this).val())+"/";
    });
    $('.parse-open-phone').on('click', function (){
        $(this).html($(this).parent().find('div').html());
    });
    $()
})
