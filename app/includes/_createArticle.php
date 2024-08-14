<?php if (isEditor() || isAdmin()) :
    $categories = getCategories($dbCo);
?>
    <!-- Admins and createors can see the create article form -->
    <form id="articl-create-form" class="articl-create-form" method="POST" action="actions.php">
        <input type="hidden" name="action" value="createArticle">
        <input type="hidden" id="token" name="token" value="<?= $_SESSION['token'] ?>">
        <input type="hidden" name="idUser" value="<?= $_SESSION['idUser']; ?>">
        <ul class="articl-create-form-ul">
            <li class="articl-create-form__title">
                <label class="articl-create-form__title-label" for="title">Titre:</label>
                <input class="articl-create-form__title-input" type="text" name="title" id="title-create" maxlength="100" required />
            </li>
            <li class="articl-create-form__img">
                <label class="articl-create-form__img-label" for="imgUrl">Image URL:</label>
                <input class="articl-create-form__img-input" type="text" name="imgUrl" id="img-create"  maxlength="255" required />
            </li>
            <li class="articl-create-form__category">
                <label class="articl-create-form__category-label" for="category">Catégorie:</label>
                <select class="articl-create-form__category-input" name="idCategory" id="category-create" required>
                    <?php foreach ($categories as $category) : ?>
                        <?php echo addOptionHtmlCategory($category, 1); ?>
                    <?php endforeach; ?>
                </select>
            </li>
            <li class="articl-create-form__txt">
                <label class="articl-create-form__txt-label" for="paragraph">Paragraphe:</label>
                <textarea id="articl-create-txt" class="articl-create-form__txt-input js-autoresizing" name="paragraph" rows="4" cols="50" required></textarea>
            </li>
        </ul>
        <ul class="articl-create-form__btn">
            <button id="articl-create-form-btn__cancel" type="button" class="articl-create-form__btn__cancel">Annuler</button>
            <button id="articl-create-form-btn__publish" type="submit" class="articl-create-form__btn__publish">Publier</button>
        </ul>
    </form>
<?php endif; ?>