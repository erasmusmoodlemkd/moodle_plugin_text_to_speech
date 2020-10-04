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
 * Dyslexic mod view page
 *
 * @package    block_dyslexic
 * @copyright  2016 onwards Éric Bugnet {@link http://eric.bugnet.fr/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Éric Bugnet
 */

require_once('../../config.php');
global $CFG, $USER, $COURSE, $DB, $PAGE;

$courseid = required_param('courseid', PARAM_INT);
$blockinstanceid = required_param('blockid', PARAM_INT);
$context = context_block::instance($blockinstanceid);
$anim = optional_param('anim', 1, PARAM_INT);

if (! $course = $DB->get_record('course', array("id" => $courseid))) {
    print_error(get_string('invalidcourse', 'block_tts', $courseid));
}

require_login($course);


$PAGE->set_url('/blocks/tts/view.php', array('courseid' => $courseid, 'blockid' => $blockinstanceid));
$PAGE->set_title(get_string('pluginname', 'block_tts'));
$PAGE->set_heading(get_string('pluginname', 'block_tts'));
$PAGE->set_pagelayout('standard');
$PAGE->navbar->add('<a href="'.$CFG->wwwroot.'/course/view.php?id='.$courseid.'"></a>
                        <a href="'.$CFG->wwwroot.'/blocks/tts/view.php?courseid='.$courseid.'&blockid='.
                        $blockinstanceid.'">'.get_string('pluginname', 'block_tts').'</a>');
$PAGE->requires->jquery();

echo $OUTPUT->header();


if ($anim != 0) {
    echo '<script type="text/javascript" src="tts.js"></script>';
    echo '<h2>'.get_string('moving_title', 'block_dyslexic').'</h2>';
    echo ''.get_string('moving_description', 'block_dyslexic').'</br>';
    echo '<a href="'.$PAGE->url.'&anim=0" >'.get_string('script_off', 'block_tts').'</a>';
} else {
    echo '<a href="'.$PAGE->url.'&anim=1" >'.get_string('script_on', 'block_tts').'</a>';
}



echo '<h2>'.get_string('howto_title', 'block_tts').'</h2>';
echo '<p>'.get_string('howto_description', 'block_tts').'</p>';
echo '<p><a href="http://opendyslexic.org/" target="_blank">'.get_string('link', 'block_dyslexic').'</a></p>';
echo '<p>'.get_string('script_info', 'block_dyslexic');
echo '<a href="https://geon.github.io/programming/2016/03/03/dsxyliea" target="_blank">https://geon.github.io/programming/2016/03/03/dsxyliea</a></p></br>';
echo '<h2>'.get_string('info', 'block_tts').'</h2>';
echo '<p>'.get_string('wikipedia_title', 'block_tts').' → ';
echo '<a href="'.get_string('wikipedia_url', 'block_dyslexic').'" target="_blank">'.get_string('wikipedia_url', 'block_tts').'</a></p></br>';

echo '<p>'.get_string('wikipedia_description', 'block_tts').'</p>';

echo $OUTPUT->footer();
