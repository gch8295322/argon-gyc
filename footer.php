					<footer id="footer" class="site-footer card shadow-sm border-0">
						<?php
							echo get_option('argon_footer_html');
						?>
						<div>Theme <a href="https://github.com/solstice23/argon-theme" target="_blank"><strong>Argon</strong></a><?php if (get_option('argon_hide_footer_author') != 'true') {echo " By solstice23"; }?></div>
						<!--计时-->
						<?php require(__DIR__ . '/specialEffects/timeRAM.php'); ?>
					</footer>
				</main>
			</div>
		</div>
		<script src="<?php echo $GLOBALS['assets_path']; ?>/argontheme.js?v<?php echo $GLOBALS['theme_version']; ?>"></script>
		<?php if (get_option('argon_math_render') == 'mathjax3') { /*Mathjax V3*/?>
			<script>
				window.MathJax = {
					tex: {
						inlineMath: [["$", "$"], ["\\\\(", "\\\\)"]],
						displayMath: [['$$','$$']],
						processEscapes: true,
						packages: {'[+]': ['noerrors']}
					},
					options: {
						skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code'],
						ignoreHtmlClass: 'tex2jax_ignore',
						processHtmlClass: 'tex2jax_process'
					},
					loader: {
						load: ['[tex]/noerrors']
					}
				};
			</script>
			<script src="<?php echo get_option('argon_mathjax_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml-full.js' : get_option('argon_mathjax_cdn_url'); ?>" id="MathJax-script" async></script>
		<?php }?>
		<?php if (get_option('argon_math_render') == 'mathjax2') { /*Mathjax V2*/?>
			<script type="text/x-mathjax-config" id="mathjax_v2_script">
				MathJax.Hub.Config({
					messageStyle: "none",
					tex2jax: {
						inlineMath: [["$", "$"], ["\\\\(", "\\\\)"]],
						displayMath: [['$$','$$']],
						processEscapes: true,
						skipTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code']
					},
					menuSettings: {
						zoom: "Hover",
						zscale: "200%"
					},
					"HTML-CSS": {
						showMathMenu: "false"
					}
				});
			</script>
			<script src="<?php echo get_option('argon_mathjax_v2_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/mathjax@2.7.5/MathJax.js?config=TeX-AMS_HTML' : get_option('argon_mathjax_v2_cdn_url'); ?>"></script>
		<?php }?>
		<?php if (get_option('argon_math_render') == 'katex') { /*Katex*/?>
			<link rel="stylesheet" href="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>katex.min.css">
			<script src="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>katex.min.js"></script>
			<script src="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>contrib/auto-render.min.js"></script>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					renderMathInElement(document.body,{
						delimiters: [
							{left: "$$", right: "$$", display: true},
							{left: "$", right: "$", display: false},
							{left: "\\(", right: "\\)", display: false}
						]
					});
				});
			</script>
		<?php }?>

		<?php if (get_option('argon_enable_code_highlight') == 'true') { /*Highlight.js*/?>
			<link rel="stylesheet" href="<?php echo $GLOBALS['assets_path']; ?>/assets/vendor/highlight/styles/<?php echo get_option('argon_code_theme') == '' ? 'vs2015' : get_option('argon_code_theme'); ?>.css">
		<?php }?>

	</div>
</div>
<?php 
	wp_enqueue_script("argonjs", $GLOBALS['assets_path'] . "/assets/js/argon.min.js", null, $GLOBALS['theme_version'], true);
?>
<?php wp_footer(); ?>
<!--个人特效-->
<?php require(__DIR__ . '/specialEffects/common.php'); ?>

<!--看板娘-->
<script src="https://blog.gyc0219.com/wp-content/uploads/live2dyy/autoload.js"></script>
<!--音乐播放器-->
<link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/aplayer/dist/APlayer.min.css">
<script src="https://fastly.jsdelivr.net/npm/aplayer/dist/APlayer.min.js"></script>
<script src="https://fastly.jsdelivr.net/npm/meting@2.0.1/dist/Meting.min.js"></script>
<meting-js id="773598114" server="netease" type="playlist" theme="#339981" fixed="true" preload="auto" autoplay="false" loop="all" order="random" volume="0.3"></meting-js>
<!--歌词相关-->
<script>
function removelrc(){
    $(".aplayer.aplayer-fixed .aplayer-body").addClass("my-hide");
    //document.querySelector('meting-js').aplayer.lrc.hide();
    $(".aplayer.aplayer-fixed .aplayer-icon-lrc").addClass("aplayer-icon-lrc-inactivity");
    $(".aplayer.aplayer-fixed .aplayer-lrc").addClass("aplayer-lrc-hide");
    document.querySelector('meting-js').aplayer.on('play', function () {
            document.querySelector('meting-js').aplayer.lrc.show();
            $(".aplayer.aplayer-fixed .aplayer-icon-lrc").removeClass("aplayer-icon-lrc-inactivity");
    });
    document.querySelector('meting-js').aplayer.on('pause', function () {
            document.querySelector('meting-js').aplayer.lrc.hide();
            $(".aplayer.aplayer-fixed .aplayer-icon-lrc").addClass("aplayer-icon-lrc-inactivity");
    });
}
document.querySelector('meting-js').addEventListener("DOMNodeInserted",removelrc);
setTimeout(function() {
    document.querySelector('meting-js').removeEventListener("DOMNodeInserted",removelrc);
    //移除左侧栏切换时的监听事件防止页面刷新
    if($("#leftbar_tab_catalog_btn").length > 0){
        var el = document.getElementById('leftbar_tab_catalog_btn'),elClone = el.cloneNode(true);
        el.parentNode.replaceChild(elClone, el);
    }
    var el = document.getElementById('leftbar_tab_overview_btn'),elClone = el.cloneNode(true);
    el.parentNode.replaceChild(elClone, el);
    var el = document.getElementById('leftbar_tab_tools_btn'),elClone = el.cloneNode(true);
    el.parentNode.replaceChild(elClone, el);
}, 5000);
</script>

</body>

<?php echo get_option('argon_custom_html_foot'); ?>

</html>
