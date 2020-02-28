$(document).ready(function(){

    //табы в админ панели
    $(document).ready(function(){
        $('.admin-tab>h3').click(function(){
            $(this).closest('.admin-tab').toggleClass('active');
        });
    });

});