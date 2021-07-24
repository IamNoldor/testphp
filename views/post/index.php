<form name="form">
    <select class="form-select" aria-label="Default select example">
        <option selected value="1">Форма 1</option>
        <option value="2">Форма 2</option>
    </select>
    <div class="form-group">
        <label for="InputCompanyName">Название компании</label>
        <input type="text" class="form-control" id="InputCompanyName" aria-describedby="CompanyNameHelp"
               placeholder="Введите название компании">
        <small id="CompanyNameHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
        <label for="InputPosition">Должность</label>
        <input type="text" class="form-control" id="InputPosition" aria-describedby="PositionHelp"
               placeholder="Введите должность">
        <small id="PositionHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group form-one">
        <label for="InputPositionDescription">Описание должности</label>
        <input type="text" class="form-control" id="InputPositionDescription" aria-describedby="PositionDescriptionHelp"
               placeholder="Введите описание должности">
        <small id="PositionDescriptionHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group form-one">
        <label for="InputSalary">Размер зароботной платы</label>
        <input type="text" class="form-control" id="InputSalary" aria-describedby="SalaryHelp"
               placeholder="Введите размер зароботной платы">
        <small id="SalaryHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group form-one">
        <label for="InputStartsAt">Дата начала</label>
        <input type="date" class="form-control" id="InputStartsAt" aria-describedby="StartsAtHelp">
        <small id="StartsAtHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group form-one">
        <label for="InputEndsAt">Дата окончания</label>
        <input type="date" class="form-control" id="InputEndsAt" aria-describedby="EndsAtHelp">
        <small id="EndsAtHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group form-two">
        <label for="InputContactName">Ваше имя</label>
        <input type="text" class="form-control" id="InputContactName" aria-describedby="ContactNameHelp"
               placeholder="Введите имя">
        <small id="ContactNameHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group form-two">
        <label for="InputContactEmail">Адресс електронной почты</label>
        <input type="email" class="form-control" id="InputContactEmail" aria-describedby="ContactEmailHelp"
               placeholder="Введите адресс електронной почты">
        <small id="ContactEmailHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
        <label for="InputPostAt">Дата размещения</label>
        <input type="datetime-local" class="form-control" id="InputPostAt" aria-describedby="PostAtHelp">
        <small id="PostAtHelp" class="form-text text-muted"></small>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Отправить</button>
</form>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>