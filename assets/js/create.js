const createForm = document.querySelector(".create-form")
createForm.addEventListener("submit", (e) => {
    e.preventDefault()
    const formData = new FormData()
    formData.append("action", "store")
    formData.append("name", createForm.name.value)
    formData.append("phone", createForm.phone.value)
    formData.append("email", createForm.email.value)
    formData.append("annotations", createForm.annotations.value)
    formData.append("photo", createForm.photo.files[0])
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
            const message = document.querySelector(".create-message")
            message.innerHTML = "Erro ao tentar salvar contato, verifique se o e-mail já foi registrado"
            message.style.display = "block"
        }
    })
    .catch((error) => {
        console.log(error)        
    })
})