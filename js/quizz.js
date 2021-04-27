function loadQuizz() {
    $.post('php/quizz_ajax.php',
            {'request_type' : 'GET_QUESTION'},
            function(data) {
                document.getElementById('question').innerHTML = data.question.enonce;
                document.getElementById('reponse-a').innerHTML = data.reponses[0].reponse;
                document.getElementById('reponse-b').innerHTML = data.reponses[1].reponse;
                document.getElementById('reponse-c').innerHTML = data.reponses[2].reponse;
                document.getElementById('reponse-d').innerHTML = data.reponses[3].reponse;

                document.getElementById('reponse-a').setAttribute('id-reponse', data.reponses[0].id);
                document.getElementById('reponse-b').setAttribute('id-reponse', data.reponses[1].id);
                document.getElementById('reponse-c').setAttribute('id-reponse', data.reponses[2].id);
                document.getElementById('reponse-d').setAttribute('id-reponse', data.reponses[3].id);
            },
            'json');
}

function checkReponse(id) {
    $.post('php/quizz_ajax.php',
            {'request_type' : 'CHECK_REPONSE', 'reponse' : id},
            function(data) {
                var retour = data.retour;
                if (retour == "true") {
                    if (data.logged == "true") {
                        document.getElementById('xp-bar').style.width = data.new_xp + "%";
                        document.getElementById('xp-bar').setAttribute('aria-valuenow', data.new_xp);
                        document.getElementById('lvl').innerHTML = data.new_lvl;
                    }
                    Swal.fire({
                        icon: 'success',
                        text: 'Bonne réponse !',
                        willClose: loadQuizz()
                    });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        text: 'Mauvaise réponse !'
                    });
                }
            },
            'json');
}


$(document).ready(function() {
loadQuizz();

$('.reponse-threshold').click(function() {
    var reponse = $(this);
    var id = reponse.find('h3').attr('id-reponse');
    checkReponse(id);
})

})

