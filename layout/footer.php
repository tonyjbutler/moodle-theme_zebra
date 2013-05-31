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
 * zebra theme footer
 *
 * @package    theme_zebra
 * @copyright  2011 Danny Wahl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 		if (!empty($coursefooter)) { ?>
 			<div id="course-footer"><?php echo $coursefooter; ?></div>
 		<?php }
	    if ($hasfooter) { ?>
                <div id="page-footer-wrapper">
                    <div id="page-footer">
                        <p class="helplink">
                            <?php echo page_doc_link(get_string('moodledocslink')); ?>
                        </p>
                        <?php echo $OUTPUT->login_info();
                        echo $OUTPUT->home_link();
                        echo $OUTPUT->standard_footer_html();
                        if (!$showbranding) {
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
    <?php if ($requirescf) {
	$PAGE->requires->js(new moodle_url('http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js')); ?>
	<script type="text/javascript">
	    //<![CDATA[
		window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})
	    //]]>
	</script>
    <?php }
    if ($requiresrespond) {
		$PAGE->requires->js(new moodle_url('https://raw.github.com/scottjehl/Respond/master/respond.min.js'));
    }
    if ($usingios) { //Check if the user is using iOS and serve a JS to fix a viewport re-flow bug
		$PAGE->requires->js(new moodle_url('https://raw.github.com/scottjehl/iOS-Orientationchange-Fix/master/ios-orientationchange-fix.js'));
    }
    if ($hascustomjs) { //Check to see if we need to output some custom JS
		echo '<script type="text/javascript">//<![CDATA[' . "\r\n" . $customjs . "\r\n" . '//]]></script>';
    }
    echo $OUTPUT->standard_end_of_body_html(); ?>
</body>
</html>