$(function() {
    $("#address").on('blur', function() {
        $.ajax({
                method: "POST",
                url: "getBTCByWallet",
                data: {
                    wallet: $(this).val()
                }
            })
            .done(function(msg) {
                if(msg == 'false'){
                     $("#depositAmount").find('input').attr('max', 0)
                     $("#deposit-acknowledge").attr("disabled", "disabled").off('click');
                }
                 else {
                     $("#depositAmount").find('input').attr('max', msg)
                     $("#deposit-acknowledge").removeAttr("disabled")
                 }
            });
    })
});