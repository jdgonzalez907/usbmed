/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var myLanguage = {
    errorTitle: 'Falló el envío del formulario!',
    requiredField: 'Campo obligatorio',
    badTime: 'Hora incorrecta',
    badEmail: 'Correo incorrecto',
    badTelephone: 'Número de telefono incorrecto',
    badSecurityAnswer: 'Respuesta de seguridad incorrecta',
    badDate: 'Fecha incorrecta',
    lengthBadStart: 'El valor debe estar entre ',
    lengthBadEnd: ' caracteres',
    lengthTooLongStart: 'El valor no puede ser mayor a ',
    lengthTooShortStart: 'El valor no puede ser menor a ',
    notConfirmed: 'Los vaalores no son iguales',
    badDomain: 'Dominio incorrecto',
    badUrl: 'Url incorrecta',
    badCustomVal: 'Valor incorrecto',
    andSpaces: ' y espacios ',
    badInt: 'Número incorrecto',
    badSecurityNumber: 'Your social security number was incorrect',
    badUKVatAnswer: 'Incorrect UK VAT Number',
    badStrength: 'La contraseña no es lo suficientemente fuerte',
    badNumberOfSelectedOptionsStart: 'Debe elegir al menos ',
    badNumberOfSelectedOptionsEnd: ' respuestas',
    badAlphaNumeric: 'Solo se permiten valores alfanuméricos ',
    badAlphaNumericExtra: ' y ',
    wrongFileSize: 'Archivo demasiado grande (máximo %s)',
    wrongFileType: 'Solo se permiten archivos del tipo %s',
    groupCheckedRangeStart: 'Elija entre ',
    groupCheckedTooFewStart: 'Elija por lo menos ',
    groupCheckedTooManyStart: 'Elija máximo ',
    groupCheckedEnd: ' item(s)',
    badCreditCard: 'Número de tarjeta de crédito incorrecto',
    badCVV: 'The CVV number was not correct',
    wrongFileDim: 'Dimensiones de imagen incorrectas,',
    imageTooTall: 'el alto de la imagen no puede ser mayor que',
    imageTooWide: 'el ancho de la imagen no puede ser mayor que',
    imageTooSmall: 'la imagen es demasiado pequeña',
    min: 'mínimo',
    max: 'máximo',
    imageRatioNotAccepted: 'Proporción de la imagen incorrecta'
};

var myLanguageTable = {
    'language': {
        "decimal": "",
        "emptyTable": "Sin datos para mostrar",
        "info": "Mostrando _START_ de _END_, _TOTAL_ registro(s) en total",
        "infoEmpty": "Mostrando 0 to 0, 0 registro(s) en total",
        "infoFiltered": "(filtrado de _MAX_ registro(s))",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrando _MENU_ registro(s)",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": activate to sort column ascending",
            "sortDescending": ": activate to sort column descending"
        }
    }
}

$('#modal_usbmed').modal({
    keyboard: false,
    show: false,
    backdrop: 'static'
})

$('#modal_usbmed').on('hide.bs.modal', function (event) {
    $('#modal_usbmed_title').html('');
    $('#modal_usbmed_body').html('');
})