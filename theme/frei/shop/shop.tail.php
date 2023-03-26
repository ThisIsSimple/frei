<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH . '/shop.tail.php');
    return;
}

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
</div> <!-- } .shop-content 끝 -->
</div> <!-- } #container 끝 -->
</div>
<!-- } 전체 콘텐츠 끝 -->

<!-- 하단 시작 { -->
<div id="footer" class="border-t-4 border-primary py-8 px-4 mx-8">
    <div class="grid grid-cols-1 md:grid-cols-[430px_1fr] gap-4 items-center text-sm text-primary">
        <div class="grid grid-cols-1 xs:grid-cols-[150px_1fr] gap-4 items-center">
            <div class="flex flex-col justify-center items-center xs:flex-none xs:items-start">
                <p><?php echo $default['de_admin_company_name']; ?></p>
                <p><?php echo $default['de_admin_company_addr']; ?></p>
                <p><?php echo $default['de_admin_company_tel']; ?></p>
                <p>instgram | homepage</p>
            </div>
            <div class="justify-self-center xs:justify-self-end md:justify-self-start text-right md:text-left grid grid-cols-2">
                <span class="mr-3">사업자등록번호</span> <?php echo $default['de_admin_company_saupja_no']; ?>
                <span class="mr-3">통신판매업신고번호</span> <?php echo $default['de_admin_tongsin_no']; ?>
                <!-- <p><span class="mr-3">개인정보 보호책임자</span> <?php echo $default['de_admin_info_name']; ?></p><br> -->
                <!-- <?php if ($default['de_admin_buga_no']) echo '<p><span class="mr-3">부가통신사업신고번호</span> ' . $default['de_admin_buga_no'] . '</p>'; ?> -->
                <span class="mr-3">대표</span> <?php echo $default['de_admin_company_owner']; ?>
            </div>
        </div>
        <div class="text-center xs:text-right">
            <div>
                <a href="<?php echo get_pretty_url('content', 'provision'); ?>">이용약관</a>
                <span class="mx-1">|</span><a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a>
            </div>
            <p id="ft_copy">Copyright &copy; 2023 <?php echo $default['de_admin_company_name']; ?>.</p>
            <p>All Rights Reserved.</p>
        </div>
    </div>
</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<!-- } 하단 끝 -->

<?php
include_once(G5_THEME_PATH . '/tail.sub.php');
