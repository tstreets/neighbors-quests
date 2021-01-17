const provider = new GeoSearch.OpenStreetMapProvider();



/**
 * @member {Object} M
 * @member {Array} M.markers
 * @member {Array} M.quests
 */
const M = {
    map: {},
    markers: [],
    quests: [],
    user: {}
};

document.body.onload = function() {
    initMap();
    modalTrigger();
}

function modalTrigger() {
    const modalTriggers = document.querySelectorAll('.modal-trigger');
    for(let trigger of modalTriggers) {
        trigger.onclick = loadModal;
    }
}

function loadModal(quest_id) {
    quest_id = (!!this.dataset) ? this.dataset.id : quest_id;
    const questRef = M.quests.find(q=>q.id == quest_id);
    const Modal = {
        title: document.querySelector('.modal-title'),
        body: document.querySelector('.modal-body'),
    }
    Modal.title.innerHTML = questRef.name;
    Modal.body.innerHTML = questDetails(questRef);
}

function questDetails(quest) {
    return `
        <div>
            <div class='d-flex'>
                <div class='quest__image'>
                    <img class='bg-first quest__img--alt' src='${globalRef['base url']}assets/images/${quest.giver_id}/${quest.image}' alt='${quest.name}'>
                </div>
                <div class='ml-3 bg-fourth text-first p-3' style='width: 275px;'>
                    <p class='d-flex'>Zipcode: <span class='ml-3'>${quest.zip}</span></p>
                    <p class='d-flex'>Reward: <span class='ml-3'>$${quest.reward}</span></p>
                    <p class='d-flex'>Difficulty: <span class='ml-1'>${quest.difficulty}</span></p>
                    <p class='d-flex'>Urgency: <span class='ml-3'>${quest.urgency}</span></p>
                </div>
            </div>

            <h3 class='text-first mt-3'>Current Activity: <em>${(!!quest.adventurer_id) ? 'In Progress' : 'Available'}</em></h3>

            <div class='text-first'>
                <h3>Description</h3>
                <p class='bg-fourth p-3'>${quest.details}</p>
            </div>

            <div></div>
        </div>
    `;
}

function initMap() {
    M.map = L.map('map').fitWorld();
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(M.map);

    getCurrentLocation();
    setQuestCoords(0);

    initSwitchBtn();
    initSeachByZipcode();
}

function clearMarkers() {
    M.markers.forEach(marker=> marker.remove());
    M.markers = [];
}

function addQuestMarkers() {
    clearMarkers();
    M.quests.forEach(quest=> {
        if(!!quest.coords) {
            M.markers.push(
                new L.marker(quest.coords).addTo(M.map)
                .bindPopup(`<a data-id='${quest.id}' onclick='loadModal("${quest.id}")' class='modal-trigger' data-toggle='modal' data-target='#exampleModal'>View Details</a>`)
            )
        }
    })
    // console.log('ready');
}

function setQuestCoords(index) {
    if(M.quests.length > index) {
        provider.search({query: `${M.quests[index].address}`})
        .then(results=> {
            let result;
            if(!!results.length > 0) {
                result = results.reduce((acc, curLoc)=> {
                    let closest= (
                            ((M.user[0] - curLoc.y)**2 + (M.user[1] - curLoc.x)**2)**-2
                            > ((M.user[0] - acc.y)**2 + (M.user[1] - acc.x)**2)**-2
                        ) ? curLoc : acc;
                    return closest;
                })
            }
            if(!!result) {
                M.quests[index].coords = [result.y, result.x];
                const labelParts = result.label.split(',');
                M.quests[index].zip = labelParts[labelParts.length - 2];
            }
            else {
                M.quests[index].zip = 'N/A';
            }
            setQuestCoords(index + 1);
        })
    } else {
        addQuestMarkers();
    }
}

function getCurrentLocation() {
    navigator.geolocation.getCurrentPosition(pos=> {
        M.user = [pos.coords.latitude, pos.coords.longitude];
        M.map.setView(M.user, 13);
    })
}

function initSeachByZipcode() {
    const form = document.querySelector('.focus-zipcode-form');
    if(!!form) {
        form.onsubmit = function(e) {
            e.preventDefault();
            const formData = Object.fromEntries(new FormData(this));
            if(!!formData.zipcode.trim()
            && formData.zipcode.length == 5
            && !isNaN(formData.zipcode)) {
                this.reset();
                focusZipCode(formData.zipcode);
            }
        };
    }
}

function focusZipCode(zipcode = 46201) {
    document.querySelector('.boardview').classList.remove('d-flex');
    document.querySelector('.mapview').classList.add('d-flex');
    document.querySelector('.switchview').dataset.view = 'map';
    document.querySelector('.switchview').innerHTML = "Show Board";
    provider.search({query: `${zipcode}`})
    .then(results=> {
        const result = results.reduce((acc, curLoc)=> {
            // 
            let closest= (
                    ((M.user[0] - curLoc.y)**2 + (M.user[1] - curLoc.x)**2)**-2
                    > ((M.user[0] - acc.y)**2 + (M.user[1] - acc.x)**2)**-2
                ) ? curLoc : acc;
            return closest;
        })
        if(!!result) {
            const loc = {
                coords: [result.y, result.x],
                street: result.label
            };
            M.map.setView(loc.coords, 13);
        }
    })
}

function initSwitchBtn() {
    const switchBtn = document.querySelector('.switchview');
    switchBtn.onclick = switchView;
}

/**
 * 
 * @param {Event} e 
 */
function switchView(e) {
    e.preventDefault();
    if(this.dataset.view == 'map') {
        document.querySelector('.mapview').classList.remove('d-flex');
        document.querySelector('.boardview').classList.add('d-flex');
        this.dataset.view = 'board';
        this.innerHTML = "Show Map";
    }
    else {
        document.querySelector('.boardview').classList.remove('d-flex');
        document.querySelector('.mapview').classList.add('d-flex');
        this.dataset.view = 'map';
        this.innerHTML = "Show Board";
        if(!!M.user){
            // M.map.setView(M.user, 13);
        }
    }
}