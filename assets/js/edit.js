window.onload = () => {
    const id = document.querySelector("#id_edit").value
    editInformation(id)
}

const editInformation = (id) => {
    fetch('../App/Controllers/ContactController.php?action=show&id='+id, {
        method: 'GET',
            headers: {'Content-Type': 'application/json'}
        })
        .then((res) => res.json())
        .then(json => {            
            if(json !== null) {
                const noPhoto = document.querySelector(".no-photo")
                const currentPhoto = document.querySelector("#currentPhoto")
                if(json.photo !== "") {                    
                    currentPhoto.src = '../assets/public/uploads/' + json.photo
                    noPhoto.style.display = "none"
                }
                else {
                    currentPhoto.remove()
                }
                const name = document.getElementsByName("name")[0]
                name.value = json.name
                const phone = document.getElementsByName("phone")[0]
                phone.value = json.phone
                const email = document.getElementsByName("email")[0]
                email.value = json.email
                const annotations = document.getElementsByName("annotations")[0]
                annotations.value = json.annotations
            }
            else {
                window.location.href = "index.php"
            }
    })
    .catch((error) => {
        console.log(error)        
    })
}

const editForm = document.querySelector(".edit-form")
editForm.addEventListener("submit", (e) => {
    e.preventDefault()    
    const currentPhoto = document.querySelector("#currentPhoto")    
    const formData = new FormData()
    const photos = currentPhoto === null ? "" : currentPhoto.src.split("/")
    const photo = photos[photos.length-1] !== undefined ? photos[photos.length-1] : ""    
    formData.append("action", "update")
    formData.append("id", editForm.id_edit.value)
    formData.append("name", editForm.name.value)
    formData.append("phone", editForm.phone.value)
    formData.append("email", editForm.email.value)
    formData.append("annotations", editForm.annotations.value)
    formData.append("currentPhoto", photo)
    formData.append("photo", editForm.photo.files[0])    
    fetch('../App/Controllers/ContactController.php', {
        body: formData,
        method: 'POST',
        headers: { 'Accept': 'application/json' }        
    })
    .then((res) => res.json())
    .then(json => {
        if(json) {
            window.location.href = "index.php"
        }
        else {
            const message = document.querySelector(".edit-message")
            message.innerHTML = "Erro ao tentar editar contato, verifique se o e-mail já foi registrado"
            message.style.display = "block"
        }
    })
    .catch((error) => {
        console.log(error)        
    })
})