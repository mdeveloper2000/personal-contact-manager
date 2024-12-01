window.onload = () => {
    const id = document.querySelector("#id_show").value
    showInformation(id)
}

const showInformation = (id) => {
    fetch('../App/Controllers/ContactController.php?action=show&id='+id, {
        method: 'GET',
            headers: {'Content-Type': 'application/json'}
        })
        .then((res) => res.json())
        .then(json => {            
            if(json !== null) {                
                const photo = document.querySelector("#photo")
                const noPhoto = document.querySelector(".no-photo")
                if(json.photo !== "") {
                    photo.src = "../assets/public/uploads/" + json.photo
                    noPhoto.style.display = "none"
                }
                else {
                    photo.remove()
                }             
                const name = document.querySelector("#name")
                name.innerHTML = json.name
                const phone = document.querySelector("#phone")
                phone.innerHTML = "Telefone: " + json.phone
                const email = document.querySelector("#email")
                email.innerHTML = "E-mail: " + json.email
                const annotations = document.querySelector("#annotations")
                annotations.innerHTML = 
                    json.annotations !== "" ? json.annotations : "Não há anotações para esse contato"
            }
            else {
                window.location.href = "index.php"
            }
        })
        .catch((error) => {
            console.log(error)
        })
}