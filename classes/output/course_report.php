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
 * Report renderer file.
 *
 * @package   report_course_views
 * @copyright 2025 Fondation UNIT <contact@unit.eu>
 * @license   https://opensource.org/license/mit MIT
 */

namespace report_course_views\output;

defined('MOODLE_INTERNAL') || die();

use paging_bar;
use renderable;
use renderer_base;
use templatable;

class course_report implements renderable, templatable {
    /** @var array The array of records to display. */
    public array $records;

    /** @var paging_bar The pagingbar object. */
    public paging_bar $pagingbar;

    /**
     * Class constructor.
     *
     * @param array $records
     * @param paging_bar $pagingbar
     */
    public function __construct($records, $pagingbar) {
        $this->records = $records;
        $this->pagingbar = $pagingbar;
    }

    /**
     * Export this data for the mustache template (templates/course_report.mustache).
     *
     * @param renderer_base $output
     * @return \stdClass
     * @throws coding_exception
     * @throws moodle_exception
     */
    public function export_for_template(renderer_base $output) {
        $paginationhtml = $output->render($this->pagingbar);

        return [
            'items' => $this->records,
            'pagination' => $paginationhtml
        ];
    }
}
