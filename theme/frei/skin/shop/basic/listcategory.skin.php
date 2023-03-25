<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$str = '';
$exists = false;

$ca_id_len = strlen($ca_id);

$original_ca_id = $ca_id;
// 하위 분류일 때 상위 분류 카테고리까지 같이 표시
if ($ca_id_len == 4) {
    $ca_id_len = 2;
    $ca_id = substr($ca_id, 0, 2);
}

$len2 = $ca_id_len + 2;
$len4 = $ca_id_len + 4;

$sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where ca_id like '$ca_id%' and length(ca_id) = $len2 and ca_use = '1' order by ca_order, ca_id ";
$result = sql_query($sql);
if ($result) $exists = true;

if ($exists) {
    // add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
    // add_stylesheet('<link rel="stylesheet" href="' . G5_SHOP_SKIN_URL . '/style.css">', 0);
?>

    <!-- 상품분류 1 시작 { -->
    <aside>
        <div class="flex justify-center items-center font-righteous text-lg text-primary mb-4">
            <?php
            while ($row = sql_fetch_array($result)) {
                $row2 = sql_fetch(" select count(*) as cnt from {$g5['g5_shop_item_table']} where (ca_id like '{$row['ca_id']}%' or ca_id2 like '{$row['ca_id']}%' or ca_id3 like '{$row['ca_id']}%') and it_use = '1'  ");
            ?>
                <a class="block mx-4 <?php if ($original_ca_id == $row['ca_id']) echo 'text-2xl'; ?>" href="<?php echo shop_category_url($row['ca_id']); ?>">
                    <?php echo $row['ca_name']; ?>
                </a>
            <?php } ?>
        </div>
    </aside>
    <!-- } 상품분류 1 끝 -->

<?php }
