<?php
    require_once("./partials/header.php");
?>
    
<div class="flex">
    <form method="post" enctype="multipart/form-data" class="create-form">
        <input type="hidden" name="action" value="store">
        <div class="label full left-0">
            <h2>Novo Contato</h2>
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
                <input title="Arraste o arquivo ou clique para selecionar (somente imagens JPG ou PNG)" type="file" name="photo" id="photo" value="<?= rand(0, 1000000) ?>">
            </label>
        </div>
        <a class="button error" href="index.php">Cancelar</a>
        <button class="right" type="submit">Salvar</button>        
        <div class="label error create-message"></div>
    </form>
</div>

<script src="../assets/js/create.js"></script>
<script src="../assets/js/photo.js"></script>

<?php
    require_once("./partials/footer.php");
?>