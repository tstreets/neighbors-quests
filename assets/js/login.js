const doc = document;
doc.qs = doc.querySelector;
doc.qsAll = doc.querySelectorAll;
doc.el = doc.createElement;

doc.body.onload = ()=> {
    initForms();
}

/**
 * Initializes the forms on the login page.
 */
function initForms() {
    const loginFormDOM = doc.qs(".loginform");
    loginFormDOM.onsubmit = submitForm;
    const signupFormDOM = doc.qs(".signupform");
    signupFormDOM.onsubmit = submitForm;
    const birthdateFieldDOM = doc.qs('.signupform__birthdate');
    birthdateFieldDOM.onclick = function() {
        if(this.dataset.clicked != 'true') {
            this.value = "2002-11-04";
            this.dataset.clicked = true;
        }
    }
}

/**
 * Validate and process forms.
 * @param {Event} e 
 */
function submitForm(e) {
    e.preventDefault();
    const formData = getFormData(this);
    if(Object.keys(formData).includes("fullname")) {
        const valid = validateSignupData(formData);
        if(valid) {
            sendData(formData, 'signup');
        }
    } else {
        const valid = validateLoginData(formData);
        if(valid) {
            sendData(formData, 'login')
        }
    }
}

/**
 * Return an object containing the data from the names inputs in the form.
 * @param {Element} form 
 */
function getFormData(form) {
    return Object.fromEntries(new FormData(form));
}

/**
 * 
 * @param {Object} signupData 
 * @param {String} signupData.fullname users full name
 * @param {String} signupData.email users email
 * @param {String} signupData.password users password
 * @param {String} signupData.birthdate users month and year of birth
 * @param {String} signupData.verify users password again
 */
function validateSignupData(signupData) {
    const message = { valid: true, errors: []};
    const dateDiff = (Date.now() - (new Date(signupData.birthdate)).getTime());
    if(5.68e11 > dateDiff || !signupData.birthdate) {
        message.valid = false;
        message.errors.push('birthdate');
    }
    if(!signupData.email || signupData.email.split('@').length != 2) {
        message.valid = false;
        message.errors.push('email');
    }
    if(!signupData.fullname.trim()) {
        message.valid = false;
        message.errors.push('fullname');
    }
    if(!signupData.password.trim() 
    || signupData.password.length < 5
    || !signupData.password.split("").find(c=> !isNaN(c))
    || !signupData.password.split("").find(c=> isNaN(c))
    ) {
        message.valid = false;
        message.errors.push('password');
    }
    if(!signupData.verify.trim() || signupData.verify != signupData.password) {
        message.valid = false;
        message.errors.push('verify');
    }
    showValidation(message.errors, 'signup');
    return message.valid;
}

/**
 * 
 * @param {Object} loginData
 * @param {String} loginData.email users email
 * @param {String} loginData.password users password
 */
function validateLoginData(loginData) {
    const message = { valid: true, errors: [] };
    if(!loginData.email.trim() || loginData.email.split('@').length != 2) {
        message.valid = false;
        message.errors.push('email');
    }
    if(!loginData.password.trim()) {
        message.valid = false;
        message.errors.push('password');
    }
    showValidation(message.errors, 'login');
    return message.valid;
}

/**
 * Sets each input as valid or invalid
 * @param {Array} errors 
 */
function showValidation(errors, form) {
    const formDOM = doc.qs(`.${form}form`);
    for(let field of formDOM) {
        if(!!field.name) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
            for(let error of errors) {
                if(error == field.name) {
                    field.classList.add('is-invalid');
                    field.classList.remove('is-valid');
                }
            }
        }
    }
}

/**
 * 
 * @param {Object} formData 
 * @param {String} formData.fullname 
 * @param {String} formData.email 
 * @param {String} formData.password 
 * @param {String} formData.birthdate 
 * @param {String} form 
 */
function sendData(formData, form) {
    const formDOM = doc.qs(`.${form}form`);
    let error = null;
    if(form == 'login') {
        fetch(`${globalRef['site url']}/Auth/login?email=${formData.email}&password=${formData.password}`)
        .then(response=> response.json())
        .then(result=> {
            console.log(result);
            if(!!result.messages.status) {
                doc.qs('.forms-out').classList.remove('d-flex');
                doc.qs('.forms-in').classList.add('d-flex');
            }
            else if(result.messages.failed == 'username') {
                error = "noemail";
                for(let field of formDOM) {
                    if(!!field.name) {
                        field.classList.remove('is-valid');
                        field.classList.add('is-invalid');
                    }
                }
            } else {
                error = "wrongpassword";
                for(let field of formDOM) {
                    if(field.name == 'password') {
                        field.classList.remove('is-valid');
                        field.classList.add('is-invalid');
                    }
                }
            }
            const alertDOM = doc.qs(`.alert-${form}-${error}`);
            for(let alert of doc.qsAll('.alert')) {
                if(alert == alertDOM) {
                    alert.removeAttribute('hidden');
                }
                else {
                    alert.setAttribute('hidden', 'true');
                }
            }
        })
    }
    else {
        fetch(`${globalRef['site url']}/Auth/signup?email=${formData.email}&password=${formData.password}&fullname=${formData.fullname}&birthdate=${formData.birthdate}`)
        .then(response=> response.json())
        .then(result=> {
            if(!!result.messages.status) {
                doc.qs('.forms-out').classList.remove('d-flex');
                doc.qs('.forms-in').classList.add('d-flex');
            }
            else if(result.messages.failed == 'Email already exists') {
                error = "usedemail";
                for(let field of formDOM) {
                    if(field.name == 'email') {
                        field.classList.remove('is-valid');
                        field.classList.add('is-invalid');
                    }
                }
            } else {
                error = "error";
            }
            const alertDOM = doc.qs(`.alert-${form}-${error}`);
            for(let alert of doc.qsAll('.alert')) {
                if(alert == alertDOM) {
                    alert.removeAttribute('hidden');
                }
                else {
                    alert.setAttribute('hidden', 'true');
                }
            }
        })
    }
}