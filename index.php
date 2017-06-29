<?php

include('header.php');

include('banner.php');

include('slidebar.php');

$objproduct = new Product();

$where = ' where pro_status=1';
$order = ' order by pro_count_buy desc';
$order1 = ' order by pro_id desc';
$order2 = ' order by pro_view desc';
$limit = 3;
$start = 0;
$buy = $objproduct->listProduct($where, $order, $start, $limit);

$new = $objproduct->listProduct($where, $order1, $start, $limit);

$view = $objproduct->listProduct($where, $order2, $start, $limit);
?>

<div ng-controller="ctrl1">
    <input type="text" ng-model="name">
    {{name}}
    <br>
    <input type="text" ng-model="number1"><br>
    <input type="text" ng-model="number2"><br>

    <button ng-click="sum()">Tong</button>
    <br>

    {{caculation}}
    <p>{{+number1++number2}}</p>
    <ul ng-repeat="x in human">
        <li>
            {{x.city}}
        </li>
        <li>
            {{x.country}}
        </li>
    </ul>
    <br>
    <ol>
        <li>{{human[0].city}}</li>
    </ol>
    <ol start="2">
        <li ng-repeat="x in human" ng-if="$index>0">
            {{x.city}} {{$index+1}}
        </li>
    </ol>
    <table border="1px thin solid #f3f3f3">
        <tr ng-repeat="x in human">
            <td>
                {{x.city}}
            </td>
            <td>
                {{x.country}}
            </td>
        </tr>
    </table>
    <input ng-model="human[0].city">
    <br>
    <input type="checkbox" ng-model="srcUrl">Mở giỏ hàng<br>
    <ng-include src="opencart()"></ng-include>

</div>
<div ng-controller="ctrl2">
    <label>Hãy chọn 1 số
        <input type="text" ng-model="fornumber">
    </label>
    <button ng-click="clickchuot()">Add</button>
    <div>{{message}}</div>
<!--    <div ng-switch="fornumber">-->
<!--        <p ng-switch-when="1">1</p>-->
<!--        <p ng-switch-default="1">k co trong mang</p>-->
<!--    </div>-->
    <p ng-repeat="x in results">{{x}}</p>

</div>

<div ng-controller="ctrl3">
    <button ng-disabled="buttondisable">Button</button>
    <input type="checkbox" ng-model="buttondisable"> Click me to disable
</div>

<div class="span9">
    <h4>Sản phẩm mới nhất </h4>
    <ul class="thumbnails">
        <?php
        foreach ($new as $key => $value) {

            ?>
            <li class="span3">

                <div class="thumbnail">
                    <div class="tag1"><img src="themes/images/new2.png"/></div>
                    <a href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>">
                        <img src="hinhanh/<?php echo $value['pro_image'] ?>" alt=""/>
                    </a>
                    <div class="caption">
                        <h5><?php echo $value['pro_name'] ?></h5>
                        <p>

                        </p>
                        <h4 style="text-align:center">
                            <a class="btn"
                               href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>">
                                <i class="icon-zoom-in"></i>
                            </a>
                            <a class="btn" href="addcart.php?proid=<?php echo $value['pro_id']; ?>">Add to
                                <i class="icon-shopping-cart"></i>
                            </a>
                            <?php
                            if ($value['pro_discount'] == 0) {
                                ?>
                                <a class="btn btn-primary"
                                   href="#"><?php echo number_format($value['pro_price']); ?></a>
                                <?php
                            } else {
                                ?>
                                <a class="btn btn-primary"
                                   href="#"><?php echo number_format($value['pro_price'] - $value['pro_discount']); ?>
                                </a>
                                <a class="btn btn-primary" style="text-decoration:line-through;"
                                   href="#"><?php echo number_format($value['pro_price']); ?>
                                </a>
                            <?php } ?>
                        </h4>
                    </div>
                </div>

            </li>
            <?php
        }
        ?>
    </ul>
    <h4>Sản phẩm bán chạy nhất </h4>
    <ul class="thumbnails">
        <?php
        foreach ($buy as $key => $value) {

            ?>
            <li class="span3">

                <div class="thumbnail">
                    <a href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>">
                        <img src="hinhanh/<?php echo $value['pro_image'] ?>" alt=""/>
                    </a>
                    <div class="caption">
                        <h5><?php echo $value['pro_name'] ?></h5>
                        <p>

                        </p>

                        <h4 style="text-align:center">
                            <a class="btn"
                               href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>">
                                <i class="icon-zoom-in"></i>
                            </a>
                            <a class="btn" href="addcart.php?proid=<?php echo $value['pro_id']; ?>">Add to
                                <i class="icon-shopping-cart"></i>
                            </a>
                            <?php
                            if ($value['pro_discount'] == 0) {
                                ?>
                                <a class="btn btn-primary"
                                   href="#"><?php echo number_format($value['pro_price']); ?></a>
                                <?php
                            } else {
                                ?>
                                <a class="btn btn-primary"
                                   href="#"><?php echo number_format($value['pro_price'] - $value['pro_discount']); ?>
                                </a>
                                <a class="btn btn-primary" style="text-decoration:line-through;"
                                   href="#"><?php echo number_format($value['pro_price']); ?>
                                </a>
                            <?php } ?>
                        </h4>
                    </div>
                </div>

            </li>
            <?php
        }
        ?>
    </ul>
    <h4>Sản phẩm xem nhiều nhất </h4>
    <ul class="thumbnails">
        <?php
        foreach ($view as $key => $value) {

            ?>
            <li class="span3">

                <div class="thumbnail">
                    <a href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>">
                        <img src="hinhanh/<?php echo $value['pro_image'] ?>" alt=""/>
                    </a>
                    <div class="caption">
                        <h5><?php echo $value['pro_name'] ?></h5>
                        <p>

                        </p>

                        <h4 style="text-align:center">
                            <a class="btn"
                               href="product_details.php?proid=<?php echo $value['pro_id']; ?>&catid=<?php echo $value['cat_id']; ?>">
                                <i class="icon-zoom-in"></i>
                            </a>
                            <a class="btn" href="addcart.php?proid=<?php echo $value['pro_id']; ?>">Add to
                                <i class="icon-shopping-cart"></i>
                            </a>
                            <?php
                            if ($value['pro_discount'] == 0) {
                                ?>
                                <a class="btn btn-primary"
                                   href="#"><?php echo number_format($value['pro_price']); ?></a>
                                <?php
                            } else {
                                ?>
                                <a class="btn btn-primary"
                                   href="#"><?php echo number_format($value['pro_price'] - $value['pro_discount']); ?>
                                </a>
                                <a class="btn btn-primary" style="text-decoration:line-through;"
                                   href="#"><?php echo number_format($value['pro_price']); ?>
                                </a>
                            <?php } ?>
                        </h4>
                    </div>
                </div>

            </li>
            <?php
        }
        ?>
    </ul>
</div>

<?php

include('footer.php');

include('themes_section.php');

?>
