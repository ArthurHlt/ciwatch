$(document).ready(function () {
    $('.addRepoButton').change(function () {
        var form = $(this).parent().parent().parent();
        console.log(form.attr('method'));
        form.alajax();
        form.submit();
    });
});
