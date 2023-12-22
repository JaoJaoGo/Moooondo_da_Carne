$(document).ready(function () {
    mensagemErro();
});

function mensagemErro() {
    if(typeof erroLogin !== 'undefined' && erroLogin) {
        var erroL = $(".mensagemErroLogin");
        erroL.fadeIn("fast");
    }

    if(typeof erroCadastroSenha !== 'undefined' && erroCadastroSenha) {
        var erroCS = $(".mensagemErroCadastroSenha");
        erroCS.fadeIn("fast");
        toggleLogin();
    }

    if(typeof erroCadastroEmail !== 'undefined' && erroCadastroEmail) {
        var erroCE = $(".mensagemErroCadastroEmail");
        erroCE.fadeIn("fast");
        toggleLogin();
    }
    
    if(typeof erroCadastroDuplicado !== 'undefined' && erroCadastroDuplicado) {
        var erroCD = $(".mensagemErroCadastroDuplicado");
        erroCD.fadeIn("fast");
        toggleLogin();
    }
}

function toggleLogin() {
    var box = $(".box");
    var login = $(".login");
    var signUp = $(".signUp");

    if (box.hasClass("shifted")) {
        // Se a classe "shifted" estiver presente, remova-a e mova para a direita
        box.removeClass("shifted");

        signUp.fadeOut("fast", () => {
            login.fadeIn("slow");
        });
    } else {
        // Se a classe "shifted" não estiver presente, adicione-a e mova para a esquerda
        box.addClass("shifted");

        login.fadeOut("fast", () => {
            signUp.fadeIn("slow");
        });
    }
}

function trocarSenha(idInput, idIcon) {
    const passwordInput = document.getElementById(idInput);
    const eyeIcon = document.getElementById(idIcon);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";

        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";

        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}