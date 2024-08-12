<div class="articl-actions">
    <?php if (isAdmin()) : ?>
        <!-- Admins  can delete and edit -->
        <button id="articl-actions-delete" type="submit" class="articl-actions-delete-btn">Supprimer</button>
        <button id="articl-actions-edit" type="submit" class="articl-actions-edit-btn">Editer</button>
    <?php elseif (isEditor()) : ?>
        <!-- Editors can only edit -->
        <button id="articl-actions-edit" type="submit" class="articl-actions-edit-btn">Editer</button>
    <?php endif; ?>
</div>

<?php if (isAdmin()) : ?>
    <!-- Admins can see the delete form -->
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
<?php endif; ?>

<?php if (isEditor()) : ?>
    <!-- Admins and Editors can see the edit form -->
   
<?php endif; ?>
