const doc = document; doc.qs = doc.querySelector; doc.qsAll = doc.querySelectorAll;

doc.body.onload = function() {
    initForm();
}

function initForm() {
    const form = doc.qs('.newquestform');
    form.onsubmit = newQuestHandler;
}

/**
 * 
 * @param {Event} e 
 */
function newQuestHandler(e) {
    e.preventDefault();
    const formData = Object.fromEntries(new FormData(this));
    if(newQuestValidation(formData)) {
        sendData(new FormData(this));
    }
}

/**
 * 
 * @param {Object} formData 
 * @param {String} formData.name 
 * @param {File} formData.image 
 * @param {String} formData.details 
 * @param {String} formData.difficulty 
 * @param {String} formData.urgency 
 * @param {String} formData.reward 
 * @param {String} formData.address
 */
function newQuestValidation(formData) {
    const msg = {valid: true, errors: []};
    if(!formData.name.trim()) {
        msg.valid = false;
        msg.errors.push('name');
    }
    if(!formData.image.name.trim()) {
        msg.valid = false;
        msg.errors.push('image');
    }
    if(!formData.details.trim()) {
        msg.valid = false;
        msg.errors.push('details');
    }
    if(!formData.difficulty.trim()) {
        msg.valid = false;
        msg.errors.push('difficulty');
    }
    if(!formData.urgency.trim()) {
        msg.valid = false;
        msg.errors.push('urgency');
    }
    if(!formData.reward.trim()) {
        msg.valid = false;
        msg.errors.push('reward');
    }
    if(!formData.address.trim()) {
        msg.valid = false;
        msg.errors.push('address');
    }

    return msg.valid;
}

/**
 * 
 * @param {Object} formData 
 * @param {String} formData.name 
 * @param {File} formData.image 
 * @param {String} formData.details 
 * @param {String} formData.difficulty 
 * @param {String} formData.urgency 
 * @param {String} formData.reward 
 * @param {String} formData.address
 */
function sendData(formData) {
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if(xhr.status == 200 && xhr.readyState == 4) {
            console.log(xhr.response);
            if(!!JSON.parse(xhr.response).status) {
                doc.qs(".questaddsuccess").click();
            }
        }
    }
    xhr.open("POST", `${globalRef['site url']}/quest/savefile`);
    xhr.send(formData);
}