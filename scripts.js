$(document).ready(function() {
    $('table tbody tr').click(function() {
        window.location = $(this).find('a').attr('href');
    });
});
