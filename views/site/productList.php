<div class="row">
    <div class="col-lg-3 filter-panel">
        <ul class="list-group">
            <?php foreach($categories as $item)
                echo '<li class="list-group-item"><span>'. $item[name].'</span> <input class="checkbox" type="checkbox"></li>'
            ?>
        </ul>
    </div>
    <div class="col-lg-9 product-panel">
        <table data-lastid=<?php echo $products[count($products)-1][id]?> class="table filter-table">
            <tr>
                <th>Название товара</th>
                <th>Категория товара</th>
                <th>Цена</th>
            </tr>
            <?php foreach($products as $item)
                echo '<tr data-id='.$item[id].'><td>'.$item[name].'</td><td>'.$item[category].'</td><td>'.$item[price].'</td><td>'.'</td></tr>';
            ?>
        </table>
        <button class="btn btn-default" id="next">Загрузить ещё</button>
    </div>

</div>
<script>

</script>