<?php 
    require_once("./partials/header.php");
    $id_show = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
?>

<input type="hidden" name="id_show" id="id_show" value="<?= $id_show ?>">

<div class="flex two">
    <div>
        <article class="card current-photo">
            <div class="no-photo">
                Não há foto para esse contato ainda
            </div>
            <img id="photo">                        
        </article>
    </div>
    <div>
        <article class="card show-information">            
            <div class="label full left-0">
                <h2>Informações</h2>
            </div>
            <footer>
                <div style="text-align: end;">
                    <button class="warning" onclick="window.location.href='edit.php?id=<?=$id_show?>'">
                        Editar informações
                    </button>
                </div>
                <i>
                    <h2 id="name"></h2>
                </i>
                <h3 id="phone"></h3>
                <h3 id="email"></h3>
                <div class="label flex">
                    <h3 id="annotations"></h3>
                </div>
            </footer>
        </article>
    </div>
</div>

<script src="../assets/js/show.js"></script>

<?php
    require_once("./partials/footer.php");
?>