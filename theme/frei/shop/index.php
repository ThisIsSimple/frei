<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH . '/index.php');
    return;
}

if (!defined('_INDEX_')) define('_INDEX_', TRUE);

include_once(G5_THEME_SHOP_PATH . '/shop.head.php');
?>

<!-- 1: 히트, 2: 추천, 3: 최신, 4: 인기, 5: 할인 -->

<?php if ($default['de_type2_list_use']) { ?>
    <!-- 인기상품 시작 { -->
    <section>
        <header>
            <h2 class="font-righteous text-2xl text-primary"><a href="<?php echo shop_type_url('2'); ?>">best!</a></h2>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(2);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', false);
        $list->set_view('it_cust_price', false);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', false);
        $list->set_view('sns', false);
        $list->set_view('star', false);
        echo $list->run();
        ?>
    </section>
    <!-- } 인기상품 끝 -->
<?php } ?>

<div class="h-[3px] bg-primary my-5"></div>

<?php if ($default['de_type3_list_use']) { ?>
    <!-- 최신상품 시작 { -->
    <section>
        <header>
            <h2 class="font-righteous text-2xl text-primary"><a href="<?php echo shop_type_url('3'); ?>">new!</a></h2>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(3);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', false);
        $list->set_view('it_cust_price', false);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', false);
        $list->set_view('sns', false);
        $list->set_view('star', false);
        echo $list->run();
        ?>
    </section>
    <!-- } 최신상품 끝 -->
<?php } ?>

<?php include_once(G5_SHOP_SKIN_PATH . '/boxevent.skin.php'); // 이벤트 
?>

<?php
include_once(G5_THEME_SHOP_PATH . '/shop.tail.php');
