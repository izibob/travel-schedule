//Сабмитим форму
$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault()
        $.ajax({
            type        : $(this).attr('method'),
            url         : $(this).attr('action'),
            data        : $(this).serialize(),
            dataType    : 'json',
            encode      : true,
            success: function(data) {
                $('#result').html("<div class='alert alert-success'>Расписание было успешно создан.</div>")
            },
            error: function (err) {
                $('#result').html("<div class='alert alert-danger'>Невозможно создать расписание.</div>")
            },
        })
        $(this)[0].reset()
    })
})

//Рассчитываем информационное поле: Дата прибытия в регион
$('#departure_date').change(function () {
    const region = $('#region').find(':selected').data('i') / 2
    const departure = Date.parse(this.value)
    const arrival_time = ((86400000 * region) + departure)
    const date = new Date(arrival_time)

    $('#arrival_date').val(date.toLocaleDateString());
})


