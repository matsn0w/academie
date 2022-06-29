function savePoorten(object) {
    $.ajax({
        url: 'http://www.dutchroleplayforces.nl/drfonline/includes/savepoorten.php',
        data: {content: object.value, id: object.id},
        cache: false,
        error: function (response) {
            alert(response);
        },
        success: function (response) {
            // A response to say if it's updated or not
            location.reload();
        }
    });
}