<?php
    require_once("./partials/header.php");
?>

<div class="flex">
    <div>
        <div class="flex" style="align-items: center;">
            <div>
                <input type="search" placeholder="Nome" id="searchInput">
            </div>
            <div>
                <button class="button" id="searchButton" data-tooltip="Pesquisar contatos por nome">Pesquisar</button>
            </div>
            <div>
                <a href="create.php" class="button success right">Novo Contato</a>
            </div>
        </div>        
    </div>
</div>

<div class="flex"> 
    <table class="primary">
        <thead>
            <tr>
                <th class="name">Nome</th>
                <th>Telefone</th>
                <th>Foto</th>
                <th colspan="3" class="actions">Ações</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <th colspan="6"></th>
        </tfoot>
    </table>
</div>

<div class="modal">
    <input type="hidden" id="delete_id">
    <input id="modal_1" type="checkbox" />
    <label for="modal_1" class="overlay"></label>
    <article>
        <header>
            <h3>Aviso</h3>
            <label for="modal_1" class="close">&times;</label>
        </header>
        <section class="content"></section>
        <footer>
            <label class="button error" onclick="deleteContact()">Sim, deletar</label>
            <label class="button" for="modal_1">Não, cancelar</label>
        </footer>
    </article>
</div>

<script src="../assets/js/index.js"></script>
<script src="../assets/js/search.js"></script>

<?php
    require_once("./partials/footer.php");
?>