let select = document.getElementsByClassName('form-select')[0];
let form_one_elements = document.getElementsByClassName('form-one');
let form_two_elements = document.getElementsByClassName('form-two');
let s_button = document.getElementsByClassName('btn')[0];
let modal_tittle = document.getElementById('exampleModalLabel');
let modal_body = document.getElementsByClassName('modal-body')[0];
let company_name_help = document.getElementById('CompanyNameHelp');
let position_help = document.getElementById('PositionHelp');
let ends_at_help = document.getElementById('EndsAtHelp');
let post_at_help = document.getElementById('PostAtHelp');
let contact_email_help = document.getElementById('ContactEmailHelp');


document.addEventListener('DOMContentLoaded', function () {
    hideFormTwo();
});
select.addEventListener('click', function () {
    if (select.value == 1) {
        dislplayFormOne();
        hideFormTwo();
    }
    if (select.value == 2) {
        dislplayFormTwo();
        hideFormOne();
    }
    hideHelp();
});
s_button.addEventListener('click', function () {
    let company_name = document.getElementById('InputCompanyName').value;
    let position = document.getElementById('InputPosition').value;
    let position_description = document.getElementById('InputPositionDescription').value;
    let salary = document.getElementById('InputSalary').value;
    let starts_at = document.getElementById('InputStartsAt').value;
    let ends_at = document.getElementById('InputEndsAt').value;
    let post_at = document.getElementById('InputPostAt').value;
    let contact_email = document.getElementById('InputContactEmail').value;
    let contact_name = document.getElementById('InputContactName').value;
    hideHelp();
    $.ajax({
        url: '/web/index.php?r=site/index',
        type: 'POST',
        data: {
            form_type: select.value,
            company_name: company_name,
            position: position,
            position_description: position_description,
            salary: salary,
            starts_at: starts_at,
            ends_at: ends_at,
            post_at: post_at,
            contact_email: contact_email,
            contact_name: contact_name
        },
        success: function (res) {
            if (res == "SUCCESS") {
                modal_tittle.textContent = 'Успех!';
                modal_body.textContent = 'Данные успешно отправлены';
                clear();
                setTimeout(hideModal, 15000);
            } else {
                modal_tittle.textContent = 'Ошибка!';
                modal_body.textContent = 'Введены неправильные значения';
                console.log(res);
                let data = JSON.parse(res);
                for (let i = 0; i < Object.keys(data).length; i++) {
                    if (data[i] == 'Error 01') {
                        company_name_help.textContent = "Поле 'Название компании' не может быть пустым";
                        company_name_help.style.display = 'block';
                    }
                    if (data[i] == 'Error 02') {
                        position_help.textContent = "Поле 'Должность' не может быть пустым";
                        position_help.style.display = 'block';
                    }
                    if (data[i] == 'Error 03') {
                        ends_at_help.textContent = "Минимальный период даты начала и даты окончания - 3 месяца";
                        ends_at_help.style.display = 'block';
                    }
                    if (data[i] == 'Error 04') {
                        post_at_help.textContent = "Дата размещения не может быть меньше текущей";
                        post_at_help.style.display = 'block';
                    }
                    if (data[i] == 'Error 05') {
                        contact_email_help.textContent = "Неправильно указан адрес электронной почты";
                        contact_email_help.style.display = 'block';
                    }
                }
            }
        },
        error: function (e) {
            console.log(e);
        }
    });
});

function dislplayFormOne() {
    for (let i = 0; i < form_one_elements.length; i++) {
        form_one_elements[i].style.display = 'block';
    }
}

function hideFormOne() {
    for (let i = 0; i < form_one_elements.length; i++) {
        form_one_elements[i].style.display = 'none';
    }
}

function dislplayFormTwo() {
    for (let i = 0; i < form_two_elements.length; i++) {
        form_two_elements[i].style.display = 'block';
    }
}

function hideFormTwo() {
    for (let i = 0; i < form_two_elements.length; i++) {
        form_two_elements[i].style.display = 'none';
    }
}

function hideHelp() {
    company_name_help.style.display = 'none';
    contact_email_help.style.display = 'none';
    position_help.style.display = 'none';
    ends_at_help.style.display = 'none';
    post_at_help.style.display = 'none';
}

function clear() {
    let inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }
}
function hideModal() {
    let modal = document.getElementById('exampleModal');
    let modal_backdrop = document.getElementsByClassName('modal-backdrop')[0];
    modal_backdrop.remove();
    modal.classList.remove('in');
}