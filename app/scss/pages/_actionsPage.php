

<div class="articl-actions">
        <button id="articl-actions-delete" type="submit" class="articl-actions-delete-btn">Supprimer</button>
        <button id="articl-actions-edit" type="submit" class="articl-actions-edit-btn">Editer</button>
    </div>

    <form id="articl-delete-form" class="articl-delete-form hidden" method="POST" action="actions.php">
        <input type="hidden" id="token" name="token" value="<?= $_SESSION['token']; ?>">
        <label for="idPost">Vous voulez supprimer cette article !!</label>
        <input type="hidden" name="idPost" value="<?= $article['id_post']; ?>">
        <input type="hidden" name="action" value="deleteArticle">
        <div class="articl-delete-form-btn">
            <button id="articl-delete-form-btn__cancel" type="button" class="articl-delete-form-btn__cancel">Annuler</button>
            <button id="articl-delete-form-btn__delete" type="submit" class="articl-delete-form-btn__delete">Supprimer</button>
        </div>

    </form>
    <form id="edit-form" class="signup-form" method="POST" action="actions.php">
        <input type="hidden" id="token" name="token" value="<?= $_SESSION['token'] ?>">
        <input type="hidden" id="token" name="token" value="<?= $_SESSION['token'] ?>">
        <input type="hidden" name="action" value="editArticle">
        <button id="edit" type="submit" class="stepper-btn__next">edit</button>
    </form>