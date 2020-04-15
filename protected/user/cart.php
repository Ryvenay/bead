<?php 
    if (!isUserLoggedIn()) {
        header('Location: Login.php');
    }
    else {
        $query = "SELECT p.id as id, product_brand, product_name, quantity, quantity*price as pricesum FROM products p, users u, cart c WHERE c.product_id = p.id AND c.user_id = :user_id";
        $params = [
            ':user_id' => $_SESSION['uid']
        ];

        require_once DATABASE_CONTROLLER;

        $cart = getList($query, $params);

        $query = "SELECT  sum(quantity*price) as total FROM products p, users u, cart c WHERE c.product_id = p.id AND c.user_id = :user_id";
    }
?>

<h2>Kosár</h2>
<?php if(count($cart) <=0 ): ?>
    <p class="alert">A kosár üres!</p>
<?php else: ?>
    <table class = "table">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Termék</th>
                <th>Mennyiség</th>
                <th>Ár</th>
                <th>Törlés</th>
            </tr>
        </thead>
        <tbody>
            <?php $i =0; ?>
            <?php $count = 0; ?>
            <?php $total = 0; ?>
            <?php foreach ($cart as $item): ?>
                <tr>
                    <?php $i++ ?>
                    <?php $total  += $item['pricesum']; ?>
                    <?php $count += $item['quantity']; ?>
                    <th scope="row"><?=$i ?></th>
                    <td><a href="index.php?P=product&ID=<?=$item['id']; ?>"><?=$item['product_brand'].' '.$item['product_name']; ?></a></td>
                    <td><?=$item['quantity']; ?></td>
                    <td><?=number_format($item['pricesum']).' Ft'; ?></td>
                    <td><a href='#'>Töröl</a></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>Összsen:</td>
                <td><?=$count; ?> </td>
                <td><?=number_format($total) .' Ft'; ?> </td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    
<?php endif; ?>