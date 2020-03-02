<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Страна</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($countries as $country): ?>
        <tr>
            <th scope="row"><?=(int) $country['id']?></th>
            <td><?=htmlspecialchars($country['country_name'])?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p><a id="buttonForShowModal" class="btn btn-dark" href="<?=ROOT?>countries/add" role="button">Добавить страну</a></p>

<!-- Modal -->
<div class="modal fade" id="modalForAddCountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Добавить страну</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formAddCountryForAjax" method="post">
                <div class="form-group">
                    <label for="country">Введите страну</label>
                    <input type="text" class="form-control bg-light" id="country" name="country">
                    <p class="hidden error-message-validation"></p>
                </div>

                <div>
                    <p><button id="buttonForSendCountryAsAjax" class="btn btn-dark" type="submit">Добавить</button></p>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Закрыть</button>
        </div>
    </div>
  </div>
</div>