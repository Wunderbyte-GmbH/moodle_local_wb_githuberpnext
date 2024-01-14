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
 * Shopping cart class to manage the shopping cart.
 *
 * @package local_wb_githuberpnext
 * @author Georg Maißer
 * @copyright 2024 Wunderbyte GmbH
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_wb_githuberpnext;

use dml_exception;
use stdClass;

/**
 * Class Github ERPNext
 *
 * @author Georg Maißer
 * @copyright 2024 Wunderbyte GmbH
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class task {

    /**
     * Create issue.
     * @param string $data
     * @return void
     * @throws dml_exception
     */
    public static function create(string $data) {
        global $DB;

        $jsonobject = json_decode($data);

        $DB->insert_record('local_wb_githuberpnext_tasks', [
            'identifier' => $jsonobject->issue->id ?? 'not found',
            'action' => $jsonobject->action ?? 'not found',
            'project' => $jsonobject->label->name ?? 'not found',
            'json' => $data,
        ]);
    }
}
