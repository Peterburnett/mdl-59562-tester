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
 *  Tester plugin for MDL-66173 
 *
 * @package    tool_loginhooktester
 * @copyright  2019 Peter Burnett <peterburnett@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

// ========================================FORM HOOKS===============================================

function tool_loginhooktester_extend_change_password_form($mform, $user) {
    // Inject static text of the username passed to it
    $mform->addElement('static', 'injectedstatic', $user->username);

    // Inject text element to test validation
    $mform->addElement('text', 'injectedtext', get_string('extendform', 'tool_loginhooktester'));
    $mform->setType('injectedtext',  PARAM_TEXT);
}

function tool_loginhooktester_extend_forgot_password_form($mform) {
    // Inject text element to test validation
    $mform->addElement('header', 'searchbyusername', '', '');
    $mform->addElement('text', 'injectedtext', get_string('extendform', 'tool_loginhooktester'),'size="20"');
    $mform->setType('injectedtext',  PARAM_TEXT);
}

function tool_loginhooktester_extend_set_password_form($mform, $user) {
    // Inject static text of the username passed to it
    $mform->addElement('static', 'injectedstatic', $user->username);

    // Inject text element to test validation
    $mform->addElement('text', 'injectedtext', get_string('extendform', 'tool_loginhooktester'));
    $mform->setType('injectedtext',  PARAM_TEXT);
}

function tool_loginhooktester_extend_signup_form($mform) {
    // Inject text element to test validation
    $mform->addElement('text', 'injectedtext', get_string('extendform', 'tool_loginhooktester'));
    $mform->setType('injectedtext',  PARAM_TEXT);
}

// ========================================VALIDATION HOOKS=========================================

function tool_loginhooktester_validate_extend_change_password_form($data, $user) {
    $errors = array();
    if ($data['injectedtext'] != 'test') { 
        $errors['injectedtext'] = ('Input: '.$data['injectedtext'].', Username: '.$user->username);
        return $errors;
    } else {
        return $errors;
    }
}

function tool_loginhooktester_validate_extend_forgot_password_form($data) {
    $errors = array();
    if ($data['injectedtext'] != 'test') { 
        $errors['injectedtext'] = ('Input: '.$data['injectedtext']);
        return $errors;
    } else {
        return $errors;
    }
}

function tool_loginhooktester_validate_extend_set_password_form($data, $user) {
    $errors = array();
    if ($data['injectedtext'] != 'test') { 
        $errors['injectedtext'] = ('Input: '.$data['injectedtext'].', Username: '.$user->username);
        return $errors;
    } else {
        return $errors;
    }
}

function tool_loginhooktester_validate_extend_signup_form($data) {
    $errors = array();
    if ($data['injectedtext'] != 'test') { 
        $errors['injectedtext'] = ('Input: '.$data['injectedtext']);
        return $errors;
    } else {
        return $errors;
    }
}

function tool_loginhooktester_post_change_password_requests($data) {
    $message = ('post_change_password_request - Input: '.$data->injectedtext);
    echo "<script type='text/javascript'>alert('$message');</script>";
}

function tool_loginhooktester_post_set_password_requests($data) {
    $message = ('post_set_password_request - Input: '.$data->injectedtext);
    echo "<script type='text/javascript'>alert('$message');</script>";
    die;
}

function tool_loginhooktester_post_forgot_password_requests($data) {
    $message = ('post_forgot_password_request - Input: '.$data->injectedtext);
    echo "<script type='text/javascript'>alert('$message');</script>";
}

function tool_loginhooktester_post_signup_requests($data) {
    $message = ('post_signup_request - Input: '.$data->injectedtext);
    echo "<script type='text/javascript'>alert('$message');</script>";
}



