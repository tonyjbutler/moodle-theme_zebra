<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * zebra theme general page layout
 *
 * @package    theme_zebra
 * @copyright  2011 Danny Wahl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$haslogininfo = (empty($PAGE->layout_options['nologininfo']));

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}

if (!empty($PAGE->theme->settings->headeralt)) {
    $headeralt = $PAGE->theme->settings->headeralt;
} else {
    $headeralt = $PAGE->heading;
}

if (!empty($PAGE->theme->settings->branding)) {
    $branding = $PAGE->theme->settings->branding;
} else {
    $branding = 0;
}

if (!empty($PAGE->theme->settings->userespond)) {
	$userespond = $PAGE->theme->settings->userespond;
} else {
	$userespond = 0;
}

if (!empty($PAGE->theme->settings->usecf)) {
	$usecf = $PAGE->theme->settings->usecf;
} else {
	$usecf = 0;
}

if (!empty($PAGE->theme->settings->cfmaxversion)) {
	$cfmaxversion = $PAGE->theme->settings->cfmaxversion;
} else {
	$cfmaxversion = 'ie6';
}

echo $OUTPUT->doctype(); ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
	<?php if ($usecf == 1) { ?><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><?php } ?>

    <title><?php echo $PAGE->title; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" type="image/png" href="<?php echo $OUTPUT->pix_url('favicon/favicon', 'theme'); ?>" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $OUTPUT->pix_url('favicon/h/apple-touch-icon-precomposed', 'theme'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $OUTPUT->pix_url('favicon/m/apple-touch-icon-precomposed', 'theme'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $OUTPUT->pix_url('favicon/l/apple-touch-icon-precomposed', 'theme'); ?>">
<?php echo $OUTPUT->standard_head_html(); ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
    <?php echo $OUTPUT->standard_top_of_body_html(); ?>
    <div id="page">
        <div id="page-inner-wrapper">
            <div id="page-header-wrapper">
                <div id="page-header" class="clearfix">
                    <h1 class="headermain"><?php echo $headeralt; ?></h1>
                    <div id="profileblock">
                        <?php if (isloggedin()) {
                            if ($haslogininfo) {
                                echo html_writer::tag('div', $OUTPUT->user_picture($USER, array('size'=>80)), array('id'=>'user-pic'));
                                echo $OUTPUT->login_info();
                            }
                            if (!empty($PAGE->layout_options['langmenu'])) {
                                echo $OUTPUT->lang_menu();
                            }
                            echo $PAGE->headingmenu;
                        } else {
                            echo $OUTPUT->login_info();
                        } ?>  
                    </div>
                </div>
                <div id="page-border-wrapper">
                    <?php if ($hascustommenu) { ?>
                        <div id="custommenu-wrapper">
                            <div id="custommenu"><?php echo $custommenu; ?></div>
                        </div>
                    <?php } ?>
                    <?php if ($hasnavbar) { ?>
                        <div id="navbar-wrapper">
                            <div class="navbar clearfix">
                                <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                                <div class="navbutton"> <?php echo $PAGE->button; ?></div>
                            </div>
                        </div>
                    <?php } ?>
                    <div id="page-content-wrapper">
                        <div id="page-content">
                            <div id="region-main-box">
                                <div id="region-post-box">
                                    <div id="region-main-wrap">
                                        <div id="region-main">
                                            <div class="region-content">
                                                <?php echo $OUTPUT->main_content(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($hassidepre) { ?>
                                        <div id="region-pre" class="block-region">
                                            <div class="region-content">
                                                <?php echo $OUTPUT->blocks_for_region('side-pre'); ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($hassidepost) { ?>
                                        <div id="region-post" class="block-region">
                                            <div class="region-content">
                                                <?php echo $OUTPUT->blocks_for_region('side-post'); ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($hasfooter) { ?>
                <div id="page-footer-wrapper">
                    <div id="page-footer">
                        <p class="helplink">
                            <?php echo page_doc_link(get_string('moodledocslink')); ?>
                        </p>
                        <?php echo $OUTPUT->login_info();
                        echo "<br />";
                        echo $OUTPUT->standard_footer_html();
                        if ($branding == 0) {
	                        echo '<div id="branding">';
	                        echo '<a href="http://ldichina.com"><img src="'.$OUTPUT->pix_url('footer/LDi', 'theme').'" alt="LDi China"></a>';
	                        echo '<a href="http://teachwithisc.com"><img src="'.$OUTPUT->pix_url('footer/iSC', 'theme').'" alt="International Schools of China"></a>';
	                        echo '<a href="http://tiseagles.com"><img src="'.$OUTPUT->pix_url('footer/TIS', 'theme').'" alt="Tianjin International School"></a>';
	                        echo '<a href="http://iyware.com"><img src="'.$OUTPUT->pix_url('footer/iyWare', 'theme').'" alt="iyWare.com"></a>';
	                        echo '</div>';
                        } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php if ($usecf == 1) {
		echo "using chrome frame";
		$ieversion = strpos($PAGE->bodyclasses, $cfmaxversion);
		if ($ieversion !== false) {
				echo "you are using IE!<br/>";
				echo "version " . $cfmaxversion . " " . $ieversion;
				$PAGE->requires->js(new moodle_url('http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js')); ?>
				<script>
					//<![CDATA[
					window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})
					//]]>
				</script>
		<?php } else { echo "you are not using IE<br/>Looking for version " . $cfmaxversion; }
	}

	if ($userespond == 1) {
		$usingie = strpos($PAGE->bodyclasses, 'ie ie');
		$usingie9 = strpos($PAGE->bodyclasses, 'ie9');
		echo "using respond";
		if ($usingie !== false) {
			echo "you are using IE!";
			$PAGE->requires->js('/theme/zebra/javascript/respond.js');
		} else { echo "you are not using IE or are using IE9"; }
	}

    echo $OUTPUT->standard_end_of_body_html(); ?>
</body>
</html>