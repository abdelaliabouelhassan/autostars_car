
function addField(id) {
    
    let fieldContainer = document.querySelector(`#${id} .row`);
    let field_name = document.getElementById(`new_name_${id}`).value;

    let field_value = document.getElementById(`new_value_${id}`).value;

    let wrapperDiv = document.createElement('div');
    wrapperDiv.classList.add('col-md-6');

    let label = document.createElement('label');
    label.textContent = field_name;

    let input = document.createElement('input');
    input.type = 'text';
    input.name = `${id}[${field_name}]`;
    input.value = field_value;
    input.classList.add('form-control');

    wrapperDiv.append(label);
    wrapperDiv.append(input);

    fieldContainer.append(wrapperDiv);

    document.getElementById(`new_name_${id}`).value=''
    document.getElementById(`new_value_${id}`).value=''
}

function addCheckbox(id) {
    let fieldContainer = document.querySelector(`#${id} .row`);
    let field_name = document.getElementById(`new_name_${id}`).value;


    let wrapperElement = document.createElement('li');
    wrapperElement.classList.add('checkbox');

    let label = document.createElement('label');
    label.textContent = field_name;

    let input = document.createElement('input');
    input.type = 'checkbox';
    input.name = `${id}[]`;
    input.value = field_name;
    input.checked = true;

    label.prepend(input);
    wrapperElement.append(label);

    fieldContainer.append(wrapperElement);
    document.getElementById(`new_name_${id}`).value=''
}