$(document).ready(function() {
    $('#marca').change(function() {
        const brandName = $(this).val(); // Obtén la marca seleccionada
        $.ajax({
            url: '/ProyectoEstacionamientos_3B/js/filterModel.php', // Ruta absoluta desde la raíz            type: 'GET',
            data: { marca: brandName },
            success: function(data) {
                $('#modelo').html(data); // Actualiza el dropdown de modelos con la respuesta del servidor
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown); // Manejo de errores
            }
        });
    });
});
