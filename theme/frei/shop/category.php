<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function get_mshop_category($ca_id, $len)
{
    global $g5;

    $sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']}
                where ca_use = '1' ";
    if ($ca_id)
        $sql .= " and ca_id like '$ca_id%' ";
    $sql .= " and length(ca_id) = '$len' order by ca_order, ca_id ";

    return $sql;
}

$mshop_categories = get_shop_category_array(true);
?>
<div class="flex">
    <?php
    $i = 0;
    foreach ($mshop_categories as $cate1) {
        if (empty($cate1)) continue;

        $mshop_ca_row1 = $cate1['text'];
    ?>
        <div class="mx-3">
            <a href="<?php echo $mshop_ca_row1['url']; ?>" class="cate_div_1_a"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
            <?php
            $j = 0;
            ?>
        </div>
    <?php
        $i++;
    }   // end for
    ?>
</div>