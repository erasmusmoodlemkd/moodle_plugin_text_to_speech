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
 * Block for displaying open-dyslexic font on site
 *
 * @package    block_tts
 * @copyright  2016 onwards Éric Bugnet {@link http://eric.bugnet.fr/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Éric Bugnet
 */

defined('MOODLE_INTERNAL') || die();
/**
 * Displays block
 */
class block_tts extends block_base {


    public function init() {
        $this->title = get_string('pluginname', 'block_tts');
        $this->content_type = BLOCK_TYPE_TEXT;
    }


    public function instance_allow_multiple() {
        return false;
    }

    public function hide_header() {
        return false;
    }

    public function get_content() {
        global $CFG, $COURSE;

        if ($this->content !== null) {
            return $this->content;
        }

        // Include Javascript.
		//$this->page->requires->js('/blocks/sign_language/popup/js/jquery-modal-video.js');
		//$this->page->requires->js('/blocks/sign_language/jquery.tmpl.js');
		//$this->page->requires->css('/blocks/sign_language/popup/css/modal-video.min.css');
		//$this->page->requires->css('/blocks/sign_language/sign_language.css');
        $this->page->requires->js('/blocks/tts/tts.js');

        $this->content = new stdClass();

        $this->content->text = get_string("tts_intro", "block_tts");
		
		if (!isset($_COOKIE["tts"]) || $_COOKIE["tts"] == "false") {
			$this->content->text .= '<div align="center"><form>
            <input class="btn btn-sm btn-default" type="submit" onclick="setCookie(\'tts\', \'true\', 60);return false;" name="theme" value="'.get_string("enable", "block_sign_language").'" id="on">
            </form></div> ';
		} else if ($_COOKIE["tts"] == "true") {
			$this->content->text .= '<div align="center"><form>
            <input class="btn btn-sm btn-default" type="submit" onclick="setCookie(\'tts\', \'false\', 60);return false;" name="theme" value="'.get_string("disable", "block_sign_language").'" id="on">
            </form></div> ';
		}
		$this->content->text .= '<audio id="audio" muted preload="auto"></audio>';
		
        return $this->content;
    }
}
