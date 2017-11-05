<div class="row">
    <div class="col-lg-12">
        <div id="ajax-status"  class="alert alert-success">
            e
        </div>
        <form id='addProductSubmit'>
            <?php
                use yii\helpers\Html;
                echo Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);
            ?>
            <div class="form-group">
                <label for="name">Название товара:</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Введите название товара">
            </div>
            <div class="form-group">
                <label for="category">Категория:</label>
                <input name="category" type="text" class="form-control" id="category" placeholder="Введите категорию товара">
            </div>
            <div class="form-group">
                <label for="price">Цена:</label>
                <input name="price" type="text" class="form-control" id="price" placeholder="Введите цену товара">
            </div>
            <button type="submit" class="btn btn-default">Отправить</button>
        </form>
    </div>
</div>