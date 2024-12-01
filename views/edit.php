<?php 
    require_once("./partials/header.php");
    $id_edit = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
?>

<div class="flex two">
    <div>
        <article class="card card-photo">
            <div class="no-photo">
                Não há foto para esse contato ainda
            </div>
            <img id="currentPhoto">
        </article>
    </div>
    <div>
        <article class="card">
            <form method="post" enctype="multipart/form-data" class="edit-form">
                <input type="hidden" name="action" value="store">
                <input type="hidden" name="id_edit" id="id_edit" value="<?= $id_edit ?>">
                <div class="label full left-0">
                    <h2>Editar</h2>
                </div>
        <div>
            <input type="text" name="name" placeholder="Nome" maxlength="35" 
                onblur="this.value=this.value.trim();" required>
        </div>
        <div>
            <input type="text" name="phone" placeholder="Telefone" maxlength="15" 
                onblur="this.value=this.value.trim();" required>
        </div>
        <div>
            <input type="email" name="email" placeholder="E-mail" maxlength="50" 
                onblur="this.value=this.value.trim();" required>
        </div>
        <div>
            <textarea name="annotations" placeholder="Anotações" rows="4" maxlength="200"></textarea>
        </div>
        <div style="width: 100px;">
            <label class="dropimage">
                <input title="Arraste o arquivo ou clique para selecionar (somente imagens JPG ou PNG)" type="file" name="photo" id="photo">
            </label>            
        </div>
        <a class="button error" href="index.php">Cancelar</a>
        <button type="submit" class="warning right">Atualizar</button>        
        <div class="label error edit-message"></div>
    </form>
    </article>
    </div>    
</div>

<script src="../assets/js/edit.js"></script>
<script src="../assets/js/photo.js"></script>

<?php
    require_once("./partials/footer.php");
?>