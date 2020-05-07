$(document).ready(function() {

    $(function() {
        var $children = $('.children');
        var original = $children.html();
    
        var val1 = $('.parent').val();
    
        $children.html(original).find('option').each(function() {
            var val2 = $(this).data('val');
            if (val1 != val2) {
            $(this).remove();
            }
        });


        $('.parent').click(function() {
        var val1 = $(this).val();
    
        $children.html(original).find('option').each(function() {
            var val2 = $(this).data('val');
            if (val1 != val2) {
            $(this).remove();
            }
        });
    
        if ($(this).val() === '') {
            $children.attr('disabled', 'disabled');
        } else {
            $children.removeAttr('disabled');
        }
    
        });

    });
  
});
