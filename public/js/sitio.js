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
    notConfirmed: 'Valores no confirmados',
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

$.validate({
    language: myLanguage,
});