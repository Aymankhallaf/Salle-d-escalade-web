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

<?php if (isEditor() || isAdmin()) :
    $categories = getCategories($dbCo);
?>
    <!-- Admins and Editors can see the edit form -->
    <form id="articl-edit-form" class="articl-edit-form hidden" method="POST" action="actions.php">
        <input type="hidden" name="action" value="editArticle">
        <input type="hidden" id="token" name="token" value="<?= $_SESSION['token'] ?>">
        <input type="hidden" name="idPost" value="<?= $article['id_post']; ?>">
        <input type="hidden" name="idUser" value="<?= $_SESSION['idUser']; ?>">
        <ul class="articl-edit-form-ul">
            <li class="articl-edit-form__title">
                <label class="articl-edit-form__title-label" for="title">Titre:</label>
                <input class="articl-edit-form__title-input" type="text" name="title" id="title-edit" value="<?= $article['title']; ?>" maxlength="100" required />
            </li>
            <li class="articl-edit-form__img">
                <label class="articl-edit-form__img-label" for="imgUrl">Image URL:</label>
                <input class="articl-edit-form__img-input" type="text" name="imgUrl" id="img-edit" value="<?= $article['href_img']; ?>" maxlength="255" required />
            </li>
            <li class="articl-edit-form__category">
                <label class="articl-edit-form__category-label" for="category">Catégorie:</label>
                <select class="articl-edit-form__category-input" name="idCategory" id="category-edit" required>
                    <?php foreach ($categories as $category) : ?>
                        <?php echo addOptionHtmlCategory($category, $article['id_category']); ?>
                    <?php endforeach; ?>
                </select>
            </li>
            <li class="articl-edit-form__txt">
                <label class="articl-edit-form__txt-label" for="paragraph">Paragraphe:</label>
                <textarea id="articl-edit-txt" class="articl-edit-form__txt-input js-autoresizing" name="paragraph" rows="4" cols="50" required><?= $article['paragraph']; ?></textarea>
            </li>
        </ul>
        <ul class="articl-edit-form__btn">
            <button id="articl-edit-form-btn__cancel" type="button" class="articl-edit-form__btn__cancel">Annuler</button>
            <button id="articl-edit-form-btn__update" type="submit" class="articl-edit-form__btn__update">Mise à jour</button>
        </ul>
    </form>
<?php endif; ?>