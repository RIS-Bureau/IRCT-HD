/**
 * verification données utilisateur
 */
$('#register-user').click(function(){
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var password_confirm = $('#password-confirm').val();
    var passwordLength = password.length;
    var agreeTerms = $('#agreeTerms');
    if (firstname !="" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(firstname)){
        $('#firstname').removeClass('is-invalid');
        $('#firstname').addClass('is-valid');
        $('#error-register-firstname').text("");
        if(lastname !="" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(lastname)){
            $('#lastname').removeClass('is-invalid');
            $('#lastname').addClass('is-valid');
            $('#error-register-lastname').text("");
            if(email !="" && /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email)){
                $('#email').removeClass('is-invalid');
                $('#email').addClass('is-valid');
                $('#error-register-email').text("");
                if(password.match( /[0-9]/g) && (password.match( /[A-Z]/g) || password.match( /[^a-zA-Z\d]/g)) && passwordLength >= 8){
                    $('#password').removeClass('is-invalid');
                    $('#password').addClass('is-valid');
                    $('#error-register-password').text("");
                    if(password == password_confirm){
                        $('#password-confirm').removeClass('is-invalid');
                        $('#password-confirm').addClass('is-valid');
                        $('#error-register-password-confirm').text("");
                        if(agreeTerms.is(':checked')){
                            $('#agreeTerms').removeClass('is-invalid');
                            $('#error-register-agreeTerms').text("");

                            //Envoie du formulaire
                                var res = emailExistjs(email);

                                      if(res != "exist"){
                                        $('#form-register').submit();
                                      }else{
                                        $('#email').addClass('is-invalid');
                                        $('#email').removeClass('is-valid');
                                        $('#error-register-email').text("Cette adresse email existe déja!");
                                      }

                        }else{
                            $('#agreeTerms').addClass('is-invalid');
                            $('#error-register-agreeTerms').text("vous devez accepter nos termes et conditions!");
                        }
                    }else{
                        $('#password-confirm').addClass('is-invalid');
                        $('#password-confirm').removeClass('is-valid');
                        $('#error-register-password-confirm').text("Le mot de passe n'est pas identique");
                    }
                }else{
                    $('#password').addClass('is-invalid');
                    $('#password').removeClass('is-valid');
                    $('#error-register-password').text("Votre mot de passe doit contenir au minimum 8 caractéres!");
                }
            }else{
                $('#email').addClass('is-invalid');
                $('#email').removeClass('is-valid');
                $('#error-register-email').text("Votre adresse email est invalide!");
            }
        }else {
            $('#lastname').addClass('is-invalid');
            $('#lastname').removeClass('is-valid');
            $('#error-register-lastname').text("Le nom Contient des chiffres ou des caractéres invalides!");
        }
    }else{
        $('#firstname').addClass('is-invalid');
        $('#firstname').removeClass('is-valid');
        $('#error-register-firstname').text("Le nom Contient des chiffres ou des caractéres invalides!");
    }
});
//Evenement pour terms et conditions
$('#agreeTerms').change(function(){
    var agreeTerms = $('#agreeTerms');
    if (agreeTerms.is(':checked')) {
        $('#agreeTerms').removeClass('is-invalid');
        $('#error-register-agreeTerms').text("");
    } else {
        $('#agreeTerms').addClass('is-invalid');
        $('#error-register-agreeTerms').text("vous devez accepter nos termes et conditions!");
    }
})

function emailExistjs(email){
    var url = $('#email').attr('url-emailExist');
    var token = $('#email').attr('token');
    var res = "";

    $.ajax({
            type: 'POST',
            url: url,
            data: {
                '_token': token,
                email: email
            },
            success:function(result){
                res = result.response;},
                async: false
    });
    return res;
}
