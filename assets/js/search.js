const searchButton = document.querySelector("#searchButton")
const searchInput = document.querySelector("#searchInput")
searchButton.addEventListener("click", () => {
    const name = searchInput.value.trim()
    if(name !== "") {
        fetch('../App/Controllers/ContactController.php?action=search&name='+name, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }        
        })
        .then((res) => res.json())
        .then(json => {
            if(json) {
                const table = document.querySelector("table")
                const tbody = document.querySelector("table").getElementsByTagName('tbody')[0]
                const tfoot = document.querySelector("table").getElementsByTagName('tfoot')[0]                
                if(json.length > 0) {
                    table.classList.add("primary")
                    table.classList.remove("error")
                    tbody.innerHTML = ""
                    tfoot.getElementsByTagName('th')[0].innerHTML = 
                        json.length === 1 ? "Pesquisa retornou 1 contato" : `Pesquisa retornou ${json.length} contatos`
                    json.forEach(contact => {
                        const row = tbody.insertRow()
                        const name = row.insertCell()
                        const phone = row.insertCell()
                        const photo = row.insertCell()
                        const show = row.insertCell()
                        const edit = row.insertCell()
                        const del = row.insertCell()
                        name.innerHTML = contact.name
                        phone.innerHTML = contact.phone
                        if(contact.photo !== "") {
                            const img = document.createElement("img")
                            img.classList.add("avatar-photo")
                            img.src = "../assets/public/uploads/" + contact.photo
                            photo.appendChild(img)
                        }
                        else {
                            const span = document.createElement("span")
                            span.classList.add("avatar-nophoto")
                            span.innerHTML = "?"
                            photo.appendChild(span)
                        }
                        const showButton = document.createElement("button")
                        const editButton = document.createElement("button")
                        const deleteButton = document.createElement("button")
                        showButton.innerHTML = "Ver"
                        editButton.innerHTML = "Editar"
                        deleteButton.innerHTML = "Deletar"
                        editButton.classList.add("warning")
                        deleteButton.classList.add("error")
                        showButton.addEventListener("click", () => {
                            showInformation(contact.id)
                        })
                        editButton.addEventListener("click", () => {
                            editInformation(contact.id)
                        })
                        deleteButton.addEventListener("click", () => {
                            deleteConfirmation(contact.id, contact.name)
                        })
                        show.appendChild(showButton)
                        edit.appendChild(editButton)
                        del.appendChild(deleteButton)
                    })
                }
                else {
                    tbody.innerHTML = ""
                    const row = tbody.insertRow()
                    const cell = row.insertCell()
                    table.classList.add("error")
                    table.classList.remove("primary")
                    tfoot.getElementsByTagName('th')[0].innerHTML = `Não houve resultados para essa pesquisa`
                }
            }            
        })
        .catch((error) => {
            console.log(error)        
        })
    }
})