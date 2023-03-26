<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$q = isset($_GET['q']) ? clean_xss_tags($_GET['q'], 1, 1) : '';

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH . '/shop.head.php');
    return;
}

include_once(G5_THEME_PATH . '/head.sub.php');
include_once(G5_LIB_PATH . '/outlogin.lib.php');
include_once(G5_LIB_PATH . '/poll.lib.php');
include_once(G5_LIB_PATH . '/visit.lib.php');
include_once(G5_LIB_PATH . '/connect.lib.php');
include_once(G5_LIB_PATH . '/popular.lib.php');
include_once(G5_LIB_PATH . '/latest.lib.php');

?>

<nav class="text-xl font-['Righteous'] text-primary font-bold fixed top-0 left-0 right-0 bg-white bg-opacity-50 z-50 flex justify-between items-center px-4 py-3">
    <div class="flex items-center">
        <img id="frei-menu-button" src="/img/menu.png" class="w-12 h-12 mr-4 cursor-pointer" alt="menu" />

        <h1 class="text-4xl">
            <a href="<?php echo G5_SHOP_URL; ?>/">frei</a>
        </h1>
    </div>

    <div class="hidden sm:block">
        <?php include_once(G5_THEME_SHOP_PATH . '/category.php'); // 분류  
        ?>
    </div>

    <div class="hidden md:flex items-center">
        <?php if ($is_admin) {  ?>
            <div class="mr-4"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">admin</a></div>
        <?php }  ?>
        <?php if (!$is_member) { ?>
            <div class="mr-4"><a href="<?php echo G5_BBS_URL ?>/login.php?url=<?php echo $urlencode; ?>">login</a></div>
            <div class="mr-4"><a href="<?php echo G5_BBS_URL ?>/register.php">join</a></div>
        <?php }  ?>
        <?php
        if ($is_member) {
        ?>
            <a href="<?php echo G5_SHOP_URL ?>/mypage.php" class="mr-4">mypage</a>
            <a href="<?php echo G5_BBS_URL; ?>/logout.php" class="mr-4">logout</a>
        <?php
        }
        ?>
        <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><span class="sound_only">cart</span><span class="count">(<?php echo get_boxcart_datas_count(); ?>)</span></a>
    </div>
</nav>

<div class="h-[72px]"></div>

<div id="frei-menu" class="hidden animate__animated font-righteous text-primary fixed left-0 top-0 right-0 bottom-0 w-screen h-screen bg-white z-[60] p-10">
    <img id="frei-menu-close-button" src="/img/close-menu.svg" class="w-16 h-16 md:w-20 md:h-20 cursor-pointer absolute top-10 right-10" alt="닫기" />
    <div class="grid grid-cols-1 md:grid-cols-2 items-end gap-4">
        <div class="w-fit">
            <div class="border-b-2 border-primary py-3">
                <a href="/" class="block text-4xl md:text-6xl">frei roasters</a>
            </div>
            <div class="border-b-2 border-primary py-3 px-5">
                <a href="/" class="block text-3xl md:text-4xl">we're</a>
            </div>
            <div class="border-b-2 border-primary py-3 px-5">
                <a href="/shop/list.php?ca_id=10" class="block text-3xl md:text-4xl">shop</a>
            </div>
            <div class="border-b-2 border-primary py-3 px-5">
                <a href="/shop/list.php?ca_id=20" class="block text-3xl md:text-4xl">wholesale</a>
            </div>
            <div class="border-b-2 border-primary py-3 px-5">
                <a href="/shop/list.php?ca_id=1010" class="block text-3xl md:text-4xl">1f</a>
            </div>
            <div class="border-b-2 border-primary py-3 px-5">
                <a href="/shop/list.php?ca_id=1020" class="block text-3xl md:text-4xl">2f</a>
            </div>
            <div class="border-b-2 border-primary py-3 px-5">
                <a href="/shop/list.php?ca_id=1030" class="block text-3xl md:text-4xl">3f</a>
            </div>
            <div class="border-b-2 border-primary py-3 px-5">
                <a href="/shop/list.php?ca_id=1040" class="block text-3xl md:text-4xl">4f</a>
            </div>
        </div>

        <div class="h-full flex flex-col justify-end items-end">
            <div class="flex text-2xl items-center">
                <?php if ($is_admin) {  ?>
                    <div class="mr-4"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">admin</a></div>
                <?php }  ?>
                <?php if (!$is_member) { ?>
                    <div class="mr-4"><a href="<?php echo G5_BBS_URL ?>/login.php?url=<?php echo $urlencode; ?>">login</a></div>
                    <div class="mr-4"><a href="<?php echo G5_BBS_URL ?>/register.php">join</a></div>
                <?php }  ?>
                <?php
                if ($is_member) {
                ?>
                    <a href="<?php echo G5_SHOP_URL ?>/mypage.php" class="mr-4">mypage</a>
                    <a href="<?php echo G5_BBS_URL; ?>/logout.php">logout</a>
                <?php
                }
                ?>
                <div class="ml-3"><a href="<?php echo G5_SHOP_URL; ?>/cart.php">cart<span class="count">(<?php echo get_boxcart_datas_count(); ?>)</span></a></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#frei-menu-button').on('click', () => {
            $("#frei-menu").removeClass("animate__fadeInDown animate__fadeOutUp");
            $("#frei-menu").addClass("animate__fadeInDown")
            $('#frei-menu').removeClass("hidden")
        })
        $('#frei-menu-close-button').on('click', () => {
            $("#frei-menu").removeClass("animate__fadeInDown animate__fadeOutUp");
            $("#frei-menu").addClass("animate__fadeOutUp")
            setTimeout(() => {
                $('#frei-menu').addClass("hidden")
            }, [500])
        })
    })
</script>

<script>
    jQuery(function($) {
        $(".btn_member_mn").on("click", function() {
            $(".member_mn").toggle();
            $(".btn_member_mn").toggleClass("btn_member_mn_on");
        });

        var active_class = "btn_sm_on",
            side_btn_el = "#quick .btn_sm",
            quick_container = ".qk_con";

        $(document).on("click", side_btn_el, function(e) {
            e.preventDefault();

            var $this = $(this);

            if (!$this.hasClass(active_class)) {
                $(side_btn_el).removeClass(active_class);
                $this.addClass(active_class);
            }

            if ($this.hasClass("btn_sm_cl1")) {
                $(".side_mn_wr1").show();
            } else if ($this.hasClass("btn_sm_cl2")) {
                $(".side_mn_wr2").show();
            } else if ($this.hasClass("btn_sm_cl3")) {
                $(".side_mn_wr3").show();
            } else if ($this.hasClass("btn_sm_cl4")) {
                $(".side_mn_wr4").show();
            }
        }).on("click", ".con_close", function(e) {
            $(quick_container).hide();
            $(side_btn_el).removeClass(active_class);
        });

        $(document).mouseup(function(e) {
            var container = $(quick_container),
                mn_container = $(".shop_login");
            if (container.has(e.target).length === 0) {
                container.hide();
                $(side_btn_el).removeClass(active_class);
            }
            if (mn_container.has(e.target).length === 0) {
                $(".member_mn").hide();
                $(".btn_member_mn").removeClass("btn_member_mn_on");
            }
        });

        $("#top_btn").on("click", function() {
            $("html, body").animate({
                scrollTop: 0
            }, '500');
            return false;
        });
    });
</script>
<?php
$wrapper_class = array();
if (defined('G5_IS_COMMUNITY_PAGE') && G5_IS_COMMUNITY_PAGE) {
    $wrapper_class[] = 'is_community';
}
?>
<!-- 전체 콘텐츠 시작 { -->
<div id="wrapper" class="px-8">
    <!-- #container 시작 { -->
    <div id="container" class="relative">
        <!-- .shop-content 시작 { -->
        <div>
            <!-- <?php if ((!$bo_table || $w == 's') && !defined('_INDEX_')) { ?><div id="wrapper_title"><?php echo $g5['title'] ?></div><?php } ?> -->