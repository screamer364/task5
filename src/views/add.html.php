<div class="row">
    <div class="col-l12">
        <form method="post">
            <div class="form-group">
                <label for="country">Введите страну</label>
                <input type="text" class="form-control bg-light" id="country" name="country">
                <?php if (!empty($err)): ?>
                <small class="error-message-validation"><?=$err?><small>
                <?php endif; ?>
            </div>

            <div>
                <p><button class="btn btn-dark" type="submit">Добавить</button></p>
            </div>

        </form>

        <p><a class="btn btn-dark" href="<?=ROOT?>" role="button">Назад</a></p>
    </div>
</div>